<?php

namespace App\Http\Controllers\Backend\SIA;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Program;
use App\Traits\General;
use App\Models\Consumer;
use App\Models\District;
use App\Models\Inspector;
use App\Models\Installer;
use App\Models\SubDistrict;
use App\Models\Installation;
use App\Models\AuditTrail;
use App\Models\InstallationReviewLog;
use App\Models\BiogasModel;
use App\Models\InstallationCapacity;
use App\Models\LocalbodyUser;
use App\Models\Inspection;
use App\Models\StateImplementingAgencyUser;
use App\Models\MaintenanceRegistry;
use App\Models\SiaInspectorAssociation;
use App\Models\SiaInstallerAssociation;
use App\Http\Controllers\Controller;
use App\Utils\Dictionary;
use App\Utils\Dashboard;
use App\Utils\FormValidator;
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
        $data = $dashboard->getSIADashboardData();
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'1','description'=>'User viewed Dashboard  ','user_type'=>'2');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.state-implementing-agency.dashboard', compact('data'));
    }

    public function localbodyList(Request $request)
    {
        $localbodyUsers = LocalbodyUser::getAll(Auth::user()->state_id);
        return view('backend.common.localbodyList', compact('localbodyUsers'));
    }

    public function localbodyDetail(Request $request, $id)
    {
        $id = base64_decode($id);
        $localbodyUser = LocalbodyUser::getById(null, $id);
        if(Gate::denies('localbodydetail', $localbodyUser)){ abort(403); }

        $stateImplementingAgencyUsers = StateImplementingAgencyUser::getAll();
        $programs = Program::all();
        $states = State::all();
        $editable = 'disabled';
        return view('backend.mnre.createLocalbody', compact('localbodyUser', 'stateImplementingAgencyUsers', 'programs', 'states', 'editable'));
    }

    public function localbodyEdit(Request $request, $id)
    {
        $id = base64_decode($id);
        $localbodyUser = LocalbodyUser::getById(null, $id);
        if(Gate::denies('localbodydetail', $localbodyUser)){ abort(403); }

        $stateImplementingAgencyUsers = StateImplementingAgencyUser::getAll();
        $programs = Program::all();
        $states = State::all();
        return view('backend.mnre.createLocalbody', compact('localbodyUser', 'stateImplementingAgencyUsers', 'programs', 'states'));
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

    public function installerEdit(Request $request, $id)
    {
        $id = base64_decode($id);
        $installer = Installer::getById(null, $id);
        if(Gate::denies('installerdetail', $installer)){ abort(403); }

        $programs = Program::all();
        $states = State::all();
        $editable = 'disabled';
        return view('backend.mnre.createInstaller', compact('installer', 'programs', 'states','editable'));
    }

    public function installerAssociation($id)
    {
        $id = base64_decode($id);
        try {
            SiaInstallerAssociation::insert(['state_implementing_agency_user_id' => Auth::id(),'installer_id' => $id, 'status' => 1]);
            $this->emailSmsNotifications->notifyInstallerAssociation(Auth::id(), $id);
            return redirect()->back()->with("status","Installers Associated successfully !");
        } 
        catch (\Exception $e) {
            return redirect()->back()->with("error","Server Error !");
        }
    }

    public function installerBlacklist(Request $request, $id)
    {
        $id = base64_decode($id);
        try {
            SiaInstallerAssociation::where([['state_implementing_agency_user_id', Auth::id()],['installer_id', $id]])
                                    ->update(['status' => $request->blacklist]);
            
            if($request->blacklist == '1')
                return redirect()->back()->with("status","Installer blacklisted successfully !");

            return redirect()->back()->with("status","Installer removed from blacklist successfully !");
        } 
        catch (\Throwable $th) {
            return redirect()->back()->with("error","Server error !");
        }
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
        if(Gate::denies('inspectordetail', $inspector)){ abort(403); }

        $programs = Program::all();
        $states = State::all();
        $editable = 'disabled';
        return view('backend.mnre.createInspector', compact('inspector', 'programs', 'states', 'editable'));
    }

    public function inspectorEdit(Request $request, $id)
    {
        $id = base64_decode($id);
        $inspector = Inspector::getById(null, $id);
        if(Gate::denies('inspectordetail', $inspector)){ abort(403); }

        $programs = Program::all();
        $states = State::all();
        return view('backend.mnre.createInspector', compact('inspector', 'programs', 'states'));
    }

    public function inspectorAssociation($id)
    {
        $id = base64_decode($id);
        try {
            SiaInspectorAssociation::insert([
                'state_implementing_agency_user_id' => Auth::id(),
                'inspector_id' => $id
            ]);
            return redirect()->back()->with("status","Inspectors Associated successfully !");
        } 
        catch (\Throwable $th) {
            if($th->errorInfo[1] == 1062){
                return redirect()->back()->with("error","One of them inspector already associated !");
            }
            return redirect()->back()->with("error","Server Error !");
        }
    }

    public function inspectorBlacklist(Request $request, $id)
    {
        $id = base64_decode($id);
        try {
            Inspector::where('id', $id)->update([
                'blacklist' => $request->blacklist
            ]);
            if($request->blacklist == '1'){
                return redirect()->back()->with("status","Inspector blacklisted successfully !");
            }
            return redirect()->back()->with("status","Inspector removed from blacklist successfully !");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error","Server error !");
        }
    }

    public function consumerList(Request $request)
    {
        $status = NULL; $priority = NULL; $filters=[];
        if($request->isMethod('post')){
            if(!empty($request->filter['status'])) $status = $request->filter['status'];
            if(!empty($request->filter['priority']) && $request->filter['priority'] != 'All') $priority = $request->filter['priority'];
            $filters = $request->filter;
        }
        $consumers = Consumer::getAll(Auth::user()->state_id, $status, $priority);
        return view('backend.common.consumerList', compact('consumers','filters'));
    }

    public function consumerDetail(Request $request, $id)
    {
        $id = base64_decode($id);
        $consumer = Consumer::getById(null, null, $id);
        if(Gate::denies('siaconsumers', $consumer)){ abort(403); }

        $consumer['number_of_cattle'] = json_decode($consumer['number_of_cattle'], true);
        $editable = 'disabled';
        $installers = SiaInstallerAssociation::getAssociatedInstallers(Auth::id());
        return view('backend.common.consumerDetail', compact('consumer', 'editable','installers'));
    }

    public function consumerRequestApproval(Request $request, $id)
    {
        $id = base64_decode($id);
        try {
            Consumer::where('id', $id)->update(['is_approved' => $request->approve,'date_of_reg' => date('d-m-Y')]);
            $message = '';
            $consumer = Consumer::where('id', $id)->first();
            if($request->approve){
                $data = [
                    'installation_status' => $consumer->installer_id > 0 ? 2 : 1,
                    'consumer_id' => $id,
                    'installer_id' => $consumer->installer_id ?? NULL,
                    'state_implementing_agency_id' => Auth::id()
                ];
                if($consumer->installer_id)
                    $data['installer_assignment_date'] = date('Y-m-d');

                $installationId = Installation::create($data)->id;
                $message = 'Consumer request approved successfully';
                $this->emailSmsNotifications->notifyAcceptanceToCustomer($id);

                if($consumer->installer_id)
                    $result = $this->emailSmsNotifications->notifyAcceptanceToInstaller($installationId);
            }
            else
                $message = 'Consumer request has been rejected';

            return redirect()->back()->with("status", $message);
        }
        catch (\Exception $th) {
            Log::error($th);
            return redirect()->back()->with("error", 'Server error !');
        }
    }

    public function consumerInstallerAssociation(Request $request, $id)
    {
        $id = base64_decode($id);
        try {
            $installations = Installation::select('id')->where('consumer_id', $id)->first();
            Installation::where('consumer_id', $id)->update([
                'installation_status' => 2,
                'installer_id' => $request->installer_id,
                'priority' => $request->priority,
                'installer_assignment_date' => date('Y-m-d')
            ]);
            $result = $this->emailSmsNotifications->notifyAcceptanceToInstaller($installations->id);
            Consumer::where('id', $id)->update(['installer_id' => $request->installer_id]);
            return redirect()->back()->with("status","Installer associated with ".$request->priority." priority!");
        }
        catch (\Exception $th) {
            return redirect()->back()->with("error","Server Error !");
        }
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
        $inspectors = SiaInspectorAssociation::getAssociatedInspectors(Auth::id());
        $states = State::All();
        $dictionaryHelper = new Dictionary();
        $priorities = $dictionaryHelper->transformArrayToDictionary(Config::get('constants.priority'));
        return view('backend.common.systems', compact('installations','inspectors','priorities','states','filters'));
    }

    public function addEditSystem(Request $request, $id)
    {
        $dictionaryHelper = new Dictionary();
        $id = base64_decode($id);
        if($request->isMethod('get')){
            $installation = Installation::getInstallation($id);
            if(Gate::denies('siainstallations', $installation)){ abort(403); }

            $logs = InstallationReviewLog::getLogs($installation->id);
            $editableInspector = $editable = 'disabled';
            $sub_districts = SubDistrict::all();
            $biogasModels = BiogasModel::getAllBiogasModels();
            $installationCapacities = InstallationCapacity::getAllInstallationCapacities();
            $categories = $dictionaryHelper->transformArrayToDictionary(Config::get('constants.categories'));
            $inspectors = Inspector::getAll(Auth::user()->state_id);
            $documentCodes = Config::get('constants.documentCodes');
            $slurry_types = Config::get('constants.slurries');
            return view('backend.common.createSystem', compact('installation','inspectors','sub_districts','editable',
                                                                'editableInspector','logs','biogasModels','installationCapacities',
                                                                'categories','documentCodes','slurry_types'));
        }
        elseif($request->isMethod('post')){
            try {
                $logId = InstallationReviewLog::create([
                    'installation_id' => $request->systemId,
                    'review' => $request->modification,
                    'docs' => json_encode($request->docs),
                    'installation_status' => 3,
                    'created_by' => Auth::id()
                ]);

                if($logId){
                    Installation::where('id', $request->systemId)->update(['installation_status' => 3]);
                    return redirect()->back()->with('status', 'Modification request sent!');
                }
            }
            catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Modification request failed!');
            }
        }
    }

    public function systemAction(Request $request, $id, $action)
    {
        $id = base64_decode($id);
        try {
            $review = 'Your installation was '.($action == 'AC' ? 'accepted' : 'rejected');
            InstallationReviewLog::create([
                                        'installation_id' => $id,
                                        'review' => $review,
                                        'review_type' => 'A',
                                        'review_action' => $action,
                                        'docs' => json_encode([]),
                                        'created_by' => Auth::id(),
                                    ]);

            if($action == 'AC')
                $this->emailSmsNotifications->notifyInstallationAcceptance($id);

            Installation::where('id', $id)->update(['installation_status' => $action == 'AC' ? 5 : 11]);
            return redirect('state-implementing-agency/systems')->with("status", 'Your Action was completed successfully!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with("error", 'Something went wrong, Please try again!');
        }
    }

    public function modificationFeedback(Request $request)
    {
        try {
            InstallationReviewLog::create([
                                        'installation_id' => $request->systemId,
                                        'review' => $request->modification,
                                        'review_type' => 'A',
                                        'review_action' => 'MD',
                                        'docs' => !empty($request->docs) ? json_encode($request->docs) : json_encode([]),
                                        'created_by' => Auth::id(),
                                    ]);

            $docs = !empty($request->docs) ? $request->docs : [];
            Installation::where('id', $request->systemId)->update(['installation_status' => 6]);
            $this->emailSmsNotifications->notifySIAFeedbacks($request->systemId, $request->modification, $docs);
            return redirect('state-implementing-agency/systems')->with("status", 'System modification feedback sent!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with("error", 'Something went wrong, Please try again!');
        }
    }

    public function allotInspectorToSystem(Request $request, $id)
    {
        $id = base64_decode($id);
        try {
            if(!$request->inspector_id){
                return redirect()->back()->with("error","No inspector selected!");
            }
            Installation::where('id', $id)->update(['installation_status' => 7,'inspector_id' => $request->inspector_id,'inspector_assignment_time' => date('Y-m-d')]);

            Inspection::create([
                'inspector_id' => $request->inspector_id,
                'installation_id' => $id,
            ]);

            $this->emailSmsNotifications->notifyInspectorAssignmentToProject($id);
            return redirect()->back()->with("status","Inspector alloted for system inspection!");
        }
        catch (\Exception $e) {
            return redirect()->back()->with("error","Server Error!");
        }
    }

    public function systemFinalAction(Request $request, $id, $action)
    {
        $id = base64_decode($id);
        try {
            Installation::where('id', $id)->update(['installation_status' => 10, 'approval_date' => date('Y-m-d')]);
            InstallationReviewLog::create([
                'installation_id' => $id,
                'review' => "Your system was approved",
                'review_type' => 'A',
                'review_action' => $action,
                'docs' => json_encode([]),
                'created_by' => Auth::id()
            ]);
            $this->emailSmsNotifications->notifySystemApproval($id);
            $maintenanceDate = Installation::where('id', $id)->value('onm_routines_schedule');
            MaintenanceRegistry::createONMRegistry($id, 'PR', $maintenanceDate);
            return redirect(Auth::getDefaultDriver().'/systems')->with("status", 'System approved!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with("error", 'Server error !');
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

    public function editProfile(Request $request)
    {
        $user = Auth::user();
        $states = State::all();
        if($request->isMethod('get')){
            return view('backend.state-implementing-agency.editProfile', compact('user', 'states'));
        }

        $user->state_id = $request->state_id;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->contact_person = $request->contact_person;
        $user->nodal = $request->nodal;
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
            $submitUrl = URL::to('/state-implementing-agency/change-password');
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

    public function systemMaintenance(Request $request)
    {
        if($request->isMethod('get')){
            try{
                $maintenanceSystems = MaintenanceRegistry::getMaintenanceSystems(null, Auth::id());
                return view('backend.common.maintenance', compact('maintenanceSystems'));
            }
            catch(\Exception $e){
                return redirect()->back()->with("error","Server error !");
            }
        }
    }

    public function maintenanceRecords(Request $request, $id)
    {
        $id = base64_decode($id);
        $installation = Installation::where('installations.id', $id)->join('consumers','consumers.id','installations.consumer_id')->first();
        if(Gate::denies('siainstallations', $installation)){ abort(403); }

        try {
            if($request->isMethod('get')){
                $maintenanceRecords = MaintenanceRegistry::getMaintenanceBySystemId($id);
                $systemId = $id;
                return view('backend.common.maintenanceRecords', compact('maintenanceRecords', 'systemId'));
            }

            MaintenanceRegistry::createONMRegistry($id, $request->type, $request->date, $request->note);
            return redirect()->back()->with("status","Maintenance requested successfully !");
        } 
        catch (\Throwable $th) {
            return redirect()->back()->with("error","Server error !");
        }
    }

    public function maintenanceRecordDetail(Request $request, $id)
    {
        $id = base64_decode($id);
        $record = MaintenanceRegistry::getMaintenanceById($id);
        if(Gate::denies('siamaintenances', $record)){ abort(403); }

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
}