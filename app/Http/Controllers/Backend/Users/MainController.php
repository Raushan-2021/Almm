<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\MachineList;
use App\Traits\General;
use App\Models\ApplicationDetail;
use App\Models\AppliedPvmodel;
use App\Models\Annexure1;
use App\Models\Annexure2;
use App\Models\Annexure3;
use App\Models\Annexure4;
use App\Models\Annexure5;
use App\Models\Annexure6;
use App\Models\InspectionHistory;
use App\Models\Module;
use App\Models\BillMaterial;
use App\Models\AnnexureAttachment;
use App\Models\ForwardDetail;
use App\Http\Controllers\Controller;
use App\Utils\Dictionary;
use App\Utils\FormValidator;
use App\Utils\ApplicationProgress;
use App\Utils\Dashboard;
use App\Utils\EmailSmsNotifications;

use DB, URL, Auth, Hash, Storage, Config, Gate,Exception, Session, PDF;

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
        return view('backend.user.dashboard', compact('data'));
    }
    public function addNewModule(Request $request){
        
        $auditData = array('action_type'=>'View','description'=>'Viewed Add Module Page', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        
        return view('backend.user.Module.addNewModule');
    }
    public function addModule(Request $request){
        if($request->isMethod('post')){
            $request->validate(
            [
                'module_type'                   => 'required|max:50',
                'main_model'                    => 'required|max:50',
                'pmax_model'                    => 'required'
            ],
            [
                'module_type.required'              => 'Type of Modules field is required.',
                'main_model.required'               => 'Main Model field is required.',
                'pmax_model.required'               =>  'Pmax (Wp) of Applicable Models Model field is required'
            ]
        );
            $moduleData = new Module();
            $moduleData->user_id = Auth::user()->id;
            $moduleData->module_type = $request->module_type;
            $moduleData->main_model = $request->main_model;
            $moduleData->pmax_model = $request->pmax_model;
            $moduleData->save();
            $moduleData->id;
            if($moduleData->id){
                
                $auditData = array('action_type'=>'Insert','description'=>'Module Details saved successfuly!', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect('users/module-master/'.$request->application_id)->with('status', 'Module Details saved successfuly!');
            }else{
                
                $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect('users/module-master/'.$request->application_id)->with('error', 'Error in Updating Details');
            }
        }
        
        $auditData = array('action_type'=>'View','description'=>'Viewed Module List', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        
        $moduleData = Module::where('user_id',Auth::user()->id)->get();
        return view('backend.user.Module.viewModule',compact('moduleData'));
    }
    public function userApplication(){
        
        $auditData = array('action_type'=>'View','description'=>'Viewed Application List Page', 'user_type'=>'MFT');
        $this->auditTrail($auditData);

        $applications=array();$i=0;
        $inspectionHistory = ApplicationDetail::getUserApplications(Auth::user()->id);
        foreach($inspectionHistory as $data){$i++;
           $applications[$i] = $data;
           $inc_history = InspectionHistory::where('application_id',$applications[$i]->id)->limit(1)->orderBy('id','DESC')->get()->toArray();
           $applications[$i]['inspectionData'] = $inc_history;
        }
        //$applications = ApplicationDetail::getUserApplications(Auth::user()->id);
        //dd($applications);
        return view('backend.user.userApplications',compact('applications'));
    }
    public function newApplication(Request $request, $id=NULL){
        if($request->isMethod('post')){
           $request->validate(
            [
                'manufacturer_name'         =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
                'manufacturer_brand_name'   =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
                'register_office_address'   =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                'register_office_phone'     =>  'required|numeric|digits:10',
                'register_office_email'     =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'manufacturer_brand_logo'   =>  'required_if:step1,0',                
                'com_address'               =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                'com_phone'                 =>  'required|numeric|digits:10',
                'com_email'                 =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'plant_address'             =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                'plant_phone'               =>  'required|numeric|digits:10',
                'plant_email'               =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'plant_latitude'            =>  'required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/',
                'plant_longitude'           =>  'required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/',
                'country'                   =>  'required',
                //'existing_plant_india'      =>  'required',
                //'existing_plant_outindia'   =>  'required',
                'contact_person_name'       =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
                'person_designation'        =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
                'person_contact_no'         =>  'required|numeric|digits:10',
                'person_email'              =>  'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'authorize_name'            =>  'required|string|regex:/^[a-zA-Z ]*$/|max:90',
                'authorize_designation'     =>  'required|string|max:90',
                'authorize_letter'          =>  'required_if:step1,0',

            ],
            [
                'phone.required' => 'Please enter mobile number',
                'phone.numeric' => 'The mobile number be a number.',
                'phone.digits:10' => 'The mobile number must be 10 digits.',
                'manufacturer_brand_logo.required_if' => 'The manufacturer brand logo field is required ',
                'authorize_letter.required_if' => 'Authorized letter required ',
                'com_address.required' => 'Communication Address is required.',
                'com_phone.required' => 'Communication Phone is required.',
                'com_phone.digits:10' => 'The mobile number must be 10 digits.',
                'com_email.required' => 'Communication Email is required.',
                'plant_address.required' => 'Manufacturing Plant Address is required.',
                'plant_phone.required' => 'Contact Number is required.',
                'plant_phone.digits:10' => 'The mobile number must be 10 digits.',
                'plant_email.required' => 'Email address is required.',
                //'existing_plant_india.required'=>'Please mention No. of Manufacturing plant in India',
                //'existing_plant_outindia.required'=>'Please mention No. of Manufacturing plant out of India',
                
            ]
            );
            try{
                //dd($request);
                if($request->edit_id){
                    $applicationDetails = ApplicationDetail::findOrFail($request->edit_id);
                }else{
                    $applicationDetails = new ApplicationDetail();
                }
                $is_comm_add_same=0;
                if (isset($request->is_comm_add_same)) {$is_comm_add_same=1;}
                
                $applicationDetails->application_type = 1;
                $applicationDetails->user_id = Auth::user()->id;
                $applicationDetails->manufacturer_name = $request->manufacturer_name;
                $applicationDetails->manufacturer_brand_name = $request->manufacturer_brand_name;
                $applicationDetails->register_office_address = $request->register_office_address;
                $applicationDetails->register_office_phone = $request->register_office_phone;
                $applicationDetails->register_office_email = $request->register_office_email;
                $applicationDetails->is_comm_add_same = $is_comm_add_same;
                if($is_comm_add_same==1){
                    $applicationDetails->com_address = $request->register_office_address;
                    $applicationDetails->com_phone = $request->register_office_phone;
                    $applicationDetails->com_email = $request->register_office_email;
                }else{
                    $applicationDetails->com_address = $request->com_address;
                    $applicationDetails->com_phone = $request->com_phone;
                    $applicationDetails->com_email = $request->com_email;
                }

                $applicationDetails->plant_address = $request->plant_address;
                $applicationDetails->plant_phone = $request->plant_phone;
                $applicationDetails->plant_email = $request->plant_email;
                $applicationDetails->plant_latitude = $request->plant_latitude;
                $applicationDetails->plant_longitude = $request->plant_longitude;
                $applicationDetails->country = $request->country;
                $applicationDetails->existing_plant_india = $request->existing_plant_india;
                $applicationDetails->existing_plant_outindia = $request->existing_plant_outindia;
                $applicationDetails->contact_person_name = $request->contact_person_name;
                $applicationDetails->person_designation = $request->person_designation;
                $applicationDetails->person_contact_no = $request->person_contact_no;
                $applicationDetails->person_email = $request->person_email;
                $applicationDetails->authorize_name = $request->authorize_name;
                $applicationDetails->authorize_designation = $request->authorize_designation;
                $applicationDetails->step1 = 1;

                $dir_path_certificate = 'systems\\Attachment\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                if($request->hasFile('authorize_letter')){
                    $authorize_letter=$this->uploadFile($request->file('authorize_letter'), $dir_path_certificate,'AUTHORIZE_LETTER');
                    $applicationDetails->authorize_letter = $authorize_letter['name'];
                }else{
                    $applicationDetails->authorize_letter = NULL;
                }

                $dir_path_logo = 'systems\\Logo\\';
                Storage::disk('filestore')->makeDirectory($dir_path_logo);
                if($request->hasFile('manufacturer_brand_logo')){
                    $manufacturer_brand_logo=$this->uploadFile($request->file('manufacturer_brand_logo'), $dir_path_logo,'LOGO');
                    $applicationDetails->manufacturer_brand_logo = $manufacturer_brand_logo['name'];
                }else{
                     $applicationDetails->manufacturer_brand_logo = $request->old_manufacturer_brand_logo;
                }
                //dd($applicationDetails);
                if(!empty($request->edit_id)){
                    $applicationDetails->update();
                    return redirect('users/new-application/'.$request->edit_id)->with('status', 'Application saved updated successfuly!');
                    return redirect()->back()->with('status', 'Application Details updated successfuly!');
                }
                
                $applicationDetails->save();
                $id=$applicationDetails->id;
                if($id){
                    
                    $auditData = array('action_type'=>'Update','description'=>'Updated New Application Form', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/new-application/'.$applicationDetails->id)->with('status', 'Application saved updated successfuly!');
                }else{
                    
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/new-application/'.$applicationDetails->id)->with('error', 'Error in Updating Details');
                }
                
            }catch(\Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                //return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }
        }
        $appData =array();
        if(isset($id)){
            $appData = ApplicationDetail::where('id',$id)->where('user_id',Auth::user()->id)->first();
            if(!$appData){
                dd('Invalid Request');
            }
        }
        $progressBar = $this->getApplicationProgress($id);
        $countries=Country::all();
        $auditData = array('action_type'=>'View','description'=>'Viewed New Application Form Page', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        
        
        return view('backend.user.form.newApplication',compact('appData','progressBar','countries'));
        
    }
    public function newApplicationStep2(Request $request, $id=NULL){
        if($request->isMethod('post')){
            //$validator = new FormValidator();
            // if($validator->applicationDetailsValidations($request,1))           
            //     return redirect()->back()->with('error', 'Some of the fields are not valid!');
           $request->validate(
            [
                'manufacturing_capacity'    =>  'required',
                'no_enlisted_pvmodel'       =>  'required_if:enlisted_almm,1',
                'total_pv_capacity'         =>  'required_if:enlisted_almm,1',
                'validity_from'             =>  'required_if:enlisted_almm,1',
                'validity_to'               =>  'required_if:enlisted_almm,1',
                'manufacturer_brand_logo'   =>  'required_if:step1,0',
                'application_fees'          =>  'required|integer',
                'total_amount'              =>  'required|integer',
                'payment_mode'              =>  'required',
                'payment_date'              =>  'required',
                'utn_no'                    =>  'required',
                'technology.*'              =>  'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                'no_pv_models.*'            =>  'required|integer',
                //'inspection_date'         =>  'required',
                'pmax.*'                    =>  'required',

            ],
            [
                'no_enlisted_pvmodel.required_if'=>'Please mention No. of Main PV Model Enlisted',
                'total_pv_capacity.required_if'=>'Please mention Total PV Module Manufacturing Capacity (MW/year)',
                'validity_from.required_if'=>'Please mention ALMM Enlistment Validity',
                'validity_to.required_if'=>'Please mention ALMM Enlistment Validity',
                'utn_no.required'=>'Please enter UTR Number',
                'technology.*'=>'Please enter Technology Details',
                'technology.regex.*'=>'Invalid Format',
                'no_pv_models.*'=>'Please enter No. of Main PV Models Applied',
                'pmax.*'=>'Please enter Highest Pmax (in Wp)'
            ]
            );
            try{
                $deleteFlg = AppliedPvmodel::where('application_id',$request->edit_id)->where('user_id',Auth::user()->id)->delete();
                $applicationDetails = ApplicationDetail::findOrFail($request->edit_id);
                $applicationDetails->manufacturing_capacity = $request->manufacturing_capacity;
                $applicationDetails->enlisted_almm = $request->enlisted_almm;
                $applicationDetails->no_enlisted_pvmodel = $request->no_enlisted_pvmodel;
                $applicationDetails->total_pv_capacity = $request->total_pv_capacity;
                $applicationDetails->validity_from = $request->validity_from;
                $applicationDetails->validity_to = $request->validity_to;
                $applicationDetails->application_fees = $request->application_fees;
                $applicationDetails->inspection_fees = $request->inspection_fees;
                $applicationDetails->payment_mode = $request->payment_mode;
                $applicationDetails->total_amount = $request->total_amount;
                $applicationDetails->payment_date = $request->payment_date;
                $applicationDetails->utn_no = $request->utn_no;
                //$applicationDetails->inspection_date=$request->inspection_date;
                $applicationDetails->applied_pv_model = count($request->pmax);
                $applicationDetails->step2 = 1;

                // $dir_path_payment = 'systems\\Payment\\';
                // Storage::disk('filestore')->makeDirectory($dir_path_payment);
                // if($request->hasFile('attachment_2')){
                //     $attachment_2=$this->uploadFile($request->file('attachment_2'), $dir_path_payment,'PAYMENT');
                //     $applicationDetails->attachment_2 = $attachment_2['name'];
                // }else{
                //     $applicationDetails->attachment_2 = $request->old_attachment_2;
                // }
                //Insert Data in AppliedPvmodels Table
                $allPvDetails = [];
                $i=0;
                foreach($request->pmax as $item){ // $interests array contains input data
                     
                    $allDetails = new AppliedPvmodel();
                    $allDetails->application_id = $request->edit_id;
                    $allDetails->user_id = Auth::user()->id;
                    $allDetails->technology = $request->technology[$i];
                    $allDetails->no_pv_models = $request->no_pv_models[$i];
                    $allDetails->pmax = $request->pmax[$i];
                    $allPvDetails[] = $allDetails->attributesToArray();
                    $i++;
                }
                AppliedPvmodel::insert($allPvDetails);
                if(!empty($request->edit_id)){
                    
                    $auditData = array('action_type'=>'Update','description'=>'Application part 2 saved successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    $applicationDetails->update();
                    return redirect('users/new-application-step2/'.$request->edit_id)->with('status', 'Application saved successfuly!');
                    //return redirect()->back()->with('status', 'Application Details updated successfuly!');
                }
                
            }catch(\Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }
        }
        $appData=$pvdata=array();
        if(isset($id)){
            $appData = ApplicationDetail::where('id',$id)->where('user_id',Auth::user()->id)->first();
            $pvdata = AppliedPvmodel::where('application_id',$id)->where('user_id',Auth::user()->id)->get();
            if(!$appData){
                dd('Invalid Request');
            }
        }
        
        $auditData = array('action_type'=>'View','description'=>'Viewed Application Part 2 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        
        $progressBar = $this->getApplicationProgress($id);
        return view('backend.user.form.newApplicationStep2',compact('appData','pvdata','progressBar'));
    }
    public function getApplicationProgress($application_id){
        $progressData = new ApplicationProgress();
        return $progressData->getApplicationProgress($application_id);
    }
    public function getApplicationAnnexureProgress($application_id){
        $progressData = new ApplicationProgress();
        return $progressData->getApplicationAnnexureProgress($application_id);
    }
    public function annexure1(Request $request, $application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            //Validation
            $request->validate(
            [
                'module_type'               =>  'required',
                'pmax_model'                =>  'required',
                'pmax_applicable_model.*'   =>  'required',
                'no_of_cells.*'             =>  'required',
                'system_voltage.*'          =>  'required',

            ],
            [
                'module_type.required'=>'Please select module',
                'pmax_applicable_model.*'=>'Please enter Pmax (Wp) of Applicable Models Model',
                'no_of_cells.*'=>'Please enter No of Cells & Cell Type',
                'system_voltage.*'=>'Please enter System Voltage (VDC)',
            ]
            );
            try{
                if($request->edit_id){
                    $deletOldAnnexure = Annexure1::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->delete();
                }
                $annaxure = new Annexure1();
                $annaxure->application_id = $request->application_id;
                $annaxure->user_id = Auth::user()->id;
                $annaxure->sub_annexure = 1;
                $annaxure->module_type = $request->module_type;
                $annaxure->model_code = $request->model_code;
                $annaxure->pmax_model = $request->pmax_model;
                $annaxure->pmax_applicable_model = json_encode($request->pmax_applicable_model);
                $annaxure->no_of_cells = json_encode($request->no_of_cells);
                $annaxure->system_voltage = json_encode($request->system_voltage);
                $annaxure->created_at = $this->getCurrentDate();
                $annaxure->updated_at = $this->getCurrentDate();
                $annaxure->save();
                $id=$annaxure->id;
                if($id){
                    
                    $auditData = array('action_type'=>'Update','description'=>'Annexure 1 Details Updated successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/annexure-one/'.$request->application_id)->with('status', 'Annexure 1 Details saved successfuly!');
                }else{
                    
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
                }

            }catch(\Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }
        }
        $appData=$annexuredata=$moduleList=array();
        $progressBar=array(0,false);
        if(isset($application_id)){
            $appData = Annexure1::getAnnexureData($application_id,Auth::user()->id,1);
            if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
                
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 1', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                $annexuredata = Annexure1::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                if($annexuredata!=null){
                    $annexuredata['pmax_applicable_model'] = json_decode($annexuredata->pmax_applicable_model);
                    $annexuredata['no_of_cells'] = json_decode($annexuredata->no_of_cells);
                    $annexuredata['system_voltage'] = json_decode($annexuredata->system_voltage);
                }
            }
        }
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $moduleList = Module::where('user_id',Auth::user()->id)->get();
        
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure 1 Form Page', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        
        return view('backend.user.form.annexureOne.annexure1',compact('appData','application_id','annexuredata','moduleList','progressBar'));
    } 
    public function annexure1_1(Request $request, $application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'module_type'               =>  'required',
                'pmax_model'                =>  'required',
                'pmax_applicable_model.*'   =>  'required',
                'no_of_cells.*'             =>  'required',
                'system_voltage.*'          =>  'required',
                'electrical_data_type'      =>  'required'

            ],
            [
                'module_type.required'=>'Please select module',
                'pmax_applicable_model.*'=>'Please enter Pmax (Wp) of Applicable Models Model',
                'no_of_cells.*'=>'Please enter No of Cells & Cell Type',
                'system_voltage.*'=>'Please enter System Voltage (VDC)',
                'electrical_data_type.required'=>'Please select Electrical Data type'
            ]
            );
            try{
                if($request->edit_id){
                    $deletOldAnnexure = Annexure1::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->delete();
                }
                $annaxure = new Annexure1();
                $annaxure->application_id = $request->application_id;
                $annaxure->user_id = Auth::user()->id;
                $annaxure->sub_annexure = 2;
                $annaxure->module_type = $request->module_type;
                $annaxure->model_code = $request->model_code;
                $annaxure->pmax_model = $request->pmax_model;
                $annaxure->applicable_mean_wattage=json_encode($request->applicable_mean_wattage);
                $annaxure->pmax_applicable_model = json_encode($request->pmax_applicable_model);
                $annaxure->electrical_data_type = $request->electrical_data_type;
                $annaxure->pmax_watt = json_encode($request->pmax_watt);
                $annaxure->vmp = json_encode($request->vmp);
                $annaxure->imp = json_encode($request->imp);
                $annaxure->voc = json_encode($request->voc);
                $annaxure->isc = json_encode($request->isc);
                $annaxure->model_efficiency = json_encode($request->model_efficiency);
                $annaxure->fill_factor = json_encode($request->fill_factor);
                $annaxure->created_at = $this->getCurrentDate();
                $annaxure->updated_at = $this->getCurrentDate();
                $annaxure->save();
                $id=$annaxure->id;
                if($id){
                    
                    $auditData = array('action_type'=>'Update','description'=>'Annexure 1_1 Details saved successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/annexure-one-b/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/annexure-one-b/'.$request->application_id)->with('error', 'Error in Updating Details');
                }

            }catch(\Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }
        }
        $appData=$annexuredata=array();
        if(isset($application_id)){
           // $appData = Annexure1::where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('sub_annexure',2)->orderby('electrical_data_type')->get();
           $appData = Annexure1::getAnnexureData($application_id,Auth::user()->id,2); 
           if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
                
                $annexuredata = Annexure1::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                if($annexuredata!=null){
                    $annexuredata['vmp'] = json_decode($annexuredata->vmp);
                    $annexuredata['imp'] = json_decode($annexuredata->imp);
                    $annexuredata['voc'] = json_decode($annexuredata->voc);
                    $annexuredata['isc'] = json_decode($annexuredata->isc);
                    $annexuredata['model_efficiency'] = json_decode($annexuredata->model_efficiency);
                    $annexuredata['applicable_mean_wattage'] = json_decode($annexuredata->applicable_mean_wattage);
                    $annexuredata['fill_factor'] = json_decode($annexuredata->fill_factor);
                    $annexuredata['pmax_applicable_model'] = json_decode($annexuredata->pmax_applicable_model);
                    $annexuredata['pmax_watt'] = json_decode($annexuredata->pmax_watt);
                }
                
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 1 of 1', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
            }
        }
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $moduleList = Module::where('user_id',Auth::user()->id)->get();
        
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure 1 of 1 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        
        return view('backend.user.form.annexureOne.annexure1_2',compact('appData','application_id','annexuredata','moduleList','progressBar'));
    }
    public function annexure1_3(Request $request, $application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'module_type'               =>  'required',
                'pmax_model'                =>  'required',
                'electrical_data_type'      =>  'required'

            ],
            [
                'module_type.required'=>'Please select module',
                'electrical_data_type.required'=>'Please select Module Operation type'
            ]
            );
            try {
                if($request->edit_id){
                    $deletOldAnnexure = Annexure1::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->delete();
                }
                $electrical_data = $request->electrical_data_type;
                $annaxure = new Annexure1();
                $annaxure->application_id = $request->application_id;
                $annaxure->user_id = Auth::user()->id;
                $annaxure->sub_annexure = $electrical_data;
                $annaxure->module_type = $request->module_type;
                $annaxure->model_code = $request->model_code;
                $annaxure->pmax_model = $request->pmax_model;
                if($electrical_data==3){ //Operational Ratings
                    $annaxure->applicable_mean_wattage = json_encode(array_filter($request->applicable_mean_wattage));
                    $annaxure->pmax_applicable_model = json_encode(array_filter($request->applicable_mean_wattage));
                    $annaxure->operation_temp = json_encode($request->operation_temp);
                    $annaxure->max_voltage = json_encode($request->max_voltage);
                    $annaxure->max_fuse_rating = json_encode($request->max_fuse_rating);
                    $annaxure->diode_rating = json_encode($request->diode_rating);
                    $annaxure->fire_rating = json_encode($request->fire_rating);
                    $annaxure->warrenty_details = json_encode($request->warrenty_details);
                }
                if($electrical_data==4){ //Module Temperature Characteristics
                    $annaxure->applicable_mean_wattage = json_encode(array_filter($request->applicable_mean_wattage_4));
                    $annaxure->pmax_applicable_model = json_encode(array_filter($request->applicable_mean_wattage_4));
                    $annaxure->pmax_watt = json_encode($request->pmax_watt);
                    $annaxure->voc = json_encode($request->voc);
                    $annaxure->isc = json_encode($request->isc);
                }
                if($electrical_data==5){ //Module Dimensions
                    $annaxure->applicable_mean_wattage = json_encode(array_filter($request->applicable_mean_wattage_5));
                    $annaxure->pmax_applicable_model = json_encode(array_filter($request->applicable_mean_wattage_5));
                    $annaxure->module_length = json_encode($request->module_length);
                    $annaxure->module_breadth = json_encode($request->module_breadth);
                    $annaxure->module_area = json_encode($request->module_area);
                    $annaxure->module_weight = json_encode($request->module_weight);
                }
                if($electrical_data==6){ //Solar Cell Specifications
                    $annaxure->applicable_mean_wattage = json_encode(array_filter($request->applicable_mean_wattage_6));
                    $annaxure->pmax_applicable_model = json_encode(array_filter($request->pmax_applicable_model_6));
                    $annaxure->cell_technology = json_encode($request->cell_technology);
                    $annaxure->cell_efficiency = json_encode($request->cell_efficiency);
                    $annaxure->cell_wattage = json_encode($request->cell_wattage);
                    $annaxure->cell_dimension = json_encode($request->cell_dimension);
                    $annaxure->cell_type = json_encode($request->cell_type);
                    $annaxure->cell_total_no = json_encode($request->cell_total_no);
                    $annaxure->cell_total_bus = json_encode($request->cell_total_bus);
                }
                $annaxure->created_at = $this->getCurrentDate();
                $annaxure->updated_at = $this->getCurrentDate();
                $annaxure->save();
                $id=$annaxure->id;
                if($id){
                    
                    $auditData = array('action_type'=>'Update','description'=>'Update Annexure 1 of 2 Form', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/annexure-one-c/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details of Annexure 1 of 2 Form', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/annexure-one-c/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
                
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
        $appData=$annexuredata=array();
        if(isset($application_id)){
            //$appData = Annexure1::where('application_id',$application_id)->where('user_id',Auth::user()->id)->whereIn('sub_annexure',[3,4,5,6])->get();
            $appData = Annexure1::getAnnexureMultipleData($application_id,Auth::user()->id,[3,4,5,6]); 
            if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
                $annexuredata = Annexure1::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                if($annexuredata!=null){
                    
                    if($annexuredata->sub_annexure ==3){ //Operational Ratings
                        $annexuredata['applicable_mean_wattage'] = json_decode($annexuredata->applicable_mean_wattage);
                        $annexuredata['pmax_applicable_model'] = json_decode($annexuredata->pmax_applicable_model);
                        $annexuredata['operation_temp'] = json_decode($annexuredata->operation_temp);
                        $annexuredata['max_voltage'] = json_decode($annexuredata->max_voltage);
                        $annexuredata['max_fuse_rating'] = json_decode($annexuredata->max_fuse_rating);
                        $annexuredata['diode_rating'] = json_decode($annexuredata->diode_rating);
                        $annexuredata['fire_rating'] = json_decode($annexuredata->fire_rating);
                        $annexuredata['warrenty_details'] = json_decode($annexuredata->warrenty_details);
                    }
                    if($annexuredata->sub_annexure ==4){ //Module Temperature Characteristics
                        $annexuredata['applicable_mean_wattage'] = json_decode($annexuredata->applicable_mean_wattage);
                        $annexuredata['pmax_applicable_model'] = json_decode($annexuredata->pmax_applicable_model);
                        $annexuredata['pmax_watt'] = json_decode($annexuredata->pmax_watt);
                        $annexuredata['voc'] = json_decode($annexuredata->voc);
                        $annexuredata['isc'] = json_decode($annexuredata->isc);
                    }
                    if($annexuredata->sub_annexure ==5){ //Module Dimensions
                        $annexuredata['applicable_mean_wattage'] = json_decode($annexuredata->applicable_mean_wattage);
                        $annexuredata['pmax_applicable_model'] = json_decode($annexuredata->pmax_applicable_model);
                        $annexuredata['module_length'] = json_decode($annexuredata->module_length);
                        $annexuredata['module_breadth'] = json_decode($annexuredata->module_breadth);
                        $annexuredata['module_area'] = json_decode($annexuredata->module_area);
                        $annexuredata['module_weight'] = json_decode($annexuredata->module_weight);
                    }
                    if($annexuredata->sub_annexure ==6){ //Solar Cell Specifications
                        $annexuredata['applicable_mean_wattage'] = json_decode($annexuredata->applicable_mean_wattage);
                        $annexuredata['pmax_applicable_model'] = json_decode($annexuredata->pmax_applicable_model);
                        $annexuredata['cell_technology'] = json_decode($annexuredata->cell_technology);
                        $annexuredata['cell_efficiency'] = json_decode($annexuredata->cell_efficiency);
                        $annexuredata['cell_wattage'] = json_decode($annexuredata->cell_wattage);
                        $annexuredata['cell_dimension'] = json_decode($annexuredata->cell_dimension);
                        $annexuredata['cell_type'] = json_decode($annexuredata->cell_type);
                        $annexuredata['cell_total_no'] = json_decode($annexuredata->cell_total_no);
                        $annexuredata['cell_total_bus'] = json_decode($annexuredata->cell_total_bus);
                    }
                    //dd($annexuredata);

                }
                
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 1 of 3 form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
            }
        }
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $moduleList = Module::where('user_id',Auth::user()->id)->get();
        
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure 1 of 3 form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        
        return view('backend.user.form.annexureOne.annexure1_3',compact('appData','application_id','annexuredata','moduleList','progressBar'));
    }
    public function annexureTwo(Request $request, $application_id=NULL,$edit_id=NULL){
       
        if($request->isMethod('post')){
            $request->validate(
            [
                'module_type'               =>  'required',
                'pmax_model'                =>  'required',
                'applicable_mean_wattage'   =>  'required',
                'make_details.*'            =>  'required',
                'model_details.*'           =>  'required',
                'specifications.*'          =>  'required',
                'country_origin.*'          =>  'required'

            ],
            [
                'module_type.required'=>'Please select module',
                'make_details.*'=>'Please enter Make Details',
                'model_details.*'=>'Please enter Model Details',
                'specifications.*'=>'Please enter Specification (Max. 200 Characters)',
                'country_origin.*'=>'Please select Country of Origin'
            ]
            );
            try {
                if($request->edit_id){
                    $deletOldAnnexure = Annexure2::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->delete();
                }
                $annexure2 = new Annexure2();
                $annexure2->application_id = $request->application_id;
                $annexure2->user_id = Auth::user()->id;
                $annexure2->module_type = $request->module_type;
                $annexure2->model_code = $request->model_code;
                $annexure2->pmax_model = $request->pmax_model;
                $annexure2->applicable_mean_wattage = $request->applicable_mean_wattage;
                $annexure2->bill_material_id = json_encode($request->bill_material_id);
                $annexure2->make_details = json_encode($request->make_details);
                $annexure2->model_details = json_encode($request->model_details);
                $annexure2->specifications = json_encode($request->specifications);
                $annexure2->country_origin = json_encode($request->country_origin);
                $annexure2->save();
                $id=$annexure2->id;
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Update Annexure Details successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-two/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Detail', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-two/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
        $appData=$annexuredata=array();$aryData=array();
        if(isset($application_id)){
            $appData = Annexure2::getAnnexureTwoData($application_id,Auth::user()->id); 
            if(!$appData){
                dd('Invalid Request');
            }else{
                foreach($appData as $index => $entry) {
                    $appData[$index] = $entry;
                    $appData[$index]['country_origin'] = Annexure2::getCountryData($entry->country_origin);
                }
            }
            if(isset($edit_id)){
                $annexuredata = Annexure2::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                if($annexuredata!=null){
                    $annexuredata['bill_material_id'] = json_decode($annexuredata->bill_material_id);
                    $annexuredata['make_details'] = json_decode($annexuredata->make_details);
                    $annexuredata['model_details'] = json_decode($annexuredata->model_details);
                    $annexuredata['specifications'] = json_decode($annexuredata->specifications);
                    $annexuredata['country_origin'] = json_decode($annexuredata->country_origin);
                }
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure Form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                //dd($annexuredata);
            }
            $i=0;
            //dd($appData);
            foreach($appData as $dt){$i++;
                $bill_material_id_array=array();
                $aryData[$i]=$dt;
                $bill_material_id = json_decode($dt['bill_material_id']);
                foreach($bill_material_id as $bill){
                    $bill_material_id_array[] = BillMaterial::getBillMaterialTitle($bill)->bill_title;
                }
                $aryData[$i]['bill_material_id']=json_encode($bill_material_id_array);
            }
            //dd($appData);
        }
        $moduleList = Module::where('user_id',Auth::user()->id)->get();
        $billMaterial = BillMaterial::get();
        $countries=Country::all();
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure 2 form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureTwo.annexureTwo',compact('application_id','aryData','billMaterial','moduleList','annexuredata','appData','countries','progressBar'));

    }
    public function annexureThree(Request $request, $application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'module_type'               =>  'required',
                'pmax_model'                =>  'required',
                'applicable_mean_wattage'   =>  'required',
                'pmax_watt'                 =>  'required',
                'sub_annexure'              =>  'required',
                'bis_certificate'           =>  'required_if:sub_annexure,1'

            ],
            [
                'module_type.required'=>'Please select module',
                'sub_annexure.required'=>'Please select details type',
                'bis_certificate.required_if'=>'Please upload BIS Certificate',
            ]);
            try {
                if($request->edit_id){
                    $deletOldAnnexure = Annexure3::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->delete();
                }
                $annexure3 = new Annexure3();
                $annexure3->application_id = $request->application_id;
                $annexure3->user_id = Auth::user()->id;
                $annexure3->sub_annexure = $request->sub_annexure;
                $annexure3->module_type = $request->module_type;
                $annexure3->model_code = $request->model_code;
                $annexure3->pmax_model = $request->pmax_model;
                $annexure3->pmax_watt = $request->pmax_watt;
                $annexure3->applicable_mean_wattage = $request->applicable_mean_wattage;
                $annexure3->pmax_watt = $request->pmax_watt;
                $annexure3->bis_certificate_no = $request->bis_certificate_no;
                $annexure3->bis_certificate_issue = $request->bis_certificate_issue;
                $annexure3->bis_certificate_valid = $request->bis_certificate_valid;

                $annexure3->test_standard_module = $request->test_standard_module;
                $annexure3->test_report_no = $request->test_report_no;
                $annexure3->testing_laboratory = $request->testing_laboratory;
                $annexure3->testing_laboratory_address = $request->testing_laboratory_address;
                $annexure3->valid_nabl_certificate_no = $request->valid_nabl_certificate_no;
                $annexure3->created_at = $this->getCurrentDate();
                $annexure3->updated_at = $this->getCurrentDate();
                
                $dir_path_payment = 'systems\\Annexure\\';
                Storage::disk('filestore')->makeDirectory($dir_path_payment);
                if($request->hasFile('bis_certificate')){
                    $bis_certificate=$this->uploadFile($request->file('bis_certificate'), $dir_path_payment,'ANNEXURE3_BISCRT_'.Auth::user()->id.$request->edit_id);
                    $annexure3->doc_certificate = $bis_certificate['name'];
                }else{
                    if($request->sub_annexure==1){$annexure3->doc_certificate = $request->old_bis_certificate;}
                    
                } 
                if($request->hasFile('nabl_certificate')){
                    $nabl_certificate=$this->uploadFile($request->file('nabl_certificate'), $dir_path_payment,'ANNEXURE3_NAVLCRT_'.Auth::user()->id.$request->edit_id);
                    $annexure3->doc_certificate = $nabl_certificate['name'];
                }else{
                    if($request->sub_annexure==2){$annexure3->doc_certificate = $request->old_nabl_certificate;}
                    
                }   
                //dd($annexure3);
                $annexure3->save();
                $id=$annexure3->id;
                if($id){
                    $auditData = array('action_type'=>'Insert','description'=>'Details saved successfuly for Annexure 3', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-three/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-three/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                dd($ex->getMessage());
                return redirect()->back()->with("error","Server error !");
                
            }

        }
        $appData=$annexuredata=array();
        if(isset($application_id)){
            $appData = Annexure3::getAnnexureThreeData($application_id,Auth::user()->id); 
            if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
               $annexuredata = Annexure3::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
               //dd($annexuredata);
               $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 3 details', 'user_type'=>'MFT');
               $this->auditTrail($auditData);
            }
        }
        
        $moduleList = Module::where('user_id',Auth::user()->id)->get();
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure 3', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureThree.annexureThree',compact('application_id','annexuredata','moduleList','appData','progressBar'));
    }
    public function annexureFour(Request $request, $application_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'plant_floor_area'          =>  'required',
                'plant_operational_date'    =>  'required',
                'no_manufaturing_line'      =>  'required',
                'no_working_day'            =>  'required',
                'manufacturing_capacity'    =>  'required',
                'electricity_load'          =>  'required',
                'electricity_consumption'   =>  'required',
                'power_backup_details'      =>  'required',
                'manufacturing_capacity'    =>  'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',

            ],
            [
                'module_type.required'=>'Please select module',
                'pmax_applicable_model.*'=>'Please enter Pmax (Wp) of Applicable Models Model',
                'no_of_cells.*'=>'Please enter No of Cells & Cell Type',
                'system_voltage.*'=>'Please enter System Voltage (VDC)',
            ]
            );
            try {
                if($request->edit_id){
                    $deletOldAnnexure = Annexure4::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->delete();
                }
                $annexure4 = new Annexure4();
                $annexure4->application_id = $request->application_id;
                $annexure4->user_id = Auth::user()->id;
                $annexure4->sub_annexure = 1;
                $annexure4->plant_floor_area = $request->plant_floor_area;
                $annexure4->plant_operational_date = $request->plant_operational_date;
                $annexure4->no_manufaturing_line = $request->no_manufaturing_line;
                $annexure4->no_working_day = $request->no_working_day;
                $annexure4->manufacturing_capacity = $request->manufacturing_capacity;
                $annexure4->electricity_load = $request->electricity_load;
                $annexure4->electricity_consumption = $request->electricity_consumption;
                $annexure4->power_backup_details = $request->power_backup_details;
                $annexure4->created_at = $this->getCurrentDate();
                $annexure4->updated_at = $this->getCurrentDate();
            
                $annexure4->save();
                $id=$annexure4->id;
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Annexure 4', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
        $appData=$annexuredata=array();
        if(isset($application_id)){
            $annexuredata = Annexure4::where('application_id',$application_id)->where('user_id',Auth::user()->id)->first();
            if(!$annexuredata){
                $annexuredata=array();
            }
            $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 4 Form', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
        }
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 4 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFour.annexureFour1',compact('application_id','annexuredata','appData','progressBar'));
    }
    public function annexureFourTwo(Request $request, $application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'line'                  =>  'required',
                'compatible_technology' =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:70',
                'commissioning_date'    =>  'required',
                'rated_mfg_capacity'    =>  'required',
                'major_equipments.*'    =>  'required',
                'equipments_type.*'     =>  'required',
                'no_of_units.*'         =>  'required',
                'make.*'                =>  'required',
                'model.*'               =>  'required',
                'rating.*'              =>  'required',
                'country_of_origin.*'   =>  'required',

            ],
            [
                'line.required'=>'Please select line',
                'compatible_technology.required'=>'Please enter Compatible Technology',
                'commissioning_date.required'=>'Please select Commissioning Date',
                'rated_mfg_capacity.required'=>'Please enter Rated Manufacturing Capacity',
                'major_equipments.*'=>'Please select Major Machines/Equipments',
                'equipments_type.*'=>'Please select Machine Type',
                'no_of_units.*'=>'Please mention No. of Units',
                'make.*'=>'Please mention Making details',
                'model.*'=>'Please mention Model Details',
                'rating.*'=>'Please mention rating',
                'country_of_origin.*'=>'Please select country origin',
            ]
            );
            try {
                if($request->edit_id){
                    $deletOldAnnexure = Annexure4::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->delete();
                }
                $annexure4 = new Annexure4();
                $annexure4->application_id = $request->application_id;
                $annexure4->user_id = Auth::user()->id;
                $annexure4->sub_annexure = 2;
                $annexure4->line = $request->line;
                $annexure4->compatible_technology = $request->compatible_technology;
                $annexure4->commissioning_date = $request->commissioning_date;
                $annexure4->rated_mfg_capacity = $request->rated_mfg_capacity;
                $annexure4->major_equipments = json_encode($request->major_equipments);
                $annexure4->equipments_type = json_encode($request->equipments_type);
                $annexure4->no_of_units = json_encode($request->no_of_units);
                $annexure4->make = json_encode($request->make);
                $annexure4->model = json_encode($request->model);
                $annexure4->rating = json_encode($request->rating);
                $annexure4->country_of_origin = json_encode($request->country_of_origin);
                $annexure4->created_at = $this->getCurrentDate();
                $annexure4->updated_at = $this->getCurrentDate();
            
                $annexure4->save();
                $id=$annexure4->id;
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Annexure 4 part 2 ', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four-two/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four-two/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
        $appData=$annexuredata=array();
        if(isset($application_id)){
            $appData = Annexure4::getAnnexureFourData($application_id,Auth::user()->id,2);
            if(!$appData){
                dd('Invalid Request');
            }else{
                foreach($appData as $index => $entry) {
                    $appData[$index] = $entry;
                    $appData[$index]['major_equipments']=Annexure4::getMajoEquipmentData($entry->major_equipments);
                    $appData[$index]['country_of_origin'] = Annexure4::getCountryData($entry->country_of_origin);
                    $appData[$index]['equipments_type'] = Annexure4::getEquipmentType($entry->equipments_type);
                }
            }
            if(isset($edit_id)){
                $annexuredata = Annexure4::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $annexuredata['major_equipments'] = json_decode($annexuredata->major_equipments);
                $annexuredata['equipments_type'] = json_decode($annexuredata->equipments_type);
                $annexuredata['no_of_units'] = json_decode($annexuredata->no_of_units);
                $annexuredata['make'] = json_decode($annexuredata->make);
                $annexuredata['model'] = json_decode($annexuredata->model);
                $annexuredata['rating'] = json_decode($annexuredata->rating);
                $annexuredata['country_of_origin'] = json_decode($annexuredata->country_of_origin);
               //dd($annexuredata);
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 4 part 2 Form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
            }
            
        }
        $countries=Country::all();
        $machineList = MachineList::all();
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 4 part 2 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFour.annexureFour2',compact('application_id','annexuredata','appData','countries','machineList','progressBar'));
    }
    public function annexureFourThree(Request $request, $application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'make_and_model'        =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:70',
                'machine_serial_no'     =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:70',
                'calibration_done_by'   =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:150',
                'last_calibration_date' =>  'required',
                'calibration_valid_upto'=>  'required',

            ]);
            try {
                if($request->edit_id){
                    $deletOldAnnexure = Annexure4::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->delete();
                }
                $annexure4 = new Annexure4();
                $annexure4->application_id = $request->application_id;
                $annexure4->user_id = Auth::user()->id;
                $annexure4->sub_annexure = 3;
                $annexure4->make_and_model = $request->make_and_model;
                $annexure4->machine_serial_no = $request->machine_serial_no;
                $annexure4->calibration_done_by = $request->calibration_done_by;
                $annexure4->last_calibration_date = $request->last_calibration_date;
                $annexure4->calibration_valid_upto = $request->calibration_valid_upto;
                $annexure4->created_at = $this->getCurrentDate();
                $annexure4->updated_at = $this->getCurrentDate();
            
                $annexure4->save();
                $id=$annexure4->id;
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Annexure 4 part 3 ', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four-three/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four-three/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
        $appData=$annexuredata=array();
        if(isset($application_id)){
            $appData = Annexure4::getAnnexureFourData($application_id,Auth::user()->id,3);
            if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
                $annexuredata = Annexure4::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 4 part 3 Form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
               //dd($annexuredata);
            }
            
        }
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 4 part 3 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFour.annexureFour3',compact('application_id','annexuredata','appData','progressBar'));
    }
    public function annexureFourFour(Request $request, $application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'module_type'        =>  'required',
                'machine_serial_no'     =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:70',
                'calibration_done_by'   =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:150',
                'last_calibration_date' =>  'required',
                'calibration_valid_upto'=>  'required',
                'technology_used'       =>  'required',
                'no_full_cell'          =>  'required',
                'no_half_cell'          =>  'required',
                'capacity'              =>  'required'

            ]);
            try {
                if($request->edit_id){
                    $deletOldAnnexure = Annexure4::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->delete();
                }
                $annexure4 = new Annexure4();
                $annexure4->application_id = $request->application_id;
                $annexure4->user_id = Auth::user()->id;
                $annexure4->sub_annexure = 4;
                $annexure4->module_type = $request->module_type;
                $annexure4->machine_serial_no = $request->machine_serial_no;
                $annexure4->calibration_done_by = $request->calibration_done_by;
                $annexure4->last_calibration_date = $request->last_calibration_date;
                $annexure4->calibration_valid_upto = $request->calibration_valid_upto;

                $annexure4->technology_used = $request->technology_used;
                $annexure4->no_full_cell = $request->no_full_cell;
                $annexure4->no_half_cell = $request->no_half_cell;
                $annexure4->capacity = $request->capacity;
                $annexure4->created_at = $this->getCurrentDate();
                $annexure4->updated_at = $this->getCurrentDate();
            
                $annexure4->save();
                $id=$annexure4->id;
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Annexure 4 part 4 ', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four-four/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four-four/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
        $appData=$annexuredata=array();
        if(isset($application_id)){
            //$appData = Annexure4::getAnnexureFourData($application_id,Auth::user()->id,4);
            $appData = Annexure4::where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('sub_annexure',4)->orderby('module_type','ASC')->get();
            if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
                $annexuredata = Annexure4::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 4 part 4 Form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
               //dd($annexuredata);
            }
            
        }
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 4 part 4 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFour.annexureFour4',compact('application_id','annexuredata','appData','progressBar'));
    }
    public function annexureFourFive(Request $request,$application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'iso_certificate'       =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:70',
                'iso_certificate_doc'   =>  'required|file|mimes:pdf',
                'issuing_agency'        =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:300',
                'issuing_date'          =>  'required',

            ]);
            try {
                if($request->edit_id){
                    $annexure4 = Annexure4::findOrFail($request->edit_id);
                }else{
                    $annexure4 = new Annexure4();
                }
                $annexure4->application_id = $request->application_id;
                $annexure4->user_id = Auth::user()->id;
                $annexure4->sub_annexure = 5;
                $annexure4->iso_certificate = $request->iso_certificate;
                $annexure4->issuing_agency = $request->issuing_agency;
                $annexure4->issuing_date = $request->issuing_date;
                $annexure4->certificate_validate = $request->certificate_validate;
                $annexure4->created_at = $this->getCurrentDate();
                $annexure4->updated_at = $this->getCurrentDate();
                
                $dir_path_certificate = 'systems\\Certificate\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                if($request->hasFile('iso_certificate_doc')){
                    $iso_certificate_doc=$this->uploadFile($request->file('iso_certificate_doc'), $dir_path_certificate,'ISO_Certificate');
                    $annexure4->iso_certificate_doc = $iso_certificate_doc['name'];
                }else{
                    $annexure4->iso_certificate_doc = $request->old_iso_certificate_doc;
                }
                $annexure4->save();

                $id=$annexure4->id;
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Annexure 4 part 5 ', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four-five/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four-five/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
        $appData=$annexuredata=array();
        if(isset($application_id)){
            $appData = Annexure4::getAnnexureFourData($application_id,Auth::user()->id,5);
            //dd($appData);
            if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
                $annexuredata = Annexure4::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 4 part 5 Form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
               //dd($annexuredata);
            }
            
        }
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 4 part 5 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFour.annexureFour5',compact('application_id','annexuredata','appData','progressBar'));
    }
    // Vivek
    public function annexureFive(Request $request, $application_id=NULL, $edit_id=NULL){
        if($request->isMethod('post')){
            try {
                if($request->id)
                {
                    $annexure5 = Annexure5::findOrFail($request->id);
                    $annexure5->application_id = $request->application_id;
                    $annexure5->user_id = Auth::user()->id;
                    $annexure5->month = $request->month;
                    $annexure5->financial_year = $request->financial_year;
                    $annexure6->module_production_data = $request->module_production_data;
                    $annexure5->module_sale = $request->module_sale;
                    $annexure5->module_sale_amount = $request->module_sale_amount;
                    $annexure5->epc_other_amount = $request->epc_other_amount;
                    $annexure5->total_sales = $request->total_sales;
                    $annexure5->raw_purchase_module = $request->raw_purchase_module;
                    $annexure5->other_raw_purchase = $request->other_raw_purchase;
                    $annexure5->total_purchase = $request->total_purchase;
                    $annexure5->update();
                    $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Annexure 5 ', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-five/'.$request->application_id)->with('status', 'Annexure Details updated successfuly!');
                }else{
                    $annexure5 = new Annexure5();
                    $annexure5->application_id = $request->application_id;
                    $annexure5->user_id = Auth::user()->id;
                    $annexure5->month = $request->month;
                    $annexure5->financial_year = $request->financial_year;
                    $annexure5->module_production_data = $request->module_production_data;
                    $annexure5->module_sale = $request->module_sale;
                    $annexure5->module_sale_amount = $request->module_sale_amount;
                    $annexure5->epc_other_amount = $request->epc_other_amount;
                    $annexure5->total_sales = $request->total_sales;
                    $annexure5->raw_purchase_module = $request->raw_purchase_module;
                    $annexure5->other_raw_purchase = $request->other_raw_purchase;
                    $annexure5->total_purchase = $request->total_purchase;
                    $annexure5->save();
                    $auditData = array('action_type'=>'Insert','description'=>'Details Saved successfuly for Annexure 5 ', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-five/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
         $appData=$annexuredata=array();
        if(isset($application_id)){
            $startYear = date("Y")+1;
            $prevYear = date("Y");
            $current_financial_year = $prevYear."-".$startYear;
            $appData = Annexure5::where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('financial_year',$current_financial_year)->get();



            $startYear = date("Y");
            $prevYear = date("Y")-1;
            $last_financial_year = $prevYear."-".$startYear;
            $lfyappData = Annexure5::where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('financial_year',$last_financial_year)->get();

            $startYear = date("Y")-1;
            $prevYear = date("Y")-2;
            $lasttolast_financial_year = $prevYear."-".$startYear;
            $ltlfyappData = Annexure5::where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('financial_year',$lasttolast_financial_year)->get();
            if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
                $annexuredata = Annexure5::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure  5', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                //dd($annexuredata);
            }
        }
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 5', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFive.annexureFive',compact('application_id','appData','annexuredata','lfyappData','ltlfyappData','progressBar'));

    }   
    public function deleteAnnexure5($annexure_id,$id){
        if($annexure_id ==1){ //Annexure Table 1
            $deleteData = Annexure5::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        
        if($deleteData){
            $auditData = array('action_type'=>'Delete','description'=>'Annexure Deleted', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
             return redirect()->back()->with('status', 'Delete successfuly!');
        }else{
             return redirect()->back()->with('error', 'Error in Deleting Details');
        }
    }
    public function annexureSix(Request $request, $application_id=NULL, $edit_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'name_of_company'       =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:70',
                'country'               =>  'required',
                'address'               =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:300',
                'whether_enlisted'      =>  'required',
                'noofpv_models'         =>  'required',
                'manufacturing_capacity'=>  'required',

            ]);
            try {
                if($request->id)
                {
                $annexure6 = Annexure6::findOrFail($request->id);
                $annexure6->application_id = $request->application_id;
                $annexure6->user_id = Auth::user()->id;
                $annexure6->name_of_company = $request->name_of_company;
                $annexure6->country = $request->country;
                $annexure6->address = $request->address;
                $annexure6->whether_enlisted = $request->whether_enlisted;
                $annexure6->noofpv_models = $request->noofpv_models;
                $annexure6->manufacturing_capacity = $request->manufacturing_capacity;
                $annexure6->update();
                $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Annexure 6 ', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return redirect('users/annexure-six/'.$request->application_id)->with('status', 'Annexure Details updated successfuly!');
                }else{
                $annexure6 = new Annexure6();
                $annexure6->application_id = $request->application_id;
                $annexure6->user_id = Auth::user()->id;
                $annexure6->name_of_company = $request->name_of_company;
                $annexure6->country = $request->country;
                $annexure6->address = $request->address;
                $annexure6->whether_enlisted = $request->whether_enlisted;
                $annexure6->noofpv_models = $request->noofpv_models;
                $annexure6->manufacturing_capacity = $request->manufacturing_capacity;
                $annexure6->save();
                $auditData = array('action_type'=>'Insert','description'=>'Details Saved successfuly for Annexure 6 ', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return redirect('users/annexure-six/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
         $appData=$annexuredata=array();
        if(isset($application_id)){
            $appData = Annexure6::where('application_id',$application_id)->where('user_id',Auth::user()->id)->get();
            if(!$appData){
                dd('Invalid Request');
            }
             if(isset($edit_id)){
                $annexuredata = Annexure6::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure  6', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                //dd($annexuredata);
            }
        }
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $countrydata = Country::select('countrycd','name')->get();
        $auditData = array('action_type'=>'View','description'=>'View Annexure 6', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureSix.annexureSix',compact('application_id','appData','annexuredata','countrydata','progressBar'));

    }
    public function deleteAnnexure6($annexure_id,$id){
        if($annexure_id ==1){ //Annexure Table 1
            $deleteData = Annexure6::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        
        if($deleteData){
            $auditData = array('action_type'=>'Delete','description'=>'Annexure Deleted', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
             return redirect()->back()->with('status', 'Delete successfuly!');
        }else{
             return redirect()->back()->with('error', 'Error in Deleting Details');
        }
    }
    public function annexureSeven(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'annexure7'       =>  'required|file|mimes:pdf|max:10192',
            ],
            [
                'annexure7.required' => "You must use the 'Choose file' button to select which file you wish to upload",
                'annexure7.max' => "Maximum file size to upload is 10MB (10192 KB)."
            ]);
            try {
                $applicationDetails = ApplicationDetail::find($request->edit_id);
                if($applicationDetails==null){
                    $auditData = array('action_type'=>'Error','description'=>'Invalid Request', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    dd('Invalid Request'); 
                }
                $dir_path_payment = 'systems\\Annexure\\';
                Storage::disk('filestore')->makeDirectory($dir_path_payment);
                if($request->hasFile('annexure7')){
                    $attachment_2=$this->uploadFile($request->file('annexure7'), $dir_path_payment,'ANNEXURE7_'.$request->edit_id);
                    $applicationDetails->annexure7 = $attachment_2['name'];
                }   
                $applicationDetails->save();
                $auditData = array('action_type'=>'Upload','description'=>'Annexure uploaded successfuly', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return redirect('users/annexure-seven/'.$request->application_id)->with('status', 'Annexure uploaded successfuly!');
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
        $appData=array();
        if(isset($application_id)){
            $appData = ApplicationDetail::select('annexure7','id')->where('id',$application_id)->where('user_id',Auth::user()->id)->first();
            if(!$appData){
                dd('Invalid Request');
            }
        }
        //dd($appData);
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 7', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureSeven.annexureSeven',compact('application_id','appData','progressBar'));
    }
    public function annexureEight(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'annexure8'       =>  'required|file|mimes:pdf|max:10192',
            ],
            [
                'annexure8.required' => "You must use the 'Choose file' button to select which file you wish to upload",
                'annexure8.max' => "Maximum file size to upload is 10MB (10192 KB)."
            ]);
            try {
                $applicationDetails = ApplicationDetail::find($request->edit_id);
                if($applicationDetails==null){
                    dd('Invalid Request'); 
                }
                $dir_path_payment = 'systems\\Annexure\\';
                Storage::disk('filestore')->makeDirectory($dir_path_payment);
                if($request->hasFile('annexure8')){
                    $attachment_2=$this->uploadFile($request->file('annexure8'), $dir_path_payment,'ANNEXURE8_'.$request->edit_id);
                    $applicationDetails->annexure8 = $attachment_2['name'];
                }  
                $applicationDetails->save();
                $auditData = array('action_type'=>'Upload','description'=>'Annexure uploaded successfuly', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return redirect('users/annexure-eight/'.$request->application_id)->with('status', 'Annexure uploaded successfuly!');
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }

        }
        $appData=array();
        if(isset($application_id)){
            $appData = ApplicationDetail::select('annexure8','id')->where('id',$application_id)->where('user_id',Auth::user()->id)->first();
            if(!$appData){
                dd('Invalid Request');
            }
        }
        //dd($appData);
        $progressBar = $this->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 8', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureEight.annexureEight',compact('application_id','appData','progressBar'));
    }
    public function deleteAnnexure($annexure_id,$id){
        if($annexure_id ==1){ //Annexure Table 1
            $deleteData = Annexure1::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        if($annexure_id ==2){ //Annexure Table 2
            $deleteData = Annexure2::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        if($annexure_id ==3){ //Annexure Table 3
            $deleteData = Annexure3::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        if($annexure_id ==4){ //Annexure Table 4
            $deleteData = Annexure4::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        if($annexure_id ==5){ //Annexure Table 5
            $deleteData = Annexure5::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        if($annexure_id ==6){ //Annexure Table 6
            $deleteData = Annexure6::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        
        if($deleteData){
            $auditData = array('action_type'=>'Delete','description'=>'Annexure deleted', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
             return redirect()->back()->with('status', 'Delete successfuly!');
        }else{
             return redirect()->back()->with('error', 'Error in Deleting Details');
        }
    }
    public function annexureAttachment(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            try {
                $annexureAttachmentData = ApplicationDetail::findOrFail($request->application_id);
            $dir_path_logo = 'systems\\Attachment\\';
            Storage::disk('filestore')->makeDirectory($dir_path_logo);

            //Certificate of Incorporation
            if($request->hasFile('attc_incorporation_cerificate')){
                $request->validate(
                [
                    'attc_incorporation_cerificate'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_incorporation_cerificate.mimes' => "Please upload PDF file only",
                    'attc_incorporation_cerificate.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_incorporation_cerificate=$this->uploadFile($request->file('attc_incorporation_cerificate'), $dir_path_logo,'CORP_CERTIFICATE_'.$request->application_id);
                $annexureAttachmentData->attc_incorporation_cerificate = $attc_incorporation_cerificate['name'];
            }
            //Details of Payment of Application and Inspection Fee
            if($request->hasFile('attc_application_inspection_payment')){
                $request->validate(
                [
                    'attc_application_inspection_payment'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_application_inspection_payment.mimes' => "Please upload PDF file only",
                    'attc_application_inspection_payment.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_application_inspection_payment=$this->uploadFile($request->file('attc_application_inspection_payment'), $dir_path_logo,'PAYMENT_'.$request->application_id);
                $annexureAttachmentData->attc_application_inspection_payment = $attc_application_inspection_payment['name'];
            }
            //Datasheets of the modules applied for enlistment in ALMM
            if($request->hasFile('attc_enlisted_module_datalist')){
                $request->validate(
                [
                    'attc_enlisted_module_datalist'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_enlisted_module_datalist.mimes' => "Please upload PDF file only",
                    'attc_enlisted_module_datalist.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_enlisted_module_datalist=$this->uploadFile($request->file('attc_enlisted_module_datalist'), $dir_path_logo,'MODULE_DATALIST_'.$request->application_id);
                $annexureAttachmentData->attc_enlisted_module_datalist = $attc_enlisted_module_datalist['name'];
            }
            //Datasheets of the solar cells used in the modules
            if($request->hasFile('attc_solar_cell_datalist')){
                $request->validate(
                [
                    'attc_solar_cell_datalist'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_solar_cell_datalist.mimes' => "Please upload PDF file only",
                    'attc_solar_cell_datalist.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_solar_cell_datalist=$this->uploadFile($request->file('attc_solar_cell_datalist'), $dir_path_logo,'SOLARCELL_DATALIST_'.$request->application_id);
                $annexureAttachmentData->attc_solar_cell_datalist = $attc_solar_cell_datalist['name'];
            }
            //Details of Balance of Materials as sought in Application Form
            if($request->hasFile('attc_bom_details')){
                $request->validate(
                [
                    'attc_bom_details'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_bom_details.mimes' => "Please upload PDF file only",
                    'attc_bom_details.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_bom_details=$this->uploadFile($request->file('attc_bom_details'), $dir_path_logo,'BOM_DETAILS_'.$request->application_id);
                $annexureAttachmentData->attc_bom_details = $attc_bom_details['name'];
            }
            //Copy of Certificate for BIS Registration/ Certification
            if($request->hasFile('attc_bis_certificate')){
                $request->validate(
                [
                    'attc_bis_certificate'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_bis_certificate.mimes' => "Please upload PDF file only",
                    'attc_bis_certificate.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_bis_certificate=$this->uploadFile($request->file('attc_bis_certificate'), $dir_path_logo,'BIS_CERTIFICATE_'.$request->application_id);
                $annexureAttachmentData->attc_bis_certificate = $attc_bis_certificate['name'];
            }
            //Copy of the Accreditation Certificate of the Lab which has given test certificates required for BIS Registration/ Certification
            if($request->hasFile('attc_accreditation_certificate')){
                $request->validate(
                [
                    'attc_accreditation_certificate'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_accreditation_certificate.mimes' => "Please upload PDF file only",
                    'attc_accreditation_certificate.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_accreditation_certificate=$this->uploadFile($request->file('attc_accreditation_certificate'), $dir_path_logo,'ACREDITATION_CERTIFICATE_'.$request->application_id);
                $annexureAttachmentData->attc_accreditation_certificate = $attc_accreditation_certificate['name'];
            }
            //Calibration Report of Sun Simulator
            if($request->hasFile('attc_calibration_report_sun_simulator')){
                $request->validate(
                [
                    'attc_calibration_report_sun_simulator'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_calibration_report_sun_simulator.mimes' => "Please upload PDF file only",
                    'attc_calibration_report_sun_simulator.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_calibration_report_sun_simulator=$this->uploadFile($request->file('attc_calibration_report_sun_simulator'), $dir_path_logo,'REPORT_SUN_SIMULATOR_'.$request->application_id);
                $annexureAttachmentData->attc_calibration_report_sun_simulator = $attc_calibration_report_sun_simulator['name'];
            }
            //Calibration Report of Reference Modules
            if($request->hasFile('attc_calibration_report_module')){
                $request->validate(
                [
                    'attc_calibration_report_module'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_calibration_report_module.mimes' => "Please upload PDF file only",
                    'attc_calibration_report_module.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_calibration_report_module=$this->uploadFile($request->file('attc_calibration_report_module'), $dir_path_logo,'REPORT_MODULE_'.$request->application_id);
                $annexureAttachmentData->attc_calibration_report_module = $attc_calibration_report_module['name'];
            }
            //Copy of valid ISO Certificate for quality management system
            if($request->hasFile('attc_iso_certificate')){
                $request->validate(
                [
                    'attc_iso_certificate'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_iso_certificate.mimes' => "Please upload PDF file only",
                    'attc_iso_certificate.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_iso_certificate=$this->uploadFile($request->file('attc_iso_certificate'), $dir_path_logo,'ISO_CERTIFICATE_'.$request->application_id);
                $annexureAttachmentData->attc_iso_certificate = $attc_iso_certificate['name'];
            }
            //Balance Sheet for last three years or the period of existence of such units, whichever is less
            if($request->hasFile('attc_balance_sheet_last_years')){
                $request->validate(
                [
                    'attc_balance_sheet_last_years'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_balance_sheet_last_years.mimes' => "Please upload PDF file only",
                    'attc_balance_sheet_last_years.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_balance_sheet_last_years=$this->uploadFile($request->file('attc_balance_sheet_last_years'), $dir_path_logo,'BALANCE_SHEET_'.$request->application_id);
                $annexureAttachmentData->attc_balance_sheet_last_years = $attc_balance_sheet_last_years['name'];
            }
            //Trademark Registration Certificate
            if($request->hasFile('attc_trademark_certificate')){
                $request->validate(
                [
                    'attc_trademark_certificate'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_trademark_certificate.mimes' => "Please upload PDF file only",
                    'attc_trademark_certificate.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_trademark_certificate=$this->uploadFile($request->file('attc_trademark_certificate'), $dir_path_logo,'TRADEMARK_CERTIFICATE_'.$request->application_id);
                $annexureAttachmentData->attc_trademark_certificate = $attc_trademark_certificate['name'];
            }
            //Trademark Registration Certificate
            if($request->hasFile('attc_bis_lab_report')){
                $request->validate(
                [
                    'attc_bis_lab_report'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_bis_lab_report.mimes' => "Please upload PDF file only",
                    'attc_bis_lab_report.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_bis_lab_report=$this->uploadFile($request->file('attc_bis_lab_report'), $dir_path_logo,'BIS_LAB_REPORTE_'.$request->application_id);
                $annexureAttachmentData->attc_bis_lab_report = $attc_bis_lab_report['name'];
            }
            $annexureAttachmentData->attachment_uploaded=1;
            $annexureAttachmentData->save();
            $auditData = array('action_type'=>'Upload','description'=>'User Upload Attachments', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
            return redirect('users/annexure-attachment/'.$request->application_id)->with('status', 'Dcoument upload successfuly!');
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
            

        }
        $appData=array();
        if(isset($application_id)){
            $appData = ApplicationDetail::where('id',$application_id)->where('user_id',Auth::user()->id)->first();
            if(!$appData){
                dd('Invalid Request');
            }
        }
        //dd($appData);
        $progressBar = $this->getApplicationProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure attachment page', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureAttachment',compact('application_id','appData','progressBar'));
    }
    public function deleteAttachment($application_id,$column_name){
        $file_name='';
        $annexureAttachmentData = ApplicationDetail::findOrFail($application_id);
        if($column_name=='attachment_1'){
            $file=ApplicationDetail::getAttachmentName('attc_incorporation_cerificate',$application_id);
            $file_name = $file->attc_incorporation_cerificate;
            $annexureAttachmentData->attc_incorporation_cerificate = NULL;
        }
        if($column_name=='attachment_2'){
            $file=ApplicationDetail::getAttachmentName('attc_application_inspection_payment',$application_id);
            $file_name = $file->attc_application_inspection_payment;
            $annexureAttachmentData->attc_application_inspection_payment = NULL;
        }
        if($column_name=='attachment_3'){
            $file=ApplicationDetail::getAttachmentName('attc_enlisted_module_datalist',$application_id);
            $file_name = $file->attc_enlisted_module_datalist;
            $annexureAttachmentData->attc_enlisted_module_datalist = NULL;
        }
        if($column_name=='attachment_4'){
            $file=ApplicationDetail::getAttachmentName('attc_solar_cell_datalist',$application_id);
            $file_name = $file->attc_solar_cell_datalist;
            $annexureAttachmentData->attc_solar_cell_datalist = NULL;
        }
        if($column_name=='attachment_5'){
            $file=ApplicationDetail::getAttachmentName('attc_bom_details',$application_id);
            $file_name = $file->attc_bom_details;
            $annexureAttachmentData->attc_bom_details = NULL;
        }
        if($column_name=='attachment_6'){
            $file=ApplicationDetail::getAttachmentName('attc_bis_certificate',$application_id);
            $file_name = $file->attc_bis_certificate;
            $annexureAttachmentData->attc_bis_certificate = NULL;
        }
        if($column_name=='attachment_7'){
            $file=ApplicationDetail::getAttachmentName('attc_accreditation_certificate',$application_id);
            $file_name = $file->attc_accreditation_certificate;
            $annexureAttachmentData->attc_accreditation_certificate = NULL;
        }
        if($column_name=='attachment_8'){
            $file=ApplicationDetail::getAttachmentName('attc_calibration_report_sun_simulator',$application_id);
            $file_name = $file->attc_calibration_report_sun_simulator;
            $annexureAttachmentData->attc_calibration_report_sun_simulator = NULL;
        }
        if($column_name=='attachment_9'){
            $file=ApplicationDetail::getAttachmentName('attc_calibration_report_module',$application_id);
            $file_name = $file->attc_calibration_report_module;
            $annexureAttachmentData->attc_calibration_report_module = NULL;
        }
        if($column_name=='attachment_10'){
            $file=ApplicationDetail::getAttachmentName('attc_iso_certificate',$application_id);
            $file_name = $file->attc_iso_certificate;
            $annexureAttachmentData->attc_iso_certificate = NULL;
        }
        if($column_name=='attachment_11'){
            $file=ApplicationDetail::getAttachmentName('attc_balance_sheet_last_years',$application_id);
            $file_name = $file->attc_balance_sheet_last_years;
            $annexureAttachmentData->attc_balance_sheet_last_years = NULL;
        }
        if($column_name=='attachment_12'){
            $file=ApplicationDetail::getAttachmentName('attc_trademark_certificate',$application_id);
            $file_name = $file->attc_trademark_certificate;
            $annexureAttachmentData->attc_trademark_certificate = NULL;
        }
        if($column_name=='attachment_13'){
            $file=ApplicationDetail::getAttachmentName('attc_bis_lab_report',$application_id);
            $file_name = $file->attc_bis_lab_report;
            $annexureAttachmentData->attc_bis_lab_report = NULL;
        }
        Storage::disk('filestore')->delete('systems/Attachment/'.$file_name);
        $annexureAttachmentData->save();
        $auditData = array('action_type'=>'Delete','description'=>'Deleted Annexure attachment ', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return redirect('users/annexure-attachment/'.$application_id)->with('status', 'Dcoument Removed successfuly!');
      
    }
    public function applicationSubmission(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'signatory_document'       => 'required|file|mimes:pdf|max:10192',
                'declaration'              => 'required'
            ],
            [
                'attc_iso_certificate.mimes' => "Please upload PDF file only",
                'attc_iso_certificate.max' => "Maximum file size to upload is 10MB (10192 KB).",
                'declaration.required'  =>  'Please check declaration'
            ]);
            try {
                $finalSubmission = ApplicationDetail::findOrFail($request->edit_id);
                $application_no = 'ALMM/'.$finalSubmission->application_type.'/'.$request->edit_id.'/'.date("Y").'/'.($finalSubmission->id+1);
                $finalSubmission->declaration = $request->declaration;
                $finalSubmission->final_submission=1;
                $finalSubmission->application_no=$application_no;
                $finalSubmission->created_at = $this->getCurrentDate();
                $finalSubmission->updated_at = $this->getCurrentDate();
                
                $dir_path_certificate = 'systems\\Attachment\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                if($request->hasFile('signatory_document')){
                    $signatory_document=$this->uploadFile($request->file('signatory_document'), $dir_path_certificate,'SIGNED_DOC_'.$request->edit_id);
                    $finalSubmission->signatory_document = $signatory_document['name'];
                }
                $finalSubmission->save();
                $auditData = array('action_type'=>'Insert','description'=>'Application Final Submitted successfuly', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return redirect('users/user-applications')->with('status', 'Application submitted successfuly');
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }
            
        }
       $progressBar = $this->getApplicationProgress($application_id);
       $auditData = array('action_type'=>'View','description'=>'View Annexure final submission', 'user_type'=>'MFT');
       $this->auditTrail($auditData);
       return view('backend.user.form.finalSubmission',compact('progressBar','application_id'));
    }
    public function downloadApplication($application_id){
        $application_data = ApplicationDetail::where('id',$application_id)->where('user_id',Auth::user()->id)->first();
        $applied_pvmodels = AppliedPvmodel::where('application_id', $application_id)->where('user_id', Auth::user()->id)->get();
        $data = array(
            'application_data'=>$application_data,
            'applied_pvmodels'=>$applied_pvmodels
        );
        //return view('backend/user/form/pdf_newApplication',$data);
        $pdf = PDF::loadView('backend/user/form/pdf_newApplication', $data);
        return $pdf->download('Application_'.date("ymdhis").'.pdf');
    }
    // Vivek
    public function viewApplication(Request $request, $id)
    {
        $annexureData = ApplicationDetail::getAnnexureByApplicationID($id);
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'View','description'=>'User viewed application detail ','user_type'=>'MFT');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.user.form.view-applications', compact('annexureData'));
    }
    public function trackDetail(Request $request, $application_id)
    {
        $application_id=base64_decode($application_id);
        $applications = ApplicationDetail::select('created_at','application_no')->where('id',$application_id)->first();
        $trackDetail = ForwardDetail::where('application_id',$application_id)->orderBy('id','DESC')->paginate(50);
        return view('backend.common.track-detail', compact('trackDetail','applications'));
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

    public function addEditSystem(Request $request, $id){
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
    public function requestToChangeScheduleDate(Request $request){
       $inspectHistory = InspectionHistory::findOrFail($request->id);
       $inspectHistory->proposed_date = $request->proposed_date;
       $inspectHistory->request_remark = $request->request_remark;
       $inspectHistory->change_request = 1;
       $inspectHistory->save();
       if($inspectHistory->save()){
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'Update','description'=>'User Request to Reschedule Inspcection','user_type'=>'MFT');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                $action ='Manufature request to re-scheduled Inspection date. New Proposed Inspection date : '.$request->proposed_date;
                $forwardDetail = array('user_type'=>'user','application_id'=>$request->application_id,'action'=>$action,'description'=>$request->request_remark);
                $this->forwardDetail($forwardDetail);
                //Please mail function add here
                return response()->json(['success'=>'Request Submitted successfully']);   
            }else{
                return response()->json(['error'=>'Error']);  
        }
        
    }
    
    public function previewDocs($folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'systems/'.$folder.'/'.$file;
        //$filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }

    public function downloadDoc($consumerId, $folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'systems/'.base64_decode($consumerId).'/'.base64_decode($folder);
        $filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return Storage::disk('filestore')->download($filePath);
    }
}