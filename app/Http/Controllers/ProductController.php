<?php

namespace ZigKart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use ZigKart\Http\Controllers\Controller;
use Session;
use ZigKart\Mail\EmailNotify;
use ZigKart\Models\Product;
use ZigKart\Models\Members;
use ZigKart\Models\Settings;
use ZigKart\Models\Languages;
use Illuminate\Validation\Rule;
use ZigKart\Models\Attribute;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Storage;
use Illuminate\Support\Facades\File;
use Auth;
use URL;
use Mail;
use Purifier;
use Twocheckout;
use Twocheckout_Charge;
use Twocheckout_Error;
use Omnipay\Omnipay;
use ZigKart\Payment;
use ZigKart\Http\Requests;
use Paystack;
use Cookie;
use Illuminate\Support\Str;
use PDF;
use Currency;
use Razorpay\Api\Api;

class ProductController extends Controller
{

    public $gateway;

    public function __construct()
    {
	    $sid = 1;
	    $setting['setting'] = Settings::editGeneral($sid);
        $this->middleware('auth');
		$this->gateway = Omnipay::create('AuthorizeNetApi_Api');
        $this->gateway->setAuthName($setting['setting']->authorize_login_id);
        $this->gateway->setTransactionKey($setting['setting']->authorize_trans_key);
        $this->gateway->setTestMode($setting['setting']->authorize_mode); //comment this line when move to 'live'

    }

	public function lang_text(){
		   if(!empty(Cookie::get('translate')))
		{
		$translate = Cookie::get('translate');


		}
		else
		{
		  $default_count = Languages::defaultLanguageCount();
		  if($default_count == 0)
		  {
		  $translate = "en";

		  }
		  else
		  {
		  $default['lang'] = Languages::defaultLanguage();
		  $translate =  $default['lang']->language_code;

		  }

		}

		   return $translate;
    }




	public function conversation_message(Request $request)
	{
	 $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	 $conver_text = $request->input('conver_text');
	 $conver_user_id = $request->input('conver_user_id');
	 $conver_seller_id = $request->input('conver_seller_id');
	 $conver_order_id = $encrypter->decrypt($request->input('conver_order_id'));
	 $order_id = $request->input('conver_order_id');
	 $conver_url = $request->input('conver_url');
	 $conver_date = date('Y-m-d H:i:s');
	 $savedata = array( 'conver_user_id' => $conver_user_id, 'conver_seller_id' => $conver_seller_id, 'conver_order_id' => $conver_order_id, 'conver_text' => $conver_text, 'conver_date' => $conver_date);
	 Product::savemessageData($savedata);
	 $userfrom['data'] = Members::singlebuyerData($conver_user_id);
	 $userto['data'] = Members::singlevendorData($conver_seller_id);
	    $from_email = $userfrom['data']->email;
		$from_name = $userfrom['data']->name;
		$from_username = $userfrom['data']->username;
		$to_email = $userto['data']->email;
		$to_name  = $userto['data']->name;
		$conversation_url = $conver_url.'/'.$from_username.'/'.$order_id;

		$record = array('to_name' => $to_name, 'from_name' => $from_name, 'from_email' => $from_email, 'conver_text' => $conver_text, 'conver_order_id' => $conver_order_id, 'conversation_url' => $conversation_url);
//		  Mail::send('chat_mail', $record, function($message) use ($to_email, $from_email, $to_name, $from_name) {
//				$message->to($to_email, $to_name)
//						->subject('Conversation Message');
//				$message->from($from_email,$from_name);
//			});

        Mail::to($to_email)->send(new EmailNotify($record));


	 return redirect()->back()->with('success', 'Your message has been sent successfully');

	}

	public function delete_conversation($id)
	{
	$conver_id = base64_decode($id);
	   Product::deleteChat($conver_id);
	return redirect()->back()->with('success', 'Your message has been deleted');
	}


	public function view_buyer_conversation($to_slug,$order_id)
	{
	$encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	$ord_id   = $encrypter->decrypt($order_id);
	$order_details = Product::getorderDetails($ord_id);
	$user_details = Members::editUser($to_slug);
	$chat['message'] = Product::getChatDetails($ord_id);

	return view('conversation-to-buyer', ['to_slug' => $to_slug, 'user_details' => $user_details, 'ord_id' => $ord_id, 'chat' => $chat, 'order_id' => $order_id, 'order_details' => $order_details]);
	}



	public function view_conversation($to_slug,$order_id)
	{
	$encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	$ord_id   = $encrypter->decrypt($order_id);
	$order_details = Product::getorderDetails($ord_id);
	$user_details = Members::logindataUser($order_details->product_user_id);
	$chat['message'] = Product::getChatDetails($ord_id);

	return view('conversation-to-vendor', ['to_slug' => $to_slug, 'user_details' => $user_details, 'ord_id' => $ord_id, 'chat' => $chat, 'order_id' => $order_id, 'order_details' => $order_details]);
	}


	/* purchase */

	public function view_orders_details()
	{

	$user_id = Auth::user()->id;
	$order['details'] = Product::myOrderDetails($user_id);
	$encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	$data = array('order' => $order, 'user_id' => $user_id, 'encrypter' => $encrypter);
	return view('my-orders')->with($data);
	}

	public function single_orders_details($ord_id,$token)
	{
	  $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	  $user_id = Auth::user()->id;
	  $purchase = Product::singleOrderdetails($token);
	  if($purchase->bill_country != '')
	  {
	  $bill_country = Product::singleCountry($purchase->bill_country);
	  $billcountry = $bill_country->country_name;
	  }
	  else
	  {
	    $billcountry = "";
	  }
	  if($purchase->ship_country != '')
	  {
	  $ship_country = Product::singleCountry($purchase->ship_country);
	  $shipcountry = $ship_country->country_name;
	  }
	  else
	  {
	  $shipcountry = "";
	  }
	  $product = Product::singleOrders($ord_id,$token);
	  $data = array('purchase' => $purchase, 'user_id' => $user_id, 'billcountry' => $billcountry, 'shipcountry' => $shipcountry, 'product' => $product, 'ord_id' => $ord_id);
	  return view('my-orders-details')->with($data);
	}

	public function view_purchase_details()
	{

	$user_id = Auth::user()->id;
	$purchase['details'] = Product::myPurchase($user_id);
	$data = array('purchase' => $purchase, 'user_id' => $user_id);
	return view('my-purchase')->with($data);
	}


	public function invoice_download($token)
	{
	    $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $user_id = Auth::user()->id;
	   $purchase = Product::singlePurchase($token,$user_id);
	   $pdf_filename = $purchase->purchase_token.'-'.$purchase->payment_date.'.pdf';
	   $purchase_token = $purchase->purchase_token;
	   $payment_token = $purchase->payment_token;
	   $shipping_price = $purchase->shipping_price;
	   $processing_fee = $purchase->processing_fee;
	   $payment_type = str_replace("-"," ",$purchase->payment_type);
	   $payment_date = $purchase->payment_date;
	   $subtotal = $purchase->subtotal;
	   $total = $purchase->total;
	   $payment_status = $purchase->payment_status;
	   $buyer_name = $purchase->bill_firstname.' '.$purchase->bill_lastname;
	   $buyer_address = $purchase->bill_address;
	   $buyer_city = $purchase->ship_city;
	   $buyer_zip = $purchase->bill_postcode;
	   if($purchase->bill_country != '')
	  {
	  $bill_country = Product::singleCountry($purchase->bill_country);
	  $billcountry = $bill_country->country_name;
	  }
	  else
	  {
	    $billcountry = "";
	  }
	   $buyer_country = $billcountry;
	   $buyer_email = $purchase->bill_email;
	   $product['view'] = Product::myOrders($token,$user_id);

		  $data = ['purchase_token' => $purchase_token, 'payment_token' => $payment_token, 'shipping_price' => $shipping_price, 'processing_fee' => $processing_fee, 'payment_type' => $payment_type, 'payment_date' => $payment_date, 'subtotal' => $subtotal, 'total' => $total, 'payment_status' => $payment_status, 'buyer_name' => $buyer_name, 'buyer_address' => $buyer_address, 'buyer_city' => $buyer_city, 'buyer_zip' => $buyer_zip, 'buyer_country' => $buyer_country, 'buyer_email' => $buyer_email, 'product' => $product, 'purchase' => $purchase];

        $pdf = PDF::loadView('pdf_view', $data);
        return $pdf->download($pdf_filename);


	}


