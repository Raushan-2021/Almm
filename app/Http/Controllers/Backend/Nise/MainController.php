<?php

namespace App\Http\Controllers\Backend\Nise;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Annexure1;
use App\Models\Annexure2;
use App\Models\Annexure3;
use App\Models\Annexure4;
use App\Models\Annexure5;
use App\Models\Annexure6;
use App\Models\BillMaterial;
use App\Models\ForwardDetail;
use App\Models\ApplicationDetail;
use App\Models\AppliedPvmodel;
use App\Models\State;
use App\Models\Mnre;
use App\Models\Program;
use App\Traits\General;
use App\Models\Consumer;
use App\Models\District;
use App\Models\Inspector;
use App\Models\Installer;
use App\Models\SubDistrict;
use App\Models\Installation;
use App\Models\StateImplementingAgencyUser;
use App\Models\MaintenanceRequest;
use App\Models\LocalbodyUser;
use App\Models\MaintenanceRegistry;
use App\Models\InstallationReviewLog;
use App\Models\InstallationCapacity;
use App\Models\AuditTrail;
use App\Models\InspectionHistory;
use App\Imports\InspectorImport;
use App\Imports\InstallerImport;
use App\Imports\LocalbodyImport;
use App\Imports\StateImplementingAgencyImport;
use App\Utils\Dictionary;
use App\Utils\Dashboard;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;


use DB, URL, Auth, Hash, Storage, Validator, Config;


