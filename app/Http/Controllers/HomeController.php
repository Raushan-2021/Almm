<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\State;
use App\Models\District;
use App\Models\Village;
use App\Traits\General;
use App\Utils\EmailSmsNotifications;
use App\Models\Consumer;
use App\Models\SubDistrict;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use Hash;

class HomeController extends Controller
{
    use General;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function registerUser(Request $request){
        if($request->isMethod('get')){
            $countries = Country::all();
            $state = State::all();
            //dd($state);
            return view('auth.register',compact('countries','state'));
        }else{
            $request->validate(
                [
                    'name'          => 'required|string|regex:/^[a-zA-Z ]*$/|max:20',
                    'email'         => 'required|email|unique:manufaturer_users,email',
                    'phone'         => 'required|numeric|digits:10',
                    'pan'           => 'required|regex:/[A-Za-z]{5}[0-9]{4}[A-Za-z]/',
                    'gst'           => 'required',
                    'address'       => 'required',
                    'country_id'    => 'required',
                    'state_id'      => 'required_if:country_id,99',
                    'district_id'   => 'required_if:country_id,99',
                ],
                [
                    'phone.required' => 'Please enter mobile number',
                    'phone.numeric' => 'The mobile number be a number.',
                    'phone.digits:10' => 'The mobile number must be 10 digits.',
                    'pan.required' => 'The PAN number field is required.',
                    'pan.regex' => 'The PAN number format is not valid',
                    'gst.required' => 'The GST number field is required.',
                    'country_id.required' => 'Please choose your country.'
                ]
            );
            //dd($request->all());
            $password=$this->generateRandomString(8);
            $email=$request->input('email');
            $name=$request->input('name');
            $user = new User;
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->pan = $request->input('pan');
            $user->gst = $request->input('gst');
            $user->address = $request->input('address');
            $user->country_id = $request->input('country_id');
            $user->state_id = $request->input('state_id');
            $user->district_id = $request->input('district_id');
            $user->pin_code = $request->input('pincode');
            //dd($user);
            $user->save();
            try {
                //code...
                try {
                    //code...
                    $this->emailSmsNotifications->notifyManufacturerRegistration($email, $password, 'MNF-MP-34', $name);
                    //dd('Email Sent');
                } catch (\Throwable $th) {
                    //throw $th;
                    dd($th->getMessage());
                }
                
                //dd('Email Sent');
            } catch (\Throwable $th) {
                //throw $th;
                dd($th->getMessage());
            }
            
            return redirect('/login')->with('status','Your account has been registered successfully. Please check your email for cridentials');
        }
    }

    public function get_distictbystate(Request $request)
    {
        
        $state_id = $request->state_id;
        $distict = District::getDistictByState($request->state_id);
        return response()->json($distict);
    }

    public function consumerInterestForm(Request $request)
    {
        if($request->isMethod('get')){
            $sub_districts = SubDistrict::all();
            return view('frontend.consumerInterestForm', compact('sub_districts'));
        }

        elseif($request->isMethod('post')){
            try {
                $consumer = new Consumer();
                $consumer->consumer_id = $this->generateIdForStakeholders('CON', $request->state_id);//traits (general.php) main function bnaya Hai generateIdForStakeholder
                $consumer->name = $request->name;
                $consumer->house_no = $request->house_no;
                //$data->columnname = $request->formvariableName
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
                $consumer->date_of_reg = date("d-m-Y");
                $isSaved = $consumer->save();
                if($isSaved){
                    Session::flash('msg', ['status' => 'Success', 'msg' => "Your interest has been successfully submitted. We will contact you soon!"]);
                    return redirect('/');
                }
            } catch (\Throwable $th) { // throwable class hai catch ki
                return redirect()->back()->with("error","Server Error !");
            }
        }
    }
    
}
