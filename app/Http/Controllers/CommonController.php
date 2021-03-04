<?php

namespace ZigKart\Http\Controllers;

use Illuminate\Http\Request;
use ZigKart\Models\Members;
use ZigKart\Models\Settings;
use ZigKart\Models\Slideshow;
use ZigKart\Models\Languages;
use ZigKart\Models\Pages;
use ZigKart\Models\Product;
use ZigKart\Models\Category;
use ZigKart\Models\Attribute;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use URL;
use Cookie;
use Redirect;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    
	
	public function cookie_translate($id)
	{
	
	  Cookie::queue(Cookie::make('translate', $id, 3000));
      return Redirect::back()->withCookie('translate');
	  
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

    public function view_index()
	{
	   
	   
	   $translate = $this->lang_text();
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $slideshow['view'] = Slideshow::viewSlideshow($translate);
	   $phy_limit = $setting['setting']->site_home_physical;
	   $phy_display =  $setting['setting']->site_physical_order;
	   $ext_limit = $setting['setting']->site_home_external;
	   $ext_display =  $setting['setting']->site_external_order;
	   $dig_limit = $setting['setting']->site_home_digital;
	   $dig_display =  $setting['setting']->site_digital_order;
	   $deal_limit = $setting['setting']->site_home_deal;
	   $deal_display =  $setting['setting']->site_deal_order;
	   $featured_limit = $setting['setting']->site_home_featured;
	   $featured_display =  $setting['setting']->site_featured_order;
	   $today_date = date('Y-m-d h:i a');
	   $physical['product'] = Product::with('ProductImages')->where('product_type','=','physical')->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->take($phy_limit)->orderBy('product_id',$phy_display)->get();
	   $external['product'] = Product::with('ProductImages')->where('product_type','=','external')->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->take($ext_limit)->orderBy('product_id',$ext_display)->get();
	   $digital['product'] = Product::with('ProductImages')->where('product_type','=','digital')->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->take($dig_limit)->orderBy('product_id',$dig_display)->get();
	   $deal['product'] = Product::with('ProductImages')->where('flash_deal_start_date','<=',$today_date)->where('flash_deal_end_date','>=',$today_date)->where('flash_deals','=',1)->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->take($deal_limit)->orderBy('product_id',$deal_display)->get();
	   $brand['view'] = Product::homebrandData();
	   $featured['product'] = Product::with('ProductImages')->where('product_featured','=',1)->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->take($featured_limit)->orderBy('product_id',$featured_display)->get();
	   $data = array('setting' => $setting, 'slideshow' => $slideshow, 'physical' => $physical, 'external' => $external, 'digital' => $digital, 'deal' => $deal, 'brand' => $brand, 'featured' => $featured);
	  return view('index')->with($data);
	}
	
	public function view_best_sellers()
	{ 
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $best['seller'] = Members::bestSeller();
	  $product_count = Members::getgroupSellers();
	  $sale_count = Members::getsaleSellers();
	  $data = array('setting' => $setting, 'best' => $best, 'product_count' => $product_count, 'sale_count' => $sale_count);
	  return view('best-sellers')->with($data);
	}
	
	public function view_track_order()
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $check_track_order = 0;
	   $without = 0;
	   $data = array('setting' => $setting, 'check_track_order' => $check_track_order, 'without' => $without);
	   return view('track-order')->with($data);
	  
	}
	
	public function get_track_order(Request $request)
	{
	   $order_id = $request->input('order_number');
	   $check_track_order = Product::orderTrackCount($order_id);
	   $track_order = Product::orderTrack($order_id);
	   $without = 1;
	   $data = array('check_track_order' => $check_track_order, 'track_order' => $track_order, 'without' => $without, 'order_id' => $order_id);
	   return view('track-order')->with($data);
	}
	
	public function view_new_releases()
	{
	   $translate = $this->lang_text();
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $today_date = date('Y-m-d h:i a');
	   $shop['product'] = Product::with('ProductImages')->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->orderBy('product_id','desc')->get();
	   $data = array('setting' => $setting, 'shop' => $shop);
	   return view('new-releases')->with($data);
	}
	
	public function view_featured_products()
	{
	   $translate = $this->lang_text();
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $today_date = date('Y-m-d h:i a');
	   $shop['product'] = Product::with('ProductImages')->where('product_featured','=',1)->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->orderBy('product_id','desc')->get();
	   $data = array('setting' => $setting, 'shop' => $shop);
	   return view('featured-products')->with($data);
	}
	
	public function view_start_sellings()
	{
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $data = array('setting' => $setting);
	  return view('start-sellings')->with($data);
	}
	
	
	public function view_top_deals()
	{
	   $translate = $this->lang_text();
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $today_date = date('Y-m-d h:i a');
	   $deal['product'] = Product::with('ProductImages')->where('flash_deal_start_date','<=',$today_date)->where('flash_deal_end_date','>=',$today_date)->where('flash_deals','=',1)->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->orderBy('product_id','desc')->get();
	   $data = array('setting' => $setting, 'deal' => $deal);
	   return view('top-deals')->with($data);
	}
	
	public function view_user($slug)
	{
	   $translate = $this->lang_text();
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $user_details = Members::editUserData($slug);
	   $user_id = $user_details->id;
	   $shop['product'] = Product::with('ProductImages')->where('product_status','=',1)->where('product_drop_status','=','no')->where('user_id','=',$user_id)->where('language_code','=',$translate)->orderBy('product_id','desc')->get();
	   $total_product = Product::totaluserProduct($user_id);
	   $getreview  = Product::getreviewData($user_id);
	   if($getreview !=0)
	   {
	      $review['view'] = Product::getreviewStore($user_id);
		  $top = 0;
		  $bottom = 0;
		  foreach($review['view'] as $review)
		  {
		     if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
			 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
			 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
			 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
			 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
			 
			 $top += $value1 + $value2 + $value3 + $value4 + $value5;
			 $bottom += $review->rating;
			 
		  }
		  if(!empty(round($top/$bottom)))
		  {
		    $count_rating = round($top/$bottom);
		  }
		  else
		  {
		    $count_rating = 0;
		  }
		  
		  
		  
	  }
	  else
	  {
	    $count_rating = 0;
	  }
	   $data = array('setting' => $setting, 'user_details' => $user_details, 'slug' => $slug, 'total_product' => $total_product, 'count_rating' => $count_rating, 'getreview' => $getreview, 'shop' => $shop);
	   return view('user')->with($data);
	   
	}
	
	
	
	
	public function send_message(Request $request)
	{
	  $message_text = $request->input('message_text');
	  $from_email = $request->input('from_email');
	  $phone = $request->input('phone');
	  $from_name = $request->input('from_name');
	  $to_email = $request->input('to_email');
	  $to_name = $request->input('to_name');
	  		
		$record = array('message_text' => $message_text, 'from_name' => $from_name, 'from_email' => $from_email, 'phone' => $phone);
		Mail::send('user_mail', $record, function($message) use ($from_name, $from_email, $to_email, $to_name) {
			$message->to($to_email, $to_name)
					->subject('New message received');
			$message->from($from_email,$from_name);
		});
 
        return redirect()->back()->with('success','Your message has been sent successfully');     
		
	
	
	}
	
	public function view_product($slug)
	{
	   $translate = $this->lang_text();
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $shop = Product::with('ProductImages')->leftJoin('brands','brands.brand_id','product.product_brand')->where('product_status','=',1)->where('product_slug','=',$slug)->where('product_drop_status','=','no')->where('language_code','=',$translate)->orderBy('product_id','desc')->first();
	   $typer = $shop->product_attribute_type;
	   $product_type = $shop->product_type;
	   if($translate == 'en')
	   {
	   $attributer['display'] = Attribute::with('AttributeValue')->where('attribute_status','=','1')->where('attribute_drop_status','=','no')->where('language_code','=',$translate)->whereIn('attribute_id',explode(',',$typer))->orderBy('attribute_order','asc')->get();
	   }
	   else
	   {
	   $attributer['display'] = Attribute::with('AttributeAgain')->where('attribute_status','=','1')->where('attribute_drop_status','=','no')->where('language_code','=','en')->whereIn('attribute_id',explode(',',$typer))->orderBy('attribute_order','asc')->get();
	   
	   }
	   $seller_id = $shop->user_id;
	   $seller = Members::logindataUser($seller_id);
	   $product_tag = explode(",",$shop->product_tags);
	   $another['product'] = Product::with('ProductImages')->where('product_status','=',1)->where('product_type','=',$product_type)->where('product_slug','!=',$slug)->where('product_drop_status','=','no')->where('language_code','=',$translate)->take(4)->orderBy(DB::raw('RAND()'))->get();
	   $getreview  = Product::getreviewCount($shop->product_id);
	   if($getreview !=0)
	   {
	      $review['view'] = Product::getreviewView($shop->product_id);
		  $top = 0;
		  $bottom = 0;
		  foreach($review['view'] as $review)
		  {
		     if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
			 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
			 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
			 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
			 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
			 
			 $top += $value1 + $value2 + $value3 + $value4 + $value5;
			 $bottom += $review->rating;
			 
		  }
		  if(!empty(round($top/$bottom)))
		  {
		    $count_rating = round($top/$bottom);
		  }
		  else
		  {
		    $count_rating = 0;
		  }
		  
		  
		  
	  }
	  else
	  {
	    $count_rating = 0;
	  }
	  if($translate == 'en')
	  {
	  $getreviewdata['view']  = Product::getreviewItems($shop->product_id);
	  }
	  else
	  {
	  $getreviewdata['view']  = Product::getreviewItems($shop->product_page_parent);
	  }
	   $data = array('setting' => $setting, 'shop' => $shop, 'attributer' => $attributer, 'typer' => $typer, 'seller' => $seller, 'product_tag' => $product_tag, 'another' => $another, 'getreview' => $getreview, 'count_rating' => $count_rating, 'getreviewdata' => $getreviewdata);
	   return view('product')->with($data);
	}
	
	
	public function view_category_shop($type,$slug)
	{
	   $translate = $this->lang_text();
	   if($type == 'category')
	   {
	     $cat_id = Category::singleCat($slug);
		 $category_id = 'cat-'.$cat_id->cat_id;
	   }
	   else
	   {
	      $cat_id = Category::singleSubcat($slug);
		  $category_id = 'subcat-'.$cat_id->subcat_id;
	   }
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $shop['product'] = Product::with('ProductImages')->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->whereRaw('FIND_IN_SET(?,product_category)', [$category_id])->orderBy('product_id','desc')->get();
	   $attributer['display'] = Attribute::with('NewAttributeValue')->where('attribute_status','=','1')->where('attribute_drop_status','=','no')->where('attribute_search','=',1)->where('language_code','=',$translate)->orderBy('attribute_order','asc')->get();
	   $data = array('setting' => $setting, 'shop' => $shop, 'attributer' => $attributer);
	   return view('shop')->with($data);
	
	}
	
	
	public function view_tag_shop($tag)
	{
	   $translate = $this->lang_text();
	   $tags = str_replace('-',' ',$tag);
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $shop['product'] = Product::with('ProductImages')->where('product_status','=',1)->where('product_drop_status','=','no')->where('product_tags', 'LIKE', "%$tags%")->where('language_code','=',$translate)->orderBy('product_id','desc')->get();
	   $attributer['display'] = Attribute::with('NewAttributeValue')->where('attribute_status','=','1')->where('attribute_drop_status','=','no')->where('attribute_search','=',1)->where('language_code','=',$translate)->orderBy('attribute_order','asc')->get();
	   $data = array('setting' => $setting, 'shop' => $shop, 'attributer' => $attributer);
	   return view('shop')->with($data);
	
	}
	
	
	public function view_shop()
	{
	   $translate = $this->lang_text();
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $shop['product'] = Product::with('ProductImages')->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->orderBy('product_id','desc')->get();
	   $attributer['display'] = Attribute::with('NewAttributeValue')->where('attribute_status','=','1')->where('attribute_drop_status','=','no')->where('attribute_search','=',1)->where('language_code','=',$translate)->orderBy('attribute_order','asc')->get();
	   $data = array('setting' => $setting, 'shop' => $shop, 'attributer' => $attributer);
	   return view('shop')->with($data);
	
	}
	
	
	
	public function search_shop(Request $request)
	{
	     $translate = $this->lang_text();
	     if(!empty($request->input('search_text')))
		 {
		   $search_txt = $request->input('search_text');
		   
		  /*$shop['product'] = Product::with('ProductImages')->where('product_status','=',1)->where('product_drop_status','=','no')->where("product_name", "LIKE","%$search_txt%")->where('language_code','=',$translate)->orderBy('product_id','desc')->get();*/
		 }
		 else
		 {
		    $search_txt = "";
		 }
		 if(!empty($request->input('category')))
	     {
	      
		  $category_no = "";
		  foreach($request->input('category') as $category_value)
		  {
		     $category_no .= $category_value.',';
		  }
		  $category = rtrim($category_no,",");
		  
		 }
		 else
		 {
			 $category = "";
		 }
	     if(!empty($request->input('orderby')))
		 {
		 $orderby = $request->input('orderby');
		 }
		 else
		 {
		 $orderby = "asc";
		 }
		 if(!empty($request->input('condition')))
		 {
		 $condition = $request->input('condition');
		 }
		 else
		 {
		 $condition = "";
		 }
		 if(!empty($request->input('product_type')))
		 {
		 $product_type = $request->input('product_type');
		 }
		 else
		 {
		 $product_type = "";
		 }
		 if(!empty($request->input('attribute')))
	     {
	      
		  $attribute_no = "";
		  foreach($request->input('attribute') as $attribute_value)
		  {
		     $attribute_no .= $attribute_value.',';
		  }
		  $attribute = rtrim($attribute_no,",");
		  
		 }
		 else
		 {
			 $attribute = "";
		 }
		 if($search_txt != "" ||  $orderby != "" || $category != "" || $condition != "" || $product_type != "" || $attribute != "")
		 {
		     $shop['product'] = Product::with('ProductImages')
			                    ->where('product_status','=',1)
								->where('product_drop_status','=','no')
								->where('language_code','=',$translate)
								->where(function ($query) use ($search_txt,$category,$orderby,$condition,$product_type,$attribute) 
								{
								if ($search_txt != "")
								{ 
								$query->where('product_name', 'LIKE', '%'.$search_txt.'%');
								}
								if ($category != "")
								{
								  $query->where('product_category', 'LIKE', '%'.$category.'%');
								 // $query->orWhereRaw('FIND_IN_SET("'.$category.'",product_category)');
								 //$query->whereRaw('FIND_IN_SET(?,product_category)', [$category]);
								  
								}
								if ($condition != "")
								{
								 $query->where('product_condition', '=', $condition);
								}
								if ($product_type != "")
								{
								 $query->where('product_type', '=', $product_type);
								}
								if ($attribute != "")
								{
								  $query->where('product_attribute', 'LIKE', '%'.$attribute.'%');
								}
								})->orderBy('product_price', $orderby)->get();
								
								
								
		 }
	     else
	     {
	     $shop['product'] = Product::with('ProductImages')->where('product_status','=',1)->where('product_drop_status','=','no')->where('language_code','=',$translate)->orderBy('product_id','desc')->get();
		 
		 
	     }
		 
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   
	   $attributer['display'] = Attribute::with('NewAttributeValue')->where('attribute_status','=','1')->where('attribute_drop_status','=','no')->where('attribute_search','=',1)->where('language_code','=',$translate)->orderBy('attribute_order','asc')->get();
	   $data = array('setting' => $setting, 'shop' => $shop, 'attributer' => $attributer);
	   return view('shop')->with($data);
	
	}
	
	public function autoComplete(Request $request) {
	    $translate = $this->lang_text();
        $query = $request->get('term','');
        
        $products=Product::autoSearch($query,$translate);
        
        $data=array();
        foreach ($products as $product) {
                $data[]=array('value'=>$product->product_name,'id'=>$product->product_id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }
	
	
	
	public function all_categories()
	{
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $category['view'] = Category::quickbookData();
	  $count_cause = Category::getgroupcauseData();
	  $data = array('setting' => $setting, 'category' => $category, 'count_cause' => $count_cause);
	  return view('categories')->with($data); 
	}
	
	
	public function all_gallery()
	{
	  $gallery['view'] = Events::viewallGallery(); 
	  $data = array('gallery' => $gallery);
	  return view('gallery')->with($data);
	
	}
	
	
	
	public function donor_paypal_success($ord_token, Request $request)
	{
	
	$payment_token = $request->input('tx');
	$purchased_token = $ord_token;
	$donor['details'] = Causes::getDonor($purchased_token);
	$user_id = $donor['details']->donor_cause_user_id;
	$checkcount = Causes::checkuserSubscription($user_id);
	$sid = 1;
	$setting['setting'] = Settings::editGeneral($sid);
	$user_data['view'] = Members::singlebuyerData($user_id);
	if($checkcount == 0)
	{
		$commission = ($setting['setting']->site_admin_commission * $donor['details']->donor_amount) / 100;
		$user_amount = $donor['details']->donor_amount - $commission;
		$admin_amount = $commission;
		$user_old_amount = $user_data['view']->earnings + $user_amount;
		$admin_details['view'] = Members::adminData();
		$admin_old_amount = $admin_details['view']->earnings + $admin_amount;
		$user_record = array('earnings' => $user_old_amount);
		Members::updateuserPrice($user_id, $user_record);
		$admin_data = array('earnings' => $admin_old_amount);
		Members::updateuserPrice(1, $admin_data);			   
				  
	}
	$cause_id = $donor['details']->donor_cause_id;
	$cause['details'] = Causes::singleCausesdetails($cause_id);
	$raised_price = $cause['details']->cause_raised + $donor['details']->donor_amount;
	$pricedata = array('cause_raised' => $raised_price);
	Causes::updatecausePrice($cause_id,$pricedata);
	
	$checkoutdata = array('donor_payment_token' => $payment_token, 'donor_payment_status' => 'completed');
	Causes::updatedonorData($purchased_token,$checkoutdata);
	$result_data = array('payment_token' => $payment_token);
	
	$check_email_support = Members::getuserSubscription($user_id);
	if($check_email_support == 1)
	{   
	    $donor_payment_amount = $donor['details']->donor_amount;
		$admin_name = $setting['setting']->sender_name;
		$admin_email = $setting['setting']->sender_email;
		$currency_symbol = $setting['setting']->site_currency_symbol;
		$cause_url = URL::to('/cause/').$cause['details']->cause_slug;
		$record = array('donor_payment_amount' => $donor_payment_amount, 'currency_symbol' => $currency_symbol, 'cause_url' => $cause_url);
		$to_name = $user_data['view']->name;
		$to_email = $user_data['view']->email;
		Mail::send('donation_mail', $record, function($message) use ($admin_name, $admin_email, $to_email, $to_name) {
		$message->to($to_email, $to_name)
			->subject('Donation payment received');
			$message->from($admin_email,$admin_name);
			});
	}
	return view('donor-success')->with($result_data);
	
	}
	
	
	
	public function confirm_donation(Request $request)
	{
	   
	   $token = $request->input('token');
	   $donor_name = $request->input('donor_name');
	   $donor_email = $request->input('donor_email'); 
	   $donor_phone = $request->input('donor_phone');
	   $donor_amount = $request->input('donor_amount');
	   $donor_note = $request->input('donor_note'); 
	   $cause_title = $request->input('cause_title');
	   $cause_slug = $request->input('cause_slug');
	   $image_size = $request->input('image_size');   
	   $purchase_token = rand(111111,999999);
	   $payment_method = $request->input('payment_method');
	   $website_url = $request->input('website_url');
	   $donor_purchase_date = date('Y-m-d');
	   $donor_cause_id = $request->input('donor_cause_id');
	   $cause_raised = base64_decode($request->input('cause_raised'));
	   $donor_cause_token = $request->input('donor_cause_token');
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $user_id = $request->input('cause_user_id');
	   $raised_price = $cause_raised + $donor_amount;
	   $miniumum_amount = $setting['setting']->site_minimum_donate;
	   
	   
	   $request->validate([
							'donor_name' => 'required',
							'donor_email' => 'required',
							'donor_phone' => 'required',
							'donor_amount' => 'required|numeric|min:'.$miniumum_amount,
							'donor_photo' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
							
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
	        
			
	   
	   
			   if ($request->hasFile('donor_photo')) 
			   {
							
							$image = $request->file('donor_photo');
							$img_name = time() . '.'.$image->getClientOriginalExtension();
							$destinationPath = public_path('/storage/donors');
							$imagePath = $destinationPath. "/".  $img_name;
							$image->move($destinationPath, $img_name);
							$donor_photo = $img_name;
			  }
			  else
			  {
				$donor_photo = "";
			  }
			   
	   
	   
			   $savedata = array('donor_cause_id' => $donor_cause_id, 'donor_cause_user_id' => $user_id, 'donor_cause_token' => $donor_cause_token, 'donor_name' => $donor_name, 'donor_email' => $donor_email, 'donor_phone' => $donor_phone, 'donor_amount' => $donor_amount, 'donor_note' => $donor_note, 'donor_payment_type' => $payment_method, 'donor_purchase_token' => $purchase_token, 'donor_purchase_date' => $donor_purchase_date, 'donor_photo' => $donor_photo, 'donor_payment_status' => 'pending');
			   
			   
			   $checkcount = Causes::checkuserSubscription($user_id);
			   $user_data['view'] = Members::singlebuyerData($user_id);
			   /* settings */
			   $site_currency = $setting['setting']->site_currency_code;
			   $success_url = $website_url.'/donor-success/'.$purchase_token;
			   $cancel_url = $website_url.'/cancel';
			   
			   if($checkcount == 1)
			   {
				   $paypal_email = $user_data['view']->user_paypal_email;
				   $paypal_mode = $user_data['view']->user_paypal_mode;
				   if($paypal_mode == 1)
				   {
					 $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
				   }
				   else
				   {
					 $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
				   }
				  
				   $stripe_mode = $user_data['view']->user_stripe_mode;
				   if($stripe_mode == 0)
				   {
					 $stripe_publish_key = $user_data['view']->user_test_publish_key;
					 $stripe_secret_key = $user_data['view']->user_test_secret_key;
				   }
				   else
				   {
					 $stripe_publish_key = $user_data['view']->user_live_publish_key;
					 $stripe_secret_key = $user_data['view']->user_live_secret_key;
				   }
			   
			   }
			   else
			   {
				  
				   $paypal_email = $setting['setting']->paypal_email;
				   $paypal_mode = $setting['setting']->paypal_mode;
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
				   
						  
			   }
			   
				   /* settings */
				   Causes::insertdonorData($savedata);
				   
				   if($payment_method == 'paypal')
					  {
						 
						 $paypal = '<form method="post" id="paypal_form" action="'.$paypal_url.'">
						  <input type="hidden" value="_xclick" name="cmd">
						  <input type="hidden" value="'.$paypal_email.'" name="business">
						  <input type="hidden" value="'.$cause_title.'" name="item_name">
						  <input type="hidden" value="'.$purchase_token.'" name="item_number">
						  <input type="hidden" value="'.$donor_amount.'" name="amount">
						  <input type="hidden" value="'.$site_currency.'" name="currency_code">
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
								'email' => $donor_email,
								'source'  => $token
							));
						 
							
							$cause_name = $cause_title;
							$donor_price = $donor_amount * 100;
							$currency = $site_currency;
							$book_id = $purchase_token;
						 
							
							$charge = \Stripe\Charge::create(array(
								'customer' => $customer->id,
								'amount'   => $donor_price,
								'currency' => $currency,
								'description' => $cause_name,
								'metadata' => array(
									'order_id' => $book_id
								)
							));
						 
							
							$chargeResponse = $charge->jsonSerialize();
						 
							
							if($chargeResponse['paid'] == 1 && $chargeResponse['captured'] == 1) 
							{
						 
								if($checkcount == 0)
								{
								   
								   $commission = ($setting['setting']->site_admin_commission * $donor_amount) / 100;
								   $user_amount = $donor_amount - $commission;
								   $admin_amount = $commission;
								   $user_old_amount = $user_data['view']->earnings + $user_amount;
								   $admin_details['view'] = Members::adminData();
								   $admin_old_amount = $admin_details['view']->earnings + $admin_amount;
								   $user_record = array('earnings' => $user_old_amount);
								   Members::updateuserPrice($user_id, $user_record);
								   $admin_data = array('earnings' => $admin_old_amount);
								   Members::updateuserPrice(1, $admin_data);
			
								  
								}
								$pricedata = array('cause_raised' => $raised_price);
								Causes::updatecausePrice($donor_cause_id,$pricedata);
													
								$payment_token = $chargeResponse['balance_transaction'];
								$purchased_token = $book_id;
								$checkoutdata = array('donor_payment_token' => $payment_token, 'donor_payment_status' => 'completed');
								Causes::updatedonorData($purchased_token,$checkoutdata);
								$data_record = array('payment_token' => $payment_token);
								
								
								$check_email_support = Members::getuserSubscription($user_id);
								if($check_email_support == 1)
								{   
									$donor_payment_amount = $donor_amount;
									$admin_name = $setting['setting']->sender_name;
									$admin_email = $setting['setting']->sender_email;
									$currency_symbol = $setting['setting']->site_currency_symbol;
									$cause_url = URL::to('/cause/').$cause_slug;
									$record = array('donor_payment_amount' => $donor_payment_amount, 'currency_symbol' => $currency_symbol, 'cause_url' => $cause_url);
									$to_name = $user_data['view']->name;
									$to_email = $user_data['view']->email;
									Mail::send('donation_mail', $record, function($message) use ($admin_name, $admin_email, $to_email, $to_name) {
									$message->to($to_email, $to_name)
										->subject('Donation payment received');
										$message->from($admin_email,$admin_name);
										});
								}
								return view('success')->with($data_record);
								
								
							}
						 
					  
					  }
					  /* stripe code */
					  
	     }
	
	
	}
	
	
	public function activate_newsletter($token)
	{
	   
	   $check = Members::checkNewsletter($token);
	   if($check == 1)
	   {
	      
		  $data = array('news_status' => 1);
		
		  Members::updateNewsletter($token,$data);
		  
		  return redirect('/newsletter')->with('success', 'Thank You! Your subscription has been confirmed!');
		  
	   }
	   else
	   {
	       return redirect('/newsletter')->with('error', 'This email address already subscribed');
	   }
	
	}
	
	
	public function view_newsletter()
	{
	 
	  return view('newsletter');
	
	}
	
	
	public function update_newsletter(Request $request)
	{
	
	   $news_email = $request->input('news_email');
	   $news_status = 0;
	   $news_token = $this->generateRandomString();
	   
	   $request->validate([
							
							'news_email' => 'required|email',
							
							
							
         ]);
		 $rules = array(
		 
		      'news_email' => ['required',  Rule::unique('newsletter') -> where(function($sql){ $sql->where('news_status','=',0);})],
								
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 /*return back()->withErrors($validator);*/
		 return redirect()->back()->with('news-error', 'This email address already subscribed.');
		} 
		else
		{
		
		
		$data = array('news_email' => $news_email, 'news_token' => $news_token, 'news_status' => $news_status);
		
		Members::savenewsletterData($data);
		
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		$from_name = $setting['setting']->sender_name;
        $from_email = $setting['setting']->sender_email;
		$activate_url = URL::to('/newsletter').'/'.$news_token;
		
		$record = array('activate_url' => $activate_url);
		Mail::send('newsletter_mail', $record, function($message) use ($from_name, $from_email, $news_email) {
			$message->to($news_email)
					->subject('Newsletter');
			$message->from($from_email,$from_name);
		});
		
			   
		return redirect()->back()->with('news-success', 'Your email address subscribed. You will receive a confirmation email.');
		
		}
	   
	
	}
	
	
	public function view_allcauses()
	{
	   $causes['view'] = Causes::viewallCauses();
	   $slug = '';
	   $data = array('causes' => $causes, 'slug' => $slug); 
	   return view('causes')->with($data);
	
	}
	
	
	public function view_category_causes($slug)
	{
	  $causes['view'] = Causes::viewcategoryCauses($slug);
	   $data = array('causes' => $causes, 'slug' => $slug); 
	   return view('causes')->with($data);
	}
	
	
	public function single_cause($slug)
	{
	  $single['view'] = Causes::singleCause($slug);
	  $user_id = $single['view']->cause_user_id;
	  $checkcount = Causes::checkuserSubscription($user_id);
	  if($checkcount == 0)
	  {
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $get_payment = explode(',', $setting['setting']->payment_option);
	  }
	  else
	  {
	      $user['details'] = Members::singlebuyerData($user_id);
		  $get_payment = explode(',', $user['details']->user_payment_option);
	  }
	  
	    $x = $single['view']->cause_raised;
        $y = $single['view']->cause_goal;
        $percent = $x/$y;
        $percent_value = number_format( $percent * 100);
        if($percent_value >= 100)
        {
          $percent_val = 100;
        }
        else
        {
          $percent_val = $percent_value;
        }
		
		$donor['details'] = Causes::recentDonation($single['view']->cause_id);
        $data = array('single' => $single, 'percent_val' => $percent_val, 'get_payment' => $get_payment, 'donor' => $donor); 
	  
	   return view('cause')->with($data);
	}
	
	
	public function view_became_volunteer()
	{
	   return view('became-volunteer');
	}

    public function user_verify($user_token)
    {
        $data = array('verified'=>'1');
		$user['user'] = Members::verifyuserData($user_token, $data);
		
		return redirect('login')->with('success','Your e-mail is verified. You can now login.');
    }
	
	
	public function single_volunteer($slug)
	{
	   $single['view'] = Volunteers::slugVolunteers($slug);
	   $data = array('single' => $single); 
	   return view('volunteer')->with($data);
	}
	
	
	public function all_volunteer()
	{
	
	  $display['view'] = Volunteers::allVolunteers();
	   $data = array('display' => $display); 
	   return view('volunteers')->with($data);
	
	}
	
	public function all_events()
	{
	
	  $display['view'] = Events::allEvents();
	  $category['view'] = Category::eventCategoryData();
	  $count_category = Category::getgroupeventData();
	  $slug = "";
	   $data = array('display' => $display, 'category' => $category, 'count_category' => $count_category, 'slug' => $slug); 
	   return view('events')->with($data);
	
	}
	
	
	public function single_event($slug)
	{
	   $single['view'] = Events::singleEvent($slug);
	   $category['view'] = Category::eventCategoryData();
	   $count_category = Category::getgroupeventData();
	   $recent['view'] = Events::recentEvent($slug);
	   $event_start_time = date('F d, Y H:i:s', strtotime($single['view']->event_start_date_time));
	   $data = array('single' => $single, 'category' => $category, 'count_category' => $count_category, 'slug' => $slug, 'recent' => $recent, 'event_start_time' => $event_start_time); 
	   return view('event')->with($data);
	
	}
	
	
	public function view_category_events($cat_id,$slug)
	{
	
	$display['view'] = Events::categoryEvents($cat_id);
	  $category['view'] = Category::eventCategoryData();
	  $count_category = Category::getgroupeventData();
	   $data = array('display' => $display, 'category' => $category, 'count_category' => $count_category, 'slug' => $slug); 
	   return view('events')->with($data);
	
	}
	
	
	
	public function view_subscription()
	{
	 $subscription['view'] = Members::viewSubscription();
	 $data = array('subscription' => $subscription);  
	 return view('subscription')->with($data);
	}
	
	public function view_forgot()
	{
	   return view('forgot');
	}
	
	public function view_contact()
	{
	   return view('contact');
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
	
	public function view_reset($token)
	{
	  $data = array('token' => $token);
	  return view('reset')->with($data);
	}
	
	public function volunteer_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	public function submit_volunteer(Request $request)
	{
	
	   $volu_firstname = $request->input('volu_firstname');
	   $volu_lastname = $request->input('volu_lastname');
	   $volu_name = $volu_firstname.'-'.$volu_lastname;
	   $volu_slug = $this->volunteer_slug($volu_name);
	   $volu_email = $request->input('volu_email');
	   $volu_phone = $request->input('volu_phone');
	   $volu_profession = $request->input('volu_profession');
	   $volu_facebook_link = $request->input('volu_facebook_link');
	   $volu_twitter_link = $request->input('volu_twitter_link');
	   $volu_linked_link = $request->input('volu_linked_link');
	   $volu_address = $request->input('volu_address');	
	   $volu_about = $request->input('volu_about');
	   $image_size = $request->input('image_size');	
	   $volu_token = $this->generateRandomString();
	   $allsettings = Settings::allSettings();
	   $volunteers_approval = $allsettings->volunteers_approval;
	   
	   
	   if($volunteers_approval == 1)
	   {
	      $volunteer_status = 1;
		  $volunteer_approve_status = "Thanks for your submission. Your details updated successfully.";
	   }
	   else
	   {
	      $volunteer_status = 0;
		  $volunteer_approve_status = "Thanks for your submission. Once admin will activated your details. will publish on our website.";
	   }
	   
	   
	   $request->validate([
							'volu_email' => 'required|email',
							'volu_firstname' => 'required',
							'volu_lastname' => 'required',
							'volu_phone' => 'required',
							'volu_photo' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
							
         ]);
		 $rules = array(
				
				'volu_email' => ['required',  Rule::unique('volunteers') -> where(function($sql){ $sql->where('volu_drop_status','=','no');})],
				
				
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
	        
		  
			   if ($request->hasFile('volu_photo')) 
				  {
					$image = $request->file('volu_photo');
					$img_name = time() . '.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/storage/volunteers');
					$imagePath = $destinationPath. "/".  $img_name;
					$image->move($destinationPath, $img_name);
					$volu_photo = $img_name;
				  }
				  else
				  {
					 $volu_photo = "";
				  }
			   
			   $data = array('volu_firstname' => $volu_firstname, 'volu_lastname' => $volu_lastname, 'volu_email' => $volu_email, 'volu_phone' => $volu_phone, 'volu_photo' => $volu_photo, 'volu_address' => $volu_address, 'volu_profession' => $volu_profession, 'volu_facebook_link' => $volu_facebook_link, 'volu_twitter_link' => $volu_twitter_link, 'volu_linked_link' => $volu_linked_link, 'volu_about' => $volu_about, 'volu_token' => $volu_token, 'volu_status' => $volunteer_status, 'volu_slug' => $volu_slug);
			   
			   Members::savevolunteerData($data);
			   
			   return redirect()->back()->with('success', $volunteer_approve_status);
			
			   
			   
		}
		
				
	
	
	}
	
	
	public function update_reset(Request $request)
	{
	
	   $user_token = $request->input('user_token');
	   $password = bcrypt($request->input('password'));
	   $password_confirmation = $request->input('password_confirmation');
	   $data = array("user_token" => $user_token);
	   $value = Members::verifytokenData($data);
	   $user['user'] = Members::gettokenData($user_token);
	   if($value)
	   {
	   
	      $request->validate([
							'password' => 'required|confirmed|min:6',
							
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
		   
		   $record = array('password' => $password);
           Members::updatepasswordData($user_token, $record);
           return redirect('login')->with('success','Your new password updated successfully. Please login now.');
		
		}
	   
	   
	   }
	   else
	   {
              
			  return redirect()->back()->with('error', 'These credentials do not match our records.');
       }
	   
	   
	
	}
	
	
	
	public function update_forgot(Request $request)
	{
	   $email = $request->input('email');
	   
	   $data = array("email"=>$email);
 
       $value = Members::verifycheckData($data);
	   $user['user'] = Members::getemailData($email);
       
	   if($value)
	   {
			
		$user_token = $user['user']->user_token;
		$name = $user['user']->name;
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		$from_name = $setting['setting']->sender_name;
        $from_email = $setting['setting']->sender_email;
		
		$record = array('user_token' => $user_token);
		Mail::send('forgot_mail', $record, function($message) use ($from_name, $from_email, $email, $name, $user_token) {
			$message->to($email, $name)
					->subject('Forgot Password');
			$message->from($from_email,$from_name);
		});
 
         return redirect('forgot')->with('success','We have e-mailed your password reset link!');     
			  
       }
	   else
	   {
              
			  return redirect()->back()->with('error', 'These credentials do not match our records.');
       }
	   
	  
	   
	   
	   
	}
	
	
	
	/* contact */
	
	public function update_contact(Request $request)
	{
	
	  $from_name = $request->input('from_name');
	  $from_email = $request->input('from_email');
	  if(!empty($request->input('from_phone')))
	  {
	  $from_phone = $request->input('from_phone');
	  }
	  else
	  {
	  $from_phone = "";
	  }
	  $message_text = $request->input('message_text');
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  	  
	  $admin_name = $setting['setting']->sender_name;
      $admin_email = $setting['setting']->sender_email;
	  
	  $request->validate([
							'from_name' => 'required',
							'from_email' => 'required|email',
							'message_text' => 'required',
							'g-recaptcha-response' => 'required|captcha',
							
							
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
	  
	      $record = array('from_name' => $from_name, 'from_email' => $from_email, 'from_phone' => $from_phone, 'message_text' => $message_text, 'contact_date' => date('Y-m-d'));
		  $contact_count = Members::getcontactCount($from_email);
		  if($contact_count == 0)
		  {
		  Members::saveContact($record);
		  Mail::send('contact_mail', $record, function($message) use ($admin_name, $admin_email, $from_email, $from_name, $from_phone) {
					$message->to($admin_email, $admin_name)
							->subject('Contact');
					$message->from($from_email,$from_name);
				});
		  return redirect('contact')->with('success','Your message has been sent successfully');
		  }
		  else
		  {
		  return redirect('contact')->with('error','Sorry! Your message already sent');
		  }
	  
	   }
	
	}
	
	/* contact */
	
	
	
	
}
