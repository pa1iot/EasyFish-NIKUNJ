<?php

namespace ZigKart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Session;
use ZigKart\Models\Settings;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Image;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	    
	
	/* settings */
	
	
	public function general_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.general-settings', [ 'setting' => $setting, 'sid' => $sid]);
		
    }
	
	public function demo_mode()
	{
	   return redirect()->back()->with('error', 'This is Demo version. You can not delete');
	}
	
	
	
	public function update_demo_mode(Request $request)
	{
	   return redirect()->back()->with('error', 'This is Demo version. You can not add or change any thing');
	}
	
	
	public function color_settings()
	{
	
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.color-settings', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	
	public function update_color_settings(Request $request)
	{
	  	$site_theme_color = $request->input('site_theme_color');
		$site_button_color = $request->input('site_button_color');
		$site_copyright_color = $request->input('site_copyright_color');
		$site_section_color = $request->input('site_section_color');
		$site_footer_color = $request->input('site_footer_color');
		$site_button_hover = $request->input('site_button_hover');
	  	$sid = $request->input('sid');
	     
         
		 $request->validate([
		 
					'site_theme_color' => 'required',
					'site_button_color' => 'required',
					'site_copyright_color' => 'required',
					'site_section_color' => 'required',	
					'site_footer_color' => 'required',			
							
							
							
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
		
			  
		 
		 
		$data = array('site_theme_color' => $site_theme_color, 'site_button_color' => $site_button_color, 'site_copyright_color' => $site_copyright_color, 'site_section_color' => $site_section_color, 'site_footer_color' => $site_footer_color, 'site_button_hover' => $site_button_hover);
 
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
	
	
	
	}
	
	
	public function counter_section()
	{
	  
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.counter-section', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	
	public function update_counter_section(Request $request)
	{
	   
	   
	   $site_counter_icon1 = $request->input('site_counter_icon1');
	   $site_counter_icon2 = $request->input('site_counter_icon2');
	   $site_counter_icon3 = $request->input('site_counter_icon3');
	   $site_counter_icon4 = $request->input('site_counter_icon4');
	   
	   $site_counter_count1 = $request->input('site_counter_count1');
	   $site_counter_count2 = $request->input('site_counter_count2');
	   $site_counter_count3 = $request->input('site_counter_count3');
	   $site_counter_count4 = $request->input('site_counter_count4');
	   
	   $site_counter_title1 = $request->input('site_counter_title1');
	   $site_counter_title2 = $request->input('site_counter_title2');
	   $site_counter_title3 = $request->input('site_counter_title3');
	   $site_counter_title4 = $request->input('site_counter_title4');
	   
	   $site_counter_display = $request->input('site_counter_display');
	   
	   
	   $sid = $request->input('sid');
	     
         
		 $request->validate([
		 
							
							
							
							
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
		
			  
		 
		 
		$data = array('site_counter_icon1' => $site_counter_icon1, 'site_counter_icon2' => $site_counter_icon2, 'site_counter_icon3' => $site_counter_icon3, 'site_counter_icon4' => $site_counter_icon4, 'site_counter_count1' => $site_counter_count1, 'site_counter_count2' => $site_counter_count2, 'site_counter_count3' => $site_counter_count3, 'site_counter_count4' => $site_counter_count4, 'site_counter_title1' => $site_counter_title1, 'site_counter_title2' => $site_counter_title2, 'site_counter_title3' => $site_counter_title3, 'site_counter_title4' => $site_counter_title4, 'site_counter_display' => $site_counter_display);
 
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
	
	
	}
	
	
	
	
	 public function update_general_settings(Request $request)
	{
	
	     $site_title = $request->input('site_title');
	     $site_desc = $request->input('site_desc');
         $site_keywords = $request->input('site_keywords');
		 $sid = $request->input('sid');
		 $office_email = $request->input('office_email');
		 $office_phone = $request->input('office_phone');
		 $office_address = $request->input('office_address');
		 $image_size = $request->input('image_size');
		 $site_copyright = $request->input('site_copyright');
		 $save_footer_logo = $request->input('save_footer_logo');
		 $site_loader_display = $request->input('site_loader_display');
		 $save_loader_image = $request->input('save_loader_image');
		 $site_multilanguage = $request->input('site_multilanguage');
		 $product_per_page = $request->input('product_per_page');
		 $post_per_page = $request->input('post_per_page');
		 $product_approval = $request->input('product_approval');
		 $google_translate = $request->input('google_translate');
		 $cookie_popup_text = $request->input('cookie_popup_text');
		 $google_analytics = $request->input('google_analytics');
		 $cookie_popup = $request->input('cookie_popup');
		  $cookie_popup_button = $request->input('cookie_popup_button');
         $display_external_product = $request->input('display_external_product');
		 $email_verification = $request->input('email_verification');
		 $maintenance_mode = $request->input('maintenance_mode');
		 $type_of_marketplace = $request->input('type_of_marketplace');
		 $site_custom_style = $request->input('site_custom_style');
		 
		 $request->validate([
							'site_title' => 'required',
							'site_favicon' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'site_logo' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'selling_background' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'selling_image_one' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'selling_image_two' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'selling_icon_one' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'selling_icon_two' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'selling_icon_three' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
							
							
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
		
		if ($request->hasFile('site_favicon')) {
		     
			Settings::dropFavicon($sid); 
		   
			$image = $request->file('site_favicon');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$fav_image = $img_name;
		  }
		  else
		  {
		     $fav_image = $request->input('save_favicon');
		  }
		  
		  
		  
		  if ($request->hasFile('site_logo')) {
		     
			Settings::dropLogo($sid); 
		   
			$image = $request->file('site_logo');
			$img_name = time() . '11.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$logo_image = $img_name;
		  }
		  else
		  {
		     $logo_image = $request->input('save_logo');
		  }
		  
		  
		  if ($request->hasFile('site_loader_image')) {
		     
			Settings::dropLoader($sid); 
		   
			$image = $request->file('site_loader_image');
			$img_name = time() . '6713.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$site_loader_image = $img_name;
		  }
		  else
		  {
		     $site_loader_image = $save_loader_image;
		  }
		   
		 
		 if ($request->hasFile('site_header_background')) {
		     
			Settings::dropBanner($sid); 
		   
			$image = $request->file('site_header_background');
			$img_name = time() . '191.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$site_header_background = $img_name;
		  }
		  else
		  {
		     $site_header_background = $request->input('save_header_background');
		  }
		  
		  
		  if ($request->hasFile('selling_background')) {
		    $column = "selling_background"; 
			Settings::dropImage($column); 
		   
			$image = $request->file('selling_background');
			$img_name = time() . '200.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$selling_background = $img_name;
		  }
		  else
		  {
		     $selling_background = $request->input('save_selling_background');
		  }
		  
		  if ($request->hasFile('selling_image_one')) {
		    $column = "selling_image_one"; 
			Settings::dropImage($column); 
		   
			$image = $request->file('selling_image_one');
			$img_name = time() . '201.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$selling_image_one = $img_name;
		  }
		  else
		  {
		     $selling_image_one = $request->input('save_selling_image_one');
		  }
		  
		  if ($request->hasFile('selling_image_two')) {
		    $column = "selling_image_two"; 
			Settings::dropImage($column); 
		   
			$image = $request->file('selling_image_two');
			$img_name = time() . '202.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$selling_image_two = $img_name;
		  }
		  else
		  {
		     $selling_image_two = $request->input('save_selling_image_two');
		  }
		  
		  if ($request->hasFile('selling_icon_one')) {
		    $column = "selling_icon_one"; 
			Settings::dropImage($column); 
		   
			$image = $request->file('selling_icon_one');
			$img_name = time() . '203.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$selling_icon_one = $img_name;
		  }
		  else
		  {
		     $selling_icon_one = $request->input('save_selling_icon_one');
		  }
		  
		  
		  if ($request->hasFile('selling_icon_two')) {
		    $column = "selling_icon_two"; 
			Settings::dropImage($column); 
		   
			$image = $request->file('selling_icon_two');
			$img_name = time() . '204.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$selling_icon_two = $img_name;
		  }
		  else
		  {
		     $selling_icon_two = $request->input('save_selling_icon_two');
		  }
		  
		  
		  if ($request->hasFile('selling_icon_three')) {
		    $column = "selling_icon_three"; 
			Settings::dropImage($column); 
		   
			$image = $request->file('selling_icon_three');
			$img_name = time() . '205.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$selling_icon_three = $img_name;
		  }
		  else
		  {
		     $selling_icon_three = $request->input('save_selling_icon_three');
		  }
		  
		 
		$data = array('site_title' => $site_title, 'site_desc' => $site_desc, 'site_keywords' => $site_keywords,  'site_favicon' => $fav_image, 'site_logo' => $logo_image, 'office_address' => $office_address, 'office_email' => $office_email, 'office_phone' => $office_phone, 'site_copyright' => $site_copyright, 'site_loader_image' => $site_loader_image, 'site_loader_display' => $site_loader_display, 'site_multilanguage' => $site_multilanguage, 'product_per_page' => $product_per_page, 'post_per_page' => $post_per_page, 'product_approval' => $product_approval, 'site_header_background' => $site_header_background, 'selling_background' => $selling_background, 'selling_image_one' => $selling_image_one, 'selling_image_two' => $selling_image_two, 'selling_icon_one' => $selling_icon_one, 'selling_icon_two' => $selling_icon_two, 'selling_icon_three' => $selling_icon_three, 'google_translate' => $google_translate, 'cookie_popup_text' => $cookie_popup_text, 'google_analytics' => $google_analytics, 'cookie_popup' => $cookie_popup, 'cookie_popup_button' => $cookie_popup_button, 'display_external_product' => $display_external_product, 'email_verification' => $email_verification, 'maintenance_mode' => $maintenance_mode, 'type_of_marketplace' => $type_of_marketplace, 'site_custom_style' => $site_custom_style);
 
            
			Settings::updategeneralData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	} 
	
	
	
	public function custom_section()
	{
	  
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.custom-section', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	
	public function update_custom_section(Request $request)
	{
	   	   
	      
	   $site_custom_display = $request->input('site_custom_display');
	   $site_custom_title = $request->input('site_custom_title');
	   $site_custom_content = $request->input('site_custom_content');
	   $sid = $request->input('sid');
	         
         
		 $request->validate([
		 
							
							
							
							
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
		
		 
		   $data = array('site_custom_display' => $site_custom_display, 'site_custom_title' => $site_custom_title, 'site_custom_content' => $site_custom_content);
 
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
	
	
	}
	
	
	
	public function home_section()
	{
	  
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.home-section', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	public function update_home_section(Request $request)
	{
	
	   if(!empty($request->input('site_home_category')))
	   {
	   $site_home_category = $request->input('site_home_category');
	   }
	   else 
	   {
	   $site_home_category = "";
	   }
	   
	   
	   
	   $save_more_category = $request->input('save_more_category');
	   $site_banner_one_heading = $request->input('site_banner_one_heading');
	   $site_banner_one_link = $request->input('site_banner_one_link');
	   $site_banner_two_heading = $request->input('site_banner_two_heading');
	   $site_banner_two_link = $request->input('site_banner_two_link');
	   $save_banner_one = $request->input('save_banner_one');
	   $save_banner_two = $request->input('save_banner_two');
	   $sid = $request->input('sid');
	   $image_size = $request->input('image_size');	
	   $site_home_physical = $request->input('site_home_physical');	
	   $site_physical_order = $request->input('site_physical_order');
	   $site_home_external = $request->input('site_home_external');
	   $site_external_order = $request->input('site_external_order');
	   $site_home_digital = $request->input('site_home_digital'); 
	   $site_digital_order = $request->input('site_digital_order');
	   $site_banner_three_heading =  $request->input('site_banner_three_heading');
	   $site_banner_three_link =  $request->input('site_banner_three_link'); 
	   $save_banner_three = $request->input('save_banner_three');
	   $site_home_deal = $request->input('site_home_deal');
	   $site_deal_order = $request->input('site_deal_order');
	   $site_home_top_banner = $request->input('site_home_top_banner'); 
	   $site_home_bottom_banner = $request->input('site_home_bottom_banner'); 
	   $site_home_featured = $request->input('site_home_featured');
	   $site_featured_order = $request->input('site_featured_order');     
         
		 $request->validate([
		 
							'site_more_category' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'site_banner_one' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'site_banner_two' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'site_banner_three' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
							
							
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
		
			  
		 if ($request->hasFile('site_more_category')) {
		     
			Settings::dropmorebanner($sid); 
		   
			$image = $request->file('site_more_category');
			$img_name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$site_more_category = $img_name;
		  }
		  else
		  {
		     $site_more_category = $save_more_category;
		  }
		  
		  
		  if ($request->hasFile('site_banner_one')) {
		     
			Settings::droponebanner($sid); 
		   
			$image = $request->file('site_banner_one');
			$img_name = time().'32.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$site_banner_one = $img_name;
		  }
		  else
		  {
		     $site_banner_one = $save_banner_one;
		  }
		  
		  
		  if ($request->hasFile('site_banner_two')) {
		     
			Settings::droptwobanner($sid); 
		   
			$image = $request->file('site_banner_two');
			$img_name = time().'312.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$site_banner_two = $img_name;
		  }
		  else
		  {
		     $site_banner_two = $save_banner_two;
		  }
		  
		  
		  if ($request->hasFile('site_banner_three')) {
		     
			Settings::dropthreebanner($sid); 
		   
			$image = $request->file('site_banner_three');
			$img_name = time().'302.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$site_banner_three = $img_name;
		  }
		  else
		  {
		     $site_banner_three = $save_banner_three;
		  }
		 
		$data = array('site_home_category' => $site_home_category, 'site_more_category' => $site_more_category, 'site_banner_one' => $site_banner_one, 'site_banner_two' => $site_banner_two, 'site_banner_one_link' => $site_banner_one_link, 'site_banner_two_link' => $site_banner_two_link, 'site_banner_one_heading' => $site_banner_one_heading, 'site_banner_two_heading' => $site_banner_two_heading, 'site_home_physical' => $site_home_physical, 'site_physical_order' => $site_physical_order, 'site_home_external' => $site_home_external, 'site_external_order' => $site_external_order, 'site_home_digital' => $site_home_digital, 'site_digital_order' => $site_digital_order, 'site_banner_three' => $site_banner_three, 'site_banner_three_heading' => $site_banner_three_heading, 'site_banner_three_link' => $site_banner_three_link, 'site_home_deal' => $site_home_deal, 'site_deal_order' => $site_deal_order, 'site_home_top_banner' => $site_home_top_banner, 'site_home_bottom_banner' => $site_home_bottom_banner, 'site_home_featured' => $site_home_featured, 'site_featured_order' => $site_featured_order);
 
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
	
	
	}
	
	
	public function ads_section()
	{
	  
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.ads', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	
	public function update_ads_section(Request $request)
	{
	   $shop_ads = $request->input('shop_ads');
	   $shop_top_ads = $request->input('shop_top_ads');
	   $shop_bottom_ads = $request->input('shop_bottom_ads');
	   $shop_sidebar_ads = $request->input('shop_sidebar_ads');
	   $blog_ads = $request->input('blog_ads');
	   $blog_top_ads = $request->input('blog_top_ads');
	   $blog_bottom_ads = $request->input('blog_bottom_ads');
	   $blog_sidebar_ads = $request->input('blog_sidebar_ads');
	   $page_ads = $request->input('page_ads');
	   $page_top_ads = $request->input('page_top_ads');
	   $page_bottom_ads = $request->input('page_bottom_ads');
	   $sid = $request->input('sid');
	   $request->validate([
		 
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
		
		   $data = array('shop_ads' => $shop_ads, 'shop_top_ads' => $shop_top_ads, 'shop_bottom_ads' => $shop_bottom_ads, 'shop_sidebar_ads' => $shop_sidebar_ads, 'blog_ads' => $blog_ads, 'blog_top_ads' => $blog_top_ads, 'blog_bottom_ads' => $blog_bottom_ads, 'blog_sidebar_ads' => $blog_sidebar_ads, 'page_ads' => $page_ads, 'page_top_ads' => $page_top_ads, 'page_bottom_ads' => $page_bottom_ads);
 
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
		
		}
	
	}
	
	
	public function footer_section()
	{
	  
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.footer-section', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	
	public function update_footer_section(Request $request)
	{
	   
	   if(!empty($request->input('site_subscribe_text')))
	   {
	   $site_subscribe_text = $request->input('site_subscribe_text');
	   }
	   else 
	   {
	   $site_subscribe_text = "";
	   }
	   
	   
	   
	   $save_footer_payment = $request->input('save_footer_payment');
	   $sid = $request->input('sid');
	   $image_size = $request->input('image_size');	         
         
		 $request->validate([
		 
							'site_footer_payment' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
							
							
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
		
			  
		 if ($request->hasFile('site_footer_payment')) {
		     
			Settings::dropPaymentbanner($sid); 
		   
			$image = $request->file('site_footer_payment');
			$img_name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$site_footer_payment = $img_name;
		  }
		  else
		  {
		     $site_footer_payment = $save_footer_payment;
		  }
		 
		$data = array('site_footer_payment' => $site_footer_payment, 'site_subscribe_text' => $site_subscribe_text);
 
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
	
	
	}
	
	
	
	
	public function about_section()
	{
	
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.about-section', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	
	public function update_about_section(Request $request)
	{
	   if(!empty($request->input('site_about_heading')))
	   {
	   $site_about_heading = $request->input('site_about_heading');
	   }
	   else
	   {
	   $site_about_heading = "";
	   }
	   if(!empty($request->input('site_about_desc')))
	   {
	   $site_about_desc = $request->input('site_about_desc');
	   }
	   else 
	   {
	   $site_about_desc = "";
	   }
	   
	   if(!empty($request->input('site_about_btntext')))
	   {
	   $site_about_btntext = $request->input('site_about_btntext');
	   }
	   else 
	   {
	   $site_about_btntext = "";
	   }
	   if(!empty($request->input('site_about_btnlink')))
	   {
	   $site_about_btnlink = $request->input('site_about_btnlink');
	   }
	   else 
	   {
	   $site_about_btnlink = "";
	   }
	   
	   
	   
	   if(!empty($request->input('site_about_videolink')))
	   {
	   $site_about_videolink = $request->input('site_about_videolink');
	   }
	   else 
	   {
	   $site_about_videolink = "";
	   }
	   
	   $save_about_image = $request->input('save_about_image');
	   $sid = $request->input('sid');
	   $image_size = $request->input('image_size');
	   $site_about_display = $request->input('site_about_display');
	            
         
		 $request->validate([
		 
							'site_about_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							
							
							
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
		
			  
		 if ($request->hasFile('site_about_image')) {
		     
			Settings::dropAboutbanner($sid); 
		   
			$image = $request->file('site_about_image');
			$img_name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/settings');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$site_about_image = $img_name;
		  }
		  else
		  {
		     $site_about_image = $request->input('save_about_image');
		  }
		 
		$data = array('site_about_heading' => $site_about_heading, 'site_about_desc' => $site_about_desc, 'site_about_btntext' => $site_about_btntext, 'site_about_btnlink' => $site_about_btnlink, 'site_about_image' => $site_about_image, 'site_about_videolink' => $site_about_videolink, 'site_about_display' => $site_about_display);
 
            
            
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
	
	
	}
	
	
	
	
	public function media_settings()
	{
	
	    $sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.media-settings', [ 'setting' => $setting, 'sid' => $sid]);
	
	}
	
	
	public function update_media_settings(Request $request)
	{
	
	   $site_max_image_size = $request->input('site_max_image_size');
	   $site_max_zip_size = $request->input('site_max_zip_size');
	   $site_s3_storage = $request->input('site_s3_storage');
	   $aws_access_key_id = $request->input('aws_access_key_id');
	   $aws_secret_access_key = $request->input('aws_secret_access_key');
	   $aws_default_region = $request->input('aws_default_region');
	   $aws_bucket = $request->input('aws_bucket');
		         
         
		 $request->validate([
							'site_max_image_size' => 'required',
							'site_max_zip_size' => 'required',
							'site_s3_storage' => 'required',
							
							
         ]);
		 
		  $sid = $request->input('sid');
		 
         
		 
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
		
			  
		 
		 
		$data = array('site_max_image_size' => $site_max_image_size, 'site_max_zip_size' => $site_max_zip_size, 'site_s3_storage' => $site_s3_storage, 'aws_access_key_id' => $aws_access_key_id, 'aws_secret_access_key' => $aws_secret_access_key, 'aws_default_region' => $aws_default_region, 'aws_bucket' => $aws_bucket);
 
            
            
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
	
	
	}
	
	
	public function email_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.email-settings', [ 'setting' => $setting, 'sid' => $sid]);
		
    }
	
	
	
	public function update_email_settings(Request $request)
	{
	
	   $sender_name = $request->input('sender_name');
	   $sender_email = $request->input('sender_email');
	   $mail_driver = $request->input('mail_driver');
	   $mail_port = $request->input('mail_port');
	   $mail_password = $request->input('mail_password');
	   $mail_host = $request->input('mail_host');
	   $mail_username = $request->input('mail_username');
	   $mail_encryption = $request->input('mail_encryption');
		         
         
		 $request->validate([
							'sender_name' => 'required',
							'sender_email' => 'required',
							'mail_driver' => 'required',
							'mail_port' => 'required',
							'mail_host' => 'required',
							
							
         ]);
		 
		  $sid = $request->input('sid');
		 
         
		 
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
		
			  
		 
		 
		$data = array('sender_name' => $sender_name, 'sender_email' => $sender_email, 'mail_driver' => $mail_driver, 'mail_host' => $mail_host, 'mail_port' => $mail_port, 'mail_username' => $mail_username, 'mail_password' => $mail_password, 'mail_encryption' => $mail_encryption);
 
            
            
			Settings::updatemailData($sid, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
      
	
	
	}
	
	
	
	public function social_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.social-settings', [ 'setting' => $setting, 'sid' => $sid]);
		
    }
	
	
	public function update_social_settings(Request $request)
	{
	    if(!empty($request->input('facebook_url')))
		{
	    $facebook = $request->input('facebook_url');
		}
		else
		{
		 $facebook = ""; 
		}
		
		if(!empty($request->input('twitter_url')))
		{
	    $twitter = $request->input('twitter_url');
		}
		else
		{
		$twitter = "";
		}
		
		if(!empty($request->input('gplus_url')))
		{
		$gplus = $request->input('gplus_url');
		}
		else
		{
		$gplus = "";
		}
		
		if(!empty($request->input('pinterest_url')))
		{
		$pinterest = $request->input('pinterest_url');
		}
		else
		{
		$pinterest = "";
		}
		
		if(!empty($request->input('instagram_url')))
		{
		$instagram = $request->input('instagram_url');
		}
		else
		{
		$instagram = "";
		}
		
		$facebook_client_id = $request->input('facebook_client_id');
		$facebook_client_secret = $request->input('facebook_client_secret');
		$facebook_callback_url = $request->input('facebook_callback_url');
		$google_client_id = $request->input('google_client_id');
		$google_client_secret = $request->input('google_client_secret');
		$google_callback_url = $request->input('google_callback_url');
		$display_social_login = $request->input('display_social_login');
		 
		$sid = $request->input('sid');
			 
		$data = array('facebook_url' => $facebook, 'twitter_url' => $twitter, 'gplus_url' => $gplus, 'pinterest_url' => $pinterest, 'instagram_url' => $instagram, 'facebook_client_id' => $facebook_client_id, 'facebook_client_secret' => $facebook_client_secret, 'facebook_callback_url' => $facebook_callback_url, 'google_client_id' => $google_client_id, 'google_client_secret' => $google_client_secret, 'google_callback_url' => $google_callback_url, 'display_social_login' => $display_social_login);
  		Settings::updatemailData($sid, $data);
        return redirect()->back()->with('success', 'Update successfully.');
       
	
		
	
	}
	
	
	
	public function preferred_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.preferred-settings', [ 'setting' => $setting, 'sid' => $sid]);
		
    }
	
	
	public function update_preferred_settings(Request $request)
	{
	
	     
		 $sid = $request->input('sid');
		 
		 
		 $site_blog_display = $request->input('site_blog_display');
		 $site_newsletter_display = $request->input('site_newsletter_display');
		
		 
         
		 $request->validate([
							
							
							
							'site_blog_display' => 'required',
							'site_newsletter_display' => 'required', 
							
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
		
		
		 
		$data = array('site_blog_display' => $site_blog_display, 'site_newsletter_display' => $site_newsletter_display);
        Settings::updategeneralData($sid, $data);
        return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	} 
	
	
	
	
	
	
	public function currency_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		return view('admin.currency-settings', [ 'setting' => $setting, 'sid' => $sid]);
		
    }
	
	
	
	public function update_currency_settings(Request $request)
	{
	
	     
		 $sid = $request->input('sid');
		 
		 $site_currency_code = $request->input('site_currency_code');
		 $site_currency_symbol = $request->input('site_currency_symbol');
		
		
		 
         
		 $request->validate([
							
							'site_currency_code' => 'required',
							'site_currency_symbol' => 'required',
							
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
		
		
		 
		$data = array('site_currency_code' => $site_currency_code, 'site_currency_symbol' => $site_currency_symbol);
        Settings::updategeneralData($sid, $data);
        return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	} 
	
	
	
	
	public function payment_settings()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$additional['setting'] = Settings::editAdditional();
		$payment_option = array('paypal','stripe','2checkout','authorize.net','paystack','localbank','cash-on-delivery','razorpay');
		$withdraw_option = array('paypal','stripe','localbank','paystack');
		$get_payment = explode(',', $setting['setting']->payment_option);
		$get_withdraw = explode(',', $setting['setting']->withdraw_option);
		return view('admin.payment-settings', [ 'setting' => $setting, 'sid' => $sid, 'payment_option' => $payment_option, 'withdraw_option' => $withdraw_option, 'get_payment' => $get_payment, 'get_withdraw' => $get_withdraw, 'additional' => $additional]);
		
    }
	
	
	public function update_payment_settings(Request $request)
	{
	
	   $site_admin_commission = $request->input('site_admin_commission');
	   
	   if(!empty($request->input('payment_option')))
	   {
	     $payment = "";
		 foreach($request->input('payment_option') as $payment_option)
		 {
		    $payment .= $payment_option.',';
		 }
		 $payment_method = rtrim($payment,',');
	   }
	   else
	   {
	   $payment_method = "";
	   }
	   
	   if(!empty($request->input('withdraw_option')))
	   {
	     $withdraw = "";
		 foreach($request->input('withdraw_option') as $withdraw_option)
		 {
		    $withdraw .= $withdraw_option.',';
		 }
		 $withdraw_method = rtrim($withdraw,',');
	   }
	   else
	   {
	   $withdraw_method = "";
	   }
	   $paypal_email = $request->input('paypal_email');
	   $paypal_mode = $request->input('paypal_mode');
	   $paypal_api_username = $request->input('paypal_api_username');
	   $paypal_api_password = $request->input('paypal_api_password');
	   $paypal_api_secret = $request->input('paypal_api_secret');
	   
	   $stripe_mode = $request->input('stripe_mode');
	   $test_publish_key = $request->input('test_publish_key');
	   $live_publish_key = $request->input('live_publish_key');
	   $test_secret_key = $request->input('test_secret_key');
	   $live_secret_key = $request->input('live_secret_key');
	   $site_minimum_withdrawal = $request->input('site_minimum_withdrawal');
	   if(!empty($request->input('site_processing_fee')))
	   {
	   $site_processing_fee = $request->input('site_processing_fee');
	   }
	   else
	   {
	   $site_processing_fee = 0;
	   }
	   $site_refund_time = $request->input('site_refund_time');
	   $site_referral_commission = $request->input('site_referral_commission');
	   $mollie_api_key = $request->input('mollie_api_key');
	   $two_checkout_mode = $request->input('two_checkout_mode');
	   $two_checkout_account = $request->input('two_checkout_account');
	   $two_checkout_publishable = $request->input('two_checkout_publishable');
	   $two_checkout_private = $request->input('two_checkout_private');
	   $authorize_mode = $request->input('authorize_mode');
	   $authorize_login_id = $request->input('authorize_login_id');
	   $authorize_trans_key = $request->input('authorize_trans_key');
	   $paystack_public_key = $request->input('paystack_public_key');
	   $paystack_secret_key = $request->input('paystack_secret_key');
	   $paystack_merchant_email = $request->input('paystack_merchant_email');
	   $local_bank_details = $request->input('local_bank_details');
	   
	   $razorpay_key = $request->input('razorpay_key');
	   $razorpay_secret = $request->input('razorpay_secret');
	   $request->validate([
							'site_admin_commission' => 'required',
							
							
							
         ]);
		 
		  $sid = $request->input('sid');
		 
         
		 
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
		
			  
		 
		 
		$data = array('site_admin_commission' => $site_admin_commission, 'payment_option' => $payment_method, 'withdraw_option' => $withdraw_method, 'paypal_email' => $paypal_email, 'paypal_mode' => $paypal_mode, 'stripe_mode' => $stripe_mode, 'test_publish_key' => $test_publish_key, 'test_secret_key' => $test_secret_key, 'live_publish_key' => $live_publish_key, 'live_secret_key' => $live_secret_key, 'site_minimum_withdrawal' => $site_minimum_withdrawal, 'site_processing_fee' => $site_processing_fee, 'site_refund_time' => $site_refund_time, 'site_referral_commission' => $site_referral_commission, 'mollie_api_key' => $mollie_api_key, 'two_checkout_mode' => $two_checkout_mode, 'two_checkout_account' => $two_checkout_account, 'two_checkout_publishable' => $two_checkout_publishable, 'two_checkout_private' => $two_checkout_private, 'authorize_mode' => $authorize_mode, 'authorize_login_id' => $authorize_login_id, 'authorize_trans_key' => $authorize_trans_key, 'paystack_public_key' => $paystack_public_key, 'paystack_secret_key' => $paystack_secret_key, 'paystack_merchant_email' => $paystack_merchant_email, 'local_bank_details' => $local_bank_details, 'paypal_api_username' => $paypal_api_username, 'paypal_api_password' => $paypal_api_password, 'paypal_api_secret' => $paypal_api_secret);
 
            
            
			Settings::updatemailData($sid, $data);
			
			$addition_data = array('razorpay_key' => $razorpay_key, 'razorpay_secret' => $razorpay_secret);
			Settings::updateAdditionData($addition_data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	   
		     
	}
	
	
	
	
	/* settings */
	
	
	
	/* country settings */
  
  
  public function country_settings()
    {
        
		
		$country['data'] = Settings::getcountryData();
		return view('admin.country-settings',[ 'country' => $country]);
    }
	
	
	public function add_country()
	{
	   
	   return view('admin.add-country');
	}
	
	
	public function save_country(Request $request)
	{
 
    
         $country_name = $request->input('country_name');
		         
         
		 $request->validate([
							'country_name' => 'required',
							
							
         ]);
		 $rules = array(
				
				'country_name' => ['required', 'max:255', Rule::unique('country') -> where(function($sql){ $sql->where('country_name','!=','');})],
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
		
				 
		$data = array('country_name' => $country_name);
 
            
            Settings::savecountryData($data);
            return redirect('/admin/country-settings')->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  
  
  
  public function delete_country($cid){

      
	  
      Settings::deleteCountrydata($cid);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_country($cid)
	{
	   
	   $edit['country'] = Settings::editCountry($cid);
	   return view('admin.edit-country', [ 'edit' => $edit, 'cid' => $cid]);
	}
	
	
	
	public function update_country(Request $request)
	{
	
	   $country_name = $request->input('country_name');
		         
         
		 $request->validate([
							'country_name' => 'required',
							
							
         ]);
		 
		  $cid = $request->input('cid');
		 
         
		 
		 $rules = array(
				'country_name' => ['required', 'max:255', Rule::unique('country') ->ignore($cid, 'country_id') -> where(function($sql){ $sql->where('country_name','!=','');})],
				
				
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
		
			  
		 
		 
		$data = array('country_name' => $country_name);
 
            
            
			Settings::updatecountryData($cid, $data);
            return redirect('/admin/country-settings')->with('success', 'Update successfully.');
            
 
       } 
     
      
	
	
	}
	
	
	
	
  /* country settings */	
  
  
	
	
	
}
