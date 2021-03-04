<?php

namespace ZigKart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ZigKart\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use ZigKart\Models\Pages;
use ZigKart\Models\Settings;
use ZigKart\Models\Product;
use ZigKart\Models\Members;
use ZigKart\Models\Category;
use ZigKart\Models\Causes;
use Auth;
use Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
    public function admin()
    {
        
		
	  $total_customers = Members::totaluserCount();
	  $total_vendors = Members::getmemberData();
	  $sub_admin = Members::getsubadminData();
	  $total_products = Product::gettotalProducts();
	  $total_category = Category::totalcategoryCount();
	  $total_orders = Product::totalCheckout();
	  $refund_request = Product::refundRequest();
	  $withdrawal_request = Product::withdrawalRequest();
	  
	    $today = date('d F Y');
		$first_day = date('d F Y', strtotime('-1 days'));
		$second_day = date('d F Y', strtotime('-2 days'));
		$third_day = date('d F Y', strtotime('-3 days'));
		$fourth_day = date('d F Y', strtotime('-4 days'));
		$fifth_day = date('d F Y', strtotime('-5 days'));
		$sixth_day = date('d F Y', strtotime('-6 days'));
		
		$data1 = date('Y-m-d');
		$data2 = date('Y-m-d', strtotime('-1 days'));
		$data3 = date('Y-m-d', strtotime('-2 days'));
		$data4 = date('Y-m-d', strtotime('-3 days'));
		$data5 = date('Y-m-d', strtotime('-4 days'));
		$data6 = date('Y-m-d', strtotime('-5 days'));
		$data7 = date('Y-m-d', strtotime('-6 days'));
		
		$view1 = Product::orderdataCheck($data1);
		$view2 = Product::orderdataCheck($data2);
		$view3 = Product::orderdataCheck($data3);
		$view4 = Product::orderdataCheck($data4);
		$view5 = Product::orderdataCheck($data5);
		$view6 = Product::orderdataCheck($data6);
		$view7 = Product::orderdataCheck($data7);
		
		$approved = Product::itemapprovedCheck(1);
		$unapproved = Product::itemapprovedCheck(0);
	 
	  
	  $data = array('total_customers' => $total_customers, 'total_category' => $total_category, 'total_vendors' => $total_vendors, 'sub_admin' => $sub_admin, 'total_products' => $total_products, 'total_orders' => $total_orders, 'refund_request' => $refund_request, 'withdrawal_request' => $withdrawal_request, 'view1' => $view1, 'view2' => $view2, 'view3' => $view3, 'view4' => $view4, 'view5' => $view5, 'view6' => $view6, 'view7' => $view7, 'today' => $today, 'first_day' => $first_day, 'second_day' => $second_day, 'third_day' => $third_day, 'fourth_day' => $fourth_day, 'fifth_day' => $fifth_day, 'sixth_day' => $sixth_day, 'approved' => $approved, 'unapproved' => $unapproved);
	  return view('admin.index')->with($data);
	
		
		
    }
}
