<?php

namespace App\Http\Controllers\Backend\Installer;

use App\Models\State;
use App\Traits\General;
use App\Models\Consumer;
use App\Models\SubDistrict;
use App\Models\Installation;
use App\Models\InstallationReviewLog;
use App\Models\BiogasModel;
use App\Models\InstallationCapacity;
use App\Models\MaintenanceRegistry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Dictionary;
use App\Utils\Dashboard;
use App\Utils\FormValidator;

use DB, URL, Auth, Hash, Storage, Config, Gate;

class MainController extends Controller
{
    use General;

    public function __construct()
    {}

    public function index()
    {
        $dashboard = new Dashboard();
        $data = $dashboard->getInstallerDashboardData();
        return view('backend.installer.dashboard', compact('data'));
    }

    public function consumerInterestForm(Request $request)
    {
        if($request->isMethod('get')){
            $sub_districts = SubDistrict::all();
            return view('backend.common.consumerDetail', compact('sub_districts'));
        }

        try {
            $consumer = new Consumer();
            $consumer->consumer_id = $this->generateIdForStakeholders('CON', $request->state_id);
            $consumer->installer_id = Auth::id();
            $consumer->name = $request->name;
            $consumer->house_no = $request->house_no;
            $consumer->village = $request->village;
            $consumer->post = $request->post;
            $consumer->block = $request->block;
            $consumer->panchayat = $request->panchayat;
            $consumer->ward_no = $request->ward_no;
            $consumer->sub_district_id = $request->sub_district_id;
            $consumer->district_id = $request->district_id;
            $consumer->state_id = $request->state_id;
            $consumer->phone = $request->phone;
            $consumer->aadhar_no = base64_encode($request->aadhar_no);
            $consumer->email = $request->email;
            $consumer->category = $request->category;
            $consumer->number_of_cattle = json_encode($request->cattles);
            $consumer->toilet_linked = $request->toilet_linked;
            $consumer->existing_biogas_plant = $request->existing_biogas_plant;
            $consumer->subsidy_availed = $request->subsidy_availed;
            $consumer->comment = $request->comment;
            $isSaved = $consumer->save();
            if($isSaved){
                return redirect()->back()->with("status", "Consumer have registered successfully, We will contact you soon !");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error","Server Error !");
        }
    }

    public function systems(Request $request)
    {
        $state = NULL; $priority = NULL; $status = NULL; $filters=[];
        if($request->isMethod('post')){
            if($request->filter['state'] != 'All'){
                if(!empty($request->filter['state'])) $state = $request->filter['state'];
                $filters = $request->filter;
            }
            if($request->filter['priority'] != 'All'){
                if(!empty($request->filter['priority'])) $priority = $request->filter['priority'];
                $filters = $request->filter;
            }
            if($request->filter['status'] != '0'){
                if(!empty($request->filter['status'])) $status = $request->filter['status'];
                $filters = $request->filter;
            }
        }
        $installations = Installation::getInstallationListing($state, Auth::id(), NULL, $priority, $status);
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
            if(Gate::denies('installerInstallations', $installation)){ abort(403); }

            $logs = InstallationReviewLog::getLogs($installation->id);
            $editable = in_array($installation->installation_status, [2, 3, 6, 9]) ? '' : 'disabled';
            $sub_districts = SubDistrict::all();
            $biogasModels = BiogasModel::getAllBiogasModels();
            $installationCapacities = InstallationCapacity::getAllInstallationCapacities();
            $categories = $dictionaryHelper->transformArrayToDictionary(Config::get('constants.categories'));
            $documentCodes = Config::get('constants.documentCodes');
            return view('backend.installer.system', compact('installation','sub_districts','editable','logs','categories','biogasModels','installationCapacities','documentCodes'));
        }
        elseif($request->isMethod('post')){
            try {
                $installation = Installation::where('id', $request->systemId)->first();
                $validator = new FormValidator();
                if(!$validator->validateInstallationForm($request, empty($installation->bpmr_no) ? true : false))
                    return redirect()->back()->with('error', 'Some of the uploaded documents are not valid!');

                $documents = $this->uploadDocuments($request, json_decode($installation->documents, true));
                $documents = json_encode($documents);
                $updateArray = ['documents' => $documents];
                if(empty($installation->bpmr_no))
                    $updateArray['bpmr_no'] = $this->generateIdForStakeholders('SYS', $request->state_id);

                $updateArray['installation_status'] = !empty($installation->inspector_id) ? 7 : 4;
                
                Installation::where('id', $request->systemId)->update($updateArray);
                return redirect(url('/'.Auth::getDefaultDriver().'/systems'))->with('status', 'System installation data updated!');
            }
            catch (\Exception $e) {
                return redirect()->back()->with('error', 'Server error!');
            }
        }
    }

