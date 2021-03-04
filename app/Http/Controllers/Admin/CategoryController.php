<?php

namespace ZigKart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Session;
use ZigKart\Models\Category;
use ZigKart\Models\SubCategory;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use ZigKart\Models\Languages;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	/* category */
	
	public function category()
    {
        
		
		$categoryData['category'] = Category::getcategoryData();
		return view('admin.category',[ 'categoryData' => $categoryData]);
    }
    
	
	public function add_category()
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   return view('admin.add-category',[ 'language' => $language, 'languages' => $languages]);
	}
	
	
	public function category_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }
	
	public function save_category(Request $request)
	{
         $data = $request->all();   
		 $image_size = $data['image_size'];
		 $this->validate($request, [
		 
		     'category_image' => 'mimes:jpeg,jpg,png|max:'.$image_size

        	]);
        
		$rules = array(
				'category_slug' => ['required', 'max:255', Rule::unique('category') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		        
                if(!empty($data['category_name']))
				{
				   $category_name = $data['category_name'];
				}
				else
				{
				   $category_name = "";
				}
				
		        $category_slug = $this->category_slug($data['category_slug']);
				$category_status = $request->input('category_status');
				$display_order = $request->input('display_order');
				if ($request->hasFile('category_image')) {
					$image = $request->file('category_image');
					$img_name = time() . '.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/storage/category');
					$imagePath = $destinationPath. "/".  $img_name;
					$image->move($destinationPath, $img_name);
					$category_image = $img_name;
				  }
				  else
				  {
					 $category_image = "";
				  }
		        $token = $data['token'];
				foreach($data['language_code'] as $index => $code)
				{
				
				   $categoryname = $category_name[$index];
				   
				   
				
					if($code=='en')
					   {
						   $parent=0;
					   }
					   else
					   {
						  
						   $pager = Category::categoryViews($token);
						   $check_page = Category::categoryGet($token);
						   if($check_page==0)
						   {
							$parent = $insertedId;				
						   }
						   else
						   {
							$parent=$pager[0]->cat_id;
						   }
					   
					  }
				    
					 
					 $record = array('category_name' => $categoryname, 'category_slug' => $category_slug, 'category_image' => $category_image, 'category_status' => $category_status, 'display_order' => $display_order, 'token' => $token, 'language_code' => $code, 'category_page_parent' => $parent);
		            $insertedId = Category::getLastInsertedId($record);
		      }
			  return redirect('/admin/category')->with('success', 'Insert successfully.');
		}
			
		
     
    
  }
  
	/*
	public function save_category(Request $request)
	{
 
    
         $category_name = $request->input('category_name');
		 $category_slug = $this->category_slug($category_name);
		 $category_status = $request->input('category_status');
		 if(!empty($request->input('display_order')))
		 {
		 $display_order = $request->input('display_order');
		 }
		 else
		 {
		   $display_order = 0;
		 }
		 
		 
         
		 $request->validate([
							'category_name' => 'required',
							'category_status' => 'required',
							
         ]);
		 $rules = array(
				'category_name' => ['required', 'max:255', Rule::unique('category') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('category_image')) {
			$image = $request->file('category_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/category');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$category_image = $img_name;
		  }
		  else
		  {
		     $category_image = "";
		  }
		  
		  
		  
		 
		$data = array('category_name' => $category_name, 'category_slug' => $category_slug, 'category_image' => $category_image, 'category_status' => $category_status, 'display_order' => $display_order);
        Category::insertcategoryData($data);
            return redirect('/admin/category')->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  */
  
  
  public function delete_category($cat_id){

      $data = array('drop_status'=>'yes');
	  
        
      Category::deleteCategorydata($cat_id,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
     
  
  
  public function edit_category($cat_id)
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $edit['category'] = Category::editcategoryData($cat_id);
	   return view('admin.edit-category', [ 'edit' => $edit, 'cat_id' => $cat_id, 'language' => $language, 'languages' => $languages]);
	}
	
	public function update_category(Request $request)
	{
	
	    
		 $data = $request->all();
		 $cat_id = $data['cat_id'];   
		 $image_size = $data['image_size'];
		 $this->validate($request, [
	        'category_image' => 'mimes:jpeg,jpg,png|max:'.$image_size
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
			
			if(!empty($data['category_name']))
			{
			   $category_name = $data['category_name'];
			}
			else
			{
			   $category_name = "";
			}
		    
			$category_slug = $this->category_slug($data['category_slug']);
			$save_category_image = $data['save_category_image'];
			$category_status = $data['category_status'];
			$display_order = $data['display_order'];
			if ($request->hasFile('category_image')) {
		    
			Category::dropCategoryimage($cat_id);
		    
			$image = $request->file('category_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/category');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$category_image = $img_name;
		  }
		  else
		  {
		     $category_image = $save_category_image;
		  }
		$token = $data['token'];
		foreach($data['language_code'] as $index => $code)
		{
		
		   $categoryname = $category_name[$index];
		   	
		   	
		   if($code=="en")
			{
			  $data = array('category_name' => $categoryname, 'category_slug' => $category_slug, 'category_status' => $category_status, 'display_order' => $display_order, 'category_image' => $category_image, 'language_code' => $code);
              Category::updatecategoryData($cat_id, $data);
			  
			  
			}
			else
			{
			    $counts = Category::categoryCount($code,$cat_id);
			    if($counts==0)
				 {
						if(!empty($categoryname))
						{
						   $categoriesname = $categoryname;
						   
						}
						else
						{
						   $categoriesname = "";
						   
						}
					 
					 $save = array('category_name' => $categoriesname, 'category_slug' => $category_slug, 'category_status' => $category_status, 'display_order' => $display_order, 'category_image' => $category_image, 'language_code' => $code, 'token' => $token, 'category_page_parent' => $cat_id);	
				     Category::insertcategoryData($save);
					 					 
				 }
				 else
				 {
				   $updata = array('category_name' => $categoryname, 'category_slug' => $category_slug, 'category_status' => $category_status, 'display_order' => $display_order, 'category_image' => $category_image);
				   
				  Category::anotherCategory($cat_id,$code,$updata); 
				  
				 }
			
			}
		}
		
		return redirect('/admin/category')->with('success', 'Update successfully.');
		
		
		}
		
	
	}
	
	/*
	public function update_category(Request $request)
	{
	
	    $category_name = $request->input('category_name');
		 $category_slug = $this->category_slug($category_name);
		 $category_status = $request->input('category_status');
		 if(!empty($request->input('display_order')))
		 {
		 $display_order = $request->input('display_order');
		 }
		 else
		 {
		   $display_order = 0;
		 }
		 
		 
		 $save_category_image = $request->input('save_category_image');
		 
		 
         $cat_id = $request->input('cat_id');
		 $request->validate([
							'category_name' => 'required',
							'category_status' => 'required',
							
         ]);
		 $rules = array(
				'category_name' => ['required', 'max:255', Rule::unique('category') ->ignore($cat_id, 'cat_id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		
		if ($request->hasFile('category_image')) {
		    
			Category::dropCategoryimage($cat_id);
		    
			$image = $request->file('category_image');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/category');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$category_image = $img_name;
		  }
		  else
		  {
		     $category_image = $save_category_image;
		  }
		  
		  
		  
		
		
		$data = array('category_name' => $category_name, 'category_slug' => $category_slug, 'category_status' => $category_status, 'display_order' => $display_order, 'category_image' => $category_image);
        Category::updatecategoryData($cat_id, $data);
            return redirect('/admin/category')->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	*/
	
	
	/* category */
	
	
	
	/* subcategory */
	
	
	public function subcategory()
    {
        
		
		$subcategoryData['subcategory'] = Category::getsubcategoryData();
		return view('admin.sub-category',[ 'subcategoryData' => $subcategoryData]);
    }
	
	
	public function add_subcategory()
	{
	   
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $categoryData['category'] = Category::allcategoryData();
	   return view('admin.add-subcategory',[ 'categoryData' => $categoryData, 'language' => $language, 'languages' => $languages]);
	}
	
	public function save_subcategory(Request $request)
	{
         $data = $request->all();   
		 
		 $this->validate($request, [
		 
		     

        	]);
        
		$rules = array(
				'subcategory_slug' => ['required', 'max:255', Rule::unique('subcategory') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		        
                if(!empty($data['subcategory_name']))
				{
				   $subcategory_name = $data['subcategory_name'];
				}
				else
				{
				   $subcategory_name = "";
				}
				
		        $subcategory_slug = $this->category_slug($data['subcategory_slug']);
				$subcategory_status = $data['subcategory_status'];
				$cat_id = $data['cat_id'];
				
		        $token = $data['token'];
				foreach($data['language_code'] as $index => $code)
				{
				
				   $subcategoryname = $subcategory_name[$index];
				   
				   
				
					if($code=='en')
					   {
						   $parent=0;
					   }
					   else
					   {
						  
						   $pager = SubCategory::subcategoryViews($token);
						   $check_page = SubCategory::subcategoryGet($token);
						   if($check_page==0)
						   {
							$parent = $insertedId;				
						   }
						   else
						   {
							$parent=$pager[0]->subcat_id;
						   }
					   
					  }
				    
					 
					 		            
					$record = array('cat_id' => $cat_id, 'subcategory_name' => $subcategoryname, 'subcategory_slug' => $subcategory_slug, 'subcategory_status' => $subcategory_status, 'token' => $token, 'language_code' => $code, 'subcategory_page_parent' => $parent);
					$insertedId = SubCategory::getLastInsertedId($record);
		      }
			  return redirect('/admin/sub-category')->with('success', 'Insert successfully.');
		}
			
		
     
    
  }
	
	/*
	public function save_subcategory(Request $request)
	{
 
    
         $cat_id = $request->input('cat_id');
		 $subcategory_name = $request->input('subcategory_name');
		 $subcategory_slug = $this->category_slug($subcategory_name);
		 $subcategory_status = $request->input('subcategory_status');
		
		 
		 
         
		 $request->validate([
							'cat_id' => 'required',
							'subcategory_name' => 'required',
							'subcategory_status' => 'required',
							
         ]);
		 $rules = array(
				
				
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
		
		
		 
		$data = array('cat_id' => $cat_id, 'subcategory_name' => $subcategory_name, 'subcategory_slug' => $subcategory_slug, 'subcategory_status' => $subcategory_status);
        Category::insertsubcategoryData($data);
            return redirect('/admin/sub-category')->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }*/
  
  
	public function delete_subcategory($subcat_id){

      $data = array('drop_status'=>'yes');
	  
        
      Category::deleteSubcategorydata($subcat_id,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  
  public function edit_subcategory($subcat_id)
	{
	   $language['data'] = Languages::pageLanguage();
	   $languages['data'] = Languages::pageLanguage();
	   $categoryData['category'] = Category::allcategoryData();
	   $edit['subcategory'] = Category::editsubcategoryData($subcat_id);
	   return view('admin.edit-subcategory', [ 'edit' => $edit, 'subcat_id' => $subcat_id, 'categoryData' => $categoryData, 'language' => $language, 'languages' => $languages]);
	}
	
	public function update_subcategory(Request $request)
	{
	
	    
		 $data = $request->all();   
		 
		 $this->validate($request, [
	        
	     ]);
       $data = $request->all();
	   $rules = array();
	   $messages = array();
	   $validator = Validator::make($request->all(), $rules, $messages);
	   if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{ 
			
			if(!empty($data['subcategory_name']))
			{
			   $subcategory_name = $data['subcategory_name'];
			}
			else
			{
			   $subcategory_name = "";
			}
		    
			$subcategory_slug = $this->category_slug($data['subcategory_slug']);
			$subcat_id = $data['subcat_id'];
			$cat_id = $data['cat_id'];
			$subcategory_status = $data['subcategory_status'];
		$token = $data['token'];
		foreach($data['language_code'] as $index => $code)
		{
		
		   $subcategoryname = $subcategory_name[$index];
		   	
		   	
		   if($code=="en")
			{
			  
			  
			  $data = array('cat_id' => $cat_id, 'subcategory_name' => $subcategoryname, 'subcategory_slug' => $subcategory_slug, 'subcategory_status' => $subcategory_status, 'language_code' => $code);
			  Category::updatesubcategoryData($subcat_id, $data);
              
			  
			  
			}
			else
			{
			    $counts = SubCategory::subcategoryCount($code,$subcat_id);
			    if($counts==0)
				 {
						if(!empty($subcategoryname))
						{
						   $subcategoriesname = $subcategoryname;
						   
						}
						else
						{
						   $subcategoriesname = "";
						   
						}
					 
					 
					 $save = array('cat_id' => $cat_id, 'subcategory_name' => $subcategoriesname, 'subcategory_slug' => $subcategory_slug, 'subcategory_status' => $subcategory_status, 'language_code' => $code, 'token' => $token, 'subcategory_page_parent' => $subcat_id);	
				     Category::insertsubcategoryData($save);
					 					 
				 }
				 else
				 {
				   
				   $updata = array('cat_id' => $cat_id, 'subcategory_name' => $subcategoryname, 'subcategory_slug' => $subcategory_slug, 'subcategory_status' => $subcategory_status);	
				  SubCategory::anotherCategory($subcat_id,$code,$updata); 
				  
				 }
			
			}
		}
		return redirect('/admin/sub-category')->with('success', 'Update successfully.');
		
		}
		
	
	}
	
	/*
	public function update_subcategory(Request $request)
	{
	
	    $cat_id = $request->input('cat_id');
		 $subcategory_name = $request->input('subcategory_name');
		 $subcategory_slug = $this->category_slug($subcategory_name);
		 $subcategory_status = $request->input('subcategory_status');
		 
		 $subcat_id = $request->input('subcat_id');
         
		 $request->validate([
							'cat_id' => 'required',
							'subcategory_name' => 'required',
							'subcategory_status' => 'required',
							
         ]);
		 $rules = array(
				'subcategory_name' => ['required', 'max:255', Rule::unique('subcategory') ->ignore($subcat_id, 'subcat_id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		$data = array('cat_id' => $cat_id, 'subcategory_name' => $subcategory_name, 'subcategory_slug' => $subcategory_slug, 'subcategory_status' => $subcategory_status);
		
        Category::updatesubcategoryData($subcat_id, $data);
            return redirect('/admin/sub-category')->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}*/
	
  
	/* subcategory */
	
	
	
		
	
}