class MainController extends Controller
{
    use General;
    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
        //dd(Auth::user());
    }

    public function index()
    {
        
        $dashboard = new Dashboard();//App-utils-Dashboard
        $users = User::select('id')->count();
        $data = $dashboard->getMNREDashboardData();//Dashboard.php (getMNREDashboardData)
        $auditData = array('action_type'=>'1','description'=>'User viewed Dashboard','user_type'=>'1');
        $this->auditTrail($auditData);
        
        return view('backend.mnre.dashboard', compact('data','users'));
 
    }

    public function mnreUsers(Request $request)
    {
        $users = Mnre::where('admin', 0)->where('admin', 0)->get();//data fatch kiya
         /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'View','description'=>'User viewed MNRE User List','user_type'=>'MNRE');
        $this->auditTrail($auditData);
         /*************************Audit Trail Start**********************************/
        return view('backend.mnre.mnreUserList', compact('users'));
    }

    public function createMnreUser(Request $request)
    {
       if($request->isMethod('get')){
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type'=>'Insert','description'=>' MNRE User visited Create Mnre User ','user_type'=>'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.mnre.createMnreUser');
        }
        elseif($request->isMethod('post')){
            try{
                $userData = [
                    'name' => $request->name,
                    'email' => $request->email
                ];
                if(!empty($request->password))
                    $userData['password'] = Hash::make($request->password);
    
                if(empty($request->id)){
                    $msg = 'New MNRE user created successfully!';
                    Mnre::create($userData);

                    /*************************Audit Trail Start**********************************/
                    $auditData = array('action_type'=>'2','description'=>' MNRE User create new user ','user_type'=>'1');
                    $this->auditTrail($auditData);
                    /*************************Audit Trail Start**********************************/
                }
                else{
                    
                    $msg = 'MNRE user updated successfully!';
                    Mnre::where('id', $request->id)->update($userData);
                    
                    /*************************Audit Trail Start**********************************/
                    $auditData = array('action_type'=>'3','description'=>' MNRE User Update data in mnre-user-list ','user_type'=>'1');
                    $this->auditTrail($auditData);
                    /*************************Audit Trail Start**********************************/
                }
                
                return redirect('mnre/mnre-user-list')->with("status", $msg);
            }
            catch(\Exception $e){
                return redirect()->back()->with("error","Server Error!");
            }
        }
    }

    public function editMnreUser(Request $request, $id)
    {
        
        $user = Mnre::where('id', base64_decode($id))->first()->toArray();
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'View','description'=>'MNRE User viewed update profile page ','user_type'=>'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnre.createMnreUser', compact('user'));
    }

    //Vivek

    public function manufaturerUsers(Request $request)
    {
        $users = User::orderBy('id','DESC')->paginate(50);
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'View','description'=>'MNRE User visited Manufaturer Users','user_type'=>'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnre.manufaturerUserList', compact('users'));
    }
   
    public function UserApplications(Request $request)
    {
        $applications=array();$i=0;
        $inspectionHistory = ApplicationDetail::where('forward_status','nise')->orderBy('id','DESC')->get();
        foreach($inspectionHistory as $data){$i++;
           $applications[$i] = $data;
           $inc_history = InspectionHistory::where('application_id',$applications[$i]->id)->limit(1)->orderBy('id','DESC')->get()->toArray();
           $applications[$i]['inspectionData'] = $inc_history;
        }
        //dd($applications);
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'View','description'=>'MNRE User viewed Application','user_type'=>'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.nise.applications-list', compact('applications'));
    }

    public function trackDetail(Request $request, $application_id)
    {
        $applications = ApplicationDetail::select('created_at')->where('id',base64_decode($application_id))->first();
        $trackDetail = ForwardDetail::where('application_id',base64_decode($application_id))->orderBy('id','DESC')->paginate(50);
        /*************************Audit Trail Start**********************************/
            $auditData = array('action_type'=>'View','description'=>'MNRE User viewed Track Detail','user_type'=>'MNRE');
            $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.common.track-detail', compact('trackDetail','applications'));
    }


    public function forwardto(Request $request, $application_id=NULL){
        if($request->isMethod('post')){

            if($request->id)
            {
                // $applicationdetail = ApplicationDetail::findOrFail($request->id);
                // $applicationdetail->update();
                  //$applicationdetail->forward_status = $request->forward_status;
                if($request->forward_status=='mnre')
                {
                    $action = 'Application has been Forwarded to MNRE by NISE';

                }elseif($request->forward_status=='reject'){
                    
                    $action = 'Application has been rejected by NISE'; 
                }elseif($request->forward_status=='user'){

                   $action = 'Notification for user';
                }else{
                    $action = '';
                }
                $forwardDetail = array('user_type'=>'nise','application_id'=>$request->id,'action'=>$action,'description'=>$request->description);
                $this->forwardDetail($forwardDetail);
                 /*************************Audit Trail Start**********************************/
                 $auditData = array('action_type'=>'Insert','description'=>$action,'user_type'=>'MNRE');
                 $this->auditTrail($auditData);
                 /*************************Audit Trail Start**********************************/
                return redirect('nise/applications-list')->with('status', $action);
            }
            
        }

     }
     public function scheduleInspection(Request $request){
        try {
            //code...
            //dd($request);
            $inspectHistory = new InspectionHistory();
            $inspectHistory->user_id = $request->user_id;
            $inspectHistory->application_id = $request->application_id;
            $inspectHistory->inspection_date = $request->inspection_date;
            $inspectHistory->proposed_date = $request->proposedDate;
            $inspectHistory->remark = $request->description;
            $inspectHistory->entry_date = $this->getCurrentDate();
            $inspectHistory->save();
            $action ='NISE scheduled Inspection date to '.$request->inspection_date;
            $forwardDetail = array('user_type'=>'nise','application_id'=>$request->application_id,'action'=>$action,'description'=>$request->description);
            $this->forwardDetail($forwardDetail);
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type'=>'Update','description'=>$action,'user_type'=>'NISE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return redirect('nise/applications-list')->with('status', $action);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        
     }
    public function previewDocs($folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'systems/'.$folder.'/'.$file;
        //$filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }

    public function viewApplication(Request $request, $id)
    {
        
        $applicationDetail = ApplicationDetail::where('id', base64_decode($id))->first()->toArray();

        $applied_pvmodels = AppliedPvmodel::where('application_id', $applicationDetail['id'])->where('user_id', $applicationDetail['user_id'])->get();
        
        $annexure6 = Annexure6::where('application_id', $applicationDetail['id'])->where('user_id', $applicationDetail['user_id'])->get();
      
         $annexure1 = Annexure1::getAnnexureData($applicationDetail['id'],$applicationDetail['user_id'],1);
         


        $annexure1_sub2 = Annexure1::where('application_id',$applicationDetail['id'])->where('user_id',$applicationDetail['user_id'])->where('sub_annexure',2)->get();
        $annexure1_sub3 = Annexure1::where('application_id',$applicationDetail['id'])->where('user_id',$applicationDetail['user_id'])->where('sub_annexure',3)->get();
        $annexure1_sub4 = Annexure1::where('application_id',$applicationDetail['id'])->where('user_id',$applicationDetail['user_id'])->where('sub_annexure',4)->get();
        $annexure1_sub5 = Annexure1::where('application_id',$applicationDetail['id'])->where('user_id',$applicationDetail['user_id'])->where('sub_annexure',5)->get();
        $annexure1_sub6 = Annexure1::where('application_id',$applicationDetail['id'])->where('user_id',$applicationDetail['user_id'])->where('sub_annexure',6)->get();

        $annexure2 = Annexure2::getAnnexureTwoData($applicationDetail['id'],Auth::user()->id);
        $annexure2_aryData=array(); $i=0;
        foreach($annexure2 as $dt){$i++;
            $bill_material_id_array=array();
            $annexure2_aryData[$i]=$dt;
            $bill_material_id = json_decode($dt['bill_material_id']);
            foreach($bill_material_id as $bill){
                $bill_material_id_array[] = BillMaterial::getBillMaterialTitle($bill)->bill_title;
            }
            $annexure2_aryData[$i]['bill_material_id']=json_encode($bill_material_id_array);
        } 
        $annexure3=array();
        $annexure3 = Annexure3::getAnnexureThreeData($applicationDetail['id'],Auth::user()->id);

        $annexure4 = Annexure4::getAnnexureFourData($applicationDetail['id'],Auth::user()->id,2);
        $annexure4_sub3 = Annexure4::getAnnexureFourData($applicationDetail['id'],Auth::user()->id,3);
        $annexure4_sub4 = Annexure4::where('application_id',$applicationDetail['id'])->where('user_id',Auth::user()->id)->where('sub_annexure',4)->orderby('module_type','ASC')->get();
        $annexure4_sub5 = Annexure4::getAnnexureFourData($applicationDetail['id'],Auth::user()->id,5);
        // Vivek
        $startYear = date("Y")+1;
        $prevYear = date("Y");
        $current_financial_year = $prevYear."-".$startYear;
        $annexure5_appData = Annexure5::where('application_id',$applicationDetail['id'])->where('user_id',$applicationDetail['user_id'])->where('financial_year',$current_financial_year)->get();

        $startYear = date("Y");
        $prevYear = date("Y")-1;
        $last_financial_year = $prevYear."-".$startYear;
        $annexure5_lfyappData = Annexure5::where('application_id',$applicationDetail['id'])->where('user_id',$applicationDetail['user_id'])->where('financial_year',$last_financial_year)->get();

        $startYear = date("Y")-1;
        $prevYear = date("Y")-2;
        $lasttolast_financial_year = $prevYear."-".$startYear;
        $annexure5_ltlfyappData = Annexure5::where('application_id',$applicationDetail['id'])->where('user_id',$applicationDetail['user_id'])->where('financial_year',$lasttolast_financial_year)->get();
        //Vivek
        //dd($annexure1_sub3);
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'View','description'=>'MNRE User viewed application detail','user_type'=>'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.nise.view-applications', compact('applicationDetail','applied_pvmodels','annexure1','annexure1_sub2','annexure1_sub3',
        'annexure1_sub4','annexure1_sub5','annexure1_sub6','annexure6','annexure5_appData','annexure5_lfyappData','annexure5_ltlfyappData',
        'annexure2_aryData','annexure3','annexure4','annexure4_sub3','annexure4_sub4','annexure4_sub5'));
    }

     public function resetPassword(Request $request)
    {
        $manufaturer_user = User::findOrFail($request->id);
        $password = $this->generateRandomString(10);
        $password_hash = Hash::make($password);
        $manufaturer_user->password = $password_hash;
        $manufaturer_user->update();
        if($manufaturer_user->update())
        {
            //Please mail function add here
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type'=>'Update','description'=>'Password has been changed by MNRE User','user_type'=>'MNRE');
            $this->auditTrail($auditData);
            return response()->json(['success'=>'Password has been changed successfully']);   
         }else{
            return response()->json(['success'=>'Password has been changed successfully']);  
         }
        
    }
    //Vivek

    public function editProfile(Request $request)
    {
        try {
            $user = Auth::user();
            if($request->isMethod('get')){
                 /*************************Audit Trail Start**********************************/
               $auditData = array('action_type'=>'View','description'=>'MNRE User viewed edit Profile Page','user_type'=>'MNRE');
               $this->auditTrail($auditData);
               /*************************Audit Trail Start**********************************/
                return view('backend.mnre.editProfile', compact('user'));
            }

            $user->name = $request->name;
            $isSaved = $user->save();
            if($isSaved){
                 /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'Update','description'=>'Profile edited MNRE User','user_type'=>'MNRE');
               $this->auditTrail($auditData);
               /*************************Audit Trail Start**********************************/
                return redirect()->back()->with("status","Profile edited successfully !");
            }
        } catch (\Throwable $th) {
            /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'ExError','description'=>'Server Error !','user_type'=>'MNRE');
               $this->auditTrail($auditData);
               /*************************Audit Trail Start**********************************/
            return redirect()->back()->with("error","Server Error !");
        }
    }

    public function changePassword(Request $request)
    {
        try {
            if($request->isMethod('get')){
                $submitUrl = URL::to('/mnre/change-password');
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'View','description'=>'MNRE User view Change Password Option','user_type'=>'MNRE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                return view('backend.common.changePassword', compact('submitUrl'));
            }

            if (!(Hash::check($request->current_password, Auth::user()->password))) {
                 /*************************Audit Trail Start**********************************/
                 $auditData = array('action_type'=>'Update','description'=>' MNRE User  Match Password ','user_type'=>'MNRE');
                 $this->auditTrail($auditData);
                 /*************************Audit Trail Start**********************************/
                // The passwords matches
                return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            }

            if(!$this->passwordPolicyTest($request->new_password)){
                $error = 'Failed strong password policy!';
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'Update','description'=>'MNRE User Test password Policy  ','user_type'=>'MNRE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
               
                return redirect()->back()->with("error", $error);
            }

            if(strcmp($request->current_password, $request->new_password) == 0){
                 /*************************Audit Trail Start**********************************/
                 $auditData = array('action_type'=>'Update','description'=>' MNRE User verify condition currunt and new password not same  ','user_type'=>'MNRE');
                 $this->auditTrail($auditData);
                 /*************************Audit Trail Start**********************************/
                //Current password and new password are same
                return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            }

            //Change Password
                $user = Auth::user();
                $user->password = bcrypt($request->new_password);
                $user->save();
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'Update','description'=>' MNRE User Inserted new password  ','user_type'=>'MNRE');
                $this->auditTrail($auditData);
             /*************************Audit Trail Start**********************************/
            return redirect()->back()->with("status","Password changed successfully !");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error","Server Error !");
        }
    }

    
    
    /****************Added By Ekta on 15 July 2022**********************/
    public function userAuditTrail(Request $request){

        if($request->isMethod('get')){
            $auditTrailData= AuditTrail::orderBy("entry_date",'DESC')->limit(200)->get();
            return view('backend.mnre.auditTrail',compact('auditTrailData'));
        }
        $validatedData = $request->validate([
            'fromDate'=>'required',
            'toDate'=>'required',
        ]);
        $fromdata=$request->input('fromDate');
        $todata=$request->input('toDate');
        
        $auditTrailData= AuditTrail::whereBetween('entry_date', [$fromdata , $todata.' 23:59:59'])->get();//(entry_date) yeh column name hai jo database me likha h 
        return view('backend.mnre.auditTrail',compact('auditTrailData'));
    
    }
    //post function main where condition m entry_date ko between use kr apply kiya
}
