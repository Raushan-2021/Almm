<?php

namespace App\Http\Controllers\Backend\Localbody;

use App\Models\State;
use App\Models\Program;
use App\Models\Consumer;
use App\Models\District;
use App\Models\Inspector;
use App\Models\Installer;
use App\Models\SubDistrict;
use App\Models\Installation;
use App\Models\InstallationReviewLog;
use App\Models\BiogasModel;
use App\Models\InstallationCapacity;
use App\Models\LocalbodyUser;
use App\Models\Inspection;
use App\Models\StateImplementingAgencyUser;
use App\Models\MaintenanceRegistry;
use App\Models\SiaInspectorAssociation;
use App\Models\SiaInstallerAssociation;
use App\Traits\General;
use Illuminate\Http\Request;
use App\Utils\Dictionary;
use App\Utils\Dashboard;
use App\Http\Controllers\Controller;
use URL, Auth, Hash, Config;

class MainController extends Controller
{
    use General;
    public function __construct()
    {}

    public function index()
    {
        $dashboard = new Dashboard();
        $data = $dashboard->getLocalBodyDashboardData();
        return view('backend.localbody.dashboard', compact('data'));
    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();
        $states = State::all();
        if($request->isMethod('get')){
            return view('backend.localbody.editProfile', compact('user', 'states'));
        }

        $user->state_id = $request->state_id;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->contact_person = $request->contact_person;
        $user->nodal = $request->nodal;
        $user->agency_type = $request->agency_type;
        $user->superior_agency = $request->superior_agency;
        $user->address = $request->address;
        $user->short_info = $request->short_info;
        $isSaved = $user->save();
        if($isSaved){
            return redirect()->back()->with("status","Profile edited successfully !");
        }
    }

    public function changePassword(Request $request)
    {
        if($request->isMethod('get')){
            $submitUrl = URL::to('/localbody/change-password');
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

    public function installerList(Request $request)
    {
        $state = NULL; $status = NULL; $filters=[];
        if($request->isMethod('post')){
            if(!empty($request->filter['state'])) $state = $request->filter['state'];
            if(!empty($request->filter['status'])) $status = $request->filter['status'];
            $filters = $request->filter;
        }
        $installers = Installer::getAll($state, $status);
        $states = State::all();
        return view('backend.common.installerList', compact('installers', 'states', 'filters'));
    }

    public function installerDetail(Request $request, $id)
    {
        $id = base64_decode($id);
        $installer = Installer::getById(null, $id);

        $programs = Program::all();
        $states = State::all();
        $editable = 'disabled';
        return view('backend.mnre.createInstaller', compact('installer', 'programs', 'states', 'editable'));
    }

    public function inspectorList(Request $request)
    {
        $status = NULL; $filters=[];
        if($request->isMethod('post')){
            if(!empty($request->filter['status'])) $status = $request->filter['status'];
            $filters = $request->filter;
        }
        $states = State::all();
        $inspectors = Inspector::getAll(Auth::user()->state_id, $status);
        return view('backend.common.inspectorList', compact('inspectors','states','filters'));
    }

    public function inspectorDetail(Request $request, $id)
    {
        $id = base64_decode($id);
        $inspector = Inspector::getById(null, $id);

        $programs = Program::all();
        $states = State::all();
        $editable = 'disabled';
        return view('backend.mnre.createInspector', compact('inspector', 'programs', 'states', 'editable'));
    }

    public function consumerList()
    {
        $consumers = Consumer::getAll(Auth::user()->state_id);
        return view('backend.common.consumerList', compact('consumers'));
    }

    public function consumerDetail(Request $request, $id)
    {
        $id = base64_decode($id);
        $consumer = Consumer::getById(null, null, $id);
        $consumer['number_of_cattle'] = json_decode($consumer['number_of_cattle'], true);
        $editable = 'disabled';
        return view('backend.common.consumerDetail', compact('consumer', 'editable'));
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
        $installations = Installation::getInstallationListing(Auth::user()->state_id, null, null, $priority, $status);
        $dictionaryHelper = new Dictionary();
        $states = State::All();
        $priorities = $dictionaryHelper->transformArrayToDictionary(Config::get('constants.priority'));
        return view('backend.common.systems', compact('installations','priorities','states','filters'));
    }

    public function addEditSystem(Request $request, $id)
    {
        $dictionaryHelper = new Dictionary();
        $id = base64_decode($id);
        if($request->isMethod('get')){
            $installation = Installation::getInstallation($id);
            $logs = InstallationReviewLog::getLogs($installation->id);

            $editable = 'disabled';
            $editableInspector = 'disabled';
            $sub_districts = SubDistrict::all();
            $biogasModels = BiogasModel::getAllBiogasModels();
            $installationCapacities = InstallationCapacity::getAllInstallationCapacities();
            $categories = $dictionaryHelper->transformArrayToDictionary(Config::get('constants.categories'));
            $inspectors = Inspector::getAll();
            $documentCodes = Config::get('constants.documentCodes');
            $slurry_types = Config::get('constants.slurries');
            return view('backend.common.createSystem', compact('installation','inspectors','sub_districts','editable',
                                                                'editableInspector','logs','biogasModels','installationCapacities',
                                                                'categories','documentCodes','slurry_types'));
        }
    }

    public function systemMaintenance(Request $request)
    {
        try{
            $maintenanceSystems = MaintenanceRegistry::getMaintenanceSystems(null, null, Auth::user()->state_id);
            $states = State::All();
            return view('backend.common.maintenance', compact('maintenanceSystems','states'));
        }
        catch(\Exception $e){
            return redirect()->back()->with("error","Server error !");
        }
    }

    public function maintenanceRecords(Request $request, $id)
    {
        $id = base64_decode($id);
        try {
            if($request->isMethod('get')){
                $maintenanceRecords = MaintenanceRegistry::getMaintenanceBySystemId($id);
                $systemId = $id;
                return view('backend.common.maintenanceRecords', compact('maintenanceRecords', 'systemId'));
            }

            MaintenanceRegistry::createONMRegistry($id, $request->type, $request->date, $request->note);
            return redirect()->back()->with("status","Maintenance requested successfully !");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error","Server error !");
        }
    }

    public function maintenanceRecordDetail(Request $request, $id)
    {
        $id = base64_decode($id);
        $record = MaintenanceRegistry::getMaintenanceById($id);
        $record->images = json_decode($record->images);
        try {
            if($request->isMethod('get')){
                $editable = 'disabled';
                return view('backend.common.maintenanceRegistry', compact('record', 'editable'));
            }

            $dir_path = 'documents\\systems\\'.$record->consumer_code.'\\maintenance\\'.$record->maintenance_code.'\\';
            Storage::disk('filestore')->makeDirectory($dir_path);
            $pictures = array();
            if(!empty($request->hasFile('images'))){
                $files = $request->file('images');
                foreach($files as $file){
                    $result = $this->uploadFile($file, $dir_path);
                    array_push($pictures, $result);
                }
            }

            $record->update([
                'images' => json_encode($pictures),
                'description' => $request->description,
                'status' => 1
            ]);

            return redirect()->back()->with("status","System maintenance complete !");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error","Server error !");
        }
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
