<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;

class order_admin_controller extends Controller
{
    public function index()
    {

        $all_orders = order::with('get_user')->where('order_status','!=','Pending')->get();
        $placed_orders = order::with('get_user')->where('order_status','placed')->get();
     
        $processing_order = order::with('get_user')->where('order_status','processing')->get();
        $out_of_delivery_order = order::with('get_user')->where('order_status','out for delivery')->get();
        $delivered_order = order::with('get_user')->where('order_status','Delivered')->get();
        $cancelled = order::with('get_user')->where('order_status','cancelled')->get();


        return view('admin-area.orders', ['orders' => $all_orders,'pending_order'=>$placed_orders,
        'processing'=>$processing_order,'out_of_delivery'=>$out_of_delivery_order,'delivered_order'=>$delivered_order
        ,'cancelled_orders'=>$cancelled]);
    }
    public function update_order_status($status, $order_id)
    {
        $order = order::find($order_id);
        $order->order_status = $status;
     

        if($order->order_status == 'Delivered'){
            $order->payment_status = 'success';
        }

        $saved = $order->save();

        if (!$saved) {
            return response()->json([
                'status' => 'error',
                'message' => 'something went wrong'
            ]);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'successfully updated'
        ]);
    }

    public function order_review($order_id)
    {
        $order_details = order::with('get_user', 'get_order_details.get_product_from_order_summery', 'get_order_adress')->where('id', $order_id)->first();

        //return $order_details;
        //calculate sub total of each item and also calculate the total price of an order
        $single_total = [];
        $full_total = 0;

        foreach ($order_details->get_order_details  as $key => $value) {
            if ($value->get_product_from_order_summery->discounted_price) {

                $total = $value->get_product_from_order_summery->discounted_price * $value->quantity;
                $single_total[$value->get_product_from_order_summery->id] = $total;
                $full_total += $total;
                $total = 0;
            } else {
                $total = $value->get_product_from_order_summery->price * $value->quantity;
                $single_total[$value->get_product_from_order_summery->id] = $total;
                $full_total += $total;
                $total = 0;
            }
        }
        //check it has delivery charge
        $delivery_charge = null;
        $total_plus_delivery_charge = null;
        if($order_details->total_price < $order_details->min_order_amount){
            $delivery_charge = $order_details -> delivery_charge;
           $total_plus_delivery_charge =  $full_total + $order_details -> $delivery_charge;
        }


        return view('admin-area.order_review', ['order_details' => $order_details, 'single_total' => $single_total,'delivery_charge' => $delivery_charge,'total_plus_delivery_charge'=>$total_plus_delivery_charge]);
    }

    //status wise listing of orders
    // public function order_status_result(Request $request){
    //    $order_status = $request->query('order-status');
    //     $status = str_replace('-',' ', $order_status);
   
    //    $statused_orders = order::with('get_user')->where('order_status',$status)->get();

    //    return response()->json([
    //        'status'=>'success',
    //        'mesage'=>'Request is fullfilled successfully',
    //        'data'=>$statused_orders,
    //        'id'=>$status
    //    ]);
    // }
}