	public function purchase_full_details($token)
	{
	  $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	  $user_id = Auth::user()->id;
	  $purchase = Product::singlePurchase($token,$user_id);
	  if($purchase->bill_country != '')
	  {
	  $bill_country = Product::singleCountry($purchase->bill_country);
	  $billcountry = $bill_country->country_name;
	  }
	  else
	  {
	    $billcountry = "";
	  }
	  if($purchase->ship_country != '')
	  {
	  $ship_country = Product::singleCountry($purchase->ship_country);
	  $shipcountry = $ship_country->country_name;
	  }
	  else
	  {
	  $shipcountry = "";
	  }
	  $product['view'] = Product::myOrders($token,$user_id);
	  $refund_time ='+'.$setting['setting']->site_refund_time.' days';
	  $refund_date = date('Y-m-d', strtotime($refund_time, strtotime($purchase->payment_date)));
	  $today_date = date('Y-m-d');
	  $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	  $data = array('purchase' => $purchase, 'user_id' => $user_id, 'billcountry' => $billcountry, 'shipcountry' => $shipcountry, 'product' => $product, 'refund_date' => $refund_date, 'today_date' => $today_date, 'encrypter' => $encrypter);
	  return view('my-purchase-details')->with($data);
	}

	/* purchase */


	/* products */

	public function show_wishlist()
	{
	   $translate = $this->lang_text();
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $user_id = Auth::user()->id;
	   $shop['product'] = Product::with('ProductImages')->join('wishlist','wishlist.product_token','product.product_token')->where('product.product_status','=',1)->where('product.product_drop_status','=','no')->where('product.language_code','=',$translate)->where('wishlist.user_id','=',$user_id)->orderBy('product_id','desc')->get();
	   $data = array('setting' => $setting, 'shop' => $shop);
	   return view('wishlist')->with($data);
	}

	public function remove_wishlist($id)
	{
	   $wid = base64_decode($id);
	   Product::removeWishlist($wid);
	   return redirect()->back()->with('success', 'Product Removed Successfully.');

	}

