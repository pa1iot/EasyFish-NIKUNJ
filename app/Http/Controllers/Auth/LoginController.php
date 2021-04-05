<?php

namespace ZigKart\Http\Controllers\Auth;

use ZigKart\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use ZigKart\Models\Settings;
use ZigKart\Models\resend_otp_history;
use Auth;
use Socialite;
use ZigKart\User;
use Illuminate\Support\Facades\Validator;
use DB;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function authenticated($request, $user)
    {
        if ($user->user_type == 'admin' || $user->user_type == 'deliveryboy') {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->scopes(['email'])->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->CreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect('/');

    }


    public function generateRandomString($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function user_slug($string)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
    }

    public function CreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }

        $token = $this->generateRandomString();
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'username' => $this->user_slug($user->name),
            'user_token' => $token,
            'earnings' => 0,
            'user_type' => 'customer',
            'verified' => 1,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);


    }


    public function login(Request $request)
    {
        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $email = trim($request->email);
        $password = trim($request->password);

        if (Auth::attempt(array($field => $email, 'password' => $password, 'verified' => 1, 'drop_status' => 'no'))) {
            if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'deliveryboy') {
                return redirect('/admin');
            } else {
                return redirect('/');
            }
        }

        return redirect('login')->withErrors([
            'error' => 'These credentials do not match our records.',
        ]);

    }

    public function SubmitLogin(Request $request)
    {
        $user_phone = $request->input('user_phone');

        $request->validate([
            'user_phone' => 'required',
        ]);

        $messsages = array();

        $validator = Validator::make($request->all(), $messsages);

        if ($validator->fails()) {
            $failedRules = $validator->failed();
            return back()->withErrors($validator);
        } else {


            $CheckPhoneno= $this->UserValidate($user_phone);

            if($CheckPhoneno == 1){
                // OTP | SMS send
                $otp = $this->OTPGenerate();
                 $this->SendSMS($user_phone,$otp);
                DB::table('users')->where('user_phone', $user_phone)->update(['otp' => $otp]);
                Session::flash('success', 'Otp Send Successfully');
                Session::flash('user_phone', $user_phone);
                return back()->with('insertGetId', $user_phone);
            }
            return back()->with('error', 'Record Not found in our system ');

        }


    }


    public function SubmitVerifyOTPLogin(Request $request)
    {
        $phone_number = base64_decode($request->user_phone);
        $otp = $request->otp;

        $validateUser = DB::table('users')->where('user_phone', $phone_number)->where('otp', $otp)->first();

        if (!empty($validateUser)) {

            //print_r($validateUser);exit();

            DB::table('users')->where('id', $validateUser->id)->update(['password'=>bcrypt($validateUser->username)]);

            if (Auth::attempt(array('user_phone' =>$phone_number, 'password' => $validateUser->username, 'verified' => 1, 'drop_status' => 'no'))) {

                if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'deliveryboy') {
                    return redirect('/admin');
                } else {
                    return redirect('/');
                }

            }
        }
        $request->session()->flash('error', 'Invalid OTP');
        $request->session()->flash('user_phone', $phone_number);
        return back()->with('insertGetId', $phone_number);

    }


    // Register Verify

    public function SubmitVerifyOTP(Request $request)
    {
        $phone_number = base64_decode($request->user_phone);
        $otp = $request->otp;


        $validateUser = DB::table('users')->where('user_phone', $phone_number)->where('otp', $otp)->first();


        if (!empty($validateUser)) {
            DB::table('users')->where('user_phone', $phone_number)->update(['verified' => 1,'email'=>'']);

            if (Auth::attempt(array('user_phone' =>$phone_number, 'password' => $validateUser->username, 'verified' => 1, 'drop_status' => 'no'))) {

                if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'deliveryboy') {
                    return redirect('/admin');
                } else {
                    return redirect('/');
                }

            }

           // return redirect('login')->with('success', 'Your account has been created. You can now login.');
        }
        $request->session()->flash('error', 'Invalid OTP');
        $request->session()->flash('user_phone', $phone_number);
        return back()->with('insertGetId', $phone_number);

    }

    public function UserValidate($phone)
    {
       $User= DB::table('users')
            ->where('user_phone', $phone)
            ->where('drop_status', 'no')
            ->where('verified', 1)
            ->first();
        if(!empty($User)){

            return 1;
        }
        else{
            return 0;
        }
    }


    // resendotp

    public function resendotp(Request $request)
    {
        $phone = base64_decode($request->phone);
//print_r($request->all());exit();

        $CheckPhoneno= $this->UserValidate($phone);
        $count = resend_otp_history::count();

        if($CheckPhoneno == 1 && $count <= 2){
            resend_otp_history::insert(['phone_number'=>$phone,'date'=>date('Y-m-d')]);
            // OTP | SMS send
            $otp = $this->OTPGenerate();
             $this->SendSMS($phone,$otp);

            return response()->json(['success'=>'Otp Resend Successfully']);
        }
        return response()->json(['success'=>'Maximum attampt Please try day after']);


    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
