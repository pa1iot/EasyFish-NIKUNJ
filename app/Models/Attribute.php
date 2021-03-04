<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Cookie;
use ZigKart\Models\Languages;
use Auth;

class Attribute extends Model
{
    
	protected $table = 'product_attribute';
	
	
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
	
	public function AttributeValue()
    {
	    $translate = $this->lang_text();
		if($translate == 'en')
		{
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'attribute_id')->where('language_code', $translate);
		}
		else
		{
		
		/*return $this->hasMany(AttributeValue::class, 'attribute_id', 'attribute_page_parent')->where('language_code', $translate);*/
		return $this->hasMany(AttributeValue::class, 'attribute_id', 'attribute_id')->where('language_code', $translate);
		}
    }
	
	
	public function NewAttributeValue()
    {
	    $translate = $this->lang_text();
		if($translate == 'en')
		{
        return $this->hasMany(NewAttributeValue::class, 'attribute_id', 'attribute_id')->where('language_code', $translate);
		}
		else
		{
		
		return $this->hasMany(NewAttributeValue::class, 'attribute_id', 'attribute_page_parent')->where('language_code', $translate);
		
		}
    }
	
	public function AttributeAgain()
    {   
	    
	    return $this->hasMany(AttributeValue::class, 'attribute_id', 'attribute_id')->where('language_code', 'en');
	}	
	
	/* attribute value */
	
	
	public static function attrivalueViews($token)
  {

    $value=DB::table('product_attribute_value')->where('token','=',$token)->where('attrivalue_page_parent','=',0)->get(); 
    return $value;
	
  }
  
  public static function attrivalueGet($token)
  {

    $get=DB::table('product_attribute_value')->where('token','=',$token)->where('attrivalue_page_parent','=',0)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  public static function getLastAttriId($data){
   
      $id = DB::table('product_attribute_value')->insertGetId($data);
     
 
    }
  
	
	public static function getvalueData()
    {

    $value=DB::table('product_attribute_value')->join('users','users.id','product_attribute_value.user_id')->join('product_attribute','product_attribute.attribute_id','product_attribute_value.attribute_id')->where('product_attribute_value.attribute_value_drop_status','=','no')->where('product_attribute_value.attrivalue_page_parent','=',0)->orderBy('product_attribute_value.attribute_value_id', 'desc')->get(); 
    return $value;
	
    }
	
	
	public static function welvalueData()
    {
    $user_id = Auth::user()->id;
	$value=DB::table('product_attribute_value')->join('product_attribute','product_attribute.attribute_id','product_attribute_value.attribute_id')->where('product_attribute_value.attrivalue_page_parent','=',0)->where('product_attribute_value.attribute_value_drop_status','=','no')->whereIn('product_attribute_value.user_id',[1, $user_id])->select(DB::raw('product_attribute.*, product_attribute_value.*,product_attribute_value.user_id as user_user_id'))->orderBy('product_attribute_value.attribute_value_id', 'desc')->get(); 
    return $value;
	
    }
	
	
	public static function insertvalueData($data){
   
      DB::table('product_attribute_value')->insert($data);
     
 
    }
	
	public static function anotherAttri($attribute_value_id,$code,$updata){
    DB::table('product_attribute_value')
      ->where('attrivalue_page_parent', $attribute_value_id)
	  ->where('language_code', $code)
      ->update($updata);
  }
	
	public static function deleteValuedata($attribute_value_id,$data){
    
	DB::table('product_attribute_value')
      ->where('attrivalue_page_parent', '=', $attribute_value_id)
      ->update($data);
	  
	DB::table('product_attribute_value')
      ->where('attribute_value_id', '=', $attribute_value_id)
      ->update($data);
	
  }
  
  
  public static function editValue($attribute_value_id){
    $value = DB::table('product_attribute_value')
      ->where('attribute_value_id', '=', $attribute_value_id)
      ->first();
	return $value;
  }
  
  
  public static function updateValuedata($attribute_value_id, $data){
    DB::table('product_attribute_value')
      ->where('attribute_value_id', '=', $attribute_value_id)
      ->update($data);
  }
	
	
	/* attribute value */
	
	
	
	/* attribute type */

   public static function usergettypeData($user_id)
  {

    $value=DB::table('product_attribute')->join('users','users.id','product_attribute.user_id')->where('user_id','=',$user_id)->where('attribute_drop_status','=','no')->orderBy('attribute_id', 'desc')->get(); 
    return $value;
	
  }

  
  public static function gettypeData()
  {

    $value=DB::table('product_attribute')->join('users','users.id','product_attribute.user_id')->where('attribute_drop_status','=','no')->where('attribute_page_parent','=',0)->orderBy('attribute_id', 'desc')->get(); 
    return $value;
	
  }
  
  public static function gettypeSELECTEDData()
  {
    $user_id = Auth::user()->id;
    $value=DB::table('product_attribute')->join('users','users.id','product_attribute.user_id')->whereIn('user_id',[1, $user_id])->where('attribute_drop_status','=','no')->where('attribute_page_parent','=',0)->orderBy('attribute_id', 'desc')->get(); 
    return $value;
	
  }    
  
  public static function inserttypeData($data){
   
      DB::table('product_attribute')->insert($data);
     
 
    }
	
	public static function anotherAttribute($attribute_id,$code,$updata){
    DB::table('product_attribute')
      ->where('attribute_page_parent', $attribute_id)
	  ->where('language_code', $code)
      ->update($updata);
  }
  
  public static function deleteTypedata($attribute_id,$data){
    
	DB::table('product_attribute')
      ->where('attribute_page_parent', '=', $attribute_id)
      ->update($data);
	  
	DB::table('product_attribute')
      ->where('attribute_id', '=', $attribute_id)
      ->update($data);
	
  }
  
  public static function singlar($attribute_id){
    $value = DB::table('product_attribute')
      ->where('attribute_page_parent','=', 0)
	  ->where('attribute_id','=', $attribute_id)
      ->first();
	return $value;
  }
  
  public static function others($attribute_id,$code){
    $value = DB::table('product_attribute')
      ->where('attribute_page_parent','=', $attribute_id)
	  ->where('language_code','=', $code)
      ->first();
	return $value;
  }
  
  
  public static function attrisinglar($attribute_value_id){
    $value = DB::table('product_attribute_value')
      ->where('attrivalue_page_parent','=', 0)
	  ->where('attribute_value_id','=', $attribute_value_id)
      ->first();
	return $value;
  }
  
  public static function attriothers($attribute_value_id,$code){
    $value = DB::table('product_attribute_value')
      ->where('attrivalue_page_parent','=', $attribute_value_id)
	  ->where('language_code','=', $code)
      ->first();
	return $value;
  }
  
  public static function attrivalCount($code,$attribute_value_id)
  {

    $get=DB::table('product_attribute_value')->where('language_code','=',$code)->where('attrivalue_page_parent','=',$attribute_value_id)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  public static function attributeCount($code,$attribute_id)
  {

    $get=DB::table('product_attribute')->where('language_code','=',$code)->where('attribute_page_parent','=',$attribute_id)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  
  public static function editType($attribute_id){
    $value = DB::table('product_attribute')
      ->where('attribute_id', '=', $attribute_id)
      ->first();
	return $value;
  }
  
  
  public static function updateTypedata($attribute_id, $data){
    DB::table('product_attribute')
      ->where('attribute_id', '=', $attribute_id)
      ->update($data);
  }
  
    
  public static function attributeViews($token)
  {

    $value=DB::table('product_attribute')->where('token','=',$token)->where('attribute_page_parent','=',0)->get(); 
    return $value;
	
  }
  
  public static function attributeGet($token)
  {

    $get=DB::table('product_attribute')->where('token','=',$token)->where('attribute_page_parent','=',0)->get(); 
    $value = $get->count(); 
    return $value;
	
  }
  
  public static function getLastInsertedId($data){
   
      $id = DB::table('product_attribute')->insertGetId($data);
     
 
    }
  /* attribute type */
  
  
  
	
	
	
	
	
  
  
  
  
}
