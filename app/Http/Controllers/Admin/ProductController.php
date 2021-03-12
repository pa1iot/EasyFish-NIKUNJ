<?php

namespace ZigKart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Session;
use ZigKart\Mail\EmailNotify;
use ZigKart\Models\Product;
use ZigKart\Models\Members;
use ZigKart\Models\Settings;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Storage;
use Illuminate\Support\Facades\File;
use Auth;
use URL;
use Mail;
use Purifier;
use ZigKart\Models\Languages;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

	/* brands */

	public function view_brands()
    {
      	$brandData['view'] = Product::brandData();
		return view('admin.brands',[ 'brandData' => $brandData]);
    }


	public function add_brand()
	{

	   return view('admin.add-brand');
	}


	public function brand_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }



	public function save_brand(Request $request)
	{

		 $brand_name = $request->input('brand_name');
		 $brand_slug = $this->brand_slug($brand_name);
         if(!empty($request->input('brand_order')))
		 {
         $brand_order = $request->input('brand_order');
		 }
		 else
		 {
		 $brand_order = 0;
		 }
		 $brand_status = $request->input('brand_status');
		 $image_size = $request->input('image_size');



		 $request->validate([
		                    'brand_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'brand_name' => 'required',
							'brand_status' => 'required',


         ]);
		 $rules = array(


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

		   if ($request->hasFile('brand_image'))
		   {

			$image = $request->file('brand_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/brands');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$brand_image = $img_name;
		  }
		  else
		  {
		     $brand_image = "";
		  }

		$data = array('brand_name' => $brand_name, 'brand_slug' => $brand_slug,  'brand_image' => $brand_image, 'brand_order' => $brand_order, 'brand_status' => $brand_status);
        Product::insertbrandData($data);
        return redirect('/admin/brands')->with('success', 'Insert successfully.');


       }


  }



  public function delete_brand($brand_id){



      Product::deleteBranddata($brand_id);

	  return redirect()->back()->with('success', 'Delete successfully.');


  }


  public function edit_brand($brand_id)
	{

	   $edit['brand'] = Product::editbrandData($brand_id);
	   return view('admin.edit-brand', [ 'edit' => $edit, 'brand_id' => $brand_id]);
	}



	public function update_brand(Request $request)
	{
	   $brand_name = $request->input('brand_name');
		 $brand_slug = $this->brand_slug($brand_name);
	   if(!empty($request->input('brand_order')))
		 {
         $brand_order = $request->input('brand_order');
		 }
		 else
		 {
		 $brand_order = 0;
		 }
		 $brand_status = $request->input('brand_status');
		 $image_size = $request->input('image_size');
		 $brand_id = $request->input('brand_id');


		 $request->validate([
		                    'brand_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'brand_status' => 'required',
							'brand_name' => 'required',

         ]);
		 $rules = array(


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

		   if ($request->hasFile('brand_image'))
		   {
		    Product::dropBrand($brand_id);
			$image = $request->file('brand_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/brands');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$brand_image = $img_name;
		  }
		  else
		  {
		     $brand_image = $request->input('save_brand_image');
		  }

		$data = array('brand_name' => $brand_name, 'brand_slug' => $brand_slug, 'brand_image' => $brand_image, 'brand_order' => $brand_order, 'brand_status' => $brand_status);
        Product::updatebrandData($brand_id,$data);
        return redirect('/admin/brands')->with('success', 'Update successfully.');


       }





	}


	/* brands */


	/* products */

	public function view_withdrawal()
	{
	  $itemData['item'] = Product::getwithdrawalData();
	   $data = array('itemData' => $itemData);
	   return view('admin.withdrawal')->with($data);
	}


	public function view_withdrawal_update($wd_id,$user_id)
	{
	         $drawal_data = array('withdraw_status' => 'paid');
			 Product::updatedrawalData($wd_id,$user_id,$drawal_data);

	         $buyer['info'] = Members::singlebuyerData($user_id);
			 $user_token = $buyer['info']->user_token;
			 $to_name = $buyer['info']->name;
			 $to_email = $buyer['info']->email;
			 $sid = 1;
			$setting['setting'] = Settings::editGeneral($sid);
			$admin_name = $setting['setting']->sender_name;
			$admin_email = $setting['setting']->sender_email;
			$currency = $setting['setting']->site_currency_symbol;
			$with['data'] = Product::singledrawalData($wd_id);
			$wd_amount = $with['data']->withdraw_amount;

			$data = array('to_name' => $to_name, 'to_email' => $to_email, 'wd_amount' => $wd_amount, 'currency' => $currency);
			Mail::send('admin.user_withdrawal_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
					$message->to($to_email, $to_name)
							->subject('Payment Withdrawal Request Accepted');
					$message->from($admin_email,$admin_name);
				});
	   return redirect()->back()->with('success','Payment withdrawal request has been completed');

	}



	public function view_payment_approval($ord_id,$user_type)
	{
	  $order = $ord_id;
	  $ordered['data'] = Product::singleorderData($order);
	  $user_id = $ordered['data']->user_id;
	  $item_user_id = $ordered['data']->product_user_id;
	  $vendor_amount = $ordered['data']->vendor_amount;
	  $total_price = $ordered['data']->total;
	  $admin_amount = $ordered['data']->admin_amount;

	  if($user_type == "vendor")
	  {

		 $vendor['info'] = Members::singlevendorData($item_user_id);
		 $user_token = $vendor['info']->user_token;
		 $to_name = $vendor['info']->name;
		 $to_email = $vendor['info']->email;
		 $vendor_earning = $vendor['info']->earnings + $vendor_amount;
		 $record = array('earnings' => $vendor_earning);
		 Members::updatepasswordData($user_token, $record);


		 $admin['info'] = Members::adminData();
		 $admin_token = $admin['info']->user_token;
		 $admin_earning = $admin['info']->earnings + $admin_amount;
		 $admin_record = array('earnings' => $admin_earning);
		 Members::updateadminData($admin_token, $admin_record);


		$orderdata = array('payment_status' => 'payment released to vendor');
		Product::singleorderupData($order,$orderdata);

		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$admin_name = $setting['setting']->sender_name;
		$admin_email = $setting['setting']->sender_email;
		$currency = $setting['setting']->site_currency_symbol;
		$data = array('to_name' => $to_name, 'to_email' => $to_email, 'vendor_amount' => $vendor_amount, 'currency' => $currency);
		Mail::send('admin.vendor_payment_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
				$message->to($to_email, $to_name)
						->subject('New Payment Approved');
				$message->from($admin_email,$admin_name);
			});



		return redirect()->back()->with('success','Payment released to vendor');

	  }
	  else if($user_type == "buyer")
	  {

		 $buyer['info'] = Members::singlebuyerData($user_id);
		 $user_token = $buyer['info']->user_token;
		 $to_name = $buyer['info']->name;
		 $to_email = $buyer['info']->email;
		 $buyer_earning = $buyer['info']->earnings + $total_price;
		 $record = array('earnings' => $buyer_earning);
		 Members::updatepasswordData($user_token, $record);

		$orderdata = array('payment_status' => 'payment released to buyer');
		Product::singleorderupData($order,$orderdata);
		Product::deleteRating($ord_id);

		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$admin_name = $setting['setting']->sender_name;
		$admin_email = $setting['setting']->sender_email;
		$currency = $setting['setting']->site_currency_symbol;
		$data = array('to_name' => $to_name, 'to_email' => $to_email, 'total_price' => $total_price, 'currency' => $currency);
		Mail::send('admin.buyer_payment_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
				$message->to($to_email, $to_name)
						->subject('Payment approval cancelled. Your amount credited on your wallet.');
				$message->from($admin_email,$admin_name);
			});



		return redirect()->back()->with('success','Payment released to buyer');


	  }





	}


	public function view_orders()
	{
        $data1 = array('body' => 'testing', 'subject' => 'test subject', 'msg_for' => 'customer', 'name' => 'dsfsfsd', 'email' => 'demo@demo.com', 'password' => 'dsfssdf', 'date' => date('Y-m-d'));
        Mail::to('nikchauhan2010@gmail.com')->send(new \ZigKart\Mail\EmailNotify($data1));

	   $itemData['item'] = Product::getorderProduct();
	   $data = array('itemData' => $itemData);
	   return view('admin.orders')->with($data);
	}


	public function view_payment_refund($ord_id,$refund_id,$user_type)
	{
	  $order = $ord_id;
	  $ordered['data'] = Product::singleorderData($order);
	  $user_id = $ordered['data']->user_id;
	  $product_user_id = $ordered['data']->product_user_id;
	  $vendor_amount = $ordered['data']->vendor_amount;
	  $total_price = $ordered['data']->total;
	  $admin_amount = $ordered['data']->admin_amount;
	  $approval_status = $ordered['data']->payment_status;


	  if($user_type == "buyer")
	  {

	      if($approval_status == "")
		  {

		    $buyer['info'] = Members::singlebuyerData($user_id);
			 $user_token = $buyer['info']->user_token;
			 $to_name = $buyer['info']->name;
			 $to_email = $buyer['info']->email;
			 $buyer_earning = $buyer['info']->earnings + $total_price;
			 $record = array('earnings' => $buyer_earning);
			 Members::updatepasswordData($user_token, $record);

			$orderdata = array('payment_status' => 'payment released to buyer');
			$refundata = array('dispute_status' => 'accepted');
			Product::singleorderupData($order,$orderdata);
			Product::refundupData($refund_id,$refundata);
			Product::deleteRating($ord_id);



			$sid = 1;
			$setting['setting'] = Settings::editGeneral($sid);
			$admin_name = $setting['setting']->sender_name;
			$admin_email = $setting['setting']->sender_email;
			$currency = $setting['setting']->site_currency_symbol;
			$data = array('to_name' => $to_name, 'to_email' => $to_email, 'total_price' => $total_price, 'currency' => $currency);
			Mail::send('admin.buyer_refund_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
					$message->to($to_email, $to_name)
							->subject('Payment Refund Accepted');
					$message->from($admin_email,$admin_name);
				});



			return redirect()->back()->with('success','Payment released to buyer');



		  }
		  else if($approval_status == 'payment released to buyer')
		  {
		     $refundata = array('dispute_status' => 'accepted');
			 Product::refundupData($refund_id,$refundata);
			 Product::deleteRating($ord_id);
		     return redirect()->back()->with('success','Payment released to buyer');
		  }
		  else if($approval_status == 'payment released to vendor')
		  {

		     $buyer['info'] = Members::singlebuyerData($user_id);
			 $user_token = $buyer['info']->user_token;
			 $to_name = $buyer['info']->name;
			 $to_email = $buyer['info']->email;
			 $buyer_earning = $buyer['info']->earnings + $total_price;
			 $record = array('earnings' => $buyer_earning);
			 Members::updatepasswordData($user_token, $record);

			$orderdata = array('payment_status' => 'payment released to buyer');
			$refundata = array('dispute_status' => 'accepted');
			Product::singleorderupData($order,$orderdata);
			Product::refundupData($refund_id,$refundata);
			Product::deleteRating($ord_id);


			 $vendor['info'] = Members::singlevendorData($item_user_id);
			 $vendor_token = $vendor['info']->user_token;
			 $to_name = $vendor['info']->name;
			 $to_email = $vendor['info']->email;
			 $vendor_earning = $vendor['info']->earnings - $vendor_amount;
			 $record_vendor = array('earnings' => $vendor_earning);
			 Members::updatevendorRecord($vendor_token, $record_vendor);


			 $admin['info'] = Members::adminData();
			 $admin_token = $admin['info']->user_token;
			 $admin_earning = $admin['info']->earnings - $admin_amount;
			 $admin_record = array('earnings' => $admin_earning);
			 Members::updateadminData($admin_token, $admin_record);



			$sid = 1;
			$setting['setting'] = Settings::editGeneral($sid);
			$admin_name = $setting['setting']->sender_name;
			$admin_email = $setting['setting']->sender_email;
			$currency = $setting['setting']->site_currency_symbol;
			$data = array('to_name' => $to_name, 'to_email' => $to_email, 'total_price' => $total_price, 'currency' => $currency);
			Mail::send('admin.buyer_refund_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
					$message->to($to_email, $to_name)
							->subject('Payment Refund Accepted');
					$message->from($admin_email,$admin_name);
				});



			return redirect()->back()->with('success','Payment released to buyer');




		  }



	  }
	  if($user_type == "vendor")
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
			$refundata = array('dispute_status' => 'declined');
			 Product::refundupData($refund_id,$refundata);
			$data = array('to_name' => $to_name, 'to_email' => $to_email, 'total_price' => $total_price, 'currency' => $currency);
			Mail::send('admin.buyer_declined_mail', $data , function($message) use ($admin_name, $admin_email, $to_name, $to_email) {
					$message->to($to_email, $to_name)
							->subject('Payment Refund Declined');
					$message->from($admin_email,$admin_name);
				});



		    return redirect()->back()->with('success','Your refund request is declined');

	  }



	}


	public function complete_orders($ord_id,$pay_type)
	{

	   $ord_token = base64_decode($ord_id);
	   $payment_type = base64_decode($pay_type);
		 $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);

