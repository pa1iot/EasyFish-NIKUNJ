<?php

namespace ZigKart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Session;
use ZigKart\Models\Slideshow;
use ZigKart\Models\Languages;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class SlideshowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	
	public function slideshow()
    {
      	$slideData['slide'] = Slideshow::getslideData();
		return view('admin.slideshow',[ 'slideData' => $slideData]);
    }
    
	
	public function add_slideshow()
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   return view('admin.add-slideshow',[ 'language' => $language, 'languages' => $languages]);
	}
	
	
	public function page_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	public function save_slideshow(Request $request)
	{
         $data = $request->all();   
		 $image_size = $data['image_size'];
		 $this->validate($request, [
		 
		   'slide_image' => 'required|mimes:jpeg,jpg,png|max:'.$image_size

        	]);
        $input['slide_title'] = $data['slide_title'];
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
		        
				if ($request->hasFile('slide_image')) 
				   {
				   
					$image = $request->file('slide_image');
					$img_name = time() . '.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/storage/slideshow');
					$imagePath = $destinationPath. "/".  $img_name;
					$image->move($destinationPath, $img_name);
					$slide_image = $img_name;
				  }
				  else
				  {
					 $slide_image = "";
				  }
				if(!empty($data['slide_title']))
				{  
                $slide_title=$data['slide_title'];
				}
				else
				{
				$slide_title = "";
				}
				if(!empty($data['slide_desc']))
				{
				   $slide_desc = $data['slide_desc'];
				}
				else
				{
				   $slide_desc = "";
				}
				if(!empty($data['slide_btn_text']))
				{
				   $slide_btn_text = $data['slide_btn_text'];
				}
				else
				{
				   $slide_btn_text = "";
				}
				if(!empty($data['slide_order']))
				 {
				 $slide_order = $data['slide_order'];
				 }
				 else
				 {
				 $slide_order = 0;
				 }
				 $slide_btn_link = $request->input('slide_btn_link');
		         $slide_text_position = $request->input('slide_text_position');
				 $slide_status = $data['slide_status'];
				 $token = $data['token'];
				 foreach($data['language_code'] as $index => $code)
				 {
				
				   $slide_heading = $slide_title[$index];
				   $slide_subtitle = $slide_desc[$index];
				   $slide_button_text = $slide_btn_text[$index];
				   
				
					if($code=='en')
					   {
						   $parent=0;
					   }
					   else
					   {
						  
						   $pager = Slideshow::slideViews($token);
						   $check_page = Slideshow::slideGet($token);
						   if($check_page==0)
						   {
							$parent = $insertedId;				
						   }
						   else
						   {
							$parent=$pager[0]->slide_id;
						   }
					   
					  }
				    
					
					
					$record = array('slide_image' => $slide_image, 'slide_order' => $slide_order, 'slide_status' => $slide_status, 'slide_title' => $slide_heading, 'slide_desc' => $slide_subtitle, 'slide_btn_text' => $slide_button_text	, 'slide_btn_link' => $slide_btn_link, 'slide_text_position' => $slide_text_position, 'token' => $token, 'language_code' => $code, 'slide_page_parent' => $parent);
		            $insertedId = Slideshow::getLastInsertedId($record);
		      }
			  return redirect()->back()->with('success', 'Insert successfully.');
		}
			
		
     
    
  }
	
	/*public function save_slideshow(Request $request)
	{
 
         if(!empty($request->input('slide_order')))
		 {
         $slide_order = $request->input('slide_order');
		 }
		 else
		 {
		 $slide_order = 0;
		 }
		 $slide_status = $request->input('slide_status');
		 $image_size = $request->input('image_size');
		 $slide_title = $request->input('slide_title');
		 $slide_desc = $request->input('slide_desc');
		 $slide_btn_text = $request->input('slide_btn_text');
		 $slide_btn_link = $request->input('slide_btn_link');
		 $slide_text_position = $request->input('slide_text_position');
		 
         
		 $request->validate([
		                    'slide_image' => 'required|mimes:jpeg,jpg,png|max:'.$image_size,
							'slide_status' => 'required',
							
							
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
		
		   if ($request->hasFile('slide_image')) 
		   {
		   
			$image = $request->file('slide_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/slideshow');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$slide_image = $img_name;
		  }
		  else
		  {
		     $slide_image = "";
		  }
		 
		$data = array('slide_image' => $slide_image, 'slide_order' => $slide_order, 'slide_status' => $slide_status, 'slide_title' => $slide_title, 'slide_desc' => $slide_desc, 'slide_btn_text' => $slide_btn_text	, 'slide_btn_link' => $slide_btn_link, 'slide_text_position' => $slide_text_position);
        Slideshow::insertslideData($data);
        return redirect()->back()->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }*/
  
  
  
  public function delete_slideshow($slide_id){

      
	  
      Slideshow::deleteSlidedata($slide_id);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_slideshow($slide_id)
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $edit['slide'] = Slideshow::editslideData($slide_id);
	   return view('admin.edit-slideshow', [ 'edit' => $edit, 'slide_id' => $slide_id, 'language' => $language, 'languages' => $languages]);
	}
	
	
	
	/*public function update_slideshow(Request $request)
	{
	
	   if(!empty($request->input('slide_order')))
		 {
         $slide_order = $request->input('slide_order');
		 }
		 else
		 {
		 $slide_order = 0;
		 }
		 $slide_status = $request->input('slide_status');
		 $image_size = $request->input('image_size');
		 $slide_id = $request->input('slide_id');
		 $slide_title = $request->input('slide_title');
		 $slide_desc = $request->input('slide_desc');
		 $slide_btn_text = $request->input('slide_btn_text');
		 $slide_btn_link = $request->input('slide_btn_link');
		 $slide_text_position = $request->input('slide_text_position');
		 		 
         
		 $request->validate([
		                    'slide_image' => 'mimes:jpeg,jpg,png|max:'.$image_size,
							'slide_status' => 'required',
							
							
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
		
		   if ($request->hasFile('slide_image')) 
		   {
		    Slideshow::dropSlide($slide_id);
			$image = $request->file('slide_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/slideshow');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$slide_image = $img_name;
		  }
		  else
		  {
		     $slide_image = $request->input('save_slide_image');
		  }
		 
		$data = array('slide_image' => $slide_image, 'slide_order' => $slide_order, 'slide_status' => $slide_status, 'slide_title' => $slide_title, 'slide_desc' => $slide_desc, 'slide_btn_text' => $slide_btn_text	, 'slide_btn_link' => $slide_btn_link, 'slide_text_position' => $slide_text_position);
        Slideshow::updateslideData($slide_id,$data);
        return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
      
     
       
	
	
	}*/
	
	
	public function update_slideshow(Request $request)
	{
	   $data = $request->all();
	   $image_size = $data['image_size'];
	   $this->validate($request, [
	   
	   'slide_image' => 'mimes:jpeg,jpg,png|max:'.$image_size
	   
	   ]);
       
	   $input['slide_title'] = $data['slide_title'];
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
		    if(!empty($data['slide_title']))
			{
			$slide_title=$data['slide_title'];
			}
			else
			{
			$slide_title = "";
			}
			if(!empty($data['slide_desc']))
			{
			   $slide_desc = $data['slide_desc'];
			}
			else
			{
			   $slide_desc = "";
			}
			if(!empty($data['slide_btn_text']))
			{
			   $slide_btn_text = $data['slide_btn_text'];
			}
			else
			{
			   $slide_btn_text = "";
			}
		    $slide_id=$data['slide_id'];
			if(!empty($data['slide_order']))
			 {
			 $slide_order = $data['slide_order'];
			 }
			 else
			 {
			 $slide_order = 0;
			 }
		     $slide_status = $data['slide_status'];
		  $slide_btn_link = $request->input('slide_btn_link');
		  $slide_text_position = $request->input('slide_text_position');
		    if ($request->hasFile('slide_image')) 
		   {
		    Slideshow::dropSlide($slide_id);
			$image = $request->file('slide_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/slideshow');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$slide_image = $img_name;
		  }
		  else
		  {
		     $slide_image = $request->input('save_slide_image');
		  }
		 $token = $data['token'];
		foreach($data['language_code'] as $index => $code)
		{
		
		   $slide_heading = $slide_title[$index];
		   $slide_subtitle = $slide_desc[$index];
		   $slide_button_text = $slide_btn_text[$index];		
		   	
		   if($code=="en")
			{
			  
			  
			  
			  $data = array('slide_image' => $slide_image, 'slide_order' => $slide_order, 'slide_status' => $slide_status, 'slide_title' => $slide_heading, 'slide_desc' => $slide_subtitle, 'slide_btn_text' => $slide_button_text, 'slide_btn_link' => $slide_btn_link, 'slide_text_position' => $slide_text_position, 'language_code' => $code);
			  Slideshow::updateslideData($slide_id,$data);
			}
			else
			{
			    $counts = Slideshow::slideCount($code,$slide_id);
			    if($counts==0)
				 {
						if(!empty($slide_heading))
						{
						   $slideheading = $slide_heading;
						   $slidedesc = $slide_subtitle;
						   $slidebuttontext = $slide_button_text;
						}
						else
						{
						   $slideheading = "";
						   $slidedesc = "";
						   $slidebuttontext = "";
						}
					$save = array('slide_image' => $slide_image, 'slide_order' => $slide_order, 'slide_status' => $slide_status, 'slide_title' => $slideheading, 'slide_desc' => $slidedesc, 'slide_btn_text' => $slidebuttontext, 'slide_btn_link' => $slide_btn_link, 'slide_text_position' => $slide_text_position, 'language_code' => $code, 'token' => $token, 'slide_page_parent' => $slide_id);
					 Slideshow::insertslideData($save);
					 					 
				 }
				 else
				 {
				   $updata = array('slide_image' => $slide_image, 'slide_order' => $slide_order, 'slide_status' => $slide_status, 'slide_title' => $slide_heading, 'slide_desc' => $slide_subtitle, 'slide_btn_text' => $slide_button_text, 'slide_btn_link' => $slide_btn_link, 'slide_text_position' => $slide_text_position);
				   
				  Slideshow::anotherPage($slide_id,$code,$updata); 
				  
				 }
			
			}
		}
		
		
		return redirect()->back()->with('success', 'Update successfully.');
        
		
		
		}
		
	
	}
	
	
  
	
	
	
}
