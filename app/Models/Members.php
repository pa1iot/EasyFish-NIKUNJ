<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Members extends Model
{


	/* administrator */
		public static function getadminData()
	  {

		$value=DB::table('users')->where('user_type','=','admin')->where('id','!=',1)->where('drop_status','=','no')->orderBy('id', 'desc')->get();
		return $value;

	  }

	  public static function logindataUser($log_id)
	  {
            $value = DB::table('users')->where('id', $log_id)->first();
	        return $value;
      }

	/* administrator */

    /* Delivery boy*/

    public static function getdeliveryboyData()
    {

        $value=DB::table('users')->where('user_type','=','deliveryboy')->where('id','!=',1)->where('drop_status','=','no')->orderBy('id', 'desc')->get();
        return $value;

    }

	/* customer */

	public static function insertData($data){

      $id =DB::table('users')->insertGetId($data);

        return $id;
    }


	public static function savenewsletterData($data)
  {

      DB::table('newsletter')->insert($data);


  }


  public static function updateData($token,$data){
    DB::table('users')
      ->where('user_token', $token)
      ->update($data);
  }

  public static function editData($token){
    $value = DB::table('users')
      ->where('user_token', $token)
      ->first();
	return $value;
  }


  public static function getuserData()
  {

    $value=DB::table('users')->where('user_type','=','customer')->where('drop_status','=','no')->orderBy('id', 'desc')->get();
    return $value;

  }





  public static function checkNewsletter($token)
  {
  $get=DB::table('newsletter')->where('news_token','=',$token)->where('news_status','=',0)->get();
  $value = $get->count();
    return $value;

  }





  public static function deleteData($token,$data){

	$image = DB::table('users')->where('user_token', $token)->first();
        $file= $image->user_photo;
        $filename = public_path().'/storage/users/'.$file;
        File::delete($filename);

	DB::table('users')
      ->where('user_token', $token)
      ->update($data);

  }

  public static function droPhoto($token)
  {
     $image = DB::table('users')->where('user_token', $token)->first();
        $file= $image->user_photo;
        $filename = public_path().'/storage/users/'.$file;
        File::delete($filename);
  }


  public static function droBanner($token)
  {
     $image = DB::table('users')->where('user_token', $token)->first();
        $file= $image->user_banner;
        $filename = public_path().'/storage/users/'.$file;
        File::delete($filename);
  }

  /* customer */


  /* vendor */


  public static function getvendorData()
  {

    $value=DB::table('users')->where('user_type','=','vendor')->where('drop_status','=','no')->orderBy('id', 'desc')->get();
    return $value;

  }

    /* vendor */



	/* edit profile */




  public static function editprofileData($token){
    $value = DB::table('users')
      ->where('id', $token)
      ->first();
	return $value;
  }


  public static function editUser($slug){
    $value = DB::table('users')
      ->where('username', $slug)
      ->first();
	return $value;
  }

  public static function editUserData($slug)
  {

    $value=DB::table('users')->leftjoin('country','users.user_country','country.country_id')->where('users.username', $slug)->first();
    return $value;

  }

  public static function adminData(){
    $value = DB::table('users')
      ->where('id', 1)
      ->first();
	return $value;
  }


  public static function updateprofileData($token,$data){
    DB::table('users')
      ->where('id', $token)
      ->update($data);
  }


  public static function updateNewsletter($token,$data){
    DB::table('newsletter')
      ->where('news_token', $token)
      ->update($data);
  }


  public static function droprofilePhoto($token)
  {
     $image = DB::table('users')->where('id', $token)->first();
        $file= $image->user_photo;
        $filename = public_path().'/storage/users/'.$file;
        File::delete($filename);
  }

	/* edit profile */


	/* verify user */

	public static function verifyuserData($user_token,$data){
    DB::table('users')
      ->where('user_token', $user_token)
      ->update($data);
  }

  /* verify user */


  /* verify user available or not */


  public static function verifycheckData($data){
    $value=DB::table('users')->where('email', $data['email'])->where('drop_status', 'no')->get();
    if($value->count() != 0){
      return 1;
     }else{
       return 0;
     }

  }


  public static function getemailData($email){
    $value = DB::table('users')
      ->where('email', $email)
	  ->where('drop_status', 'no')
      ->first();
	return $value;
  }



  public static function verifytokenData($data){
    $value=DB::table('users')->where('user_token', $data['user_token'])->where('drop_status', 'no')->get();
    if($value->count() != 0){
      return 1;
     }else{
       return 0;
     }

  }



  public static function gettokenData($user_token){
    $value = DB::table('users')
      ->where('user_token', $user_token)
	  ->where('drop_status', 'no')
      ->first();
	return $value;
  }


   public static function updatepasswordData($user_token, $record){
    DB::table('users')
      ->where('user_token', $user_token)
      ->update($record);
  }


  public static function updateadminData($admin_token, $admin_record){
    DB::table('users')
      ->where('user_token', $admin_token)
      ->update($admin_record);
  }



  public static function updateuserPrice($user_id, $user_data){
    DB::table('users')
      ->where('id', $user_id)
      ->update($user_data);
  }



  /* verify user available or not */


  /* single user get */

  public static function singlevendorData($item_user_id){
    $value = DB::table('users')
      ->where('id', $item_user_id)
      ->first();
	return $value;
  }


  public static function singlebuyerData($user_id){
    $value = DB::table('users')
      ->where('id', $user_id)
      ->first();
	return $value;
  }



  public static function updatevendorRecord($vendor_token, $record_vendor){
    DB::table('users')
      ->where('user_token', $vendor_token)
      ->update($record_vendor);
  }

  /* single user get */


  /* total members */

  public static function getmemberData()
  {

    $get=DB::table('users')->where('user_type','=','vendor')->where('drop_status','=','no')->orderBy('id', 'desc')->get();
	$value = $get->count();
    return $value;

  }

  public static function totaluserCount()
  {

    $get=DB::table('users')->where('user_type','=','customer')->where('drop_status','=','no')->orderBy('id', 'desc')->get();
	$value = $get->count();
    return $value;

  }


  public static function getsubadminData()
  {

    $get=DB::table('users')->where('user_type','=','admin')->where('id','!=',1)->where('drop_status','=','no')->orderBy('id', 'desc')->get();
	$value = $get->count();
    return $value;

  }
  /* total members */


	 public static function getcontactCount($from_email)
  {

    $get=DB::table('contact')->where('from_email','=',$from_email)->get();
	$value = $get->count();
    return $value;

  }

  public static function saveContact($record)
  {

      DB::table('contact')->insert($record);


  }

  public static function bestSeller()
  {

    $value=DB::table('users')->leftJoin('product_orders','product_orders.product_user_id','users.id')->where('product_orders.order_status', 'completed')->where('users.user_type', 'vendor')->groupBy('product_orders.product_user_id')->orderBy('users.id', 'desc')->get();
    return $value;

  }

  public static function getgroupSellers()
  {

    $value=DB::table('product')->where('product_status','=',1)->where('product_drop_status','=','no')->where('product_page_parent','=',0)->orderBy('product_id', 'desc')->get()->groupBy('user_id');
    return $value;

  }

  public static function getsaleSellers()
  {

    $value=DB::table('product_orders')->where('order_status','=','completed')->get()->groupBy('product_user_id');
    return $value;

  }

  public static function getCountry($country_id)
  {

    $value=DB::table('country')->where('country_id','=',$country_id)->first();
    return $value;

  }

  /* referral */
   public static function referralUser($referral_by)
  {

    $value=DB::table('users')->where('id', $referral_by)->first();
    return $value;

  }

  public static function referralCheck($referral_by)
  {

    $get=DB::table('users')->where('id', $referral_by)->get();
    $value = $get->count();
    return $value;

  }



  public static function updateReferral($referral_by,$update_data){
    DB::table('users')
      ->where('id', $referral_by)
      ->update($update_data);
  }

  /* referral */


}
