<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Blog extends Model
{
    
	
  public static function getblogcatData($translate)
  {

    $value=DB::table('blog_category')->where('drop_status','=','no')->where('blog_category_status','=',1)->where('language_code','=',$translate)->orderBy('blog_cat_id', 'desc')->get(); 
    return $value;
	
  }
  public static function blogViews($token)
  {

    $value=DB::table('blog_category')->where('token','=',$token)->where('blog_page_parent','=',0)->get(); 
    return $value;
	
  }
  
  public static function postCount($code,$post_id)
  {

    $get=DB::table('post')->where('language_code','=',$code)->where('post_page_parent','=',$post_id)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  
  public static function blogCount($code,$blog_cat_id)
  {

    $get=DB::table('blog_category')->where('language_code','=',$code)->where('blog_page_parent','=',$blog_cat_id)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  public static function anotherBlog($blog_cat_id,$code,$updata){
    DB::table('blog_category')
      ->where('blog_page_parent', $blog_cat_id)
	  ->where('language_code', $code)
      ->update($updata);
  }
  
  public static function insertblogData($data){
   
      DB::table('blog_category')->insert($data);
     
 
    }
  
  public static function blogGet($token)
  {

    $get=DB::table('blog_category')->where('token','=',$token)->where('blog_page_parent','=',0)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  public static function getLastInsertedId($data){
   
      $id = DB::table('blog_category')->insertGetId($data);
     
 
    }
  
  public static function getblogcategoryData()
  {

    $value=DB::table('blog_category')->where('drop_status','=','no')->where('blog_page_parent','=',0)->orderBy('blog_cat_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  public static function editsingleData($slug,$translate){
    $value = DB::table('post')->join('blog_category','blog_category.blog_cat_id','post.blog_cat_id')->where('post.post_slug', $slug)->where('post.language_code', $translate)->first();
	return $value;
  }   
  
  public static function saveblogcategoryData($data){
   
      DB::table('blog_category')->insert($data);
     
 
    }
  
  public static function deleteBlogcategorydata($blog_cat_id,$data){
    
	DB::table('blog_category')
      ->where('blog_page_parent', $blog_cat_id)
      ->update($data);	
	DB::table('blog_category')
      ->where('blog_cat_id', $blog_cat_id)
      ->update($data);
	
  }
  
  public static function singlar($blog_cat_id){
    $value = DB::table('blog_category')
      ->where('blog_page_parent','=', 0)
	  ->where('blog_cat_id','=', $blog_cat_id)
      ->first();
	return $value;
  }
  
  
  public static function others($blog_cat_id,$code){
    $value = DB::table('blog_category')
      ->where('blog_page_parent','=', $blog_cat_id)
	  ->where('language_code','=', $code)
      ->first();
	return $value;
  }
  
  
  public static function postsinglar($post_id){
    $value = DB::table('post')
      ->where('post_page_parent','=', 0)
	  ->where('post_id','=', $post_id)
      ->first();
	return $value;
  }
  
  public static function postothers($post_id,$code){
    $value = DB::table('post')
      ->where('post_page_parent','=', $post_id)
	  ->where('language_code','=', $code)
      ->first();
	return $value;
  }
  
  
  public static function updatesingleData($slug,$data){
    DB::table('post')
      ->where('post_slug', $slug)
      ->update($data);
  }
  
  
  
  
  public static function editblogcategoryData($blog_cat_id){
    $value = DB::table('blog_category')
      ->where('blog_cat_id', $blog_cat_id)
      ->first();
	return $value;
  }
  
  
  public static function updatecatBlogData($blog_cat_id,$data){
    DB::table('blog_category')
      ->where('blog_cat_id', $blog_cat_id)
      ->update($data);
  }
  
  
  
  
  /* category */
  
  
  /* post */
  
  
 
  
  
   public static function getgrouppostData($translate)
  {

    $value=DB::table('post')->where('post_status','=',1)->where('language_code','=',$translate)->orderBy('post_id', 'desc')->get()->groupBy('blog_cat_id'); 
    return $value;
	
  }	
  
  
  public static function getpostcategoryData()
  {

    $value=DB::table('blog_category')->where('drop_status','=','no')->where('blog_page_parent','=',0)->orderBy('blog_cat_id', 'desc')->get(); 
    return $value;
	
  }
  
  public static function blogCates($token)
  {

    $value=DB::table('post')->where('token','=',$token)->where('post_page_parent','=',0)->get(); 
    return $value;
	
  }
  public static function blogGetry($token)
  {

    $get=DB::table('post')->where('token','=',$token)->where('post_page_parent','=',0)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
   public static function getLastPostId($data){
   
      $id = DB::table('post')->insertGetId($data);
     
 
    }
  
  public static function getpostData()
  {

    $value=DB::table('post')->join('blog_category','blog_category.blog_cat_id','post.blog_cat_id')->where('post_page_parent','=',0)->orderBy('post.post_id', 'desc')->get(); 
    return $value;
	
  }
  
  public static function getcommentData($post_id)
  {

    $value=DB::table('post_comment')->join('users','users.id','post_comment.user_id')->where('post_comment.post_id','=',$post_id)->orderBy('post_comment.comment_id', 'desc')->get(); 
    return $value;
	
  }
  
  public static function getcommentRecord($post_id)
  {

    $value=DB::table('post_comment')->join('users','users.id','post_comment.user_id')->where('post_comment.post_id','=',$post_id)->where('post_comment.comment_status','=',1)->orderBy('post_comment.comment_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  
  public static function allpostData($translate)
  {
    
    $value=DB::table('post')->join('blog_category','blog_category.blog_cat_id','post.blog_cat_id')->where('post.post_status','=',1)->where('post.language_code','=',$translate)->orderBy('post.post_id', 'desc')->get(); 
	
    return $value;
	
  }
  
  
  public static function catpostData($id,$translate)
  {

    $value=DB::table('post')->join('blog_category','blog_category.blog_cat_id','post.blog_cat_id')->where('post.blog_cat_id','=',$id)->where('post.post_status','=',1)->where('post.language_code','=',$translate)->orderBy('post.post_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  
  public static function getpopularData()
  {

    $value=DB::table('post')->where('post_status','=',1)->orderBy('post_view', 'desc')->take(5)->get(); 
    return $value;
	
  }
  
  
  public static function getlatestData($translate)
  {

    $value=DB::table('post')->where('post_status','=',1)->where('language_code','=',$translate)->orderBy('post_id', 'desc')->take(5)->get(); 
    return $value;
	
  }
  
  
  public static function insertpostData($data){
   
      DB::table('post')->insert($data);
     
 
    }
	
	public static function anotherPost($post_id,$code,$updata){
    DB::table('post')
      ->where('post_page_parent', $post_id)
	  ->where('language_code', $code)
      ->update($updata);
  }
	
	
  public static function deletePostdata($post_id){
  
    $image = DB::table('post')->where('post_id', '=', $post_id)->first();
    $file= $image->post_image;
    $filename = public_path().'/storage/post/'.$file;
    File::delete($filename);
    DB::table('post')->where('post_page_parent', '=', $post_id)->delete();
	DB::table('post')->where('post_id', '=', $post_id)->delete();	
	
	
  }	
  
  
  public static function deleteCommentdata($comment_id){
  
   
    
	DB::table('post_comment')->where('comment_id', '=', $comment_id)->delete();	
	
	
  }	
  
  
  
  public static function editpostData($post_id){
    $value = DB::table('post')
      ->where('post_id', $post_id)
      ->first();
	return $value;
  }
  
  
  
   public static function updatepostData($post_id,$data){
    DB::table('post')
      ->where('post_id', $post_id)
      ->update($data);
  }
  
  
  public static function updatecommentData($comment_id, $data){
    DB::table('post_comment')
      ->where('comment_id', $comment_id)
      ->update($data);
  }
  
  
  public static function dropBlogimage($post_id)
	  {
		 $image = DB::table('post')->where('post_id', $post_id)->first();
			$file= $image->post_image;
			$filename = public_path().'/storage/post/'.$file;
			File::delete($filename);
	  }
  
  /* post */
  
  
  
  /* comment */
  
  
  public static function commentCheck($post_id,$user_id)
  {

    $get=DB::table('post_comment')->where('post_id','=', $post_id)->where('user_id','=', $user_id)->get();
	$value = $get->count(); 
    return $value;
	
  }
  
  public static function savecommentData($data){
   
      DB::table('post_comment')->insert($data);
     
 
    }
	
	
   
  
  public static function getgroupcommentData()
  {

    $value=DB::table('post_comment')->where('comment_status','=',1)->get()->groupBy('post_id'); 
    return $value;
	
  }	
  
  
  public static function getcountcommentData()
  {

    $value=DB::table('post_comment')->get()->groupBy('post_id'); 
    return $value;
	
  }	
  
  
  
  public static function getcommentCount($post_id)
  {

    $get=DB::table('post_comment')->where('post_id','=',$post_id)->where('comment_status','=',1)->orderBy('comment_id', 'desc')->get(); 
    $value = $get->count(); 
	return $value;
	
  }	
  
  
  /* comment */
  
  
  
  /* tags */
  
   public static function alltagData($slug,$translate)
  {
   
    
    $value=DB::table('post')->join('blog_category','blog_category.blog_cat_id','post.blog_cat_id')->where('post.post_tags', 'LIKE', "%$slug%")->where('post.post_status','=',1)->where('post.language_code','=',$translate)->orderBy('post.post_id', 'desc')->get(); 
    return $value;
	
  }
  
  /* tags */
  
  
  /* home blog */
  
  public static function homeblogData()
  {

    $value=DB::table('post')->where('post_status','=',1)->orderBy('post_id', 'desc')->take(3)->get(); 
    return $value;
	
  }
  
  /* home blog */
  
  
  public static function totalblogData()
  {

    $get=DB::table('post')->where('post_status','=',1)->orderBy('post_id', 'desc')->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  
}
