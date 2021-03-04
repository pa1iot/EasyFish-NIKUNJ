<?php

namespace ZigKart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use ZigKart\Models\Members;
use ZigKart\Models\Product;
use ZigKart\Models\Settings;
use ZigKart\Models\Category;
use Auth;
use Mail;
use Purifier;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    	
	public function view_myprofile()
	{
	
	  $log_id = Auth::user()->id;
	  $edit['profile'] = Members::logindataUser($log_id);
	  return view('my-profile', ['edit' => $edit]);
	  
	
	}
	
	public function update_myprofile(Request $request)
	{
	
	   $name = $request->input('name');
	   $username = $request->input('username');
         $email = $request->input('email');
		 
		 
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 
		  $user_country = $request->input('user_country');	
		  $user_gender = $request->input('user_gender');
		  $user_address = $request->input('user_address');
		  $user_phone = $request->input('user_phone'); 
		  $user_about = Purifier::clean($request->input('user_about')); 
		  $token = $request->input('edit_id');
		  $image_size = $request->input('image_size');
		 
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							'user_banner' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		if ($request->hasFile('user_photo')) {
		     
			Members::droPhoto($token); 
		   
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = $request->input('save_photo');
		  }
		  
		  if ($request->hasFile('user_banner')) {
		     
			Members::droBanner($token); 
		   
			$image = $request->file('user_banner');
			$img_name = time() . '45.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_banner = $img_name;
		  }
		  else
		  {
		     $user_banner = $request->input('save_banner');
		  }
		 
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email, 'password' => $pass, 'user_country' => $user_country, 'user_gender' => $user_gender, 
		'user_photo' => $user_image, 'user_banner' => $user_banner, 'user_address' => $user_address, 'user_phone' => $user_phone, 'user_about' => $user_about, 
		'updated_at' => date('Y-m-d H:i:s'));
 
            
            
			Members::updateData($token, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
		
	
	public function view_withdrawal_request()
	{
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid); 
	  $withdraw_option = explode(",",$setting['setting']->withdraw_option);
	  $user_id = Auth::user()->id;
	  $withdrawData['view'] = Product::getdrawalData($user_id);
	  $data = array('withdraw_option' => $withdraw_option, 'withdrawData' => $withdrawData);
	  return view('my-wallet')->with($data);
	}
	
	
	
	public function withdrawal_request(Request $request)
	{
	   $withdrawal = $request->input('withdrawal');
	   $paypal_id = $request->input('paypal_email');
	   $stripe_id = $request->input('stripe_email');
	   $available_balance = base64_decode($request->input('available_balance'));
	   $get_amount = $request->input('get_amount');
	   $user_id = $request->input('user_id');
	   $token = $request->input('user_token');
	   $withdraw_date = date('Y-m-d');
	   $wd_status = "pending";
	   $paystack_email = $request->input('paystack_email');
	   $bank_details = $request->input('bank_details');
	   
	   $drawal_data = array('user_id' => $user_id, 'withdraw_payment_type' => $withdrawal, 'paypal_id' => $paypal_id, 'stripe_id' => $stripe_id, 'withdraw_amount' => $get_amount, 'withdraw_status' => $wd_status, 'withdraw_date' => $withdraw_date, 'paystack_email' => $paystack_email, 'bank_details' => $bank_details);
	   if($available_balance > $get_amount)
	   {
	     Product::savedrawalData($drawal_data);
		 $less_amount = $available_balance - $get_amount;
		 $data = array('earnings' => $less_amount);
		 Members::updateData($token,$data);
		 $sid = 1;
	     $setting['setting'] = Settings::editGeneral($sid);
	     $admin_name = $setting['setting']->sender_name;
		 $admin_email = $setting['setting']->sender_email;
		 $currency = $setting['setting']->site_currency_symbol;
		 $user['details'] = Members::singlebuyerData($user_id);
		 $from_name = $user['details']->name;
		 $from_email = $user['details']->email;
		 $record = array('from_name' => $from_name, 'from_email' => $from_email, 'withdrawal' => $withdrawal, 'paypal_id' => $paypal_id, 'stripe_id' => $stripe_id, 'paystack_email' => $paystack_email, 'bank_details' => $bank_details, 'get_amount' => $get_amount, 'currency' => $currency);
			 Mail::send('withdrawal_mail', $record, function($message) use ($admin_name, $admin_email, $from_name, $from_email) {
					$message->to($admin_email, $admin_name)
							->subject('New Withdrawal Request');
					$message->from($from_email,$from_name);
				});
		 return redirect()->back()->with('success', 'Your withdrawal request has been sent');
	   }
	   else
	   {
	     return redirect()->back()->with('error', 'Sorry Please check your available balance');
	   }
	   
	   
	   
	}
	
	
	public function cause_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	
	public function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
	
	
	
	public function paypal_success($ord_token, Request $request)
	{
	
	$payment_token = $request->input('tx');
	$purchased_token = $ord_token;
	$subscr_id = Auth::user()->user_subscr_id;
	$subscr['view'] = Subscription::editsubData($subscr_id);
	$subscri_date = $subscr['view']->subscr_duration;
	$subscr_value = "+".$subscri_date;
	$subscr_date = date('Y-m-d', strtotime($subscr_value));
	$user_id = Auth::user()->id;
	$checkoutdata = array('user_subscr_date' => $subscr_date);
	Subscription::confirmsubscriData($user_id,$checkoutdata);
	$result_data = array('payment_token' => $payment_token);
	return view('success')->with($result_data);
	
	}
	
	public function payment_cancel()
	{
	  return view('cancel');
	}
	
	
	
	
	
}
