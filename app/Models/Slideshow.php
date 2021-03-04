<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Slideshow extends Model
{
    
	/* slideshow */
	
  
  public static function getslideData()
  {

    $value=DB::table('slideshow')->where('slide_page_parent', 0)->orderBy('slide_id', 'desc')->get(); 
    return $value;
	
  }
  
  public static function insertslideData($data){
   
      DB::table('slideshow')->insert($data);
     
 
    }
	
	public static function anotherPage($slide_id,$code,$updata){
    DB::table('slideshow')
      ->where('slide_page_parent', $slide_id)
	  ->where('language_code', $code)
      ->update($updata);
  }
	
	 public static function slideViews($token)
  {

    $value=DB::table('slideshow')->where('token','=',$token)->where('slide_page_parent','=',0)->get(); 
    return $value;
	
  }
  
  public static function slideGet($token)
  {

    $get=DB::table('slideshow')->where('token','=',$token)->where('slide_page_parent','=',0)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
	
   public static function deleteSlidedata($slide_id){
   
    $image = DB::table('slideshow')->where('slide_id', $slide_id)->first();
			$file= $image->slide_image;
			$filename = public_path().'/storage/slideshow/'.$file;
			File::delete($filename); 
    DB::table('slideshow')->where('slide_page_parent', '=', $slide_id)->delete();
	DB::table('slideshow')->where('slide_id', '=', $slide_id)->delete();	
	
	
  }	
  public static function singlar($slide_id){
    $value = DB::table('slideshow')
      ->where('slide_page_parent','=', 0)
	  ->where('slide_id','=', $slide_id)
      ->first();
	return $value;
  }
  
  public static function others($slide_id,$code){
    $value = DB::table('slideshow')
      ->where('slide_page_parent','=', $slide_id)
	  ->where('language_code','=', $code)
      ->first();
	return $value;
  }
  
  public static function editslideData($slide_id){
    $value = DB::table('slideshow')
      ->where('slide_id', $slide_id)
      ->first();
	return $value;
  }
	
	
	
  public static function updateslideData($slide_id,$data){
    DB::table('slideshow')
      ->where('slide_id', $slide_id)
      ->update($data);
  }
  	
  public static function slideCount($code,$slide_id)
  {

    $get=DB::table('slideshow')->where('language_code','=',$code)->where('slide_page_parent','=',$slide_id)->get(); 
    $value = $get->count(); 
    return $value;
	
  }	
  
  public static function dropSlide($slide_id)
	  {
		 $image = DB::table('slideshow')->where('slide_id', $slide_id)->first();
			$file= $image->slide_image;
			$filename = public_path().'/storage/slideshow/'.$file;
			File::delete($filename);
	  }
  
  public static function viewSlideshow($translate)
  {
    $value=DB::table('slideshow')->where('slide_status','=','1')->where('language_code','=',$translate)->orderBy('slide_order', 'asc')->get(); 
    return $value;
     
  }
  public static function getLastInsertedId($data){
   
      $id = DB::table('slideshow')->insertGetId($data);
     
 
    }
  /* slideshow */
  
  
  
	
	
	
	
	
  
  
  
  
}