//		print_r($setting);exit();
							$order_update = array('order_status' => 'completed', 'payment_type' => $payment_type);
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


                        Mail::to($admin_email)->send(new \ZigKart\Mail\EmailNotify($data_record));
                        Mail::to($email)->send(new \ZigKart\Mail\EmailNotify($data_record));


//								Mail::send('order_email', $data_record, function($message) use ($admin_name, $admin_email, $email, $name) {
//										$message->to($admin_email,$admin_name)
//												->subject('New Order Received');
//										$message->from($admin_email,$admin_name);
//									});
//
//								Mail::send('order_email', $data_record, function($message) use ($admin_name, $admin_email, $email, $name) {
//										$message->to($email, $name)
//												->subject('New Order Received');
//										$message->from($admin_email,$admin_name);
//									});

			return redirect()->back()->with('success', 'Payment details has been completed');


	}


	public function order_track(Request $request)
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $codes = $request->input('order_track');
	   $names = $request->input('order_id');
	   foreach( $codes as $index => $code )
	   {
	      $order_id = $names[$index];
	      $update_data = array('order_tracking' => $code);
	      Product::updateadminTrack($order_id,$update_data);
	   }

	   return redirect()->back()->with('success', 'Order tracking status has been updated.');

	}

	public function view_order_single($token)
	{
	  $itemData['item'] = Product::adminorderItem($token);
	  $single_data = Product::getCheckout($token);
	  if($single_data->bill_country != "")
	  {
	  $bill_country = $single_data->bill_country;
	  $bill_country_name = Members::getCountry($bill_country);
	  $billcountry_name = $bill_country_name->country_name;
	  }
	  else
	  {
	  $billcountry_name = "";
	  }
	  if($single_data->ship_country != "")
	  {
	  $ship_country = $single_data->ship_country;
	  $ship_country_name = Members::getCountry($ship_country);
	  $shipcountry_name = $ship_country_name->country_name;
	  }
	  else
	  {
	   $shipcountry_name = "";
	  }


	  $data = array('itemData' => $itemData, 'single_data' => $single_data, 'billcountry_name' => $billcountry_name, 'shipcountry_name' => $shipcountry_name);
	  return view('admin.order-details')->with($data);
	}


	public function view_products()
    {
      	$product['view'] = Product::productData();
		return view('admin.products',[ 'product' => $product]);
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
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $vendor['view'] = Members::getvendorData();
	   $edit['product'] = Product::editproductData($product_token);
	   $product_categories = explode(',',$edit['product']->product_category);
	   $editimage['view'] = Product::editimageData($product_token);
	   $brand['view'] = Product::homebrandData();
	   $product_attribute = explode(',',$edit['product']->product_attribute);
	   return view('admin.edit-product',[ 'vendor' => $vendor, 'edit' => $edit, 'product_categories' => $product_categories, 'editimage' => $editimage, 'product_attribute' => $product_attribute, 'brand' => $brand, 'language' => $language, 'languages' => $languages]);
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
		 $product_id = $data['product_id'];
		 $product_offer_price = $data['product_offer_price'];
		 $user_id = $data['user_id'];
		 //$product_return_policy = $data['product_return_policy'];
		 $product_video_url = $data['product_video_url'];
		 $product_allow_seo = $data['product_allow_seo'];
		 $product_seo_keyword = $data['product_seo_keyword'];
		 $product_seo_desc = $data['product_seo_desc'];
		 $product_estimate_time = $data['product_estimate_time'];
		 //$product_condition = $data['product_condition'];
		 //$product_tags = $data['product_tags'];
		// $product_featured = $data['product_featured'];
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
		 $product_status = 1;
		 //$flash_deals = $data['flash_deals'];
		 $flash_deal_start_date = $data['flash_deal_start_date'];
		 $flash_deal_end_date = $data['flash_deal_end_date'];
		 $product_brand = $data['product_brand'];
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


			  $data = array('user_id' => $user_id, 'product_name' => $productname, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $productshortdesc, 'product_desc' => htmlentities($productdesc), 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => " ", 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => $product_estimate_time, 'product_condition' => " ", 'product_tags' => " ", 'product_featured' => "", 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => "", 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand, 'language_code' => $code);
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

					 $save = array('user_id' => $user_id, 'product_name' => $products_name, 'product_token' => $product_token, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $productshort_desc, 'product_desc' => htmlentities($products_desc), 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => $product_return_policy, 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => " ", 'product_condition' => " ", 'product_tags' => " ", 'product_featured' => " ", 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => $flash_deals, 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand, 'language_code' => $code, 'token' => $token, 'product_page_parent' => $product_id);


				     Product::saveproductData($save);

				 }
				 else
				 {


				   $updata = array('user_id' => $user_id, 'product_name' => $productname, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $productshortdesc, 'product_desc' => htmlentities($productdesc), 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => $product_return_policy, 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => $product_estimate_time, 'product_condition' => " ", 'product_tags' => " ", 'product_featured' => " ", 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => $flash_deals, 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand);
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
        return redirect('/admin/products')->with('success', 'Update successfully.');

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
		 $product_featured = $request->input('product_featured');
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
		 $product_status = $request->input('product_status');
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

		$data = array('user_id' => $user_id, 'product_name' => $product_name, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $product_short_desc, 'product_desc' => $product_desc, 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => $product_return_policy, 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => $product_estimate_time, 'product_condition' => $product_condition, 'product_tags' => $product_tags, 'product_featured' => $product_featured, 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => $flash_deals, 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand);
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
        return redirect('/admin/products')->with('success', 'Update successfully.');


       }



	}*/


	public function add_product()
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $vendor['view'] = Members::getvendorData();
	   $brand['view'] = Product::homebrandData();
	   return view('admin.add-product',[ 'vendor' => $vendor, 'brand' => $brand, 'language' => $language, 'languages' => $languages]);
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
		// $product_return_policy = $data['product_return_policy'];
		 $product_video_url = $data['product_video_url'];
		 $product_allow_seo = $data['product_allow_seo'];
		 $product_seo_keyword = $data['product_seo_keyword'];
		 $product_seo_desc = $data['product_seo_desc'];
		// $product_estimate_time = $data['product_estimate_time'];
		 //$product_condition = $data['product_condition'];
		// $product_tags = $data['product_tags'];
		 //$product_featured = $data['product_featured'];


