<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Cookie;
use ZigKart\Models\Languages;

class Category extends Model
{
    
	/* category */
	
	protected $table = 'category';
	
	public function SubCategory()
    {
	    $translate = $this->lang_text();
		if($translate == 'en')
		{
        return $this->hasMany(SubCategory::class, 'cat_id', 'cat_id')->where('drop_status', 'no')->where('language_code', $translate);
		}
		else
		{
		return $this->hasMany(SubCategory::class, 'cat_id', 'category_page_parent')->where('drop_status', 'no')->where('language_code', $translate);
		}
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
	
	
  public static function getsinglecatData($item_cat_id)
  {

    $value=DB::table('category')->where('cat_id','=',$item_cat_id)->first(); 
    return $value;
	
  }
  
  public static function singleCat($slug)
  {

    $value=DB::table('category')->where('category_slug','=',$slug)->first(); 
    return $value;
	
  }	
  
  public static function singleSubcat($slug)
  {

    $value=DB::table('subcategory')->where('subcategory_slug','=',$slug)->first(); 
    return $value;
	
  }
	
	
  public static function slugcategoryData($slug)
  {

    $value=DB::table('category')->where('drop_status','=','no')->where('category_status','=',1)->where('category_slug','=',$slug)->first(); 
    return $value;
	
  }	
	
  
  public static function getcategoryData()
  {

    $value=DB::table('category')->where('drop_status','=','no')->where('category_page_parent','=',0)->orderBy('cat_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  
  public static function categoryViews($token)
  {

    $value=DB::table('category')->where('token','=',$token)->where('category_page_parent','=',0)->get(); 
    return $value;
	
  }
  
  public static function categoryGet($token)
  {

    $get=DB::table('category')->where('token','=',$token)->where('category_page_parent','=',0)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  public static function getLastInsertedId($data){
   
      $id = DB::table('category')->insertGetId($data);
     
 
    }
  
  public static function totalcategoryCount()
  {

    $get=DB::table('category')->where('drop_status','=','no')->where('category_page_parent','=',0)->orderBy('cat_id', 'desc')->get(); 
    $value = $get->count();
	return $value;
	
  }
  
  
  
  public static function recentcategoryData($take,$translate)
  {

    $value=DB::table('category')->where('drop_status','=','no')->where('category_status','=',1)->where('language_code','=',$translate)->orderBy('cat_id', 'desc')->take($take)->get(); 
    return $value;
	
  }
  
  
  public static function footcategoryData($take)
  {

    $value=DB::table('category')->where('drop_status','=','no')->where('category_status','=',1)->orderBy('display_order', 'asc')->take($take)->get(); 
    return $value;
	
  }
  
  
  public static function quickbookData()
  {

    $value=DB::table('category')->where('drop_status','=','no')->where('category_status','=',1)->orderBy('display_order', 'asc')->get(); 
    return $value;
	
  }
  
  
  public static function eventCategoryData()
  {

    $value=DB::table('category')->join('events','events.event_cat_id','category.cat_id')->where('category.drop_status','=','no')->where('category.category_status','=',1)->where('events.event_status','=',1)->orderBy('category.display_order', 'asc')->groupBy('category.cat_id')->get(); 
    return $value;
	
  }
  
  
  public static function getgroupeventData()
  {

    $value=DB::table('events')->where('event_status','=',1)->orderBy('event_id', 'desc')->get()->groupBy('event_cat_id'); 
    return $value;
	
  }	
  
  
  
  public static function getgroupcauseData()
  {

    $value=DB::table('causes')->where('cause_status','=',1)->orderBy('cause_id', 'desc')->get()->groupBy('cat_id'); 
    return $value;
	
  }	
  
  
  
  public static function categorydisplayOrder()
  {

    $value=DB::table('category')->where('drop_status','=','no')->where('category_status','=',1)->orderBy('display_order', 'asc')->get(); 
    return $value;
	
  }
  public static function anotherCategory($cat_id,$code,$updata){
    DB::table('category')
      ->where('category_page_parent', $cat_id)
	  ->where('language_code', $code)
      ->update($updata);
  }
  
  
  public static function insertcategoryData($data){
   
      DB::table('category')->insert($data);
     
 
    }
	
	public static function singlar($cat_id){
    $value = DB::table('category')
      ->where('category_page_parent','=', 0)
	  ->where('cat_id','=', $cat_id)
      ->first();
	return $value;
  }
  
  public static function others($cat_id,$code){
    $value = DB::table('category')
      ->where('category_page_parent','=', $cat_id)
	  ->where('language_code','=', $code)
      ->first();
	return $value;
  }
  
  
  public static function categoryCount($code,$cat_id)
  {

    $get=DB::table('category')->where('language_code','=',$code)->where('category_page_parent','=',$cat_id)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
	
  
  public static function deleteCategorydata($cat_id,$data){
    
	$image = DB::table('category')->where('cat_id', $cat_id)->first();
			$file= $image->category_image;
			$filename = public_path().'/storage/category/'.$file;
			File::delete($filename);
	DB::table('category')
      ->where('category_page_parent', $cat_id)
      ->update($data);
		
	DB::table('category')
      ->where('cat_id', $cat_id)
      ->update($data);
	
  }
  
  
  public static function dropCategoryimage($cat_id)
  {
		 $image = DB::table('category')->where('cat_id', $cat_id)->first();
			$file= $image->category_image;
			$filename = public_path().'/storage/category/'.$file;
			File::delete($filename);
  }
  
  
  
  public static function editcategoryData($cat_id){
    $value = DB::table('category')
      ->where('cat_id', $cat_id)
      ->first();
	return $value;
  }
  
  
  public static function updatecategoryData($cat_id,$data){
    DB::table('category')
      ->where('cat_id', $cat_id)
      ->update($data);
  }
  
  
  public static function allcategoryData()
  {

    $value=DB::table('category')->where('drop_status','=','no')->where('category_status','=','1')->where('category_page_parent','=',0)->orderBy('cat_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  public static function menucategoryData()
  {

    $value=DB::table('category')->where('drop_status','=','no')->where('category_status','=','1')->orderBy('cat_id', 'asc')->get(); 
    return $value;
	
  }
  
  /* category */
  
  
	
  /* subcategory */
  
  
  
  public static function getsubcategoryData()
  {

    $value=DB::table('subcategory')->leftJoin('category','category.cat_id','=','subcategory.cat_id')->where('subcategory.subcategory_page_parent','=',0)->where('subcategory.drop_status','=','no')->orderBy('subcategory.subcat_id', 'desc')->get(); 
    return $value;
	
  }
  
   public static function insertsubcategoryData($data){
   
      DB::table('subcategory')->insert($data);
     
 
    }
	
	
    public static function deleteSubcategorydata($subcat_id,$data){
    
	DB::table('subcategory')
      ->where('subcategory_page_parent', $subcat_id)
      ->update($data);	
	DB::table('subcategory')
      ->where('subcat_id', $subcat_id)
      ->update($data);
	
  }	
  
  
  
  public static function editsubcategoryData($subcat_id){
    $value = DB::table('subcategory')
      ->where('subcat_id', $subcat_id)
      ->first();
	return $value;
  }
  
  
  
  public static function updatesubcategoryData($subcat_id,$data){
    DB::table('subcategory')
      ->where('subcat_id', $subcat_id)
      ->update($data);
  }
  
  /* subcategory */
  
  
  
}
