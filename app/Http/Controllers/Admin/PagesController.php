<?php

namespace ZigKart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Session;
use ZigKart\Models\Pages;
use ZigKart\Models\Settings;
use ZigKart\Models\Languages;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Purifier;


class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	public function features()
    {
        
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		$featureData['view'] = Pages::getfeatureData();
		return view('admin.features',[ 'featureData' => $featureData, 'setting' => $setting]);
    }
	
	public function pages()
    {
        
		
		$pageData['pages'] = Pages::getpageData();
		return view('admin.pages',[ 'pageData' => $pageData]);
    }
    
	
	public function add_page()
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   return view('admin.add-page',[ 'language' => $language, 'languages' => $languages]);
	}
	
	
	public function page_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	
	
	/*public function save_page(Request $request)
	{
 
    
         $page_title = $request->input('page_title');
		 $page_desc = Purifier::clean($request->input('page_desc'));
         $page_slug = $this->page_slug($page_title);
		 $page_status = $request->input('page_status');
		 $footer_menu = $request->input('footer_menu');
		 $main_menu = $request->input('main_menu');
		
		 if($request->input('menu_order'))
		 {
		    $menu_order = $request->input('menu_order');
		 }
		 else
		 {
		   $menu_order = 0;
		 }
		
		 
		 
         
		 $request->validate([
							'page_title' => 'required',
							'page_desc' => 'required',
							'page_status' => 'required',
							
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
		
		
		 
		$data = array('page_title' => $page_title, 'page_desc' => $page_desc, 'page_slug' => $page_slug, 'page_status' => $page_status, 'menu_order' => $menu_order, 'footer_menu' => $footer_menu, 'main_menu' => $main_menu);
        Pages::insertpageData($data);
        return redirect()->back()->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }*/
  
  
  public function save_page(Request $request)
	{
            
		 $data = $request->all();
		 $this->validate($request, [

        	]);
        $input['page_title'] = $data['page_title'];
		$rules = array();
		$messages = array();
		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
		        
                $page_title=$data['page_title'];
				if(!empty($data['page_desc']))
				{
				   $page_desc = $data['page_desc'];
				}
				else
				{
				   $page_desc = "";
				}
				if(!empty($data['main_menu']))
				{
				   $main_menu = $data['main_menu'];
				}
				else
				{
				  $main_menu = 0;
				}
				if(!empty($data['footer_menu']))
				{
				   $footer_menu = $data['footer_menu'];
				}
				else
				{
				  $footer_menu = 0;
				}
		        $page_slug = $this->page_slug($data['page_slug']);
		        $token = $data['token'];
				foreach($data['language_code'] as $index => $code)
				{
				
				   $page_heading = $page_title[$index];
				   $page_description = $page_desc[$index];
				   
				
					if($code=='en')
					   {
						   $parent=0;
					   }
					   else
					   {
						  
						   $pager = Pages::pageViews($token);
						   $check_page = Pages::pageGet($token);
						   if($check_page==0)
						   {
							$parent = $insertedId;				
						   }
						   else
						   {
							$parent=$pager[0]->page_id;
						   }
					   
					  }
				    $menu_order = $data['menu_order'];
		            $page_status = $data['page_status'];
					$record = array('page_title' => $page_heading, 'page_desc' => htmlentities($page_description), 'page_slug' => $page_slug, 'page_status' => $page_status, 'main_menu' => $main_menu, 'menu_order' => $menu_order, 'footer_menu' => $footer_menu, 'token' => $token, 'language_code' => $code, 'page_parent' => $parent);
		            $insertedId = Pages::getLastInsertedId($record);
		      }
			  return redirect()->back()->with('success', 'Insert successfully.');
		}
			
		
     
    
  }
  
  
  
  
  public function delete_pages($page_id){

      
	  
      Pages::deletePagedata($page_id);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_page($page_id)
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $edit['page'] = Pages::editadminPage($page_id);
	   return view('admin.edit-page', [ 'edit' => $edit, 'page_id' => $page_id, 'language' => $language, 'languages' => $languages]);
	}
	
	
	public function edit_features($feature_id)
	{
	   
	   $edit['feature'] = Pages::editfeatureData($feature_id);
	   return view('admin.edit-features', [ 'edit' => $edit, 'feature_id' => $feature_id]);
	}
	
	
	public function update_features(Request $request)
	{
	
	   
		 $feature_title = $request->input('feature_title');
		 $image_size = $request->input('image_size');
		 $feature_id = $request->input('feature_id');
		 $save_feature_image = $request->input('save_feature_image');
		 $feature_desc = $request->input('feature_desc');
		 if(!empty($request->input('feature_link')))
		 {
		 $feature_link = $request->input('feature_link');
		 }
		 else
		 {
		 $feature_link = "";
		 }
		 $feature_color = $request->input('feature_color');
		 
		 
         
		 $request->validate([
		                    'feature_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'feature_title' => 'required',
							'feature_desc' => 'required',
							'feature_color' => 'required',
							
							
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
		
		   if ($request->hasFile('feature_image')) 
		   {
		    Pages::dropFeatures($feature_id);
			$image = $request->file('feature_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/features');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$feature_image = $img_name;
		  }
		  else
		  {
		     $feature_image = $save_feature_image;
		  }
		 
		$data = array('feature_title' => $feature_title, 'feature_desc' => $feature_desc, 'feature_image' => $feature_image, 'feature_link' => $feature_link, 'feature_color' => $feature_color);
        Pages::updatefeatureData($feature_id,$data);
        return redirect('/admin/features')->with('success', 'Update successfully.');
            
 
       } 
      
     
       
	
	
	}
	
	
	
	
	
	
	public function upedit_features(Request $request)
	{
	
	   
		 $site_features_display = $request->input('site_features_display');
		 
		 $sid = $request->input('sid');
		 
		 
         
		 $request->validate([
		                    
							'site_features_display' => 'required',
							
							
							
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
		
		   
		 
		$data = array('site_features_display' => $site_features_display);
        Settings::updatemailData($sid, $data);
        return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
      
     
       
	
	
	}
	
	
	
	
	/*public function update_page(Request $request)
	{
	
	   $page_title = $request->input('page_title');
		 $page_desc = Purifier::clean($request->input('page_desc'));
         $page_slug = $this->page_slug($page_title);
		 $page_status = $request->input('page_status');
		 
		 $page_id = $request->input('page_id');
		 $footer_menu = $request->input('footer_menu');
		 $main_menu = $request->input('main_menu');
		 
		 if($request->input('menu_order'))
		 {
		    $menu_order = $request->input('menu_order');
		 }
		 else
		 {
		   $menu_order = 0;
		 }
		 
         
		 $request->validate([
							'page_title' => 'required',
							'page_desc' => 'required',
							'page_status' => 'required',
							
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
		
		
		$data = array('page_title' => $page_title, 'page_desc' => $page_desc, 'page_slug' => $page_slug, 'page_status' => $page_status, 'menu_order' => $menu_order, 'footer_menu' => $footer_menu, 'main_menu' => $main_menu);
        Pages::updatepageData($page_id, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}*/
	
	
	public function update_page(Request $request)
	{
	
	   $this->validate($request, []);
       $data = $request->all();
	   $input['page_title'] = $data['page_title'];
	   $rules = array();
	   $messages = array();
	   $validator = Validator::make($request->all(), $rules, $messages);
	   if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
			$page_title=$data['page_title'];
			if(!empty($data['page_desc']))
			{
			   $page_desc = $data['page_desc'];
			}
			else
			{
			   $page_desc = "";
			}
		    $page_id=$data['page_id'];
			$page_status = $data['page_status'];
			$menu_order = $data['menu_order'];
			if(!empty($data['main_menu']))
			{
				   $main_menu = $data['main_menu'];
			}
			else
			{
				  $main_menu = 0;
			}
			if(!empty($data['footer_menu']))
			{
				   $footer_menu = $data['footer_menu'];
			}
			else
			{
				  $footer_menu = 0;
			}
		    $page_slug = $this->page_slug($data['page_slug']);
		$token = $data['token'];
		foreach($data['language_code'] as $index => $code)
		{
		
		   $page_heading = $page_title[$index];
		   $page_description = $page_desc[$index];		
		   	
		   if($code=="en")
			{
			  $data = array('page_title' => $page_heading, 'page_desc' => htmlentities($page_description), 'page_slug' => $page_slug, 'page_status' => $page_status, 'main_menu' => $main_menu, 'menu_order' => $menu_order, 'footer_menu' => $footer_menu, 'language_code' => $code);
			  Pages::updatePage($page_id,$data);
			}
			else
			{
			    $counts = Pages::pageCount($code,$page_id);
			    if($counts==0)
				 {
						if(!empty($page_heading))
						{
						   $pagetitle = $page_heading;
						   $pagedesc = $page_description;
						}
						else
						{
						   $pagetitle = "";
						   $pagedesc = "";
						}
					 $save = array('page_title' => $pagetitle, 'page_desc' => htmlentities($pagedesc), 'page_slug' => $page_slug, 'main_menu' => $main_menu, 'menu_order' => $menu_order, 'footer_menu' => $footer_menu, 'language_code' => $code, 'token' => $token, 'page_parent' => $page_id, 'page_status' => $page_status);	
				     Pages::insertpageData($save);
					 					 
				 }
				 else
				 {
				   $updata = array('page_title' => $page_heading, 'page_desc' => htmlentities($page_description), 'page_slug' => $page_slug, 'page_status' => $page_status, 'main_menu' => $main_menu, 'menu_order' => $menu_order, 'footer_menu' => $footer_menu);
				  Pages::anotherPage($page_id,$code,$updata); 
				  
				 }
			
			}
		}
		
		
		return redirect()->back()->with('success', 'Update successfully.');
        
		
		
		}
		
	
	}
	
  
	
	
	
}
