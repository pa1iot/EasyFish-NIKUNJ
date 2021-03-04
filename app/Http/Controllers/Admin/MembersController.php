<?php

namespace ZigKart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Session;
use ZigKart\Models\Members;
use ZigKart\Models\Settings;
use ZigKart\Models\Volunteers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use URL;
use Mail;


class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	
	
	public function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
	
	
  
	/* edit profile */
		
	
	
	
	
	public function edit_profile()
    {
        $token = Auth::user()->id;
		$edit['userdata'] = Members::editprofileData($token);
		
		return view('admin.edit-profile', [ 'edit' => $edit, 'token' => $token]);
		
    }
	
	
	
	public function update_profile(Request $request)
	{
	
	   $name = $request->input('name');
	   $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 
		 
		 
		  $token = $request->input('edit_id');
		 
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:3000',
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
		     
			Members::droprofilePhoto($token); 
		   
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = $request->input('save_photo');
		  }
		  
		 
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email,'user_type' => $user_type, 'password' => $pass, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'));
 
            
            
			Members::updateprofileData($token, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	/* edit profile */
	
	
	/* vendor */
	
	public function vendor()
    {
        
		$userData['data'] = Members::getvendorData();
		return view('admin.vendor',[ 'userData' => $userData]);
    }
	
	public function add_vendor()
	{
	   
	   return view('admin.add-vendor');
	}
	
	
	public function edit_vendor($token)
	{
	   
	   $edit['userdata'] = Members::editData($token);
	   return view('admin.edit-vendor', [ 'edit' => $edit, 'token' => $token]);
	}
	
	/* vendor */
	
	
	/* administrator */
	
	public function administrator()
    {
        
		
		$userData['data'] = Members::getadminData();
		return view('admin.administrator',[ 'userData' => $userData]);
    }
	
	public function add_administrator()
	{
	   
	   return view('admin.add-administrator');
	}
	
	
	public function save_administrator(Request $request)
	{
 
         $sid = 1;
		 $setting['setting'] = Settings::editGeneral($sid);
		 $site_max_image_size = $setting['setting']->site_max_image_size;
		 $name = $request->input('name');
		 $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 $password = bcrypt($request->input('password'));
		 if(!empty($request->input('earnings')))
		 {
		 $earnings = $request->input('earnings');
         }
		 else
		 {
		   $earnings = 0;
		 }
		 $page_url = '/admin/administrator';
		 if(!empty($request->input('user_permission')))
	     {
	      
		  $user_permission = "";
		  foreach($request->input('user_permission') as $permission)
		  {
		     $user_permission .= $permission.',';
		  }
		  $user_permissions = rtrim($user_permission,",");
		  
	     }
	     else
	     {
	     $user_permissions = "";
	     }
		 
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png|max:'.$site_max_image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = "";
		  }
		  $verified = 1;
		  $token = $this->generateRandomString();
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $password, 'earnings' => $earnings, 'user_photo' => $user_image, 'verified' => $verified, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'user_token' => $token, 'user_permission' => $user_permissions);
 
            
            Members::insertData($data);
            return redirect($page_url)->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  
  public function delete_administrator($token){

      $data = array('drop_status'=>'yes');
	  
      Members::deleteData($token,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  public function edit_administrator($token)
	{
	   
	   $edit['userdata'] = Members::editData($token);
	   return view('admin.edit-administrator', [ 'edit' => $edit, 'token' => $token]);
	}
	
	
	public function update_administrator(Request $request)
	{
	
	   $sid = 1;
		 $setting['setting'] = Settings::editGeneral($sid);
		 $site_max_image_size = $setting['setting']->site_max_image_size;
		 $name = $request->input('name');
		 $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 if(!empty($request->input('earnings')))
		 {
		 $earnings = $request->input('earnings');
         }
		 else
		 {
		   $earnings = 0;
		 }
		 $page_url = '/admin/administrator';
		 if(!empty($request->input('user_permission')))
	     {
	      
		  $user_permission = "";
		  foreach($request->input('user_permission') as $permission)
		  {
		     $user_permission .= $permission.',';
		  }
		  $user_permissions = rtrim($user_permission,",");
		  
	     }
	     else
	     {
	     $user_permissions = "";
	     }
		 $token = $request->input('user_token');
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png|max:'.$site_max_image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = $request->input('save_photo');
		  }
		  $data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $pass, 'earnings' => $earnings, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'), 'user_permission' => $user_permissions);
          Members::updateData($token, $data);
          return redirect($page_url)->with('success', 'Update successfully.');
            
 
       } 
	
	
	}
  
	
	/* administrator */
	
	/* customer */
	
    public function customer()
    {
        
		
		$userData['data'] = Members::getuserData();
		return view('admin.customer',[ 'userData' => $userData]);
    }
	
	public function add_customer()
	{
	   
	   return view('admin.add-customer');
	}
	
	
	
	
	public function save_customer(Request $request)
	{
 
         $sid = 1;
		 $setting['setting'] = Settings::editGeneral($sid);
		 $site_max_image_size = $setting['setting']->site_max_image_size;
		 $name = $request->input('name');
		 $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 $password = bcrypt($request->input('password'));
		 if(!empty($request->input('earnings')))
		 {
		 $earnings = $request->input('earnings');
         }
		 else
		 {
		   $earnings = 0;
		 }
		 
		 if($user_type == 'customer')
		 {
		    $page_url = '/admin/customer';
		 }
		 else
		 {
		   $page_url = '/admin/vendor';
		 }
		 
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png|max:'.$site_max_image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = "";
		  }
		  $verified = 1;
		  $token = $this->generateRandomString();
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $password, 'earnings' => $earnings, 'user_photo' => $user_image, 'verified' => $verified, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'user_token' => $token);
 
            
            Members::insertData($data);
            return redirect($page_url)->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  
  
  public function delete_customer($token){

      $data = array('drop_status'=>'yes');
	  
      Members::deleteData($token,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  public function edit_customer($token)
	{
	   
	   $edit['userdata'] = Members::editData($token);
	   return view('admin.edit-customer', [ 'edit' => $edit, 'token' => $token]);
	}
	
	
	public function update_customer(Request $request)
	{
	
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $site_max_image_size = $setting['setting']->site_max_image_size;
	   $name = $request->input('name');
	   $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 
		 if(!empty($request->input('earnings')))
		 {
		 $earnings = $request->input('earnings');
         }
		 else
		 {
		   $earnings = 0;
		 }
		 
		 if($user_type == 'customer')
		 {
		    $page_url = '/admin/customer';
		 }
		 else
		 {
		   $page_url = '/admin/vendor';
		 }
		 
		  $token = $request->input('edit_id');
		 
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$site_max_image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
		     
			Members::droPhoto($token); 
		   
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = $request->input('save_photo');
		  }
		  
		 
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $pass, 'earnings' => $earnings, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'));
 
            
            
			Members::updateData($token, $data);
            return redirect($page_url)->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	/* customer */
	
	
	
	
	
}