//		 $product_type = $data['product_type'];
		 $product_type = 'physical';


		 if($product_type != 'digital')
		 {
		 $product_stock = $data['product_stock'];
		 }
		 else
		 {
		 $product_stock = 1;
		 }

		 //$product_external_url = $data['product_external_url'];
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
		 $product_status = 1;
		// $flash_deals = $data['flash_deals'];
		// $flash_deal_start_date = $data['flash_deal_start_date'];
		 //$flash_deal_end_date = $data['flash_deal_end_date'];
		// $product_brand = $data['product_brand'];
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


					$record = array('user_id' => $user_id, 'product_token' => $product_token, 'product_name' => $productname, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $productshortdesc, 'product_desc' => htmlentities($productdesc), 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => " ", 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => " ", 'product_condition' => " ", 'product_tags' => "", 'product_featured' => "", 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => " ", 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => "", 'flash_deal_start_date' => "", 'flash_deal_end_date' => "", 'product_attribute_type' => $product_attribute_type, 'product_brand' => "", 'token' => $token, 'language_code' => $code, 'product_page_parent' => $parent);
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
			  return redirect('/admin/products')->with('success', 'Insert successfully.');
		}




  }

	/*public function save_product(Request $request)
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
		 $product_token = $this->generateRandomString();
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
		 $product_featured = $request->input('product_featured');
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
		 $product_status = 1;
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


		$data = array('user_id' => $user_id, 'product_token' => $product_token, 'product_name' => $product_name, 'product_sku' => $product_sku, 'product_slug' => $product_slug, 'product_category' => $product_category, 'product_short_desc' => $product_short_desc, 'product_desc' => $product_desc, 'product_price' => $product_price, 'product_offer_price' => $product_offer_price, 'product_image' => $product_image, 'product_return_policy' => $product_return_policy, 'product_video_url' => $product_video_url, 'product_allow_seo' => $product_allow_seo, 'product_seo_keyword' => $product_seo_keyword, 'product_seo_desc' => $product_seo_desc, 'product_estimate_time' => $product_estimate_time, 'product_condition' => $product_condition, 'product_tags' => $product_tags, 'product_featured' => $product_featured, 'product_type' => $product_type, 'product_file' => $product_file, 'product_external_url' => $product_external_url, 'product_local_shipping_fee' => $product_local_shipping_fee, 'product_global_shipping_fee' => $product_global_shipping_fee, 'product_attribute' => $product_attribute, 'product_stock' => $product_stock, 'product_date' => $product_date, 'product_status' => $product_status, 'flash_deals' => $flash_deals, 'flash_deal_start_date' => $flash_deal_start_date, 'flash_deal_end_date' => $flash_deal_end_date, 'product_attribute_type' => $product_attribute_type, 'product_brand' => $product_brand);
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
        return redirect('/admin/products')->with('success', 'Insert successfully.');


       }


  } */

  public function view_rating()
	{
	   $itemData['item'] = Product::getratingItem();
	   $data = array('itemData' => $itemData);
	   return view('admin.rating')->with($data);
	}

	public function rating_delete($rating_id)
	{
	   Product::dropRating($rating_id);
	   return redirect()->back()->with('success','Product rating has been removed');

	}

	public function view_refund()
	{

	  $itemData['item'] = Product::getrefundItem();
	   $data = array('itemData' => $itemData);
	   return view('admin.refund')->with($data);
	}
	/* products */


}
