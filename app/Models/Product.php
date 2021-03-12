<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Product extends Model
{


  protected $table = 'product';


  public function ProductImages()
  {
        return $this->hasMany(ProductImages::class, 'product_token', 'product_token');
  }

  public static function upAdditional($aid,$additional){
    DB::table('additional_settings')
      ->where('sno', $aid)
      ->update($additional);
  }

  public static function getAdditional()
   {

    $value=DB::table('additional_settings')->where('sno','=',1)->first();
    return $value;

   }


  public static function getorderDetails($ord_id)
  {

     $value=DB::table('product_orders')->join('product','product.product_id','product_orders.product_id')->where('ord_id','=',$ord_id)->first();
	  return $value;
  }

  public static function deleteChat($conver_id){



	DB::table('conversation')->where('conver_id', '=', $conver_id)->delete();


  }




  public static function findProduct($product_token,$language_code)
  {

    $get=DB::table('product')->where('product_token','=',$product_token)->where('language_code','=',$language_code)->get();
	$value = $get->count();
    return $value;


  }

  public static function dumperData()
  {

    $value=DB::table('product')->where('product_page_parent','=',0)->orderBy('product_id', 'asc')->get();
    return $value;

  }


  public static function getChatDetails($ord_id)
  {

     $value=DB::table('conversation')->join('users','users.id','conversation.conver_user_id')->where('conversation.conver_order_id','=',$ord_id)->orderBy('conversation.conver_id','desc')->get();
	  return $value;

  }

  public static function savemessageData($savedata)
  {

	DB::table('conversation')->insert($savedata);

  }
  /* brands */


  public static function brandData()
  {

    $value=DB::table('brands')->orderBy('brand_id', 'desc')->get();
    return $value;

  }

  public static function homebrandData()
  {

    $value=DB::table('brands')->where('brand_status','=',1)->orderBy('brand_order', 'asc')->get();
    return $value;

  }

 public static function insertbrandData($data){

      DB::table('brands')->insert($data);


    }

    public static function deleteBranddata($brand_id){

    $image = DB::table('brands')->where('brand_id', $brand_id)->first();
			$file= $image->brand_image;
			$filename = public_path().'/storage/brands/'.$file;
			File::delete($filename);

	DB::table('brands')->where('brand_id', '=', $brand_id)->delete();


  }


  public static function editbrandData($brand_id){
    $value = DB::table('brands')
      ->where('brand_id', $brand_id)
      ->first();
	return $value;
  }



  public static function updatebrandData($brand_id,$data){
    DB::table('brands')
      ->where('brand_id', $brand_id)
      ->update($data);
  }


  public static function dropBrand($brand_id)
	  {
		 $image = DB::table('brands')->where('brand_id', $brand_id)->first();
			$file= $image->brand_image;
			$filename = public_path().'/storage/brands/'.$file;
			File::delete($filename);
	  }


  /* brands */



	/* products */

	public static function updateParent($product_token,$update_data)
	{
    DB::table('product')
      ->where('product_token', $product_token)
	  ->where('language_code', '!=', 'en')
	  ->where('product_page_parent','!=', 0)
      ->update($update_data);
  }


	public static function deleteRating($ord_id){



	DB::table('product_rating')->where('order_id', '=', $ord_id)->delete();


  }

	public static function singleorderupData($order,$orderdata)
  {
    DB::table('product_orders')
      ->where('ord_id', $order)
	  ->update($orderdata);
  }

	public static function singleorderData($order)
  {
    $value = DB::table('product_orders')
      ->where('ord_id', $order)
      ->first();
	return $value;
  }


	/*public static function viewPhysical($phy_limit,$phy_display)
	{
	   $value=DB::table('product')->where('product_type','=','physical')->where('product_status','=',1)->where('product_drop_status','=','no')->take($phy_limit)->orderBy('product_id', $phy_display)->get();
       return $value;
	}*/

	public static function editproductData($product_token){
    $value = DB::table('product')
      ->where('product_token', $product_token)
      ->first();
	return $value;
  }


  public static function editimageData($product_token)
  {

    $value=DB::table('product_images')->where('product_token','=',$product_token)->get();
    return $value;

  }

  public static function dropProductimg($product_token){

    $image = DB::table('product')->where('product_token', $product_token)->first();
			$file= $image->product_image;
			$filename = public_path().'/storage/product/'.$file;
			File::delete($filename);
  }

  public static function dropProductfile($product_token){

    $image = DB::table('product')->where('product_token', $product_token)->first();
			$file= $image->product_file;
			$filename = public_path().'/storage/product/'.$file;
			File::delete($filename);
  }

	public static function productData()
  {

    $value=DB::table('product')->join('users','users.id','product.user_id')->where('product.product_drop_status','=','no')->where('product.product_page_parent','=',0)->orderBy('product.product_id', 'desc')->get();
    return $value;

  }

  public static function userproductData($user_token)
  {

    $value=DB::table('product')->join('users','users.id','product.user_id')->where('product.product_drop_status','=','no')->where('product.user_id','=',$user_token)->where('product.product_page_parent','=',0)->orderBy('product.product_id', 'desc')->get();
    return $value;

  }

  public static function autoSearch($query,$translate)
  {

    $value=DB::table('product')->where('product_name', 'LIKE', '%'. $query. '%')->where('product_drop_status','=','no')->where('language_code','=',$translate)->orderBy('product_name', 'asc')->get();
    return $value;

  }

  public static function deleteimgdata($token){

	$image = DB::table('product_images')->where('proimg_id', '=', $token)->first();
    $file= $image->product_image;
    $filename = public_path().'/storage/product/'.$file;
    File::delete($filename);

	DB::table('product_images')->where('proimg_id', '=', $token)->delete();


  }


  public static function deleteData($token,$data){

	    $image = DB::table('product')->where('product_token', $token)->first();
        $file= $image->product_image;
        $filename = public_path().'/storage/product/'.$file;
		File::delete($filename);


        $file_2= $image->product_file;
        $filename_2 = public_path().'/storage/product/'.$file_2;
		File::delete($filename_2);


		$getall = DB::table('product_images')->where('product_token', $token)->get();
		foreach($getall as $get)
		{
	    $file_main= $get->product_image;
        $filename_main = public_path().'/storage/product/'.$file_main;
        File::delete($filename_main);
		}


		DB::table('product')
      		->where('product_token', $token)
      		->update($data);

  }



  public static function saveproductData($data){

      DB::table('product')->insert($data);


    }
	 public static function updateproductData($product_id,$data){
    DB::table('product')
      ->where('product_id', $product_id)
      ->update($data);
  }

	public static function saveproductImages($imgdata)
  {

      DB::table('product_images')->insert($imgdata);


  }


  public static function wishlistCount($user_id,$token)
  {

    $get=DB::table('wishlist')->where('user_id','=',$user_id)->where('product_token','=',$token)->get();
    $value = $get->count();
    return $value;

  }

  public static function totaluserProduct($user_id)
  {

    $get=DB::table('product')->where('user_id','=',$user_id)->where('product_page_parent','=',0)->get();
    $value = $get->count();
    return $value;

  }

  public static function getreviewData($user_id)
  {

    $get=DB::table('product_rating')->join('product','product.product_id','product_rating.product_id')->where('product.user_id','=', $user_id)->get();
	$value = $get->count();
    return $value;

  }

  public static function getreviewStore($user_id)
  {

    $value=DB::table('product_rating')->join('product','product.product_id','product_rating.product_id')->where('product.user_id','=', $user_id)->get();
	return $value;

  }

  public static function saveWishlist($data){

      DB::table('wishlist')->insert($data);


    }

	public static function removeWishlist($id)
	{
	   DB::table('wishlist')->where('wid', '=', $id)->delete();
	}

	public static function removeCart($delete_id)
	{
	   DB::table('product_orders')->where('ord_id', '=', $delete_id)->delete();
	}

	public static function checkOrder($user_id,$product_token)
  {

    $get=DB::table('product_orders')->where('product_token','=', $product_token)->where('user_id','=', $user_id)->where('order_status','=', 'pending')->get();
	$value = $get->count();
    return $value;

  }
   public static function saveOrder($data)
   {

     DB::table('product_orders')->insert($data);

   }

   public static function updateOrder($user_id,$order_status,$product_token,$updata)
   {
    DB::table('product_orders')
	  ->where('user_id', $user_id)
	  ->where('order_status', $order_status)
	  ->where('product_token', $product_token)
      ->update($updata);
   }

   public static function viewOrder($user_id,$translate)
  {

    $value=DB::table('product_orders')->join('users','users.id','product_orders.product_user_id')->join('product','product.product_token','product_orders.product_token')->where('product_orders.user_id', '=', $user_id)->where('product_orders.order_status','=','pending')->where('product.language_code','=',$translate)->orderBy('product_orders.ord_id', 'asc')->get();
    return $value;

  }

  public static function viewOrderSingle($user_id)
  {

    $value=DB::table('product_orders')->join('users','users.id','product_orders.product_user_id')->join('product','product.product_token','product_orders.product_token')->where('product_orders.user_id', '=', $user_id)->where('product_orders.order_status','=','pending')->orderBy('product_orders.ord_id', 'desc')->first();
    return $value;

  }

  public static function cartCount($user_id)
  {

    $get=DB::table('product_orders')->where('order_status','=', 'pending')->where('user_id','=', $user_id)->get();
	$value = $get->count();
    return $value;

  }


  public static function updateOrders($or_id,$order_data)
  {
    DB::table('product_orders')
      ->where('ord_id', $or_id)
	  ->where('order_status', 'pending')
      ->update($order_data);
  }

  public static function totalCheckout()
  {

    $get=DB::table('product_checkout')->where('payment_status','=', 'completed')->get();
	$value = $get->count();
    return $value;

  }

  public static function refundRequest()
  {

    $get=DB::table('product_refund')->where('dispute_status','=', '')->get();
	$value = $get->count();
    return $value;

  }

  public static function withdrawalRequest()
  {

    $get=DB::table('product_withdraw')->where('withdraw_status','=', 'pending')->get();
	$value = $get->count();
    return $value;

  }


  public static function checkCheckout($token)
  {

    $get=DB::table('product_checkout')->where('token','=', $token)->where('payment_status','=', 'pending')->get();
	$value = $get->count();
    return $value;

  }

  public static function saveCheckout($save_data)
   {

     DB::table('product_checkout')->insert($save_data);

   }

   public static function updateCheckout($token,$update_data)
  {
    DB::table('product_checkout')
      ->where('token', $token)
	  ->where('payment_status', 'pending')
      ->update($update_data);
  }

  public static function upOrders($user_id,$uporder)
  {
    DB::table('product_orders')
      ->where('user_id', $user_id)
	  ->where('order_status', 'pending')
      ->update($uporder);
  }

  public static function returnOrders($ord_token,$order_update)
  {
    DB::table('product_orders')
      ->where('purchase_token', $ord_token)
	  ->where('order_status', 'pending')
      ->update($order_update);
  }
  public static function returnCheckout($ord_token,$check_update)
  {
    DB::table('product_checkout')
      ->where('purchase_token', $ord_token)
	  ->where('payment_status', 'pending')
      ->update($check_update);
  }

  public static function doneOrder($ord_token)
  {

    $get=DB::table('product_orders')->where('purchase_token','=', $ord_token)->where('order_status','=', 'completed')->get();
	$value = $get->count();
    return $value;

  }
  public static function getOrders($ord_token)
  {

    $value=DB::table('product_orders')->where('purchase_token','=', $ord_token)->where('order_status','=', 'completed')->get();
	return $value;

  }
  public static function editedOrder($order_id,$edit_data)
  {
    DB::table('product_orders')
      ->where('ord_id', $order_id)
	  ->where('order_status', 'completed')
      ->update($edit_data);
  }

  public static function getCheckout($ord_token)
  {

    $value=DB::table('product_checkout')->join('users','users.id','product_checkout.user_id')->where('product_checkout.purchase_token', '=', $ord_token)->first();
    return $value;

  }


  public static function gettotalProducts()
  {

    $get=DB::table('product')->where('product_drop_status','=','no')->where('product_page_parent','=',0)->orderBy('product_id', 'desc')->get();
	$value = $get->count();
    return $value;

  }

	/* products */


	/* coupon */

	public static function singleCoupon($coupon)
   {

    $value=DB::table('coupon')->where('coupon_code','=',$coupon)->where('coupon_status','=',1)->first();
    return $value;

   }


	public static function checkCoupon($coupon)
   {
    $today_date = date('Y-m-d h:i a');
    $get=DB::table('coupon')->where('coupon_start_date','<=',$today_date)->where('coupon_end_date','>=',$today_date)->where('coupon_code','=',$coupon)->where('coupon_status','=',1)->get();
    $value = $get->count();
    return $value;

   }

   public static function getCoupon($coupon,$user_id)
  {

    $value=DB::table('coupon')->join('product_orders','product_orders.product_user_id','coupon.user_id')->where('coupon.coupon_code','=',$coupon)->where('coupon.coupon_status','=',1)->where('product_orders.order_status','=','pending')->where('product_orders.user_id','=',$user_id)->get();
    return $value;

  }


  public static function updateCoupon($order_id,$data)
  {
    DB::table('product_orders')
      ->where('ord_id', $order_id)
      ->update($data);
  }

  public static function removeCoupon($coupon,$user_id,$data)
  {
    DB::table('product_orders')
      ->where('coupon_code', $coupon)
	  ->where('user_id', $user_id)
	  ->where('order_status', 'pending')
      ->update($data);
  }
  /* coupon */

  /* purchase */

  public static function myPurchase($user_id)
  {
    $value=DB::table('product_checkout')->where('user_id','=',$user_id)->orderBy('cid', 'desc')->get();
    return $value;
  }

  public static function myOrderDetails($user_id)
  {
    $value=DB::table('product_orders')->join('users','users.id','product_orders.user_id')->join('product','product.product_token','product_orders.product_token')->where('product_orders.product_user_id','=',$user_id)->where('product.product_page_parent','=',0)->orderBy('product_orders.ord_id', 'desc')->get();
    return $value;
  }


  public static function myOrders($token,$user_id)
  {
    $value=DB::table('product_orders')->join('users','users.id','product_orders.product_user_id')->join('product','product.product_token','product_orders.product_token')->where('product_orders.user_id','=',$user_id)->where('product_orders.purchase_token','=',$token)->where('product.product_page_parent','=',0)->orderBy('product_orders.ord_id', 'desc')->get();
    return $value;
  }

  public static function singleOrders($ord_id,$token)
  {
    $value=DB::table('product_orders')->join('users','users.id','product_orders.product_user_id')->join('product','product.product_token','product_orders.product_token')->where('product_orders.ord_id','=',$ord_id)->where('product_orders.purchase_token','=',$token)->first();
    return $value;
  }

  public static function singlePurchase($token,$user_id)
  {
    $value=DB::table('product_checkout')->where('purchase_token','=',$token)->where('user_id','=',$user_id)->first();
    return $value;
  }

  public static function singleOrderdetails($token)
  {
    $value=DB::table('product_checkout')->where('purchase_token','=',$token)->first();
    return $value;
  }

  public static function singleCountry($country_id)
  {
    $value=DB::table('country')->where('country_id','=',$country_id)->first();
    return $value;
  }

  public static function updateTrack($user_id,$order_id,$update_data)
  {
    DB::table('product_orders')
      ->where('ord_id','=', $order_id)
	  ->where('product_user_id','=', $user_id)
      ->update($update_data);
  }

  public static function updateadminTrack($order_id,$update_data)
  {
    DB::table('product_orders')
      ->where('ord_id','=', $order_id)
	  ->update($update_data);
  }

  public static function orderTrack($order_id)
  {
    $value=DB::table('product_orders')->join('product','product.product_id','product_orders.product_id')->join('product_checkout','product_checkout.purchase_token','product_orders.purchase_token')->where('product_orders.ord_id','=',$order_id)->where('product_orders.order_status','=','completed')->first();
    return $value;
  }

  public static function orderTrackCount($order_id)
  {
    $get=DB::table('product_orders')->join('product','product.product_id','product_orders.product_id')->join('product_checkout','product_checkout.purchase_token','product_orders.purchase_token')->where('product_orders.ord_id','=',$order_id)->where('product_orders.order_status','=','completed')->get();
    $value = $get->count();
	return $value;
  }

  /* purchase */

  /* refund */

  public static function checkRefund($purchase_token,$order_id,$buyer_id,$vendor_id)
  {

    $get=DB::table('product_refund')->where('purchase_token','=', $purchase_token)->where('order_id','=', $order_id)->where('buyer_id','=', $buyer_id)->where('vendor_id','=', $vendor_id)->where('dispute_status','!=', 'declined')->get();
	$value = $get->count();
    return $value;

  }

  public static function saveRefund($save_refund)
   {

     DB::table('product_refund')->insert($save_refund);

   }

  /* refund */

  /* rating */

  public static function checkRating($user_id,$product_id,$order_id)
  {

    $get=DB::table('product_rating')->where('product_id','=', $product_id)->where('order_id','=', $order_id)->where('user_id','=', $user_id)->get();
	$value = $get->count();
    return $value;

  }

  public static function saveRating($save_rating)
   {

     DB::table('product_rating')->insert($save_rating);

   }

   public static function updateRating($user_id,$product_id,$order_id,$update_rating)
  {
    DB::table('product_rating')
      ->where('product_id','=', $product_id)
	  ->where('user_id','=', $user_id)
	  ->where('order_id','=', $order_id)
      ->update($update_rating);
  }

  public static function getreviewCount($product_id)
  {

    $get=DB::table('product_rating')->where('product_id','=', $product_id)->get();
	$value = $get->count();
    return $value;

  }

  public static function getreviewView($product_id)
  {
    $value = DB::table('product_rating')->where('product_id','=', $product_id)->get();
	return $value;
  }

  public static function getreviewItems($product_id)
  {
    $value = DB::table('product_rating')->join('users','users.id','product_rating.user_id')->join('product','product.product_id','product_rating.product_id')->where('product_rating.product_id','=', $product_id)->orderBy('product_rating.rate_id', 'desc')->get();
	return $value;
  }

  /* rating */

  /* wallet */

   public static function getdrawalData($user_id)
  {

    $value=DB::table('product_withdraw')->where('user_id','=',$user_id)->orderBy('wid', 'desc')->get();
    return $value;

  }

  public static function savedrawalData($data)
  {

      DB::table('product_withdraw')->insert($data);


  }

  /* wallet */

  /* orders */

  public static function getorderProduct()
  {

    $value=DB::table('product_checkout')->join('users','users.id','product_checkout.user_id')->orderBy('product_checkout.cid', 'desc')->get();
    return $value;

  }

  public static function adminorderItem($token)
  {

    $value=DB::table('product_orders')->join('product','product.product_id','product_orders.product_id')->join('users','users.id','product_orders.product_user_id')->where('product_orders.purchase_token','=',$token)->orderBy('product_orders.ord_id', 'desc')->get();
    return $value;

  }

   /* orders */

   /* rating */

  public static function getratingItem()
  {

    $value=DB::table('product_rating')->join('users','users.id','product_rating.user_id')->join('product','product.product_id','product_rating.product_id')->orderBy('product_rating.rate_id', 'desc')->get();
    return $value;

  }

  public static function dropRating($rating_id){



	DB::table('product_rating')->where('rate_id', '=', $rating_id)->delete();


  }

  /* rating */

  /* admin refund */

   public static function getrefundItem()
  {

    $value=DB::table('product_refund')->join('users','users.id','product_refund.buyer_id')->join('product','product.product_id','product_refund.product_id')->orderBy('product_refund.dispute_id', 'desc')->get();
    return $value;

  }


  public static function refundupData($refund_id,$refundata)
  {
    DB::table('product_refund')
      ->where('dispute_id', $refund_id)
	  ->update($refundata);
  }
  /* admin refund */

  /* admin withdrawal */

  public static function getwithdrawalData()
  {

    $value=DB::table('product_withdraw')->join('users','users.id','product_withdraw.user_id')->orderBy('product_withdraw.wid', 'desc')->get();
    return $value;

  }


  public static function updatedrawalData($wd_id,$user_id,$drawal_data)
  {
    DB::table('product_withdraw')
      ->where('wid', $wd_id)
	  ->where('user_id',$user_id)
      ->update($drawal_data);
  }

  public static function singledrawalData($wd_id)
  {
    $value = DB::table('product_withdraw')
      ->where('wid', $wd_id)
      ->first();
	return $value;
  }

  /* admin withdrawal */


  public static function orderdataCheck($check_date)
  {

    $get=DB::table('product_checkout')->where('payment_status','=','completed')->where('payment_date','=',$check_date)->get();
	$value = $get->count();
    return $value;

  }

  public static function itemapprovedCheck($status)
  {

    $get=DB::table('product')->where('product_drop_status','=','no')->where('product_status','=',$status)->get();
	$value = $get->count();
    return $value;

  }

  public static function productViews($token)
  {

    $value=DB::table('product')->where('token','=',$token)->where('product_page_parent','=',0)->get();
    return $value;

  }

  public static function productGet($token)
  {

    $get=DB::table('product')->where('token','=',$token)->where('product_page_parent','=',0)->get();
    $value = $get->count();
    return $value;

  }
  public static function getLastInsertedId($data){

      $id = DB::table('product')->insertGetId($data);


    }
   public static function singlar($product_id){
    $value = DB::table('product')
      ->where('product_page_parent','=', 0)
	  ->where('product_id','=', $product_id)
      ->first();
	return $value;
  }
  public static function others($product_id,$code){
    $value = DB::table('product')
      ->where('product_page_parent','=', $product_id)
	  ->where('language_code','=', $code)
      ->first();
	return $value;
  }

  public static function productCounts($code,$product_id)
  {

    $get=DB::table('product')->where('language_code','=',$code)->where('product_page_parent','=',$product_id)->get();
    $value = $get->count();
    return $value;

  }

  public static function anotherProduct($product_id,$code,$updata){
    DB::table('product')
      ->where('product_page_parent', $product_id)
	  ->where('language_code', $code)
      ->update($updata);
  }


  public static function GetAllProducts()
  {

    $value=DB::table('product')->get();
	return $value;

  }

  public static function GetSelectedProducts($user_id)
  {

    $value=DB::table('product')->where('user_id','=',$user_id)->get();
	return $value;

  }

    public static function getProductid($user_id,$oid)
    {

        $value=DB::table('product_orders')->where('user_id','=',$user_id)->where('ord_id',$oid)->first();
        if(!empty($value)){
            $values=DB::table('product')->where('product_id',$value->product_id)->first();
        }
        else{
            $values =array();
        }



        return $values;

    }

    public static function getorderDetils($user_id,$oid)
    {

        $value=DB::table('product_orders')->where('user_id','=',$user_id)->where('ord_id',$oid)->first();

        return $value;

    }



}
