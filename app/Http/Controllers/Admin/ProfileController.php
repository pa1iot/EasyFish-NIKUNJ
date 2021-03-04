<?php

namespace ZigKart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use ZigKart\Models\Members;
use ZigKart\Models\Settings;
use ZigKart\Models\Subscription;
use ZigKart\Models\Category;
use ZigKart\Models\Causes;
use Auth;
use URL;
use Mail;

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
	
	  
	  return view('my-profile');
	
	}
	
	public function view_mycauses()
	{
	   
	   $mycauses['view'] = Causes::getAllcauses();
	   return view('admin.causes', ['mycauses' => $mycauses]);
	}
	
	public function view_addcauses()
	{
	  
	  $category['view'] = Category::quickbookData();
	  $user['data'] = Members::getuserData();
	  return view('admin.add-causes',['category' => $category, 'user' => $user]);
	  
	}
	
	public function view_donations()
	{
		  
	   $donation['view'] = Causes::getDonations();
	   return view('admin.donations', ['donation' => $donation]);
	
	}
	
	
	
	public function delete_mycauses($id)
	{
	  $data = array('cause_drop_status' => 'yes');
	  
	  Causes::dropCausesadmin($id,$data);
	  return redirect()->back()->with('success', 'Delete successfully.'); 
	
	}
	
	public function view_donate_details($id)
	{
	  $donor_id = base64_decode($id);
	  $single['view'] = Causes::singleDonor($donor_id);
	  return view('admin.fund-details', ['single' => $single]);
	}
	
	public function view_editcauses($id)
	{
	  
	  $category['view'] = Category::quickbookData();
	  $user['data'] = Members::getuserData();
	  $edit['view'] = Causes::singleCausesdata($id);
	  return view('admin.edit-causes',['category' => $category, 'edit' => $edit, 'user' => $user]);
	}
	
	
	public function update_edit_causes(Request $request)
	{
	
	   $cause_title = $request->input('cause_title');
	   $cause_slug = $this->cause_slug($cause_title);
	   $cause_short_desc = $request->input('cause_short_desc');
	   $cause_desc = $request->input('cause_desc');
	   $cause_goal = $request->input('cause_goal');
	   $cat_id = $request->input('cat_id');
	   $image_size = $request->input('image_size');
	   $user_id = $request->input('user_id');
	   $count_data = Members::getuserSubscription($user_id);
	   $cause_token = $this->generateRandomString();
	   $allsettings = Settings::allSettings();
	   $causes_approval = $allsettings->causes_approval;
	   $cause_raised = 0;
	   $save_cause_image = $request->input('save_cause_image');
	   $cause_token = $request->input('cause_token'); 
	   $cause_status = $request->input('cause_status');
	   $cause_approve_status = "Thanks for your submission. Your cause updated successfully.";
	   
	   
	   $request->validate([
							'cause_title' => 'required',
							'cause_short_desc' => 'required',
							'cause_desc' => 'required',
							'cause_goal' => 'required',
							'cause_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
							
         ]);
		 $rules = array(
				
				'cause_title' => ['required',  Rule::unique('causes') ->ignore($cause_token, 'cause_token') -> where(function($sql){ $sql->where('cause_drop_status','=','no');})],
				
				
				
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
	        
		  
			   if ($request->hasFile('cause_image')) 
				  {
				    Causes::dropCauseimage($cause_token);
					$image = $request->file('cause_image');
					$img_name = time() . '.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/storage/causes');
					$imagePath = $destinationPath. "/".  $img_name;
					$image->move($destinationPath, $img_name);
					$cause_image = $img_name;
				  }
				  else
				  {
					 $cause_image = $save_cause_image;
				  }
			   
			   $data = array('cat_id' => $cat_id, 'cause_token' => $cause_token, 'cause_title' => $cause_title, 'cause_slug' => $cause_slug, 'cause_short_desc' => $cause_short_desc,'cause_desc' => $cause_desc, 'cause_goal' => $cause_goal, 'cause_image' => $cause_image, 'cause_status' => $cause_status, 'cause_raised' => $cause_raised, 'cause_user_id' => $user_id);
			   
			   Causes::updatecausesRecord($cause_token,$data);
			   $cause_url = URL::to('/cause/').$cause_slug;
			   if($cause_status == 1)
			   {  
			      if($count_data == 1)
				  {
					  $sid = 1;
					  $setting['setting'] = Settings::editGeneral($sid);
					  $admin_name = $setting['setting']->sender_name;
					  $admin_email = $setting['setting']->sender_email;
					  $record = array('cause_url' => $cause_url, 'cause_title' => $cause_title);
					  $getvendor['user'] = Members::singlebuyerData($user_id);
					  $to_name = $getvendor['user']->name;
					  $to_email = $getvendor['user']->email;
					  Mail::send('admin.cause_review_mail', $record, function($message) use ($admin_name, $admin_email, $to_email, $to_name) {
							$message->to($to_email, $to_name)
									->subject('Cause Review Notifications');
							$message->from($admin_email,$admin_name);
						});
				  }	
			   
			   }
			   
			   
			   return redirect('/admin/causes')->with('success', $cause_approve_status);
			 
			   
			   
		}
		
		
		
		
			   
	
	}
	
	
	
	public function upgrade_subscription($id)
	{
	   $subscr_id = base64_decode($id);
	   $subscr['view'] = Members::getSubscription($subscr_id);
	   $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $get_payment = explode(',', $setting['setting']->payment_option);
	   return view('confirm-subscription', ['subscr' => $subscr, 'get_payment' => $get_payment]);
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
	
	public function save_add_causes(Request $request)
	{
	
	   $cause_title = $request->input('cause_title');
	   $cause_slug = $this->cause_slug($cause_title);
	   $cause_short_desc = $request->input('cause_short_desc');
	   $cause_desc = $request->input('cause_desc');
	   $cause_goal = $request->input('cause_goal');
	   $cat_id = $request->input('cat_id');
	   $image_size = $request->input('image_size');
	   $user_id = $request->input('user_id');
	   $cause_token = $this->generateRandomString();
	   $allsettings = Settings::allSettings();
	   $causes_approval = $allsettings->causes_approval;
	   $cause_raised = 0;
	   $view['user'] = Members::singlebuyerData($user_id);
	   $user_subscr_causes = $view['user']->user_subscr_causes;
	   $count_causes = Causes::countCauses($user_id);
	   $cause_status = $request->input('cause_status');
	   $cause_approve_status = "Thanks for your submission. Your cause updated successfully.";
	   
	   
	   
	   $request->validate([
							'cause_title' => 'required',
							'cause_short_desc' => 'required',
							'cause_desc' => 'required',
							'cause_goal' => 'required',
							'cause_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
							
         ]);
		 $rules = array(
				
				'cause_title' => ['required',  Rule::unique('causes') -> where(function($sql){ $sql->where('cause_drop_status','=','no');})],
				
				
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
	        if($user_subscr_causes > $count_causes)
			{
		  
			   if ($request->hasFile('cause_image')) 
				  {
					$image = $request->file('cause_image');
					$img_name = time() . '.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/storage/causes');
					$imagePath = $destinationPath. "/".  $img_name;
					$image->move($destinationPath, $img_name);
					$cause_image = $img_name;
				  }
				  else
				  {
					 $cause_image = "";
				  }
			   
			   $data = array('cat_id' => $cat_id, 'cause_token' => $cause_token, 'cause_title' => $cause_title, 'cause_slug' => $cause_slug, 'cause_short_desc' => $cause_short_desc,'cause_desc' => $cause_desc, 'cause_goal' => $cause_goal, 'cause_image' => $cause_image, 'cause_status' => $cause_status, 'cause_raised' => $cause_raised, 'cause_user_id' => $user_id, 'cause_status' => $cause_status);
			   
			   Causes::savecausesData($data);
			   
			   return redirect('/admin/causes')->with('success', $cause_approve_status);
			}
			else
			{
			   return redirect('/admin/causes')->with('error', 'Sorry!! That customer causes limit reached.');
			} 
			   
			   
		}
		
		
		
		
			   
	
	}
	
	
	
	public function update_subscription(Request $request)
	{
	   
	   $token = $request->input('token');
	   $price = base64_decode($request->input('user_subscr_price'));
	   $user_id = Auth::user()->id;
	   $order_email = Auth::user()->email;
	   $purchase_token = rand(111111,999999);
	   $payment_method = $request->input('payment_method');
	   $user_subscr_type = $request->input('user_subscr_type');
	   $user_subscr_date = $request->input('user_subscr_date');
	   $user_subscr_causes = $request->input('user_subscr_causes');
	   $user_subscr_id = $request->input('user_subscr_id');
	   $website_url = $request->input('website_url');
	   $subscr_value = "+".$user_subscr_date;
	   $subscr_date = date('Y-m-d', strtotime($subscr_value));
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $admin_amount = $price;
	   
	   
	   $updatedata = array('user_subscr_type' => $user_subscr_type, 'user_subscr_price' => $price, 'user_subscr_causes' => $user_subscr_causes, 'user_subscr_id' => $user_subscr_id);
	   
	   
	   /* settings */
	   
	   $paypal_email = $setting['setting']->paypal_email;
	   $paypal_mode = $setting['setting']->paypal_mode;
	   $site_currency = $setting['setting']->site_currency_code;
	   if($paypal_mode == 1)
	   {
	     $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
	   }
	   else
	   {
	     $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	   }
	   $success_url = $website_url.'/success/'.$purchase_token;
	   $cancel_url = $website_url.'/cancel';
	   
	   $stripe_mode = $setting['setting']->stripe_mode;
	   if($stripe_mode == 0)
	   {
	     $stripe_publish_key = $setting['setting']->test_publish_key;
		 $stripe_secret_key = $setting['setting']->test_secret_key;
	   }
	   else
	   {
	     $stripe_publish_key = $setting['setting']->live_publish_key;
		 $stripe_secret_key = $setting['setting']->live_secret_key;
	   }
	   
	   /* settings */
	   Subscription::upsubscribeData($user_id,$updatedata);
	   if($payment_method == 'paypal')
		  {
		     
			 $paypal = '<form method="post" id="paypal_form" action="'.$paypal_url.'">
			  <input type="hidden" value="_xclick" name="cmd">
			  <input type="hidden" value="'.$paypal_email.'" name="business">
			  <input type="hidden" value="'.$user_subscr_type.'" name="item_name">
			  <input type="hidden" value="'.$purchase_token.'" name="item_number">
			  <input type="hidden" value="'.$price.'" name="amount">
			  <input type="hidden" value="USD" name="'.$site_currency.'">
			  <input type="hidden" value="'.$success_url.'" name="return">
			  <input type="hidden" value="'.$cancel_url.'" name="cancel_return">
			  		  
			</form>';
			$paypal .= '<script>window.paypal_form.submit();</script>';
			echo $paypal;
					 
			 
		  }
		  /* stripe code */
		  else if($payment_method == 'stripe')
		  {
		     
			 			 
				$stripe = array(
					"secret_key"      => $stripe_secret_key,
					"publishable_key" => $stripe_publish_key
				);
			 
				\Stripe\Stripe::setApiKey($stripe['secret_key']);
			 
				
				$customer = \Stripe\Customer::create(array(
					'email' => $order_email,
					'source'  => $token
				));
			 
				
				$subscribe_name = $user_subscr_type;
				$subscribe_price = $price * 100;
				$currency = $site_currency;
				$book_id = $purchase_token;
			 
				
				$charge = \Stripe\Charge::create(array(
					'customer' => $customer->id,
					'amount'   => $subscribe_price,
					'currency' => $currency,
					'description' => $subscribe_name,
					'metadata' => array(
						'order_id' => $book_id
					)
				));
			 
				
				$chargeResponse = $charge->jsonSerialize();
			 
				
				if($chargeResponse['paid'] == 1 && $chargeResponse['captured'] == 1) 
				{
			 
					
										
					$payment_token = $chargeResponse['balance_transaction'];
					$purchased_token = $book_id;
					$checkoutdata = array('user_subscr_date' => $subscr_date);
					Subscription::confirmsubscriData($user_id,$checkoutdata);
					$data_record = array('payment_token' => $payment_token);
					return view('success')->with($data_record);
					
					
				}
		     
		  
		  }
		  /* stripe code */
		  
	
	
	
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
		 
		 		 
		  $token = $request->input('edit_id');
		  $image_size = $request->input('image_size');
		 
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							
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
		  
		 
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email, 'password' => $pass, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'));
 
            
            
			Members::updateData($token, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
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
	
	
	
	public function donation_delete($id)
	{
	   $donor_id = base64_decode($id);
	   Causes::deleteDonor($donor_id);
	   return redirect()->back()->with('success','Delete successfully.');
	}
	
	
	public function view_withdrawal()
	{
	  $withdrawData['view'] = Causes::getwithdrawalData();
	   $data = array('withdrawData' => $withdrawData);
	   return view('admin.withdrawal')->with($data);
	}
	
	public function view_withdrawal_update($wd_id,$user_id)
	{
	         $drawal_data = array('wd_status' => 'paid');
			 Causes::updatedrawalData($wd_id,$user_id,$drawal_data);
			 
			 $check_email_status = Members::getuserSubscription($user_id);
			 if($check_email_status == 1)
			 {
				 $buyer['info'] = Members::singlebuyerData($user_id);
				 $user_token = $buyer['info']->user_token;
				 $to_name = $buyer['info']->name;
				 $to_email = $buyer['info']->email;
				 $sid = 1;
				 $setting['setting'] = Settings::editGeneral($sid);
				 $admin_name = $setting['setting']->sender_name;
				 $admin_email = $setting['setting']->sender_email;
				 $currency = $setting['setting']->site_currency_symbol;
				 $with['data'] = Causes::singledrawalData($wd_id);
				 $wd_amount = $with['data']->wd_amount;
				
				 $data = array('to_name' => $to_name, 'to_email' => $to_email, 'wd_amount' => $wd_amount, 'currency' => $currency);
				 Mail::send('admin.user_withdrawal_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
						$message->to($to_email, $to_name)
								->subject('Payment Withdrawal Request Accepted');
						$message->from($admin_email,$admin_name);
					});
				
		   }		
	   return redirect()->back()->with('success','Payment withdrawal request has been completed'); 			
	   
	}
	
	
}
