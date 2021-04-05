<?php

namespace ZigKart\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function OTPGenerate()
    {
        return rand(111111,999999);
    }

    public function SendSMS($Mobile_no,$otp)
    {
        $Message ="Welcome to Easyfish,Your One Time Password(OTP) is ".$otp." . Never share the otp with onyone.";
        $url = 'http://pentaleadsms.com/app/smsapi/index.php?key=2604B607DCCAB7&campaign=10462&routeid=8&type=text&contacts='.$Mobile_no.'&senderid=SMSDMO&msg='.urlencode($Message).'';

        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        return $output;
    }


    public function verifyOTP($phone_number,$otp)
    {
        $phone_number = $phone_number;
        $otp = $otp;
        return $this->authentication($phone_number, $otp);

    }

    public function authentication($phone_number, $otp)
    {
        $validateUser =  DB::table('users')->where('user_phone', $phone_number)->where('otp', $otp)->first();

        if (!empty($validateUser)) {

            if (Auth::attempt(['email' => $validateUser->user_phone, 'password' => $validateUser->username])) {

//                return back()->with('success', 'Registration Successfully , Now you can login');
                return redirect('login')->with('success','Your account has been created. You can now login.');
            } else {

                return back()->with('error', 'Invalid OTP');
            }
        }

        Session::flash('user_phone', $phone_number);
        Session::flash('insertGetId', $phone_number);
        return back()->with('error', 'Invalid Phone and OTP');

    }

}