	public function order_track(Request $request)
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $order_track = $request->input('order_track');
	   $user_id = Auth::user()->id;
	   $order_id = $request->input('order_id');
	   $update_data = array('order_tracking' => $order_track);
	   Product::updateTrack($user_id,$order_id,$update_data);
	   return redirect()->back()->with('success', 'Order tracking status has been updated.');

	}

	public function rating_request(Request $request)
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $rating = $request->input('rating');
	   $review = $request->input('review');
	   $user_id = $request->input('user_id');
	   $product_id = $request->input('product_id');
	   $order_id = $request->input('order_id');
	   $rating_check = Product::checkRating($user_id,$product_id,$order_id);
	   if($rating_check == 0)
	   {
	      $save_rating = array('product_id' => $product_id, 'order_id' => $order_id, 'user_id' => $user_id, 'rating' => $rating, 'review' => $review);
	      Product::saveRating($save_rating);
	   }
	   else
	   {
	      $update_rating = array('rating' => $rating, 'review' => $review);
		  Product::updateRating($user_id,$product_id,$order_id,$update_rating);
	   }
	   return redirect()->back()->with('success', 'Your rating & review has been submitted.');

	}

	public function refund_request(Request $request)
	{

	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $product_id = $request->input('product_id');
	   $product_slug = $request->input('product_slug');
	   $product_name = $request->input('product_name');
	   $purchase_token = $request->input('purchase_token');
	   $order_id = $request->input('order_id');
	   $payment_date = $request->input('payment_date');
	   $buyer_id = $request->input('buyer_id');
	   $vendor_id = $request->input('vendor_id');
	   $payment = $request->input('payment');
	   $payment_type = $request->input('payment_type');
	   $request_date = date("Y-m-d");
	   $reason = $request->input('reason');
	   $message_text = $request->input('message');
	   $refund_check = Product::checkRefund($purchase_token,$order_id,$buyer_id,$vendor_id);
	   if($refund_check == 0)
	   {
	      $save_refund = array('purchase_token' => $purchase_token, 'request_date' => $request_date, 'order_id' => $order_id, 'product_id' => $product_id, 'payment_date' => $payment_date, 'buyer_id' => $buyer_id, 'vendor_id' => $vendor_id, 'payment' => $payment, 'payment_type' => $payment_type, 'reason' => $reason, 'message' => $message_text);
		  Product::saveRefund($save_refund);
		    $url = URL::to("/");
		    $site_logo=$url.'/public/storage/settings/'.$setting['setting']->site_logo;
			$site_name = $setting['setting']->site_title;
			$admin_name = $setting['setting']->sender_name;
			$admin_email = $setting['setting']->sender_email;
			$site_currency = $setting['setting']->site_currency_symbol;
			$buyer_details = Members::singlebuyerData($buyer_id);
			$to_name = $buyer_details->name;
			$to_email = $buyer_details->email;
			$to_slug = $buyer_details->username;
	$data_record = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url, 'site_currency' => $site_currency, 'to_name' => $to_name, 'to_email' => $to_email, 'admin_name' => $admin_name, 'admin_email' => $admin_email, 'to_slug' => $to_slug, 'product_slug' => $product_slug, 'purchase_token' => $purchase_token, 'payment' => $payment, 'payment_type' => $payment_type, 'payment_date' => $payment_date, 'reason' => $reason, 'message_text' => $message_text, 'product_name' => $product_name
        ];
		Mail::send('refund_email', $data_record, function($message) use ($admin_name, $admin_email, $to_email, $to_name) {
				$message->to($admin_email,$admin_name)
						->subject('New Refund Request');
				$message->from($to_email,$to_name);
			});
		  return redirect()->back()->with('success', 'Your refund request has been sent successfully.');

	   }
	   else
	   {

		 return redirect()->back()->with('error', 'Sorry Refund Request Already Sent');

	   }

	}

	public function remove_coupon($remove,$coupon)
	{
	   $user_id = Auth::user()->id;
	   $data = array('coupon_id' => '', 'coupon_code' => '', 'coupon_type' => '', 'coupon_value' => '', 'discount_price' => 0);
	   Product::removeCoupon($coupon,$user_id,$data);
	   return redirect()->back()->with('success', 'Coupon Removed Successfully.');
	}

	public function view_checkout()
	{
	  $translate = $this->lang_text();
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $user_id = Auth::user()->id;
	  $cart['product'] = Product::viewOrder($user_id,$translate);
	  $subtotal = 0;
      $coupon_code = "";
      $new_price = 0;
	  $order_id = "";
	  $product_id = "";
	  $product_name = "";
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
	  $get_payment = explode(',', $setting['setting']->payment_option);
	  $data = array('setting' => $setting, 'cart' => $cart, 'subtotal' => $subtotal, 'coupon_code' => $coupon_code, 'new_price' => $new_price, 'coupon_discount' => $coupon_discount, 'final' => $final, 'get_payment' => $get_payment, 'order_numbers' => $order_numbers, 'product_numbers' => $product_numbers, 'product_names' => $product_names);
	  return view('checkout')->with($data);

	}


	public function update_checkout(Request $request)
	{
	   $translate = $this->lang_text();
	   $allsettings = Settings::allSettings();
	   $user_id = Auth::user()->id;

	   $bill_firstname = $request->input('bill_firstname');
	   $bill_lastname = $request->input('bill_lastname');
	   $bill_companyname = $request->input('bill_companyname');
	   $bill_email = $request->input('bill_email');
	   $bill_phone = $request->input('bill_phone');
	   $bill_address = $request->input('bill_address');
	   $bill_city = $request->input('bill_city');
	   $bill_state = $request->input('bill_state');
	   $bill_postcode = $request->input('bill_postcode');
	   $bill_country = $request->input('bill_country');

	   $enable_shipping = $request->input('enable_shipping');

	   $ship_firstname = $request->input('ship_firstname');
	   $ship_lastname = $request->input('ship_lastname');
	   $ship_companyname = $request->input('ship_companyname');
	   $ship_email = $request->input('ship_email');
	   $ship_phone = $request->input('ship_phone');
	   $ship_address = $request->input('ship_address');
	   $ship_city = $request->input('ship_city');
	   $ship_state = $request->input('ship_state');
	   $ship_postcode = $request->input('ship_postcode');
	   $ship_country = $request->input('ship_country');

	   // addressbook

        if(!empty($enable_shipping)){

          //  $addrebook_data1 = array_merge($addrebook_data1,$addrebook_data2);
            $addressbook = DB::table('address_books')->insert([
                'user_id'=>$user_id,
                'bill_firstname'=>$bill_firstname,
                'bill_lastname'=>$bill_lastname,
                'bill_companyname'=>$bill_companyname,
                'bill_email'=>$bill_email,
                'bill_phone'=>$bill_phone,
                'bill_address'=>$bill_address,
                'bill_city'=>$bill_city,
                'bill_state'=>$bill_state,
                'bill_postcode'=>$bill_postcode,
                'bill_country'=>$bill_country,
                'ship_firstname'=>$ship_firstname,
                'ship_lastname'=>$ship_lastname,
                'ship_companyname'=>$ship_companyname,
                'ship_email'=>$ship_email,
                'ship_phone'=>$ship_phone,
                'ship_address'=>$ship_address,
                'ship_city'=>$ship_city,
                'ship_state'=>$ship_state,
                'ship_postcode'=>$ship_postcode,
                'ship_country'=>$ship_country,
                'enable_shipping'=>$enable_shipping,
            ]);

        }
        else{
            $addressbook = DB::table('address_books')->insert([
                'user_id'=>$user_id,
                'bill_firstname'=>$bill_firstname,
                'bill_lastname'=>$bill_lastname,
                'bill_companyname'=>$bill_companyname,
                'bill_email'=>$bill_email,
                'bill_phone'=>$bill_phone,
                'bill_address'=>$bill_address,
                'bill_city'=>$bill_city,
                'bill_state'=>$bill_state,
                'bill_postcode'=>$bill_postcode,
                'bill_country'=>$bill_country,
            ]);
        }
//        print_r($addrebook_data1);






	   $other_notes = $request->input('other_notes');
	   $payment_method = $request->input('payment_method');
	   $purchase_token = rand(1111111,9999999);
	   $token = csrf_token();
	   $payment_date =  date("Y-m-d");
	   $order_id = $request->input('order_id');
	   $sub_total = $request->input('sub_total');
	   $processing_fee = $request->input('processing_fee');
	   $total = $request->input('total');
	   $product_id = $request->input('product_id');
	   $product_names = $request->input('product_names');
	   $payment_status = 'pending';
	   $cart['product'] = Product::viewOrder($user_id,$translate);
	   $ship_rate = 0;
	   $single_rate = "";
	   foreach($cart['product'] as $cart)
	   {
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
	   $single_rates = rtrim($single_rate,",");
	   $codes = explode(",",$order_id);
		$names = explode(",",$single_rates);
		$separate = "";
		foreach( $codes as $index => $code )
		{
		   $separate .=$code.'_'.$names[$index].',';
		   $ship_price = $names[$index];
		   $or_id = $code;
		   $order_data = array('shipping_price' => $ship_price);
		   Product::updateOrders($or_id,$order_data);

		}
		$order_id_shipping = rtrim($separate,',');
		$check_checkout = Product::checkCheckout($token);
		$total_price = $total + $ship_rate;
		if($check_checkout == 0)
		{
		   $save_data = array('purchase_token' => $purchase_token, 'token' => $token, 'ord_id' => $order_id, 'shipping_separate' => $single_rates, 'order_id_shipping' => $order_id_shipping, 'user_id' => $user_id, 'shipping_price' => $ship_rate, 'processing_fee' => $processing_fee, 'subtotal' => $sub_total, 'total' => $total_price, 'payment_type' => $payment_method, 'payment_date' => $payment_date, 'bill_firstname' => $bill_firstname, 'bill_lastname' => $bill_lastname, 'bill_companyname' => $bill_companyname, 'bill_email' => $bill_email, 'bill_phone' => $bill_phone, 'bill_country' => $bill_country, 'bill_address' => $bill_address, 'bill_city' => $bill_city, 'bill_state' => $bill_state, 'bill_postcode' => $bill_postcode, 'enable_ship' => $enable_shipping, 'ship_firstname' => $ship_firstname, 'ship_lastname' => $ship_lastname, 'ship_companyname' => $ship_companyname, 'ship_email' => $ship_email, 'ship_phone' => $ship_phone, 'ship_country' => $ship_country, 'ship_address' => $ship_address, 'ship_city' => $ship_city, 'ship_state' => $ship_state, 'ship_postcode' => $ship_postcode, 'other_notes' => $other_notes, 'payment_status' => $payment_status);

		 Product::saveCheckout($save_data);

		}
		else
		{
		   $update_data = array('purchase_token' => $purchase_token, 'ord_id' => $order_id, 'shipping_separate' => $single_rates, 'order_id_shipping' => $order_id_shipping, 'user_id' => $user_id, 'shipping_price' => $ship_rate, 'processing_fee' => $processing_fee, 'subtotal' => $sub_total, 'total' => $total_price, 'payment_type' => $payment_method, 'payment_date' => $payment_date, 'bill_firstname' => $bill_firstname, 'bill_lastname' => $bill_lastname, 'bill_companyname' => $bill_companyname, 'bill_email' => $bill_email, 'bill_phone' => $bill_phone, 'bill_country' => $bill_country, 'bill_address' => $bill_address, 'bill_city' => $bill_city, 'bill_state' => $bill_state, 'bill_postcode' => $bill_postcode, 'enable_ship' => $enable_shipping, 'ship_firstname' => $ship_firstname, 'ship_lastname' => $ship_lastname, 'ship_companyname' => $ship_companyname, 'ship_email' => $ship_email, 'ship_phone' => $ship_phone, 'ship_country' => $ship_country, 'ship_address' => $ship_address, 'ship_city' => $ship_city, 'ship_state' => $ship_state, 'ship_postcode' => $ship_postcode, 'other_notes' => $other_notes);

		   Product::updateCheckout($token,$update_data);
		}
		$uporder = array('purchase_token' => $purchase_token);
		Product::upOrders($user_id,$uporder);
		/* settings */

	   $paypal_email = $allsettings->paypal_email;
	   $paypal_mode = $allsettings->paypal_mode;
	   $site_currency = $allsettings->site_currency_code;
	   $website_url = URL::to("/");
	   if($paypal_mode == 1)
	   {
	     $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
	   }
	   else
	   {
	     $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	   }
	   $success_url = $website_url.'/success/'.base64_encode($purchase_token);
	   $cancel_url = $website_url.'/cancel';

	   $stripe_mode = $allsettings->stripe_mode;
	   if($stripe_mode == 0)
	   {
	     $stripe_publish_key = $allsettings->test_publish_key;
		 $stripe_secret_key = $allsettings->test_secret_key;
	   }
	   else
	   {
	     $stripe_publish_key = $allsettings->live_publish_key;
		 $stripe_secret_key = $allsettings->live_secret_key;
	   }

	   $two_checkout_mode = $allsettings->two_checkout_mode;
	   $two_checkout_account = $allsettings->two_checkout_account;
	   $two_checkout_publishable = $allsettings->two_checkout_publishable;
	   $two_checkout_private = $allsettings->two_checkout_private;

	   /* settings */
	   if($payment_method == 'paypal')
	   {
	      $additional =  array('total_price' => $total_price, 'purchase_token' => $purchase_token, 'payment_method' => $payment_method, 'product_names' => $product_names);
		  $aid = 1;
	      Product::upAdditional($aid,$additional);
	   }

	   $record = array('total_price' => $total_price, 'purchase_token' => $purchase_token, 'payment_method' => $payment_method, 'product_names' => $product_names, 'ship_rate' => $ship_rate, 'sub_total' => $sub_total, 'paypal_url' => $paypal_url, 'paypal_email' => $paypal_email, 'site_currency' => $site_currency, 'website_url' => $website_url, 'stripe_mode' => $stripe_mode, 'stripe_publish_key' => $stripe_publish_key, 'two_checkout_private' => $two_checkout_private, 'two_checkout_account' => $two_checkout_account, 'two_checkout_mode' => $two_checkout_mode, 'token' => $token, 'two_checkout_publishable' => $two_checkout_publishable);
       return view('order-confirm')->with($record);





	}

	public function razorpay_payment(Request $request)
    {
	    $sid = 1;
	    $setting['setting'] = Settings::editGeneral($sid);
        $input = $request->all();
        $extra['setting'] = Settings::editAdditional();
        $api = new Api($extra['setting']->razorpay_key, $extra['setting']->razorpay_secret);

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        $user_id = Auth::user()->id;

        //dd($paymentDetails);
         //print_r($paymentDetails);
		if(count($input)  && !empty($input['razorpay_payment_id']))
		{

		 $payment_token = $input['razorpay_payment_id'];
		 $ord_token = $payment->description;
		 $order_update = array('order_status' => 'completed', 'payment_type' => 'razorpay', 'payment_token' => $payment_token);
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


						  $data_record = array('payment_token' => $payment_token);
						 return view('success')->with($data_record);


	    }
		else
		{
		  return redirect('/cancel');
		}




    }



	public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();


        //dd($paymentDetails);
         //print_r($paymentDetails);
		if (array_key_exists('data', $paymentDetails) && array_key_exists('status', $paymentDetails['data']) && ($paymentDetails['data']['status'] === 'success'))
		{
		 // echo "Transaction was successful - ".$paymentDetails['data']['reference']. ' - '.$paymentDetails['data']['metadata'];

		 $payment_token = $paymentDetails['data']['reference'];
		 $ord_token = $paymentDetails['data']['metadata'];
		 $sid = 1;
							$setting['setting'] = Settings::editGeneral($sid);
							$order_update = array('order_status' => 'completed', 'payment_type' => 'paystack', 'payment_token' => $payment_token);
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


						  $data_record = array('payment_token' => $payment_token);
						 return view('success')->with($data_record);


		}
		else
		{
		  return redirect('/cancel');
		}

    }



	public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

	public function confirm_paystack(Request $request)
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $convert = Currency::convert($setting['setting']->site_currency_code,'NGN',base64_decode($request->input('amount')));
	   $convertedAmount = $convert['convertedAmount'];
	   $email = $request->input('email');
	   $purchase_token = $request->input('purchase_token');
	   $amount = $convertedAmount * 100;
	   $site_currency = $request->input('site_currency');
	   $reference = $request->input('reference');
	   $csf_token = csrf_token();
	   $website_url = URL::to("/");
	   $callback = $website_url.'/paystack';

	   $paystack = '<form method="post" id="stack_form" action="'.route('paystack').'">
	          <input type="hidden" name="_token" value="'.$csf_token.'">
			  <input type="hidden" name="email" value="'.$email.'" >
			  <input type="hidden" name="order_id" value="'.$purchase_token.'">
			  <input type="hidden" name="amount" value="'.$amount.'">
			  <input type="hidden" name="quantity" value="1">
			  <input type="hidden" name="currency" value="NGN">
			  <input type="hidden" name="reference" value="'.$reference.'">
			  <input type="hidden" name="callback_url" value="'.$callback.'">
			  <input type="hidden" name="metadata" value="'.$purchase_token.'">
			  <input type="hidden" name="key" value="'.$setting['setting']->paystack_secret_key.'">
			</form>';
			$paystack .= '<script>window.stack_form.submit();</script>';
			echo $paystack;



	}

	public function confirm_razorpay(Request $request)
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $extra['setting'] = Settings::editAdditional();
	   $convert = Currency::convert($setting['setting']->site_currency_code,'INR',base64_decode($request->input('amount')));
	   $convertedAmount = $convert['convertedAmount'];
	    $item_names_data = $request->input('product_names');
		$purchase_token = $request->input('purchase_token');
		$order_firstname = $request->input('user_name');
		$order_email = $request->input('user_email');
		$order_address = $request->input('user_name');
		$website_url = $request->input('website_url');
	   $csf_token = csrf_token();
			   $price_amount = $convertedAmount * 100;
			   $logo_url = $website_url.'/public/storage/settings/'.$setting['setting']->site_logo;
			   $script_url = $website_url.'/resources/views/template/js/jquery.min.js';
			   $callback = $website_url.'/razorpay';
			   $razorpay = '
			   <script type="text/javascript" src="'.$script_url.'"></script>
			   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
			   <script>
				var options = {
					"key": "'.$extra['setting']->razorpay_key.'",
					"amount": "'.$price_amount.'",
					"currency": "INR",
					"name": "'.$item_names_data.'",
					"description": "'.$purchase_token.'",
					"image": "'.$logo_url.'",
					"callback_url": "'.$callback.'",
					"prefill": {
						"name": "'.$order_firstname.'",
						"email": "'.$order_email.'"

					},
					"notes": {
						"address": "'.$order_address.'"


					},
					"theme": {
						"color": "'.$setting['setting']->site_theme_color.'"
					}
				};
				var rzp1 = new Razorpay(options);
				rzp1.on("payment.failed", function (response){
						alert(response.error.code);
						alert(response.error.description);
						alert(response.error.source);
						alert(response.error.step);
						alert(response.error.reason);
						alert(response.error.metadata);
				});

				$(window).on("load", function() {
					 rzp1.open();
					e.preventDefault();
					});
				</script>';
				echo $razorpay;
			$total_price = base64_decode($request->input('amount'));
			$payment_method = $request->input('payment_method');
			$product_names = $item_names_data;
			$ship_rate = base64_decode($request->input('ship_rate'));
			$sub_total = base64_decode($request->input('sub_total'));
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

	   $two_checkout_mode = $setting['setting']->two_checkout_mode;
	   $two_checkout_account = $setting['setting']->two_checkout_account;
	   $two_checkout_publishable = $setting['setting']->two_checkout_publishable;
	   $two_checkout_private = $setting['setting']->two_checkout_private;
	   $token = $csf_token;
	 	$record = array('total_price' => $total_price, 'purchase_token' => $purchase_token, 'payment_method' => $payment_method, 'product_names' => $product_names, 'ship_rate' => $ship_rate, 'sub_total' => $sub_total, 'paypal_url' => $paypal_url, 'paypal_email' => $paypal_email, 'site_currency' => $site_currency, 'website_url' => $website_url, 'stripe_mode' => $stripe_mode, 'stripe_publish_key' => $stripe_publish_key, 'two_checkout_private' => $two_checkout_private, 'two_checkout_account' => $two_checkout_account, 'two_checkout_mode' => $two_checkout_mode, 'token' => $token, 'two_checkout_publishable' => $two_checkout_publishable);
		return view('order-confirm')->with($record);

	}

	public function confirm_bank(Request $request)
	{
	   $purchase_token = $request->input('purchase_token');
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $bank_details = $setting['setting']->local_bank_details;
	   $bank_data = array('purchase_token' => $purchase_token, 'bank_details' => $bank_details);
	   return view('bank-details')->with($bank_data);
	}


	public function confirm_cod(Request $request)
	{
	   $purchase_token = $request->input('purchase_token');
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $bank_data = array('purchase_token' => $purchase_token);
	   return view('cash-on-delivery')->with($bank_data);
	}

	public function charge(Request $request)
    {

	   $token = $request->input('token');
	   $user_id = $request->input('user_id');
	   $user_name = $request->input('user_name');
	   $user_email = $request->input('user_email');
	   $product_names = $request->input('product_names');
	   $amount = base64_decode($request->input('amount'));
	   $site_currency = $request->input('site_currency');
	   $purchase_token = $request->input('purchase_token');
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   try {
            $creditCard = new \Omnipay\Common\CreditCard([
                'number' => $request->input('cc_number'),
                'expiryMonth' => $request->input('expiry_month'),
                'expiryYear' => $request->input('expiry_year'),
                'cvv' => $request->input('cvv'),
            ]);

            // Generate a unique merchant site transaction ID.
            $payment_token = rand(100000000, 999999999);

            $response = $this->gateway->authorize([
                'amount' => $amount,
                'currency' => $site_currency,
                'transactionId' => $payment_token,
                'card' => $creditCard,
            ])->send();

            if($response->isSuccessful()) {

                // Captured from the authorization response.
                $transactionReference = $response->getTransactionReference();

                $response = $this->gateway->capture([
                    'amount' => $amount,
                    'currency' => $site_currency,
                    'transactionReference' => $transactionReference,
                    ])->send();

                $payment_token = $response->getTransactionReference();
                $ord_token = $purchase_token;
                $sid = 1;
							$setting['setting'] = Settings::editGeneral($sid);
							$order_update = array('order_status' => 'completed', 'payment_type' => 'authorize.net', 'payment_token' => $payment_token);
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


						  $data_record = array('payment_token' => $payment_token);
						 return view('success')->with($data_record);


            } else {
                // not successful
                return redirect('/cancel');
            }
        } catch(Exception $e) {
            return $e->getMessage();
        }



	}

	public function confirm_2checkout(Request $request)
	{
	   $token = $request->input('token');
	   $user_id = $request->input('user_id');
	   $user_name = $request->input('user_name');
	   $user_email = $request->input('user_email');
	   $product_names = $request->input('product_names');
	   $amount = base64_decode($request->input('amount'));
	   $site_currency = $request->input('site_currency');
	   $two_checkout_private = $request->input('two_checkout_private');
	   $two_checkout_account = $request->input('two_checkout_account');
	   $two_checkout_mode = $request->input('two_checkout_mode');
	   $purchase_token = $request->input('purchase_token');
	   $user_phone = rand(444444,999999);

	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   include(app_path() . '/2Checkout/Twocheckout.php');
						Twocheckout::privateKey($two_checkout_private);
		                Twocheckout::sellerId($two_checkout_account);
		                Twocheckout::sandbox($two_checkout_mode);
						try {
							$charge = Twocheckout_Charge::auth(array(
								"merchantOrderId" => $purchase_token,
								"token"      => $token,
								"currency"   => $site_currency,
								"total"      => $amount,
								"billingAddr" => array(
									"name" => $user_name,
									"addrLine1" => $user_name,
									"city" => $user_name,
									"state" => "US",
									"zipCode" => $user_phone,
									"country" => "US",
									"email" => $user_email,
									"phoneNumber" => $user_phone
								)
							));

						if ($charge['response']['responseCode'] == 'APPROVED')
			            {
		                  $payment_token = $charge['response']['transactionId'];
						  $ord_token = $purchase_token;
							$sid = 1;
							$setting['setting'] = Settings::editGeneral($sid);
							$order_update = array('order_status' => 'completed', 'payment_type' => '2checkout', 'payment_token' => $payment_token);
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


						  $data_record = array('payment_token' => $payment_token);
						 return view('success')->with($data_record);


						}
						else
						{
						   return redirect('/cancel');
						}
					}
					catch (Twocheckout_Error $e)
					{

						  echo $e->getMessage();
					}

	}




	public function confirm_paypal(Request $request)
	{
	   $paypal_url = $request->input('paypal_url');
	   $paypal_email = $request->input('paypal_email');
	   $product_names = $request->input('product_names');
	   $purchase_token = $request->input('purchase_token');
	   $total_price = base64_decode($request->input('total_price'));
	   $site_currency = $request->input('site_currency');
	   $cancel = $request->input('cancel');
	   $return = $request->input('return');
	   $paypal = '<form method="post" id="paypal_form" action="'.$paypal_url.'">
			  <input type="hidden" value="_xclick" name="cmd">
			  <input type="hidden" value="'.$paypal_email.'" name="business">
			  <input type="hidden" value="'.$product_names.'" name="item_name">
			  <input type="hidden" value="'.$purchase_token.'" name="item_number">
			  <input type="hidden" value="'.$total_price.'" name="amount">
			  <input type="hidden" value="'.$site_currency.'" name="currency_code">
			  <input type="hidden" value="'.$return.'" name="return">
			  <input type="hidden" value="'.$cancel.'" name="cancel_return">

			</form>';
			$paypal .= '<script>window.paypal_form.submit();</script>';
			echo $paypal;



	}



	public function view_coupon(Request $request)
	{
	   $allsettings = Settings::allSettings();
	   $coupon = $request->input('coupon');
	   $user_id = Auth::user()->id;
	   $coupon_key = uniqid();
	   $check_coupon = Product::checkCoupon($coupon);



	   if($check_coupon == 1)
	   {
	      $single = Product::singleCoupon($coupon);

           $CheckAlreadyUse=DB::table('product_orders')->where('coupon_id','=',$single->coupon_id)->where('user_id','=',$user_id)->first();

           if(!empty($CheckAlreadyUse))
           {
               return redirect()->back()->with('error', 'Coupon Code Already Use');
           }

	      $coupondata['get'] = Product::getCoupon($coupon,$user_id);
		  foreach($coupondata['get'] as $couponview)
		  {
		     $order_id = $couponview->ord_id;
			 $coupon_id = $single->coupon_id;
			 $coupon_code = $single->coupon_code;
			 $coupon_type = $single->discount_type;
			 $coupon_value = $single->coupon_value;
			 $price = $couponview->price;
			 $discount = ($coupon_value * $price) / 100;
			 $discount_price = $price - $discount;
			 $data = array('coupon_key' => $coupon_key, 'coupon_id' => $coupon_id, 'coupon_code' => $coupon_code, 'coupon_type' => $coupon_type, 'coupon_value' => $coupon_value, 'discount_price' => $discount_price);
			 Product::updateCoupon($order_id,$data);

		  }
		  return redirect()->back()->with('success', 'Coupon Added Successfully.');
	   }
	   else
	   {
	      return redirect()->back()->with('error', 'Invalid Coupon Code or Expired');
	   }

	}

	public function show_cart()
	{
	  $translate = $this->lang_text();
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $user_id = Auth::user()->id;
	  $cart['product'] = Product::viewOrder($user_id,$translate);
	  $data = array('setting' => $setting, 'cart' => $cart);
	  return view('cart')->with($data);
	}

	public function delete_cart($id)
	{
	  $delete_id = base64_decode($id);
	  Product::removeCart($delete_id);
	  return redirect()->back()->with('success', 'Product Removed Successfully.');

	}
	public function view_cart(Request $request)
	{
	  $allsettings = Settings::allSettings();
	  $product_quantity = $request->input('qty');
	  $token = Session::getId();
	  if(!empty($request->input('product_attribute')))
	  {

		  $attribute_id = "";
		  $attribute_values = "";
		  foreach($request->input('product_attribute') as $prod_attribute)
		  {
		     $split = explode("_", $prod_attribute);
		     $attribute_id .= $split[0].',';
			 $attribute_values .= $split[1].', ';
		  }
		  $product_attribute = rtrim($attribute_id,",");
		  $product_attribute_values = rtrim($attribute_values,", ");

	  }
	  else
	  {
	     $product_attribute = "";
		 $product_attribute_values = "";
	  }
	  $product_token = $request->input('product_token');
	  $product_id = $request->input('product_id');
	  $product_price = base64_decode($request->input('price'));
	  $product_user_id = $request->input('product_user_id');
	  $user_id = Auth::user()->id;
	  $product_stock = $request->input('product_stock');
	  $order_status = 'pending';
	  $savedata = array('user_id' => $user_id, 'product_id' => $product_id, 'product_user_id' => $product_user_id, 'product_token' => $product_token, 'token' => $token, 'quantity' => $product_quantity, 'product_attribute' => $product_attribute, 'product_attribute_values' => $product_attribute_values, 'price' => $product_price, 'order_status' => $order_status);
	  $updata = array('quantity' => $product_quantity, 'product_attribute' => $product_attribute, 'product_attribute_values' => $product_attribute_values, 'price' => $product_price);
	  if($product_stock >= $product_quantity && $product_quantity > 0)
	  {
	     $check_order = Product::checkOrder($user_id,$product_token);
		 if($check_order == 0)
		 {
		    Product::saveOrder($savedata);
			return redirect('/cart')->with('success', 'Product Added Successfully.');
		 }
		 else
		 {
		    Product::updateOrder($user_id,$order_status,$product_token,$updata);
			return redirect('/cart')->with('success', 'Product Updated Successfully.');
		 }

	  }
	  else
	  {
	     return redirect()->back()->with('error', 'Please check available stock.');
	  }

	}


	public function view_wishlist($user_id,$token)
	{
	  $check = Product::wishlistCount($user_id,$token);
	  if($check == 0)
	  {
	     $data = array('user_id' => $user_id, 'product_token' => $token);
	     Product::saveWishlist($data);
		 return redirect('/wishlist')->with('success', 'Product Added Successfully.');
	  }
	  else
	  {
	     return redirect('/wishlist')->with('error', 'Sorry This Product Already Added');
	  }
	}

	public function view_products()
    {
	    $user_token = Auth::user()->id;
      	$product['view'] = Product::userproductData($user_token);
		return view('my-product',[ 'product' => $product]);
    }

	public function delete_product($token)
	{

	  $data = array('product_drop_status'=>'yes', 'product_status' => 0);

      Product::deleteData($token,$data);

	  return redirect()->back()->with('success', 'Product Deleted Successfully.');

	}


	public function delete_single_image($dropimg,$img_id)
	{

	   $token = base64_decode($img_id);
	   Product::deleteimgdata($token);

	  return redirect()->back()->with('success', 'Delete successfully.');

	}

	public function edit_product($product_token)
	{
	   $language_page['data'] = Languages::pageLanguage();
	   $languages_page['data'] = Languages::pageLanguage();
	   $edit['product'] = Product::editproductData($product_token);
	   $product_categories = explode(',',$edit['product']->product_category);
	   $editimage['view'] = Product::editimageData($product_token);
	   $product_attribute = explode(',',$edit['product']->product_attribute);
	   $user_id = Auth::user()->id;
	   $brand['view'] = Product::homebrandData();
	   $attributer['display'] = Attribute::with('AttributeAgain')->where('attribute_status','=','1')->where('attribute_drop_status','=','no')->where('attribute_page_parent','=',0)->orderBy('attribute_order','asc')->get();
	   return view('edit-product',[ 'edit' => $edit, 'product_categories' => $product_categories, 'editimage' => $editimage, 'product_attribute' => $product_attribute, 'attributer' => $attributer, 'brand' => $brand, 'language_page' => $language_page, 'languages_page' => $languages_page]);
	}


	public function update_product(Request $request)
	{

	     $allsettings = Settings::allSettings();
		 $data = $request->all();
		 $product_token = $data['product_token'];
		 $image_size = $data['image_size'];
		 $file_size = $data['file_size'];
		 $this->validate($request, [

		                    'product_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'product_gallery.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
							'product_file' => 'max:'.$file_size,

	     ]);
       $data = $request->all();
	   $rules = array(

				'product_slug' => ['required', Rule::unique('product') ->ignore($product_token, 'product_token') -> where(function($sql){ $sql->where('product_drop_status','=','no');})],

	     );
	   $messages = array();
	   $validator = Validator::make($request->all(), $rules, $messages);
	   if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{
		if(!empty($data['product_name']))
		 {
			$product_name = $data['product_name'];
		 }
		 else
		 {
			$product_name = "";
		 }
		 if(!empty($data['product_short_desc']))
		 {
			$product_short_desc = $data['product_short_desc'];
		 }
		 else
		 {
			$product_short_desc = "";
		 }
		 if(!empty($data['product_desc']))
		 {
			$product_desc = Purifier::clean($data['product_desc']);
		 }
		 else
		 {
			$product_desc = "";
		 }
		 $product_slug = $this->brand_slug($data['product_slug']);

		 $product_sku = $data['product_sku'];
		 if(!empty($data['product_category']))
	     {

		  $category1 = "";
		  foreach($data['product_category'] as $category)
		  {
		     $category1 .= $category.',';
		  }
		  $product_category = rtrim($category1,",");

	     }
	     else
	     {
	     $product_category = "";
	     }
		 $product_price = $data['product_price'];
		 $product_token = $data['product_token'];
		 $product_id = $data['product_id'];
		 $product_offer_price = $data['product_offer_price'];
		 $user_id = $data['user_id'];
		 $product_return_policy = $data['product_return_policy'];
		 $product_video_url = $data['product_video_url'];
		 $product_allow_seo = $data['product_allow_seo'];
		 $product_seo_keyword = $data['product_seo_keyword'];
		 $product_seo_desc = $data['product_seo_desc'];
		 $product_estimate_time = $data['product_estimate_time'];
		 $product_condition = $data['product_condition'];
		 $product_tags = $data['product_tags'];
		 $product_type = $data['product_type'];
		 if($product_type != 'digital')
		 {
		 $product_stock = $data['product_stock'];
		 }
		 else
		 {
		 $product_stock = 1;
		 }

		 $product_external_url = $data['product_external_url'];
		 $product_local_shipping_fee = $data['product_local_shipping_fee'];
		 $product_global_shipping_fee = $data['product_global_shipping_fee'];
		 if(!empty($data['product_attribute']))
	     {

		  $attributes = "";
		  $type = "";
		  foreach($data['product_attribute'] as $attribute)
		  {
		     $split = explode("-", $attribute);
		     $attributes .= $split[0].',';
			 $type .= $split[1].',';
		  }
		  $product_attribute = rtrim($attributes,",");
		  $product_attribute_type = rtrim($type,",");

	     }
	     else
	     {
	     $product_attribute = "";
		 $product_attribute_type = "";
	     }
		 $product_date = date('Y-m-d');
		 $flash_deals = $data['flash_deals'];
		 $flash_deal_start_date = $data['flash_deal_start_date'];
		 $flash_deal_end_date = $data['flash_deal_end_date'];
		 $product_brand = $data['product_brand'];
		 if($allsettings->product_approval == 1)
		 {
		 $product_status = 1;
		 $product_approve_status = "Your product updated successfully.";
		 }
		 else
		 {
		 $product_status = 0;
		 $product_approve_status = "Thanks for your submission. Once admin will approved your product. will publish on our marketplace.";
		 }
         if ($request->hasFile('product_image'))
		   {
		    Product::dropProductimg($product_token);
			$image = $request->file('product_image');
			$img_name = time() . '1.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/product');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$product_image = $img_name;
		  }
		  else
		  {
		     $product_image = $request->input('save_product_image');
		  }


		  if ($request->hasFile('product_file'))
		  {
			  $image = $request->file('product_file');
			  $img_name = time() . '147.'.$image->getClientOriginalExtension();
			  if($allsettings->site_s3_storage == 1)
			  {
			     Storage::disk('s3')->delete($request->input('save_product_file'));
				 Storage::disk('s3')->put($img_name, file_get_contents($image), 'public');
				 $product_file = $img_name;
			  }
			  else
			  {
			    Product::dropProductfile($product_token);
				$destinationPath = public_path('/storage/product');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				$product_file = $img_name;
			  }

		  }
		  else
		  {
		     $product_file = $request->input('save_product_file');
		  }


		$token = $data['token'];
		foreach($data['language_code'] as $index => $code)
		{


		   	$productname = $product_name[$index];
		    $productshortdesc = $product_short_desc[$index];
			$productdesc = $product_desc[$index];

		   if($code=="en")
			{


			  $data = array('user_id' => $user_id, 'product_name' => $productname, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $productshortdesc, 'product_desc' => htmlentities($productdesc), 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => $product_return_policy, 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => $product_estimate_time, 'product_condition' => $product_condition, 'product_tags' => $product_tags, 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => $flash_deals, 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand, 'language_code' => $code);
             Product::updateproductData($product_id,$data);

			}
			else
			{
			    $counts = Product::productCounts($code,$product_id);
			    if($counts==0)
				 {
						if(!empty($productname))
						{
						   $products_name = $productname;

						}
						else
						{
						   $products_name = "";

						}

						if(!empty($productshortdesc))
						{
						   $productshort_desc = $productshortdesc;

						}
						else
						{
						   $productshort_desc = "";

						}
						if(!empty($productdesc))
						{
						   $products_desc = $productdesc;

						}
						else
						{
						   $products_desc = "";

						}

					 $save = array('user_id' => $user_id, 'product_name' => $products_name, 'product_token' => $product_token, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $productshort_desc, 'product_desc' => htmlentities($products_desc), 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => $product_return_policy, 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => $product_estimate_time, 'product_condition' => $product_condition, 'product_tags' => $product_tags, 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => $flash_deals, 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand, 'language_code' => $code, 'token' => $token, 'product_page_parent' => $product_id);


				     Product::saveproductData($save);

				 }
				 else
				 {


				   $updata = array('user_id' => $user_id, 'product_name' => $productname, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $productshortdesc, 'product_desc' => htmlentities($productdesc), 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => $product_return_policy, 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => $product_estimate_time, 'product_condition' => $product_condition, 'product_tags' => $product_tags, 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => $flash_deals, 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand);
				  Product::anotherProduct($product_id,$code,$updata);

				 }

			}
		}
		if ($request->hasFile('product_gallery'))
			{
				$files = $request->file('product_gallery');
				foreach($files as $file)
				{
					$extension = $file->getClientOriginalExtension();
					$fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
					$folderpath  = public_path('/storage/product');
					$file->move($folderpath , $fileName);
					$imgdata = array('product_token' => $product_token, 'product_image' => $fileName);
				    Product::saveproductImages($imgdata);
			    }
		 }
        return redirect('/my-product')->with('success', $product_approve_status);

		}


	}

	/*public function update_product(Request $request)
	{
	     $allsettings = Settings::allSettings();
	     $product_name = $request->input('product_name');
		 $product_slug = $this->brand_slug($product_name);
         $image_size = $request->input('image_size');
		 $file_size = $request->input('file_size');
		 $product_sku = $request->input('product_sku');
		 $product_short_desc = $request->input('product_short_desc');
		 $product_desc = Purifier::clean($request->input('product_desc'));
		 if(!empty($request->input('product_category')))
	     {

		  $category1 = "";
		  foreach($request->input('product_category') as $category)
		  {
		     $category1 .= $category.',';
		  }
		  $product_category = rtrim($category1,",");

	     }
	     else
	     {
	     $product_category = "";
	     }
		 $product_price = $request->input('product_price');
		 $product_token = $request->input('product_token');
		 $product_offer_price = $request->input('product_offer_price');
		 $user_id = $request->input('user_id');
		 $product_return_policy = $request->input('product_return_policy');
		 $product_video_url = $request->input('product_video_url');
		 $product_allow_seo = $request->input('product_allow_seo');
		 $product_seo_keyword = $request->input('product_seo_keyword');
		 $product_seo_desc = $request->input('product_seo_desc');
		 $product_estimate_time = $request->input('product_estimate_time');
		 $product_condition = $request->input('product_condition');
		 $product_tags = $request->input('product_tags');
		 $product_type = $request->input('product_type');
		 if($product_type != 'digital')
		 {
		 $product_stock = $request->input('product_stock');
		 }
		 else
		 {
		 $product_stock = 1;
		 }
		 $product_file = $request->input('product_file');
		 $product_external_url = $request->input('product_external_url');
		 $product_local_shipping_fee = $request->input('product_local_shipping_fee');
		 $product_global_shipping_fee = $request->input('product_global_shipping_fee');
		 if(!empty($request->input('product_attribute')))
	     {

		  $attributes = "";
		  $type = "";
		  foreach($request->input('product_attribute') as $attribute)
		  {
		     $split = explode("-", $attribute);
		     $attributes .= $split[0].',';
			 $type .= $split[1].',';
		  }
		  $product_attribute = rtrim($attributes,",");
		  $product_attribute_type = rtrim($type,",");

	     }
	     else
	     {
	     $product_attribute = "";
		 $product_attribute_type = "";
	     }
		 $product_date = date('Y-m-d');
		 if($allsettings->product_approval == 1)
		 {
		 $product_status = 1;
		 $product_approve_status = "Your product updated successfully.";
		 }
		 else
		 {
		 $product_status = 0;
		 $product_approve_status = "Thanks for your submission. Once admin will approved your product. will publish on our marketplace.";
		 }
		 $flash_deals = $request->input('flash_deals');
		 $flash_deal_start_date = $request->input('flash_deal_start_date');
		 $flash_deal_end_date = $request->input('flash_deal_end_date');
		 $product_brand = $request->input('product_brand');

		 $request->validate([
		                    'product_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'product_gallery.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
							'product_file' => 'max:'.$file_size,
							'product_desc' => 'required',
							'product_name' => 'required',


         ]);
		 $rules = array(

				'product_name' => ['required', 'max:100', Rule::unique('product') ->ignore($product_token, 'product_token') -> where(function($sql){ $sql->where('product_drop_status','=','no');})],

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

		   if ($request->hasFile('product_image'))
		   {
		    Product::dropProductimg($product_token);
			$image = $request->file('product_image');
			$img_name = time() . '1.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/product');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$product_image = $img_name;
		  }
		  else
		  {
		     $product_image = $request->input('save_product_image');
		  }


		  if ($request->hasFile('product_file'))
		  {
			  $image = $request->file('product_file');
			  $img_name = time() . '147.'.$image->getClientOriginalExtension();
			  if($allsettings->site_s3_storage == 1)
			  {
			     Storage::disk('s3')->delete($request->input('save_product_file'));
				 Storage::disk('s3')->put($img_name, file_get_contents($image), 'public');
				 $product_file = $img_name;
			  }
			  else
			  {
			    Product::dropProductfile($product_token);
				$destinationPath = public_path('/storage/product');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				$product_file = $img_name;
			  }

		  }
		  else
		  {
		     $product_file = $request->input('save_product_file');
		  }

		$data = array('user_id' => $user_id, 'product_name' => $product_name, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $product_short_desc, 'product_desc' => $product_desc, 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => $product_return_policy, 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => $product_estimate_time, 'product_condition' => $product_condition, 'product_tags' => $product_tags, 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => $flash_deals, 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand);
        Product::updateproductData($product_token,$data);
		if ($request->hasFile('product_gallery'))
			{
				$files = $request->file('product_gallery');
				foreach($files as $file)
				{
					$extension = $file->getClientOriginalExtension();
					$fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
					$folderpath  = public_path('/storage/product');
					$file->move($folderpath , $fileName);
					$imgdata = array('product_token' => $product_token, 'product_image' => $fileName);
				    Product::saveproductImages($imgdata);
			    }
		 }
        return redirect('/my-product')->with('success', $product_approve_status);


       }



	}*/


	public function add_product()
	{
	   $language_page['data'] = Languages::pageLanguage();
	   $languages_page['data'] = Languages::pageLanguage();
	   $user_id = Auth::user()->id;
	   $attributer['display'] = Attribute::with('AttributeAgain')->where('attribute_status','=','1')->where('attribute_drop_status','=','no')->where('attribute_page_parent','=',0)->orderBy('attribute_order','asc')->get();
	   $brand['view'] = Product::homebrandData();
	   return view('add-product',[ 'attributer' => $attributer, 'brand' => $brand, 'language_page' => $language_page, 'languages_page' => $languages_page]);
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


	public function brand_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }

	public function save_product(Request $request)
	{
         $data = $request->all();
		 $image_size = $data['image_size'];
		 $file_size = $data['file_size'];
		 $allsettings = Settings::allSettings();
		 $this->validate($request, [

		     'product_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
			 'product_gallery.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
			 'product_file' => 'max:'.$file_size,

        	]);

		$rules = array(

				'product_slug' => ['required',  Rule::unique('product') -> where(function($sql){ $sql->where('product_drop_status','=','no');})],

	     );
		$messages = array();
		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{


		 if(!empty($data['product_name']))
		 {
			$product_name = $data['product_name'];
		 }
		 else
		 {
			$product_name = "";
		 }
		 if(!empty($data['product_short_desc']))
		 {
			$product_short_desc = $data['product_short_desc'];
		 }
		 else
		 {
			$product_short_desc = "";
		 }
		 if(!empty($data['product_desc']))
		 {
			$product_desc = Purifier::clean($data['product_desc']);
		 }
		 else
		 {
			$product_desc = "";
		 }
		 $product_slug = $this->brand_slug($data['product_slug']);

		 $product_sku = $data['product_sku'];
		 if(!empty($data['product_category']))
	     {

		  $category1 = "";
		  foreach($data['product_category'] as $category)
		  {
		     $category1 .= $category.',';
		  }
		  $product_category = rtrim($category1,",");

	     }
	     else
	     {
	     $product_category = "";
	     }
		 $product_price = $data['product_price'];
		 $product_token = $this->generateRandomString();
		 $product_offer_price = $data['product_offer_price'];
		 $user_id = $data['user_id'];
		 $product_return_policy = $data['product_return_policy'];
		 $product_video_url = $data['product_video_url'];
		 $product_allow_seo = $data['product_allow_seo'];
		 $product_seo_keyword = $data['product_seo_keyword'];
		 $product_seo_desc = $data['product_seo_desc'];
		 $product_estimate_time = $data['product_estimate_time'];
		 $product_condition = $data['product_condition'];
		 $product_tags = $data['product_tags'];
		 $product_type = $data['product_type'];
		 if($product_type != 'digital')
		 {
		 $product_stock = $data['product_stock'];
		 }
		 else
		 {
		 $product_stock = 1;
		 }

		 $product_external_url = $data['product_external_url'];
		 $product_local_shipping_fee = $data['product_local_shipping_fee'];
		 $product_global_shipping_fee = $data['product_global_shipping_fee'];
		 if(!empty($data['product_attribute']))
	     {

		  $attributes = "";
		  $type = "";
		  foreach($data['product_attribute'] as $attribute)
		  {
		     $split = explode("-", $attribute);
		     $attributes .= $split[0].',';
			 $type .= $split[1].',';
		  }
		  $product_attribute = rtrim($attributes,",");
		  $product_attribute_type = rtrim($type,",");

	     }
	     else
	     {
	     $product_attribute = "";
		 $product_attribute_type = "";
	     }
		 $product_date = date('Y-m-d');
		 $flash_deals = $data['flash_deals'];
		 $flash_deal_start_date = $data['flash_deal_start_date'];
		 $flash_deal_end_date = $data['flash_deal_end_date'];
		 $product_brand = $data['product_brand'];
		 if($allsettings->product_approval == 1)
		 {
		 $product_status = 1;
		 $product_approve_status = "Your product updated successfully.";
		 }
		 else
		 {
		 $product_status = 0;
		 $product_approve_status = "Thanks for your submission. Once admin will approved your product. will publish on our marketplace.";
		 }
		 if ($request->hasFile('product_image'))
		   {

			$image = $request->file('product_image');
			$img_name = time() . '1.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/product');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$product_image = $img_name;
		  }
		  else
		  {
		     $product_image = "";
		  }
		  if ($request->hasFile('product_file'))
		  {
			  $image = $request->file('product_file');
			  $img_name = time() . '147.'.$image->getClientOriginalExtension();
			  if($allsettings->site_s3_storage == 1)
			  {
				 Storage::disk('s3')->put($img_name, file_get_contents($image), 'public');
				 $product_file = $img_name;
			  }
			  else
			  {

				$destinationPath = public_path('/storage/product');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				$product_file = $img_name;
			  }

		  }
		  else
		  {
		     $product_file = "";
		  }

         $token = $data['token'];
		 foreach($data['language_code'] as $index => $code)
				{

				   $productname = $product_name[$index];
				   $productshortdesc = $product_short_desc[$index];
				   $productdesc = $product_desc[$index];



					if($code=='en')
					   {
						   $parent=0;
					   }
					   else
					   {

						   $pager = Product::productViews($token);
						   $check_page = Product::productGet($token);
						   if($check_page==0)
						   {
							$parent = $insertedId;
						   }
						   else
						   {
							$parent=$pager[0]->product_id;
						   }

					  }


					$record = array('user_id' => $user_id, 'product_token' => $product_token, 'product_name' => $productname, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $productshortdesc, 'product_desc' => htmlentities($productdesc), 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => $product_return_policy, 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => $product_estimate_time, 'product_condition' => $product_condition, 'product_tags' => $product_tags, 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => $flash_deals, 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand, 'token' => $token, 'language_code' => $code, 'product_page_parent' => $parent);
					$insertedId = Product::getLastInsertedId($record);
		      }
			  if ($request->hasFile('product_gallery'))
			  {
					$files = $request->file('product_gallery');
					foreach($files as $file)
					{
						$extension = $file->getClientOriginalExtension();
						$fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
						$folderpath  = public_path('/storage/product');
						$file->move($folderpath , $fileName);
						$imgdata = array('product_token' => $product_token, 'product_image' => $fileName);
						Product::saveproductImages($imgdata);
					}
			  }
			  return redirect('/my-product')->with('success', $product_approve_status);
		}




  }

	/*public function save_product(Request $request)
	{
         $allsettings = Settings::allSettings();
		 $product_name = $request->input('product_name');
		 $product_sku = $request->input('product_sku');
		 $product_slug = $this->brand_slug($product_name);
         $image_size = $request->input('image_size');
		 $file_size = $request->input('file_size');

		 $product_short_desc = $request->input('product_short_desc');
		 $product_desc = Purifier::clean($request->input('product_desc'));
		 if(!empty($request->input('product_category')))
	     {

		  $category1 = "";
		  foreach($request->input('product_category') as $category)
		  {
		     $category1 .= $category.',';
		  }
		  $product_category = rtrim($category1,",");

	     }
	     else
	     {
	     $product_category = "";
	     }
		 $product_video_url = $request->input('product_video_url');
		 $product_price = $request->input('product_price');
		 $product_offer_price = $request->input('product_offer_price');
		 $product_token = $this->generateRandomString();
		 $user_id = $request->input('user_id');
		 $product_tags = $request->input('product_tags');
		 $product_allow_seo = $request->input('product_allow_seo');
		 $product_seo_keyword = $request->input('product_seo_keyword');
		 $product_seo_desc = $request->input('product_seo_desc');
		 $product_type = $request->input('product_type');
		 $product_return_policy = $request->input('product_return_policy');
		 $product_estimate_time = $request->input('product_estimate_time');
		 $product_condition = $request->input('product_condition');
		 if($product_type != 'digital')
		 {
		 $product_stock = $request->input('product_stock');
		 }
		 else
		 {
		 $product_stock = 1;
		 }
		 $product_file = $request->input('product_file');
		 $product_external_url = $request->input('product_external_url');
		 $product_local_shipping_fee = $request->input('product_local_shipping_fee');
		 $product_global_shipping_fee = $request->input('product_global_shipping_fee');
		 if(!empty($request->input('product_attribute')))
	     {

		  $attributes = "";
		  $type = "";
		  foreach($request->input('product_attribute') as $attribute)
		  {
		     $split = explode("-", $attribute);
		     $attributes .= $split[0].',';
			 $type .= $split[1].',';
		  }
		  $product_attribute = rtrim($attributes,",");
		  $product_attribute_type = rtrim($type,",");

	     }
	     else
	     {
	     $product_attribute = "";
		 $product_attribute_type = "";
	     }
		 $product_date = date('Y-m-d');
		 if($allsettings->product_approval == 1)
		 {
		 $product_status = 1;
		 $product_approve_status = "Your product updated successfully.";
		 }
		 else
		 {
		 $product_status = 0;
		 $product_approve_status = "Thanks for your submission. Once admin will approved your product. will publish on our marketplace.";
		 }
		 $flash_deals = $request->input('flash_deals');
		 $flash_deal_start_date = $request->input('flash_deal_start_date');
		 $flash_deal_end_date = $request->input('flash_deal_end_date');
		 $product_brand = $request->input('product_brand');

		 $request->validate([
		                    'product_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'product_gallery.*' => 'image|mimes:jpeg,jpg,png|max:'.$image_size,
							'product_file' => 'max:'.$file_size,
							'product_desc' => 'required',
							'product_name' => 'required',


         ]);
		 $rules = array(

				'product_name' => ['required', 'max:100', Rule::unique('product') -> where(function($sql){ $sql->where('product_drop_status','=','no');})],

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

		   if ($request->hasFile('product_image'))
		   {

			$image = $request->file('product_image');
			$img_name = time() . '1.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/product');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$product_image = $img_name;
		  }
		  else
		  {
		     $product_image = "";
		  }




		  if ($request->hasFile('product_file'))
		  {
			  $image = $request->file('product_file');
			  $img_name = time() . '147.'.$image->getClientOriginalExtension();
			  if($allsettings->site_s3_storage == 1)
			  {
				 Storage::disk('s3')->put($img_name, file_get_contents($image), 'public');
				 $product_file = $img_name;
			  }
			  else
			  {

				$destinationPath = public_path('/storage/product');
				$imagePath = $destinationPath. "/".  $img_name;
				$image->move($destinationPath, $img_name);
				$product_file = $img_name;
			  }

		  }
		  else
		  {
		     $product_file = "";
		  }


		$data = array('user_id' => $user_id, 'product_token' => $product_token, 'product_name' => $product_name, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $product_short_desc, 'product_desc' => $product_desc, 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => $product_return_policy, 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => $product_estimate_time, 'product_condition' => $product_condition, 'product_tags' => $product_tags, 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => $flash_deals, 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand);
        Product::saveproductData($data);
		if ($request->hasFile('product_gallery'))
			{
				$files = $request->file('product_gallery');
				foreach($files as $file)
				{
					$extension = $file->getClientOriginalExtension();
					$fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
					$folderpath  = public_path('/storage/product');
					$file->move($folderpath , $fileName);
					$imgdata = array('product_token' => $product_token, 'product_image' => $fileName);
				    Product::saveproductImages($imgdata);
			    }
		 }
        return redirect('/my-product')->with('success', $product_approve_status);


       }


  }*/

	/* products */


}