    protected function uploadDocuments($request, $docs)
    {
        $dir_path = 'systems\\'.$request->consumerId.'\\installation\\';
        Storage::disk('filestore')->makeDirectory($dir_path);
        if(empty($docs)) { $docs = []; }

        if($request->hasFile('pictures.installer_pic')){
            $docs['installer_pic'] = $this->uploadFile($request->file('pictures.installer_pic'), $dir_path);
        }
        if($request->hasFile('pictures.owner_pic')){
            $docs['owner_pic'] = $this->uploadFile($request->file('pictures.owner_pic'), $dir_path);
        }
        if($request->hasFile('pictures.site_before_installation_pic')){
            $docs['site_before_installation_pic'] = $this->uploadFile($request->file('pictures.site_before_installation_pic'), $dir_path);
        }
        if($request->hasFile('pictures.under_const_bio_plant')){
            $docs['under_const_bio_plant'] = $this->uploadFile($request->file('pictures.under_const_bio_plant'), $dir_path);
        }
        if($request->hasFile('pictures.bio_plant_with_beneficiary')){
            $docs['bio_plant_with_beneficiary'] = $this->uploadFile($request->file('pictures.bio_plant_with_beneficiary'), $dir_path);
        }
        if($request->hasFile('pictures.stove_pic')){
            $docs['stove_pic'] = $this->uploadFile($request->file('pictures.stove_pic'), $dir_path);
        }
        if($request->hasFile('pictures.h_s_training_statement_pic')){
            $docs['h_s_training_statement_pic'] = $this->uploadFile($request->file('pictures.h_s_training_statement_pic'), $dir_path);
        }
        if($request->hasFile('pictures.linked_toilet_photo')){
            $docs['linked_toilet_photo'] = $this->uploadFile($request->file('pictures.linked_toilet_photo'), $dir_path);
        }
        if($request->hasFile('pictures.agreement_copy')){
            $docs['agreement_copy'] = $this->uploadFile($request->file('pictures.agreement_copy'), $dir_path);
        }
        return $docs;
    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();
        $states = State::all();
        if($request->isMethod('get')){
            return view('backend.installer.editProfile', compact('user', 'states'));
        }

        $user->state_id = $request->state_id;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->contact_person = $request->contact_person;
        $user->address = $request->address;
        $user->pincode = $request->pincode;
        $user->category = $request->category;
        $user->short_info = $request->short_info;
        $isSaved = $user->save();
        if($isSaved){
            return redirect()->back()->with("status","Profile edited successfully !");
        }
    }

    public function changePassword(Request $request)
    {
        if($request->isMethod('get')){
            $submitUrl = URL::to('installer/change-password');
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

    public function systemMaintenance(Request $request)
    {
        try{
            $state = NULL; $filters=[];
            if($request->isMethod('post')){
                if(!empty($request->filter['state']) && $request->filter['state'] != 'All') $state = $request->filter['state'];
                $filters = $request->filter;
            }
            $maintenanceSystems = MaintenanceRegistry::getMaintenanceSystems(Auth::id(), null, $state);
            $states = State::All();
            return view('backend.common.maintenance', compact('maintenanceSystems','states','filters'));
        }
        catch(\Exception $e){
            return redirect()->back()->with("error","Server error!");
        }
    }

    public function maintenanceRecords(Request $request, $id)
    {
        $id = base64_decode($id);
        $installation = Installation::where('id', $id)->first();
        if(Gate::denies('installerInstallations', $installation)){ abort(403); }
        try {
            if($request->isMethod('get')){
                $maintenanceRecords = MaintenanceRegistry::getMaintenanceBySystemId($id);
                $systemId = $id;
                return view('backend.common.maintenanceRecords', compact('maintenanceRecords', 'systemId'));
            }

            MaintenanceRegistry::createONMRegistry($id, $request->type, $request->date, $request->note);
            return redirect()->back()->with("status","Maintenance requested successfully !");
        } 
        catch (\Exception $e) {
            return redirect()->back()->with("error","Server error !");
        }
    }

    public function maintenanceRecordDetail(Request $request, $id)
    {
        $id = base64_decode($id);
        $record = MaintenanceRegistry::getMaintenanceById($id);
        if(Gate::denies('installerMaintenance', $record)){ abort(403); }

        $record->images = json_decode($record->images);
        try {
            if($request->isMethod('get')){
                $editable = $record->status == 1 ? 'disabled' : '';
                return view('backend.common.maintenanceRegistry', compact('record', 'editable'));
            }

            $registryCode = MaintenanceRegistry::generateCode($record->state_code, 'MREG');

            $dir_path = 'systems\\'.$record->consumer_code.'\\maintenance\\'.$registryCode.'\\';
            Storage::disk('filestore')->makeDirectory($dir_path);
            $pictures = array();
            if(!empty($request->hasFile('images'))){
                $files = $request->file('images');
                foreach($files as $file){
                    $result = $this->uploadFile($file, $dir_path);
                    array_push($pictures, $result);
                }
            }
            MaintenanceRegistry::where('id',$id)->update([
                'maintenance_code' => $registryCode,
                'images' => json_encode($pictures),
                'maintenance_date' => date('Y-m-d', strtotime($request->maintenance_date)),
                'description' => $request->description,
                'status' => 1
            ]);

            return redirect()->back()->with("status","System maintenance complete!");
        } 
        catch (\Throwable $th) {
            return redirect()->back()->with("error","Server error!");
        }
    }
}
