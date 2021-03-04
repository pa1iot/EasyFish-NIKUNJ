<?php

namespace ZigKart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use ZigKart\Models\Pages;
use Cookie;
use ZigKart\Models\Languages;
use Illuminate\Support\Facades\Crypt;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    
    	
	public function view_page($page_slug)
	{
	  
	   
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
	  $page['page'] = Pages::singlePage($page_slug,$translate);
	  
	  $data = array('page' => $page);
	  return view('page')->with($data);
	
	}
	
	
	
	
}
