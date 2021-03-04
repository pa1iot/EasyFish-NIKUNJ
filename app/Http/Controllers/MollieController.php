<?php

namespace ZigKart\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use ZigKart\Models\Product;
use ZigKart\Models\Members;
use ZigKart\Models\Settings;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use ZigKart\Http\Controllers\Controller;
use Auth;
use URL;
use Mail;
class MollieController extends Controller
{
    
	public function  __construct() 
	{
	    $sid = 1;
	    $setting['setting'] = Settings::editGeneral($sid);
        Mollie::api()->setApiKey($setting['setting']->mollie_api_key); 
    }
	public function preparePayment()
    {   
	    $sid = 1;
	    $setting['setting'] = Settings::editGeneral($sid);
		$user_id = Auth::user()->id;
	    $cart['product'] = Product::viewOrder($user_id);
		$sigle_record = Product::viewOrderSingle($user_id);
		$purchase_token = $sigle_record->purchase_token;
		$check_details = Product::singlePurchase($purchase_token,$user_id);
		$ship_country = $check_details->ship_country;
		$bill_country = $check_details->bill_country;
		$subtotal = 0;
      	$coupon_code = ""; 
      	$new_price = 0;
	  	$order_id = "";
	  	$product_id = "";
	  	$product_name = "";
		$ship_rate = 0;
	    $single_rate = "";
	  	foreach($cart['product'] as $cart)
	  	{
	                      if($cart->discount_price != 0)
                          {
                            $price = $cart->discount_price;
                            $new_price += $cart->quantity * $cart->discount_price;
                            $coupon_code .= $cart->coupon_code.', ';
                            
                          }
                          else
                          {
                            $price = $cart->price;
                            $new_price += $cart->quantity * $cart->price;
							$coupon_code .= "";
                            
                          }
						  $total = $cart->quantity * $cart->price;
                          $subtotal += $total;
						  $order_id .= $cart->ord_id.",";
						  $product_id .= $cart->product_id.",";
						  $product_name .= $cart->product_name.",";
						  
			  $shop_country = $cart->user_country;
			  if(!empty($ship_country))
			  {
								   if($ship_country == $shop_country)
								   {
									  $ship_rate += $cart->product_local_shipping_fee;
									  $single_rate .= $cart->product_local_shipping_fee.',';
								   }
								   else
								   {
										$ship_rate += $cart->product_global_shipping_fee;
										$single_rate .= $cart->product_global_shipping_fee.',';
								   }
								
								
			  }
			  else
			  {
									
									if($bill_country == $shop_country)
								   {
									  $ship_rate += $cart->product_local_shipping_fee;
									  $single_rate .= $cart->product_local_shipping_fee.',';
								   }
								   else
								   {
										$ship_rate += $cart->product_global_shipping_fee;
										$single_rate .= $cart->product_global_shipping_fee.',';
								   }
								 
								   
				}	  
						  
	  	}
        
	 	$coupon_code = rtrim($coupon_code,', ');
	  	$order_numbers = rtrim($order_id,',');
	  	$product_numbers = rtrim($product_id,',');
	  	$product_names = rtrim($product_name,',');
	  	if($coupon_code != "")
	  	{
	  	$coupon_discount = $subtotal - $new_price;
      	$final = $new_price+$setting['setting']->site_processing_fee;
	  	}
	  	else
	  	{
	  	$final = $subtotal+$setting['setting']->site_processing_fee;
	  	$coupon_discount = 0;
	  	}
		$total_price = $final + $ship_rate;
		$website_url = URL::to("/");
        $payment = Mollie::api()->payments()->create([
        'amount' => [
            'currency' => $setting['setting']->site_currency_code, 
            'value' => number_format($total_price,2), 
        ],
        'description' => $product_names, 
        'redirectUrl' => $website_url.'/payment-success/'.$purchase_token, 
        ]);
    
        $payment = Mollie::api()->payments()->get($payment->id);
    
       
        return redirect($payment->getCheckoutUrl(), 303);
		
		
    }
     
	public function paymentSuccess($purchase_token) 
	{
	
	$sid = 1;
	$setting['setting'] = Settings::editGeneral($sid);
	$ord_token = $purchase_token;
	$order_update = array('order_status' => 'completed', 'payment_type' => 'mollie');
	Product::returnOrders($ord_token,$order_update);
	$check_update = array('payment_status' => 'completed');
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
        
		return view('payment-success');
       
    } 
   
	
}
