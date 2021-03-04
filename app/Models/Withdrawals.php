<?php

namespace ZigKart\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Withdrawals extends Model
{
    
	
  public static function getdrawalData($user_id)
  {
    
    $value=DB::table('withdrawal')->where('wd_user_id','=',$user_id)->orderBy('wd_id', 'desc')->get(); 
    return $value;
	
  }
  
   
  
  public static function savedrawalData($data)
  {
   
      DB::table('withdrawal')->insert($data);
     
 
  }
    
 
 
  
  public static function getwithdrawalData()
  {
    
    $value=DB::table('withdrawal')->join('users','users.id','withdrawal.wd_user_id')->orderBy('withdrawal.wd_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  
  public static function totalWithdrawal()
  {
    
    $get=DB::table('withdrawal')->orderBy('withdrawal.wd_id', 'desc')->get();
	$value = $get->count(); 
    return $value;
	
  }
  
  
  public static function updatedrawalData($wd_id,$user_id,$drawal_data)
  {
    DB::table('withdrawal')
      ->where('wd_id', $wd_id)
	  ->where('wd_user_id',$user_id)
      ->update($drawal_data);
  }
  
  public static function singledrawalData($wd_id)
  {
    $value = DB::table('withdrawal')
      ->where('wd_id', $wd_id)
      ->first();
	return $value;
  }
	
  
  
  
}
