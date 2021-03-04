<?php

namespace ZigKart\Http\Controllers;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Session;
use ZigKart\Models\Product;
use ZigKart\Models\Settings;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Stripe;
use Stripe_Charge;
use URL;
use Mail;

class StripeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	public function stripe_success(Request $request) 
	{
	   $ord_token = $request->input('ord_token');
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   if($setting['setting']->stripe_mode == 0) 
		{
			$secretkey = $setting['setting']->test_secret_key;
		}
		else
		{
			$secretkey = $setting['setting']->live_secret_key;
		}
		
		try {	
		
		include(app_path() . '/Stripe/lib/Stripe.php');
		Stripe::setApiKey($secretkey); 
		$charge = Stripe_Charge::create(array(
			"amount" => base64_decode($request->input('amount')),
			"currency" => $request->input('currency_code'),
			"card" => $request->input('stripeToken'),
			"description" => $request->input('item_name')
		));
		
		
		
		$payment_token = $request->input('stripeToken');
		}

		catch(Stripe_CardError $e) {
			
		}



		catch (Stripe_InvalidRequestError $e) {
		  // Invalid parameters were supplied to Stripe's API

		} catch (Stripe_AuthenticationError $e) {
		  // Authentication with Stripe's API failed
		  // (maybe you changed API keys recently)

		} catch (Stripe_ApiConnectionError $e) {
		  // Network communication with Stripe failed
		} catch (Stripe_Error $e) {

		  // Display a very generic error to the user, and maybe send
		  // yourself an email
		} catch (Exception $e) {

		  // Something else happened, completely unrelated to Stripe
		}
		
		$order_update = array('order_status' => 'completed', 'payment_type' => 'stripe', 'payment_token' => $payment_token);
	    Product::returnOrders($ord_token,$order_update);
	    $check_update = array('payment_status' => 'completed', 'payment_token' => $payment_token);
		Product::returnCheckout($ord_token,$check_update);
		$order_count = Product::doneOrder($ord_token);
		$order['details'] = Product::getOrders($ord_token);
		foreach($order['details'] as $orders)
		{
		   $order_id = $orders->ord_id;
		   if($orders->discount_price != 0)
		   {
		   $subtotal = $orders->quantity * $orders->discount_price;
		   $total = $subtotal + $orders->shipping_price;
		   }
		   else
		   {
		   $subtotal = $orders->quantity * $orders->price;
		   $total = $subtotal + $orders->shipping_price;
		   }
		   $commission = ($setting['setting']->site_admin_commission * $subtotal) / 100;
	       $vendor_amount = $subtotal - $commission;
	       $admin_amount = $commission;
		   $edit_data = array('subtotal' => $subtotal, 'total' => $total, 'vendor_amount' => $vendor_amount, 'admin_amount' => $admin_amount); 
		   Product::editedOrder($order_id,$edit_data);
		}				
			
		$user_details = Product::getCheckout($ord_token);						
		$order_id = $ord_token;
		$name = $user_details->name;
		$email = $user_details->email;
		$phone = $user_details->user_phone;			
		$amount = $user_details->total;
		$url = URL::to("/");
		$site_logo=$url.'/public/storage/settings/'.$setting['setting']->site_logo;
		$site_name = $setting['setting']->site_title;
		$admin_name = $setting['setting']->sender_name;
		$admin_email = $setting['setting']->sender_email;
		$site_currency = $setting['setting']->site_currency_symbol;
		$data_record = [
				'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'phone' => $phone, 'amount' => $amount, 'url' => $url, 'site_currency' => $site_currency, 'order_id' => $order_id
			];
			Mail::send('order_email', $data_record, function($message) use ($admin_name, $admin_email, $email, $name) {
					$message->to($admin_email,$admin_name)
							->subject('New Order Received');
					$message->from($admin_email,$admin_name);
				});
			Mail::send('order_email', $data_record, function($message) use ($admin_name, $admin_email, $email, $name) {
					$message->to($email, $name)
							->subject('New Order Received');
					$message->from($admin_email,$admin_name);
				});
		  $data = array('payment_token' => $payment_token);
		  return view('success')->with($data);
			
	   
	
	}
  
	
	
	
}
