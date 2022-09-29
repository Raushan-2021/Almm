<?php

namespace App\Http\Controllers\Backend\Mnre;

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
use App\Models\SubDistrict;
use App\Models\AuditTrail;
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
        $auditData = array('action_type'=>'View','description'=>'User viewed Dashboard', 'user_type'=>'MNRE');
        $this->auditTrail($auditData);
        return view('backend.mnre.dashboard', compact('data','users'));
 
    }

    public function mnreUsers(Request $request)
    {
        $users = Mnre::where('admin', 0)->get();//data fatch kiya
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
    public function previewDocs($folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'systems/'.$folder.'/'.$file;
        //$filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return view('auth.preview', compact('filePath'));
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
        $applications = ApplicationDetail::orderBy('id','DESC')->where('final_submission',1)->paginate(50);
        /*************************Audit Trail Start**********************************/
            $auditData = array('action_type'=>'View','description'=>'MNRE User viewed Application','user_type'=>'MNRE');
            $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnre.applications-list', compact('applications'));
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
                $applicationdetail = ApplicationDetail::findOrFail($request->id);
                $applicationdetail->forward_status = $request->forward_status;
                if($request->forward_status=='nise')
                {
                    $action = 'Application has been Forwarded to NISE by MNRE';

                }elseif($request->forward_status=='reject'){
                    
                    $action = 'Application has been rejected by MNRE'; 
                }else{

                   $action = '';
                }

                $applicationdetail->update();
            $forwardDetail = array('user_type'=>'mnre','application_id'=>$request->id,'action'=>$action,'description'=>$request->description);
                $this->forwardDetail($forwardDetail);
                /*************************Audit Trail Start**********************************/
            $auditData = array('action_type'=>'Insert','description'=>$action,'user_type'=>'MNRE');
            $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
                return redirect('mnre/applications-list')->with('status', $action);
            }
            
        }

     }

     private function forwardDetail($dataArr)
     {
            $applicationdetail = new ForwardDetail();
            $applicationdetail->user_id = Auth::user()->id;
            $applicationdetail->user_type = $dataArr['user_type'];
            $applicationdetail->application_id = $dataArr['application_id'];
            $applicationdetail->action = $dataArr['action'];
            $applicationdetail->description = $dataArr['description'];
            $applicationdetail->save();
     }


    public function viewApplication(Request $request, $id)
    {
        
        $annexureData = ApplicationDetail::getAnnexureByApplicationID($id);
        //dd($annexureData);
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'View','description'=>'MNRE User viewed application detail','user_type'=>'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail End**********************************/
        return view('backend.mnre.view-applications', compact('annexureData'));
    }

    public function resetPassword(Request $request)
    {
        $manufaturer_user = User::findOrFail($request->id);
        $password = $this->randomPassword();
        $password_hash = Hash::make($password);
        $manufaturer_user->password = $password_hash;
        $manufaturer_user->update();
        if($manufaturer_user->update())
        {

        /*************************Audit Trail Start**********************************/
            $auditData = array('action_type'=>'Update','description'=>'Password has been changed by MNRE User','user_type'=>'MNRE');
            $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
          //Please mail function add here
         return response()->json(['success'=>'Password has been changed successfully']);   
         }else{
         return response()->json(['error'=>'Error In Password Changing']);  
         }
        
    }

    public function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
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
    public function userAuditTrail(Request $request){

        if($request->isMethod('get')){
            $auditTrailData= AuditTrail::orderBy("entry_date",'DESC')->paginate(30);
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
    
   
}
