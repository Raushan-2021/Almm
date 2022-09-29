<?php

namespace App\Http\Controllers\Backend\Inspector;

use Illuminate\Http\Request;
use App\Models\State;
use App\Traits\General;
use App\Models\Consumer;
use App\Models\Inspection;
use App\Models\SubDistrict;
use App\Models\Installation;
use App\Models\BiogasModel;
use App\Models\InstallationCapacity;
use App\Models\InstallationReviewLog;
use App\Http\Controllers\Controller;
use App\Utils\Dictionary;
use App\Utils\FormValidator;
use App\Utils\Dashboard;
use App\Utils\EmailSmsNotifications;

use DB, URL, Auth, Hash, Storage, Config, Gate;

class MainController extends Controller
{
    use General;

    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }

    public function index()
    {
        $dashboard = new Dashboard();
        $data = $dashboard->getInspectorDashboardData();
        return view('backend.inspector.dashboard', compact('data'));
    }

    public function systems(Request $request)
    {
        $state = NULL; $priority = NULL; $status = NULL; $filters=[];
        if($request->isMethod('post')){
            if($request->filter['priority'] != 'All'){
                if(!empty($request->filter['priority'])) $priority = $request->filter['priority'];
                $filters = $request->filter;
            }
            if($request->filter['status'] != '0'){
                if(!empty($request->filter['status'])) $status = $request->filter['status'];
                $filters = $request->filter;
            }
        }
        $installations = Installation::getInstallationListing(null, null, Auth::id(), $priority, $status);
        $states = State::All();
        $dictionaryHelper = new Dictionary();
        $priorities = $dictionaryHelper->transformArrayToDictionary(Config::get('constants.priority'));
        return view('backend.common.systems', compact('installations','priorities','states','filters'));
    }

    public function addEditSystem(Request $request, $id)
    {
        $dictionaryHelper = new Dictionary();
        $id = base64_decode($id);
        if($request->isMethod('get')){
            $installation = Installation::getInstallation($id);
            if(Gate::denies('inspectorSystem', $installation)){ abort(403); }

            $logs = InstallationReviewLog::getLogs($installation->id);
            $editableInspector = in_array($installation->installation_status, [5, 7]) ? '' : 'disabled';
            $editable = 'disabled';
            $sub_districts = SubDistrict::all();
            $biogasModels = BiogasModel::getAllBiogasModels();
            $installationCapacities = InstallationCapacity::getAllInstallationCapacities();
            $categories = $dictionaryHelper->transformArrayToDictionary(Config::get('constants.categories'));
            $documentCodes = Config::get('constants.documentCodes');
            $slurry_types = Config::get('constants.slurries');
            return view('backend.inspector.system', compact('installation','sub_districts','editableInspector','logs','biogasModels','installationCapacities','categories','documentCodes','editable','slurry_types'));
        }
    }

    public function updateInspection(Request $request, $id)
    {
        $id = base64_decode($id);
        try {
            $installation = Installation::where('id', $id)->first();

            $validator = new FormValidator();
            if(!$validator->validateInspectionForm($request))
                return redirect()->back()->with('error', 'Some of the uploaded documents are not valid!');

            $updateArray = [
                'date' => !empty($request->date) ? date("Y-m-d", strtotime($request->date)) : NULL,
                'appropriate_location' => $request->appropriate_location,
                'beneficiary_feeding_plant' => $request->beneficiary_feeding_plant,
                'biogas_production_optimum_level' => $request->biogas_production_optimum_level,
                'plant_connected_to_pipeline' => $request->plant_connected_to_pipeline,
                'biogas_used_at_kitchen' => $request->biogas_used_at_kitchen,
                'optimum_quantity_of_biogas_slurry_produced' => $request->optimum_quantity_of_biogas_slurry_produced,
                'slurry_used_for_agriculture_business' => $request->slurry_used_for_agriculture_business,
                'recommendations' => $request->recommendations,
                'approval' => $request->approval
            ];

            $dir_path = 'systems\\'.$request->consumerId.'\\inspection\\';
            Storage::disk('filestore')->makeDirectory($dir_path);

            if($request->hasFile('pic_of_plant_with_family_member')){
                $updateArray['pic_of_plant_with_family_member'] = json_encode($this->uploadFile($request->file('pic_of_plant_with_family_member'), $dir_path));
            }
            if($request->hasFile('pic_of_stove_with_flame')){
                $updateArray['pic_of_stove_with_flame'] = json_encode($this->uploadFile($request->file('pic_of_stove_with_flame'), $dir_path));
            }

            if(empty($request->inspection_id))
                $updateArray['inspection_id'] = $this->generateIdForStakeholders('INS', $request->state_id);

            if($request->approval == 1){
                $updateArray['approval_date'] = date('Y-m-d');
            }
            Inspection::where('id', $id)->update($updateArray);
            Installation::where('id', $request->systemId)->update(['installation_status' => $request->approval == 1 ? 8 : 9]);
            if($request->approval == 0){
                InstallationReviewLog::insert([
                    'installation_id' => $request->systemId,
                    'review_type' => 'I',
                    'review_action' => 'MD',
                    'docs' => json_encode([]),
                    'review' => $request->corrections,
                    'created_by' => Auth::id(),
                ]);
                $this->emailSmsNotifications->notifyInspectionFeedback($request->systemId, $request->corrections);
            }
            else
                $this->emailSmsNotifications->notifyInspectionApproval($request->systemId);

            return redirect('inspector/systems')->with('status', 'Inspection completed!');
        } 
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Server error!');
        }
    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();
        $states = State::all();
        if($request->isMethod('get')){
            return view('backend.inspector.editProfile', compact('user', 'states'));
        }

        $user->state_id = $request->state_id;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $isSaved = $user->save();
        if($isSaved){
            return redirect()->back()->with("status","Profile edited successfully !");
        }
    }

    public function changePassword(Request $request)
    {
        if($request->isMethod('get')){
            $submitUrl = URL::to('/inspector/change-password');
            return view('backend.common.changePassword', compact('submitUrl'));
        }

        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(!$this->passwordPolicyTest($request->new_password)){
            $error = 'Failed strong password policy!';
            return redirect()->back()->with("error", $error);
        }

        if(strcmp($request->current_password, $request->new_password) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with("status","Password changed successfully !");
    }

    public function previewDocs($consumerId, $folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'systems/'.base64_decode($consumerId).'/'.base64_decode($folder);
        $filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }

    public function downloadDoc($consumerId, $folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'systems/'.base64_decode($consumerId).'/'.base64_decode($folder);
        $filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return Storage::disk('filestore')->download($filePath);
    }
}