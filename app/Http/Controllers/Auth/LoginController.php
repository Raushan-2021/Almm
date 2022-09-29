<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:mnre')->except('logout');
        $this->middleware('guest:manufaturer_users')->except('logout');
        $this->middleware('guest:nise')->except('logout');
    }



    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {

        //dd($request);
        switch ($request->user_type) {
            case 'MNRE':
                $this->redirectTo = '/mnre';
                break;
            case 'MANUFATURER':
                $this->redirectTo = '/users';
                break;
            case 'NISE':
                $this->redirectTo = '/nise';
                break;
            default:
                $this->redirectTo = '/home';
                break;
        }

        $this->validator($request);

        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)){
            //Fire the lockout event.
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }
        // dd($request);
        if($this->guard($request)->attempt($request->only('email','password'), $request->filled('remember'))){
           
            //Authentication passed...
            return redirect($this->redirectTo);
        }

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);

        //Authentication failed...
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
        //validation rules.
        switch ($request->user_type) {
            case 'MNRE':
                $rules = [
                    'email'    => 'required|email|exists:mnre_users|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
           
            case 'MANUFATURER':
                $rules = [
                    'email'    => 'required|email|exists:manufaturer_users|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;

            case 'NISE':
            $rules = [
                'email'    => 'required|email|exists:nise_users|min:5|max:191',
                'password' => 'required|string|min:4|max:255',
                'user_type' => 'required',
            ];
            break;
            
            default:
                $rules = [
                    'email'    => 'required|email|exists:users|min:5|max:191',
                    'password' => 'required|string|min:4|max:255',
                ];
                break;
        }

        if(!env('DEV_ENVIRONMENT'))
            $rules['captcha'] = 'required|captcha';

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
            'captcha.captcha' => 'Invalid captcha'
        ];

        //validate the request.
        $request->validate($rules, $messages);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard($request)
    {
        switch ($request->user_type) {
            case 'MNRE':
                return Auth::guard('mnre');
                break;

            case 'NISE':
                return Auth::guard('nise');
                break;
        
            case 'MANUFATURER':
                return Auth::guard('manufaturer_users');
                break;
            default:
                return Auth::guard();
                break;
        }
    }

    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        if(Auth::guard('mnre')->check()){
            Auth::guard('mnre')->logout();
        }elseif(Auth::guard('manufaturer_users')->check()){
            Session::forget('application_id');
            Auth::guard('manufaturer_users')->logout();
        }elseif(Auth::guard('nise')->check()){
            Auth::guard('nise')->logout();
        }else{
            Auth::guard()->logout();
        }

        return redirect()->route('login')->with('status','Admin has been logged out!');
    }
}
