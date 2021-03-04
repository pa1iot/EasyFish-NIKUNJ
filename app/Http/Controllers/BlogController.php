<?php

namespace ZigKart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use ZigKart\Models\Blog;
use Cookie;
use ZigKart\Models\Languages;


class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    
	public function view_category_blog($category,$id,$slug)
	{
	  $translate = $this->lang_text();
	  $blogData['post'] = Blog::catpostData($id,$translate); 
	  $blog['popular'] = Blog::getpopularData();
	  $blogPost['latest'] = Blog::getlatestData($translate);
	  
	  $catData['post'] = Blog::getblogcatData($translate);
	  $comments = Blog::getgroupcommentData();
	  $category_count = Blog::getgrouppostData($translate);
	  return view('blog',[ 'blogData' => $blogData, 'catData' => $catData, 'blog' => $blog, 'blogPost' => $blogPost, 'slug' => str_replace("-"," ",$slug), 'comments' => $comments, 'category_count' => $category_count]);
	   
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
	
	
    public function view_blog()
    {
      $translate = $this->lang_text();  
	  $blogData['post'] = Blog::allpostData($translate);
	  $blogPost['latest'] = Blog::getlatestData($translate);
	  $slug = "Blog";
	  
	  $catData['post'] = Blog::getblogcatData($translate);
	  $comments = Blog::getgroupcommentData();
	  $category_count = Blog::getgrouppostData($translate);
	  return view('blog',[ 'blogData' => $blogData, 'catData' => $catData, 'blogPost' => $blogPost, 'slug' => $slug, 'comments' => $comments, 'category_count' => $category_count]);
    }
	
	
	public function view_tags($type,$slug)
	{
	$translate = $this->lang_text();
	$blogData['post'] = Blog::alltagData($slug,$translate);
	$blogPost['latest'] = Blog::getlatestData($translate);
	$comments = Blog::getgroupcommentData();
	$catData['post'] = Blog::getblogcatData($translate); 
	$category_count = Blog::getgrouppostData($translate);
	return view('blog',[ 'blogData' => $blogData, 'catData' => $catData, 'blogPost' => $blogPost, 'slug' => $slug, 'comments' => $comments, 'category_count' => $category_count]);
	
	}
	
	
	
	public function view_single($slug)
	{
	  $translate = $this->lang_text();
	  $edit['post'] = Blog::editsingleData($slug,$translate);
	  $view = $edit['post']->post_view + 1;
	  $data = array('post_view'=> $view);
	  
	  $blog['popular'] = Blog::getpopularData();
	  $blogPost['latest'] = Blog::getlatestData($translate);
	  
	  Blog::updatesingleData($slug,$data);
	  $catData['post'] = Blog::getblogcatData($translate);
	  
	  $post_tags = explode(",",$edit['post']->post_tags);
	  
	  if($translate == 'en')
	  {
	  $post_id = $edit['post']->post_id;
	  }
	  else
	  {
	  $post_id = $edit['post']->post_page_parent;
	  }
	  $comment['display'] = Blog::getcommentRecord($post_id);
	  $count = Blog::getcommentCount($post_id);
	  $category_count = Blog::getgrouppostData($translate);
	  return view('single', [ 'edit' => $edit, 'slug' => $slug, 'catData' => $catData, 'blog' => $blog, 'blogPost' => $blogPost, 'post_tags' => $post_tags, 'comment' => $comment, 'count' => $count, 'category_count' => $category_count]);
	 
	}
	
	
	public function insert_comment(Request $request)
	{
	   $user_id = $request->input('user_id');
	   $comment_content = $request->input('comment_content');
	   $post_id = $request->input('post_id');
	   $getcount  = Blog::commentCheck($post_id,$user_id);
	   $comment_date = date('Y-m-d');
	   
	   $data = array('post_id' => $post_id, 'user_id' => $user_id, 'comment_content' => $comment_content, 'comment_date' => $comment_date);
	   Blog::savecommentData($data);
	   return redirect()->back()->with('success', 'Thanks for your comments. Once admin will approved your comment. will publish on this post.');
	   
	
	}
	
	
	
	
	
}
