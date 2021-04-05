<?php

namespace ZigKart\Http\Controllers\Auth;

use ZigKart\User;
use ZigKart\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use ZigKart\Models\Members;
use ZigKart\Models\Settings;
use Mail;
use Cookie;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {

        $allsettings = Settings::allSettings();
        $name = $request->input('name');
        $email = $request->input('email');
        $user_type = $request->input('user_type');
        $username = $request->input('username');
        $user_phone = $request->input('user_phone');
        $password = bcrypt($username);

        $earnings = 0;
        $referral_by = "";
//		 $user_country = $request->input('user_country');

        $user_country = 105;

        $request->validate([
            'name' => 'required',
            'user_phone' => 'required|unique:users',
            'email' => 'email',
            'username' => 'required',
        ]);
        $rules = array(
            'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
            'email' => [ 'email', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
        );

        $messsages = array();

        $validator = Validator::make($request->all(), $rules, $messsages);

        if ($validator->fails()) {
            $failedRules = $validator->failed();
            return back()->withErrors($validator);
        } else {

            if ($allsettings->email_verification == 1) {
                $verified = 0;
            } else {
                $verified = 1;
            }
            $user_token = $this->generateRandomString();

            // OTP | SMS send
            $otp = $this->OTPGenerate();
            $this->SendSMS($user_phone,$otp);

            $data = array(
                'name' => $name,
                'username' => $username,
                'user_phone' => $user_phone,
                'email' => !empty($email) ? $email : ' ',
                'user_type' => $user_type,
                'password' => $password,
                'earnings' => $earnings,
                'verified' => $verified,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_token' => $user_token,
                'user_country' => $user_country,
                'referral_by' => $referral_by,
                'otp' => $otp
            );

            $insertGetId =Members::insertData($data);

            Session::flash('success', 'Otp Send Successfully');
            Session::flash('user_phone', $user_phone);
            return back()->with('insertGetId', $insertGetId);

        }


    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_phone' => ['required', 'string', 'max:255', 'unique:users'],
            'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', 'unique:users'],
          //  'password' => ['required', 'string', 'min:6', 'confirmed'],
          //  'user_country' => 'required',
           // 'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \ZigKart\User
     */
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

    protected function create(array $data)
    {
        $allsettings = Settings::allSettings();
        if (!empty(unserialize(Cookie::get('referral')))) {
            $referral_by = unserialize(Cookie::get('referral'));
            $referral_commission = $allsettings->site_referral_commission;
            $check_referral = Members::referralCheck($referral_by);
            if ($check_referral != 0) {
                $referred['display'] = Members::referralUser($referral_by);
                $wallet_amount = $referred['display']->earnings + $referral_commission;
                $referral_amount = $referred['display']->referral_amount + $referral_commission;
                $referral_count = $referred['display']->referral_count + 1;

                $update_data = array('earnings' => $wallet_amount, 'referral_amount' => $referral_amount, 'referral_count' => $referral_count);
                Members::updateReferral($referral_by, $update_data);
            }
        } else {
            $referral_by = "";
        }
        $token = $this->generateRandomString();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'user_token' => $token,
            'earnings' => 0,
            'user_type' => $data['user_type'],
            'user_country' => $data['user_country'],
            'referral_by' => $referral_by,
            'g-recaptcha-response' => 'required|captcha',

        ]);
    }

}
