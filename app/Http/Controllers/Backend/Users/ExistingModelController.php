<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Models\Existingmodel;
use App\Models\Country;
use App\Models\State;
use App\Models\MachineList;
use App\Traits\General;
use App\Models\ApplicationDetail;
use App\Models\AppliedPvmodel;
use App\Models\Annexure1;
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

class ExistingModelController extends Controller
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

    public function selectExisingApplication(Request $request, $id=NULL){
       if($request->ismethod('post')){
            try {
                $old_application_details = ApplicationDetail::find($request->application);
                $new_application_data = $old_application_details->replicate();
                $new_application_data->created_at = $this->getCurrentDate();
                $new_application_data->updated_at = $this->getCurrentDate();
                $new_application_data->final_submission = 0;
                $new_application_data->application_type = 2;
                $new_application_data->status=0;
                $save=$new_application_data->save();
                $id=$new_application_data->id;
                ApplicationDetail::replicateAnnexures($request->application,$id);
                 
                if($save){
                    return redirect('users/existing-application/'.$id)->with('status', 'Saved successfuly!');
                }else{
                    return redirect('users/select-exising-application/'.$request->application)->with('error', 'Error in Details');
                } 
            } catch (Exception $ex) {
                //return redirect()->back()->with("error","Server error !");
                dd($ex->getMessage());
            }
        }
        $application_details = ApplicationDetail::select('id','application_no')->where('application_type',1)->where('final_submission',1)->get();
        // $annexure1 = annexure1::select('id','application_no')->where('')->get();
        return view('backend.user.existingmodel.selectapplication', compact('application_details'));
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

    public function ExistingApplication(Request $request, $id=NULL){
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
                    return redirect('users/existing-application/'.$request->edit_id)->with('status', 'Application saved updated successfuly!');
                    return redirect()->back()->with('status', 'Application Details updated successfuly!');
                }
                
                $applicationDetails->save();
                $id=$applicationDetails->id;
                if($id){
                    
                    $auditData = array('action_type'=>'Update','description'=>'Updated New Application Form', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/existing-application-step2'.$applicationDetails->id)->with('status', 'Application saved updated successfuly!');
                }else{
                    
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/existing-application/'.$applicationDetails->id)->with('error', 'Error in Updating Details');
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
        
       
        return view('backend.user.\existingmodel\newExistingApplication',compact('appData','progressBar','countries'));
        
    }

    public function ExistingApplicationStep2(Request $request, $id=NULL){
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
                //'inspection_date'           =>  'required',
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
                    return redirect('users/existing-application-step2/'.$request->edit_id)->with('status', 'Application saved successfuly!');
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
        return view('backend.user.existingmodel\newExistingApplicationStep2',compact('appData','pvdata','progressBar'));
    }

    public function getApplicationProgress($application_id){
        $progressData = new ApplicationProgress();
        return $progressData->getApplicationProgress($application_id);
    }

    public function getApplicationAnnexureProgress($application_id){
        $progressData = new ApplicationProgress();
        return $progressData->getApplicationAnnexureProgress($application_id);
    }

    public function existingannexure1(Request $request, $application_id=NULL,$edit_id=NULL){
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
                    
                    return redirect('users/existing-annexure-one/'.$request->application_id)->with('status', 'Annexure 1 Details saved successfuly!');
                }else{
                    
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/existing-annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
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
        
        return view('backend.user.existingmodel.annexureOne.existingannexure1',compact('appData','application_id','annexuredata','moduleList','progressBar'));
    } 
    
    public function existingannexure1_1(Request $request, $application_id=NULL,$edit_id=NULL){
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
                    
                    return redirect('users/existing-annexure-one-b/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return redirect('users/existing-annexure-one-b/'.$request->application_id)->with('error', 'Error in Updating Details');
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
       
        return view('backend.user.existingmodel.annexureOne.existingannexure1_2',compact('appData','application_id','annexuredata','moduleList','progressBar'));
    }

   

    
}