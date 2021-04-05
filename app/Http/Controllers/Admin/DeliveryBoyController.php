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

class DeliveryBoyController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');

    }
    public function admin()
    {
//print_r(Auth::user()->id);exit();

        $total_orders = Product::getTotalOrder(Auth::user()->id);

        $data = array( 'total_orders' => $total_orders);
        return view('deliveryboy.index')->with($data);



    }

    public function assign_orders()
    {
        $itemData['item'] = Product::getorderProductByDelivery();
        $data = array('itemData' => $itemData);

//        print_r($data);exit();
        return view('deliveryboy.assign-orders')->with($data);
    }

    public function orders(Request $request,$status,$ordid)
    {
        $user_id = Auth::user()->id;

        if($status == 'acceptall' || $status == 'declineall'){
            $delivery_status=2;
            if($status == 'declineall'){$delivery_status=3;}
             Product::updateAllOrderStatus($user_id,1,array('delivery_status'=>$delivery_status,'delivery_date'=>date('Y-m-d h:i:s')));
        }
        else{
            Product::updateOrderStatus($user_id,$ordid,array('delivery_status'=>$status,'delivery_date'=>date('Y-m-d h:i:s')));
        }

        $itemData['item'] = Product::getorderProductByDelivery();
        $data = array('itemData' => $itemData);

        return redirect('/deliveryboy/assign-orders')->with('success','Order Change Successfully');

    }
}
