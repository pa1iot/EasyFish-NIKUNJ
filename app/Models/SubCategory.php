<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class SubCategory extends Model
{
    
	/* category */
	
	protected $table = 'subcategory';
	
  
  
  public function Category(){
      return $this->belongsTo(Category::class);
   }
   
   public static function subcategoryViews($token)
  {

    $value=DB::table('subcategory')->where('token','=',$token)->where('subcategory_page_parent','=',0)->get(); 
    return $value;
	
  }
  
  public static function subcategoryGet($token)
  {

    $get=DB::table('subcategory')->where('token','=',$token)->where('subcategory_page_parent','=',0)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  public static function getLastInsertedId($data){
   
      $id = DB::table('subcategory')->insertGetId($data);
     
 
    }
	
	public static function singlar($subcat_id){
    $value = DB::table('subcategory')
      ->where('subcategory_page_parent','=', 0)
	  ->where('subcat_id','=', $subcat_id)
      ->first();
	return $value;
  }
  public static function others($subcat_id,$code){
    $value = DB::table('subcategory')
      ->where('subcategory_page_parent','=', $subcat_id)
	  ->where('language_code','=', $code)
      ->first();
	return $value;
  }
  
  public static function subcategoryCount($code,$subcat_id)
  {

    $get=DB::table('subcategory')->where('language_code','=',$code)->where('subcategory_page_parent','=',$subcat_id)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  public static function anotherCategory($subcat_id,$code,$updata){
    DB::table('subcategory')
      ->where('subcategory_page_parent', $subcat_id)
	  ->where('language_code', $code)
      ->update($updata);
  }
  
  
}
