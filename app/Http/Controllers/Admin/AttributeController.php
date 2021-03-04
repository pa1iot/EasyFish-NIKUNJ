<?php

namespace ZigKart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Session;
use ZigKart\Models\Attribute;
use ZigKart\Models\Settings;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use ZigKart\Models\Languages;

class AttributeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	
	/* attribute value */
	
	public function attribute_value()
    {
        
		
		$valueData['view'] = Attribute::getvalueData();
		return view('admin.attribute-value',[ 'valueData' => $valueData]);
    }
	
	
	public function add_attribute_value()
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $typeData['view'] = Attribute::gettypeData();
	   return view('admin.add-attribute-value',[ 'typeData' => $typeData, 'language' => $language, 'languages' => $languages]);
	}
	
	
	public function save_attribute_value(Request $request)
	{
         $data = $request->all();   
		 
		 $this->validate($request, [
		 
		     

        	]);
        
		$rules = array(
				'attribute_value_slug' => ['required',  Rule::unique('product_attribute_value') -> where(function($sql){ $sql->where('attribute_value_drop_status','=','no');})],
				
	     );
		$messages = array();
		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
		        
                if(!empty($data['attribute_value']))
				{
				   $attribute_value = $data['attribute_value'];
				}
				else
				{
				   $attribute_value = "";
				}
				
		        $attribute_type = $data['attribute_type'];
		        $user_id = $data['user_id'];
		        $attribute_value_slug = $this->attribute_slug($data['attribute_value_slug']);
		        $attribute_status = $data['attribute_status'];
				if(!empty($data['attribute_value_price']))
				{
				   $attribute_value_price = $data['attribute_value_price'];
				}
				else
				{
				   $attribute_value_price = 0;
				}
		        $token = $data['token'];
				foreach($data['language_code'] as $index => $code)
				{
				
				   $attributevalue = $attribute_value[$index];
				   
				   
				
					if($code=='en')
					   {
						   $parent=0;
					   }
					   else
					   {
						  
						   $pager = Attribute::attrivalueViews($token);
						   $check_page = Attribute::attrivalueGet($token);
						   if($check_page==0)
						   {
							$parent = $insertedId;				
						   }
						   else
						   {
							$parent=$pager[0]->attribute_value_id;
						   }
					   
					  }
				    
					$record = array('attribute_id' => $attribute_type, 'user_id' => $user_id, 'attribute_value' => $attributevalue, 'attribute_value_price' => $attribute_value_price, 'attribute_value_slug' => $attribute_value_slug, 'attribute_value_status' => $attribute_status, 'token' => $token, 'language_code' => $code, 'attrivalue_page_parent' => $parent);
					$insertedId = Attribute::getLastAttriId($record);
		      }
			  return redirect('/admin/attribute-value')->with('success', 'Insert successfully.');
		}
			
		
     
    
  }
	
	/*public function save_attribute_value(Request $request)
	{
 
    
         $attribute_type = $request->input('attribute_type');
		 $user_id = $request->input('user_id');
		 $attribute_value = $request->input('attribute_value');
         $attribute_value_slug = $this->attribute_slug($attribute_value);
		 $attribute_status = $request->input('attribute_status');
		 	
		 
		
		 
		 
         
		 $request->validate([
							'attribute_type' => 'required',
							'attribute_value' => 'required',
							'attribute_status' => 'required',
							
         ]);
		 $rules = array(
				'attribute_value' => ['required',  Rule::unique('product_attribute_value') -> where(function($sql){ $sql->where('attribute_value_drop_status','=','no');})],
				
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
		
		
		 
		$data = array('attribute_id' => $attribute_type, 'user_id' => $user_id, 'attribute_value' => $attribute_value, 'attribute_value_slug' => $attribute_value_slug, 'attribute_value_status' => $attribute_status);
        Attribute::insertvalueData($data);
        return redirect('/admin/attribute-value')->with('success', 'Insert successfully.');
            
 
       } 
     
    
  } */
  
  
    public function delete_attribute_value($attribute_value_id){

      $data = array('attribute_value_drop_status' => 'yes');
	  
      Attribute::deleteValuedata($attribute_value_id,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_attribute_value($attribute_value_id)
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $typeData['view'] = Attribute::gettypeData();
	   $edit['value'] = Attribute::editValue($attribute_value_id);
	   return view('admin.edit-attribute-value', [ 'edit' => $edit, 'attribute_value_id' => $attribute_value_id, 'typeData' => $typeData, 'language' => $language, 'languages' => $languages]);
	}
	
	public function update_attribute_value(Request $request)
	{
	
	    
		 $data = $request->all();   
		 $attribute_value_id = $data['attribute_value_id'];
		 $this->validate($request, [
	        
	     ]);
       $data = $request->all();
	   $rules = array(
				
				
	     );
	   $messages = array();
	   $validator = Validator::make($request->all(), $rules, $messages);
	   if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
			
			if(!empty($data['attribute_value']))
				{
				   $attribute_value = $data['attribute_value'];
				}
				else
				{
				   $attribute_value = "";
				}
				if(!empty($data['attribute_value_price']))
				{
				   $attribute_value_price = $data['attribute_value_price'];
				}
				else
				{
				   $attribute_value_price = 0;
				}
		        $attribute_type = $data['attribute_type'];
		        $user_id = $data['user_id'];
		        $attribute_value_slug = $this->attribute_slug($data['attribute_value_slug']);
		        $attribute_status = $data['attribute_status'];
		$token = $data['token'];
		foreach($data['language_code'] as $index => $code)
		{
		
		   $attributevalue = $attribute_value[$index];
		   	
		   	
		   if($code=="en")
			{
			  
			  
			  
              $data = array('attribute_id' => $attribute_type, 'attribute_value' => $attributevalue, 'attribute_value_price' => $attribute_value_price, 'attribute_value_slug' => $attribute_value_slug, 'attribute_value_status' => $attribute_status, 'language_code' => $code);
              Attribute::updateValuedata($attribute_value_id, $data);
			  
			  
			}
			else
			{
			    $counts = Attribute::attrivalCount($code,$attribute_value_id);
			    if($counts==0)
				 {
						if(!empty($attributevalue))
						{
						   $attrivalue = $attributevalue;
						   
						}
						else
						{
						   $attrivalue = "";
						   
						}
					 
					 $save = array('attribute_id' => $attribute_type, 'user_id' => $user_id,  'attribute_value' => $attrivalue, 'attribute_value_price' => $attribute_value_price, 'attribute_value_slug' => $attribute_value_slug, 'attribute_value_status' => $attribute_status, 'language_code' => $code, 'token' => $token, 'attrivalue_page_parent' => $attribute_value_id);
					 
				     Attribute::insertvalueData($save);
					 					 
				 }
				 else
				 {
				   
				   $updata = array('attribute_id' => $attribute_type, 'attribute_value' => $attributevalue, 'attribute_value_price' => $attribute_value_price, 'attribute_value_slug' => $attribute_value_slug, 'attribute_value_status' => $attribute_status);
				  Attribute::anotherAttri($attribute_value_id,$code,$updata); 
				  
				 }
			
			}
		}
		return redirect('/admin/attribute-value')->with('success', 'Update successfully.');
		
		}
		
	
	}
	
	/*public function update_attribute_value(Request $request)
	{
	
	     $attribute_type = $request->input('attribute_type');
		 $attribute_value_id = $request->input('attribute_value_id');
		 $attribute_value = $request->input('attribute_value');
         $attribute_value_slug = $this->attribute_slug($attribute_value);
		 $attribute_status = $request->input('attribute_status');
		 
         
		 $request->validate([
							'attribute_type' => 'required',
							'attribute_value' => 'required',
							'attribute_status' => 'required',
							
         ]);
		 $rules = array(
				'attribute_value' => ['required',  Rule::unique('product_attribute_value') ->ignore($attribute_value_id, 'attribute_value_id') -> where(function($sql){ $sql->where('attribute_value_drop_status','=','no');})],
				
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
		
		
		$data = array('attribute_id' => $attribute_type, 'attribute_value' => $attribute_value, 'attribute_value_slug' => $attribute_value_slug, 'attribute_value_status' => $attribute_status);
        Attribute::updateValuedata($attribute_value_id, $data);
        return redirect('/admin/attribute-value')->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}*/
	
	
	/* attribute value */
	
	
	
	/* attribute type */
	
	
	public function attribute_type()
    {
        
		
		$typeData['view'] = Attribute::gettypeData();
		return view('admin.attribute-type',[ 'typeData' => $typeData]);
    }
	
	
    
	
	public function add_attribute_type()
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   return view('admin.add-attribute-type',[ 'language' => $language, 'languages' => $languages]);
	}
	
	
	public function attribute_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	public function save_attribute_type(Request $request)
	{
         $data = $request->all();   
		 
		 $this->validate($request, [
		 
		     

        	]);
        
		$rules = array(
				'attribute_slug' => ['required',  Rule::unique('product_attribute') -> where(function($sql){ $sql->where('attribute_drop_status','=','no');})],
				
	     );
		$messages = array();
		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
		        
                if(!empty($data['attribute_name']))
				{
				   $attribute_name = $data['attribute_name'];
				}
				else
				{
				   $attribute_name = "";
				}
				$user_id = $data['user_id'];
		        $attribute_slug = $this->attribute_slug($data['attribute_slug']);
				 $attribute_status = $data['attribute_status'];
				 $attribute_search = $data['attribute_search'];
				
				 if(!empty($data['attribute_order']))
				 {
					$attribute_order = $data['attribute_order'];
				 }
				 else
				 {
				   $attribute_order = 0;
				 }
				$token = $data['token'];
				foreach($data['language_code'] as $index => $code)
				{
				
				   $attributename = $attribute_name[$index];
				   
				   
				
					if($code=='en')
					   {
						   $parent=0;
					   }
					   else
					   {
						  
						   $pager = Attribute::attributeViews($token);
						   $check_page = Attribute::attributeGet($token);
						   if($check_page==0)
						   {
							$parent = $insertedId;				
						   }
						   else
						   {
							$parent=$pager[0]->attribute_id;
						   }
					   
					  }
				    
					 
					$record = array('attribute_name' => $attributename, 'user_id' => $user_id, 'attribute_slug' => $attribute_slug,  'attribute_search' => $attribute_search, 'attribute_status' => $attribute_status, 'attribute_order' => $attribute_order, 'token' => $token, 'language_code' => $code, 'attribute_page_parent' => $parent);
					
					$insertedId = Attribute::getLastInsertedId($record);
		      }
			   return redirect('/admin/attribute-type')->with('success', 'Insert successfully.');
		}
			
		
     
    
  }
	
	/*
	public function save_attribute_type(Request $request)
	{
 
    
         $attribute_name = $request->input('attribute_name');
		 $user_id = $request->input('user_id');
		 
         $attribute_slug = $this->attribute_slug($attribute_name);
		 $attribute_status = $request->input('attribute_status');
		 $attribute_search = $request->input('attribute_search');
		
		 if($request->input('attribute_order'))
		 {
		    $attribute_order = $request->input('attribute_order');
		 }
		 else
		 {
		   $attribute_order = 0;
		 }
		
		 
		 
         
		 $request->validate([
							'attribute_name' => 'required',
							'attribute_search' => 'required',
							'attribute_status' => 'required',
							
         ]);
		 $rules = array(
				'attribute_name' => ['required',  Rule::unique('product_attribute') -> where(function($sql){ $sql->where('attribute_drop_status','=','no');})],
				
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
		
		
		 
		$data = array('attribute_name' => $attribute_name, 'user_id' => $user_id, 'attribute_slug' => $attribute_slug,  'attribute_search' => $attribute_search, 'attribute_status' => $attribute_status, 'attribute_order' => $attribute_order);
        Attribute::inserttypeData($data);
        return redirect('/admin/attribute-type')->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  */
  
  
  public function delete_attribute($attribute_id){

      $data = array('attribute_drop_status' => 'yes');
	  
      Attribute::deleteTypedata($attribute_id,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_attribute_type($attribute_id)
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $edit['type'] = Attribute::editType($attribute_id);
	   return view('admin.edit-attribute-type', [ 'edit' => $edit, 'attribute_id' => $attribute_id, 'language' => $language, 'languages' => $languages]);
	}
	
	
	public function update_attribute_type(Request $request)
	{
	
	    
		 $data = $request->all();   
		 $attribute_id = $data['attribute_id'];
		 $this->validate($request, [
	        
	     ]);
       $data = $request->all();
	   $rules = array(
				
				
	     );
	   $messages = array();
	   $validator = Validator::make($request->all(), $rules, $messages);
	   if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
			
			if(!empty($data['attribute_name']))
				{
				   $attribute_name = $data['attribute_name'];
				}
				else
				{
				   $attribute_name = "";
				}
				
		        $attribute_slug = $this->attribute_slug($data['attribute_slug']);
				 $attribute_status = $data['attribute_status'];
				 $attribute_search = $data['attribute_search'];
				$user_id = $data['user_id'];
				 if(!empty($data['attribute_order']))
				 {
					$attribute_order = $data['attribute_order'];
				 }
				 else
				 {
				   $attribute_order = 0;
				 }
		$token = $data['token'];
		foreach($data['language_code'] as $index => $code)
		{
		
		   $attributename = $attribute_name[$index];
		   	
		   	
		   if($code=="en")
			{
			  
			  $data = array('attribute_name' => $attributename, 'attribute_slug' => $attribute_slug,  'attribute_search' => $attribute_search, 'attribute_status' => $attribute_status, 'attribute_order' => $attribute_order, 'language_code' => $code);
              Attribute::updateTypedata($attribute_id, $data);
		
			  
			}
			else
			{
			    $counts = Attribute::attributeCount($code,$attribute_id);
			    if($counts==0)
				 {
						if(!empty($attributename))
						{
						   $attributtyname = $attributename;
						   
						}
						else
						{
						   $attributtyname = "";
						   
						}
					 
					 $save = array('attribute_name' => $attributtyname, 'user_id' => $user_id, 'attribute_slug' => $attribute_slug,  'attribute_search' => $attribute_search, 'attribute_status' => $attribute_status, 'attribute_order' => $attribute_order, 'language_code' => $code, 'token' => $token, 'attribute_page_parent' => $attribute_id);
					 
				     Attribute::inserttypeData($save);
					 					 
				 }
				 else
				 {
				   
				   
				   $updata = array('attribute_name' => $attributename, 'attribute_slug' => $attribute_slug,  'attribute_search' => $attribute_search, 'attribute_status' => $attribute_status, 'attribute_order' => $attribute_order);
				   
				  Attribute::anotherAttribute($attribute_id,$code,$updata); 
				  
				 }
			
			}
		}
		return redirect('/admin/attribute-type')->with('success', 'Update successfully.');
		
		}
		
	
	}	
	
	
	/*public function update_attribute_type(Request $request)
	{
	
	     $attribute_name = $request->input('attribute_name');
		 $attribute_id = $request->input('attribute_id');
		 
         $attribute_slug = $this->attribute_slug($attribute_name);
		 $attribute_status = $request->input('attribute_status');
		 $attribute_search = $request->input('attribute_search');
		
		 if($request->input('attribute_order'))
		 {
		    $attribute_order = $request->input('attribute_order');
		 }
		 else
		 {
		   $attribute_order = 0;
		 }
		 
         
		 $request->validate([
							'attribute_name' => 'required',
							'attribute_search' => 'required',
							'attribute_status' => 'required',
							
         ]);
		 $rules = array(
				'attribute_name' => ['required',  Rule::unique('product_attribute') ->ignore($attribute_id, 'attribute_id') -> where(function($sql){ $sql->where('attribute_drop_status','=','no');})],
				
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
		
		
		$data = array('attribute_name' => $attribute_name, 'attribute_slug' => $attribute_slug,  'attribute_search' => $attribute_search, 'attribute_status' => $attribute_status, 'attribute_order' => $attribute_order);
        Attribute::updateTypedata($attribute_id, $data);
        return redirect('/admin/attribute-type')->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}*/
	
  
	
	
	
}
