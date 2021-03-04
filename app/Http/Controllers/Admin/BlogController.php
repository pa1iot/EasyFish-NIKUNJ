<?php

namespace ZigKart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Session;
use ZigKart\Models\Blog;
use ZigKart\Models\Category;
use ZigKart\Models\Languages;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Purifier;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	/* category */
	
	public function blog_category()
    {
        
		
		$categoryData['category'] = Blog::getblogcategoryData();
		return view('admin.blog-category',[ 'categoryData' => $categoryData]);
    }
    
	
	public function add_blog_category()
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   return view('admin.add-blog-category',[ 'language' => $language, 'languages' => $languages]);
	}
	
	
	public function category_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	public function save_blog_category(Request $request)
	{
            
		 $data = $request->all();
		 $this->validate($request, [

        	]);
        $input['blog_category_name'] = $data['blog_category_name'];
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
		        
                if(!empty($data['blog_category_name']))
				{
				   $blog_category_name = $data['blog_category_name'];
				}
				else
				{
				   $blog_category_name = "";
				}
				
		        $blog_category_slug = $this->category_slug($data['blog_category_slug']);
				$blog_category_status = $request->input('blog_category_status');
		        $token = $data['token'];
				foreach($data['language_code'] as $index => $code)
				{
				
				   $blogcategoryname = $blog_category_name[$index];
				   
				   
				
					if($code=='en')
					   {
						   $parent=0;
					   }
					   else
					   {
						  
						   $pager = Blog::blogViews($token);
						   $check_page = Blog::blogGet($token);
						   if($check_page==0)
						   {
							$parent = $insertedId;				
						   }
						   else
						   {
							$parent=$pager[0]->blog_cat_id;
						   }
					   
					  }
				    
					 $record = array('blog_category_name' => $blogcategoryname, 'blog_category_slug' => $blog_category_slug, 'blog_category_status' => $blog_category_status, 'token' => $token, 'language_code' => $code, 'blog_page_parent' => $parent);
		            $insertedId = Blog::getLastInsertedId($record);
		      }
			  return redirect('/admin/blog-category')->with('success', 'Insert successfully.');
		}
			
		
     
    
  }
  
  
	
	/*public function save_blog_category(Request $request)
	{
 
    
         $blog_category_name = $request->input('blog_category_name');
		 $blog_category_slug = $this->category_slug($blog_category_name);
		 $blog_category_status = $request->input('blog_category_status');
		 
		 
		 
		 
         
		 $request->validate([
							'blog_category_name' => 'required',
							'blog_category_status' => 'required',
							
         ]);
		 $rules = array(
				'blog_category_name' => ['required', 'max:255', Rule::unique('blog_category') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		
		 
		$data = array('blog_category_name' => $blog_category_name, 'blog_category_slug' => $blog_category_slug, 'blog_category_status' => $blog_category_status);
        Blog::saveblogcategoryData($data);
            return redirect('/admin/blog-category')->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }*/
  
  
  
  public function delete_blog_category($blog_cat_id){

      $data = array('drop_status'=>'yes');
	  
        
      Blog::deleteBlogcategorydata($blog_cat_id,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_blog_category($blog_cat_id)
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $edit['category'] = Blog::editblogcategoryData($blog_cat_id);
	   return view('admin.edit-blog-category', [ 'edit' => $edit, 'blog_cat_id' => $blog_cat_id, 'language' => $language, 'languages' => $languages]);
	}
	
	public function update_blog_category(Request $request)
	{
	
	    
		 
		 
	   $this->validate($request, []);
       $data = $request->all();
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
			
			if(!empty($data['blog_category_name']))
			{
			   $blog_category_name = $data['blog_category_name'];
			}
			else
			{
			   $blog_category_name = "";
			}
		    $blog_category_status = $request->input('blog_category_status');
			$blog_category_slug = $this->category_slug($data['blog_category_slug']);
			$blog_cat_id = $request->input('blog_cat_id');
		$token = $data['token'];
		foreach($data['language_code'] as $index => $code)
		{
		
		   $blogcategoryname = $blog_category_name[$index];
		   	
		   	
		   if($code=="en")
			{
			  $data = array('blog_category_name' => $blogcategoryname,  'blog_category_slug' => $blog_category_slug, 'blog_category_status' => $blog_category_status,  'language_code' => $code);
			  Blog::updatecatBlogData($blog_cat_id, $data);
			}
			else
			{
			    $counts = Blog::blogCount($code,$blog_cat_id);
			    if($counts==0)
				 {
						if(!empty($blogcategoryname))
						{
						   $blog_name = $blogcategoryname;
						   
						}
						else
						{
						   $blog_name = "";
						   
						}
					 $save = array('blog_category_name' => $blog_name,  'blog_category_slug' => $blog_category_slug, 'blog_category_status' => $blog_category_status, 'language_code' => $code, 'token' => $token, 'blog_page_parent' => $blog_cat_id);	
				     Blog::insertblogData($save);
					 					 
				 }
				 else
				 {
				   $updata = array('blog_category_name' => $blogcategoryname,  'blog_category_slug' => $blog_category_slug, 'blog_category_status' => $blog_category_status);
				  Blog::anotherBlog($blog_cat_id,$code,$updata); 
				  
				 }
			
			}
		}
		
		return redirect('/admin/blog-category')->with('success', 'Update successfully.');
		
        
		
		
		}
		
	
	}
	
	
	/*
	public function update_blog_category(Request $request)
	{
	
	    $blog_category_name = $request->input('blog_category_name');
		 $blog_category_slug = $this->category_slug($blog_category_name);
		 $blog_category_status = $request->input('blog_category_status');
		 
		 
         $blog_cat_id = $request->input('blog_cat_id');
		 $request->validate([
							'blog_category_name' => 'required',
							'blog_category_status' => 'required',
							
         ]);
		 $rules = array(
				'blog_category_name' => ['required', 'max:255', Rule::unique('blog_category') ->ignore($blog_cat_id, 'blog_cat_id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		
		$data = array('blog_category_name' => $blog_category_name, 'blog_category_slug' => $blog_category_slug, 'blog_category_status' => $blog_category_status);
		Blog::updatecatBlogData($blog_cat_id, $data);
            return redirect('/admin/blog-category')->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}*/
	
	
	/* category */
	
	
	/* comments */
	
	
	public function comments($post_id)
	{
	  $commentData['post'] = Blog::getcommentData($post_id);
	  return view('admin.comment',[ 'commentData' => $commentData]);
	}
	
	
	public function delete_comment($delete,$comment_id){

      
	  
      Blog::deleteCommentdata($comment_id);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  public function comment_status($status,$comment_id)
  {
     if($status == 0)
	 {
	   $status_value = 1;
	 }
	 else
	 {
	   $status_value = 0;
	 }
	 
	 $data = array( 'comment_status' => $status_value);
	 
	 Blog::updatecommentData($comment_id, $data);
     return redirect()->back()->with('success', 'Update successfully.');
  
  }
  
  
	/* comments */
	
	
	
	/* posts */
	
	
	public function posts()
    {
        
		
		$postData['post'] = Blog::getpostData();
		$comments = Blog::getcountcommentData();
		return view('admin.post',[ 'postData' => $postData, 'comments' => $comments]);
    }
	

	public function add_post()
	{
	   
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $catData['view'] = Blog::getpostcategoryData();
		return view('admin.add-post',[ 'catData' => $catData, 'language' => $language, 'languages' => $languages]);
	}
	
	
	public function post_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	public function save_post(Request $request)
	{
            
		 
		 $this->validate($request, [
		 
		     'post_image' => 'mimes:jpeg,jpg,png|max:1000'

        	]);
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
		        $data = $request->all();
                if(!empty($data['post_title']))
				{
				   $post_title = $data['post_title'];
				}
				else
				{
				   $post_title = "";
				}
				if(!empty($data['post_short_desc']))
				{
				   $post_short_desc = $data['post_short_desc'];
				}
				else
				{
				  $post_short_desc = "";
				}
				if(!empty($data['post_desc']))
				{
				   $post_desc = Purifier::clean($data['post_desc']);
				}
				else
				{
				  $post_desc = "";
				}
		        $post_slug = $this->post_slug($data['post_slug']);
				$post_status = $request->input('post_status');
				 $blog_cat_id = $request->input('blog_cat_id');
				 $post_tags = $request->input('post_tags');
				 $post_media_type = $request->input('post_media_type');
				 $post_video = $request->input('post_video');
		        $token = $data['token'];
				$post_date = date('Y-m-d');
				   if ($request->hasFile('post_image')) {
					 
						   
					$image = $request->file('post_image');
					$img_name = time() . '.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/storage/post');
					$imagePath = $destinationPath. "/".  $img_name;
					$image->move($destinationPath, $img_name);
					$post_image = $img_name;
				  }
				  else
				  {
					 $post_image = "";
				  }
				foreach($data['language_code'] as $index => $code)
				{
				
				   $post_heading = $post_title[$index];
				   $post_short_description = $post_short_desc[$index];
				   $post_description = $post_desc[$index];
				   
				
					if($code=='en')
					   {
						   $parent=0;
					   }
					   else
					   {
						  
						   $pager = Blog::blogCates($token);
						   $check_page = Blog::blogGetry($token);
						   if($check_page==0)
						   {
							$parent = $insertedId;				
						   }
						   else
						   {
							$parent=$pager[0]->post_id;
						   }
					   
					  }
				    
					$record = array('post_title' => $post_heading, 'post_slug' => $post_slug, 'post_short_desc' => $post_short_description, 'post_image' => $post_image, 'post_desc' => htmlentities($post_description), 'post_date' => $post_date, 'post_status' => $post_status, 'blog_cat_id' => $blog_cat_id, 'post_tags' => $post_tags, 'post_media_type' => $post_media_type, 'post_video' => $post_video, 'token' => $token, 'language_code' => $code, 'post_page_parent' => $parent);
					
					$insertedId = Blog::getLastPostId($record);
		      }
			  
			  return redirect('/admin/post')->with('success', 'Insert successfully.');
		
		}
			
		
     
    
  }
  
	
	/*
	public function save_post(Request $request)
	{
 
    
         $post_title = $request->input('post_title');
		 $post_short_desc = $request->input('post_short_desc');
		 $post_desc = Purifier::clean($request->input('post_desc'));
         $post_slug = $this->post_slug($post_title);
		 $post_status = $request->input('post_status');
		 $blog_cat_id = $request->input('blog_cat_id');
		 $post_tags = $request->input('post_tags');
		 $post_media_type = $request->input('post_media_type');
		 $post_video = $request->input('post_video');
		
		 
		 
         
		 $request->validate([
							'post_title' => 'required',
							'post_short_desc' => 'required',
							'post_desc' => 'required',
							'post_image' => 'mimes:jpeg,jpg,png|max:1000',
							'post_status' => 'required',
							'blog_cat_id' => 'required',
							
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
		
		$post_date = date('Y-m-d');
		
		if ($request->hasFile('post_image')) {
		     
				   
			$image = $request->file('post_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/post');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$post_image = $img_name;
		  }
		  else
		  {
		     $post_image = "";
		  }
		 
		$data = array('post_title' => $post_title, 'post_slug' => $post_slug, 'post_short_desc' => $post_short_desc, 'post_image' => $post_image, 'post_desc' => $post_desc, 'post_date' => $post_date, 'post_status' => $post_status, 'blog_cat_id' => $blog_cat_id, 'post_tags' => $post_tags, 'post_media_type' => $post_media_type, 'post_video' => $post_video);
        Blog::insertpostData($data);
        return redirect('/admin/post')->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }*/
  
	
	
	public function delete_post($post_id){

      
	  
      Blog::deletePostdata($post_id);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_post($post_id)
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $edit['post'] = Blog::editpostData($post_id);
	   $catData['view'] = Blog::getpostcategoryData();
	   return view('admin.edit-post', [ 'edit' => $edit, 'post_id' => $post_id, 'catData' => $catData, 'language' => $language, 'languages' => $languages]);
	}
	
	
	public function update_post(Request $request)
	{
	
	   $this->validate($request, [
	   'post_image' => 'mimes:jpeg,jpg,png|max:1000',
	   ]);
       $data = $request->all();
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
			if(!empty($data['post_title']))
				{
				   $post_title = $data['post_title'];
				}
				else
				{
				   $post_title = "";
				}
				if(!empty($data['post_short_desc']))
				{
				   $post_short_desc = $data['post_short_desc'];
				}
				else
				{
				  $post_short_desc = "";
				}
				if(!empty($data['post_desc']))
				{
				   $post_desc = Purifier::clean($data['post_desc']);
				}
				else
				{
				  $post_desc = "";
				}
		        $post_slug = $this->post_slug($data['post_slug']);
				$post_status = $request->input('post_status');
				 $blog_cat_id = $request->input('blog_cat_id');
				 $post_tags = $request->input('post_tags');
				 $post_media_type = $request->input('post_media_type');
				 $post_video = $request->input('post_video');
		    $save_post_image = $request->input('save_post_image');
			$post_id = $request->input('post_id');
			if ($request->hasFile('post_image')) 
		   {
		     
			Blog::dropBlogimage($post_id);	   
			$image = $request->file('post_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/post');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$post_image = $img_name;
		  }
		  else
		  {
		     $post_image = $save_post_image;
		  }
		  $post_date = date('Y-m-d');
		$token = $data['token'];
		foreach($data['language_code'] as $index => $code)
		{
		
		   $post_heading = $post_title[$index];
		   $post_short_description = $post_short_desc[$index];
		   $post_description = $post_desc[$index];		
		   	
		   if($code=="en")
			{
			  $data = array('post_title' => $post_heading, 'post_slug' => $post_slug, 'post_short_desc' => $post_short_description, 'post_image' => $post_image, 'post_desc' => htmlentities($post_description), 'post_date' => $post_date, 'post_status' => $post_status, 'blog_cat_id' => $blog_cat_id, 'post_tags' => $post_tags, 'post_media_type' => $post_media_type, 'post_video' => $post_video, 'language_code' => $code);
			  
			  Blog::updatepostData($post_id, $data);
			}
			else
			{
			    $counts = Blog::postCount($code,$post_id);
			    if($counts==0)
				 {
						if(!empty($post_heading))
						{
						   $postheading = $post_heading;
						   $postshortdesc = $post_short_description;
						   $postdesc = $post_description;
						}
						else
						{
						   $postheading = "";
						   $postshortdesc = "";
						   $postdesc = "";
						}
					 $save = array('post_title' => $postheading, 'post_slug' => $post_slug, 'post_short_desc' => $postshortdesc, 'post_image' => $post_image, 'post_desc' => htmlentities($postdesc), 'post_date' => $post_date, 'post_status' => $post_status, 'blog_cat_id' => $blog_cat_id, 'post_tags' => $post_tags, 'post_media_type' => $post_media_type, 'post_video' => $post_video, 'language_code' => $code, 'token' => $token, 'post_page_parent' => $post_id);	
					 	
				     Blog::insertpostData($save);
					 					 
				 }
				 else
				 {
				   $updata = array('post_title' => $post_heading, 'post_slug' => $post_slug, 'post_short_desc' => $post_short_description, 'post_image' => $post_image, 'post_desc' => htmlentities($post_description), 'post_date' => $post_date, 'post_status' => $post_status, 'blog_cat_id' => $blog_cat_id, 'post_tags' => $post_tags, 'post_media_type' => $post_media_type, 'post_video' => $post_video);
				   
				  Blog::anotherPost($post_id,$code,$updata); 
				  
				 }
			
			}
		}
		
		 return redirect('/admin/post')->with('success', 'Update successfully.');
		
        
		
		
		}
		
	
	}
	
  
	
	
	/*
	public function update_post(Request $request)
	{
	
	   $post_title = $request->input('post_title');
		 $post_short_desc = $request->input('post_short_desc');
		 $post_desc = Purifier::clean($request->input('post_desc'));
         $post_slug = $this->post_slug($post_title);
		 $post_status = $request->input('post_status');
		 $blog_cat_id = $request->input('blog_cat_id');
		 
		 $save_post_image = $request->input('save_post_image');
		 $post_id = $request->input('post_id');
		 $post_tags = $request->input('post_tags');
		 $post_media_type = $request->input('post_media_type');
		 $post_video = $request->input('post_video');
		 
		 
         
		 $request->validate([
							'post_title' => 'required',
							'post_short_desc' => 'required',
							'post_desc' => 'required',
							'post_image' => 'mimes:jpeg,jpg,png|max:1000',
							'post_status' => 'required',
							'blog_cat_id' => 'required',
							
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
		
		
		$post_date = date('Y-m-d');
		
		if ($request->hasFile('post_image')) 
		{
		     
			Blog::dropBlogimage($post_id);	   
			$image = $request->file('post_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/post');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$post_image = $img_name;
		  }
		  else
		  {
		     $post_image = $save_post_image;
		  }
		 
		$data = array('post_title' => $post_title, 'post_slug' => $post_slug, 'post_short_desc' => $post_short_desc, 'post_image' => $post_image, 'post_desc' => $post_desc, 'post_date' => $post_date, 'post_status' => $post_status, 'blog_cat_id' => $blog_cat_id, 'post_tags' => $post_tags, 'post_media_type' => $post_media_type, 'post_video' => $post_video);
		
		
		
        Blog::updatepostData($post_id, $data);
            return redirect('/admin/post')->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}*/
	
	
	/* posts */
	
	
	
}
