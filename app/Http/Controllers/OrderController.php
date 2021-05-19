<?php

namespace App\Http\Controllers;

use App\Models\adress;
use App\Models\cart;
use App\Models\order;
use App\Models\order_summary;
use App\Models\payments;
use App\Models\product;
use App\Models\refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class OrderController extends Controller
{


    //frontent order controller
    public function get_order_page()
    {
        
        
        
        $cart_count = cart::where('user_id', Auth::user()->id)->count();

        if ($cart_count > 0) {


            $address = adress::where('user_id', Auth::user()->id)->get();
            $get_cart_items = cart::with('get_cart_products')->where('user_id', Auth::user()->id)->get();

            //check if all the products are in stock for order

            foreach($get_cart_items as $it){
                if($it->quantity > $it->get_cart_products->stock){
                    return redirect('/cart');
                }
            }
        

            $single_total = [];
            $full_total = 0;


            foreach ($get_cart_items  as $key => $value) {

                if ($value->get_cart_products->discounted_price) {

                    $total = $value->get_cart_products->discounted_price * $value->quantity;
                    $single_total[$value->get_cart_products->id] = $total;

                    $full_total += $total;
                    $total = 0;
                } else {
                    $total = $value->get_cart_products->price * $value->quantity;
                    $single_total[$value->get_cart_products->id] = $total;

                    $full_total += $total;
                    $total = 0;
                }
            }






            return view('frontent.order', ['address' => $address, 'single_total' => $single_total, 'full_total' => $full_total, 'products' => $get_cart_items->pluck('get_cart_products')]);
        } else {
            return redirect('/');
        }
    }
    //add adress to db
    public function add_address(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'address' => 'required',
            'land_mark' => 'required',
            'city' => 'required',
            'post' => 'required',
            'pin' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'All fied is required'
            ]);
        }
        $address = new adress();
        $address->address = $request->address;
        $address->land_mark = $request->land_mark;
        $address->city = $request->city;
        $address->post_office = $request->post;
        $address->pin_code = $request->pin;
        $address->user_id = Auth::user()->id;

        $saved = $address->save();

        if (!$saved) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully Added the adress',
            'data' => $address
        ]);
    }
    public function edit_get($id)
    {
        $data = adress::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    //update adress with new data
    public function update_adress(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'e_address' => 'required',
            'e_city' => 'required',
            'e_land_mark' => 'required',
            'e_pin' => 'required',
            'e_post' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'All field is required'
            ]);
        }

        $address = adress::find($request->id);
        $address->address = $request->e_address;
        $address->land_mark = $request->e_land_mark;
        $address->city = $request->e_city;
        $address->post_office = $request->e_post;
        $address->pin_code = $request->e_pin;

        $updated = $address->save();

        if (!$updated) {
            return response()->json([
                'status' => 'error',
                'message' => 'All field is required'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'updated successfully'
        ]);
    }
    //delte adress
    public function delete_adress($id)
    {
        $deleted = adress::find($id)->delete();
        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'something went wrong'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'successfully deleted the adress'
        ]);
    }

    //place order
    public function place_order(Request $request)
    {
        //get cart count for getting hacking attempts

        $cart_count = cart::where('user_id', Auth::user()->id)->count();
        if ($cart_count > 0) {
            $cart_items =  cart::with('get_cart_products')->where('user_id', Auth::user()->id)->get();

             //check if the ordered product is in stock

             foreach($cart_items as $items){
                 if($items->quantity>$items->get_cart_products->stock){
                     return response()->json([
                         'status'=>'failed',
                         'message'=>'The ordered product not in stock'
                     ]);
                 }
             }




            //getting total price
            $full_total = 0;

            foreach ($cart_items  as $key => $value) {

                if ($value->get_cart_products->discounted_price) {
                    $total = $value->get_cart_products->discounted_price * $value->quantity;
                    $full_total += $total;
                } else {
                    $total = $value->get_cart_products->price * $value->quantity;
                    $full_total += $total;
                }
            }

           
            if($request->payment_type != 'online'){
                 //strore to order table
            $order = new order();
            $order->user_id = Auth::user()->id;
            $order->address_id = $request->adress_id;
            $order->total_price = $full_total;
            $order->order_type = 'cod';
            $order->order_status = 'placed';
            $order->payment_status = 'pending';
            if ($full_total < get_basic_details()->min_order_amount) {
                $order->delivery_charge = get_basic_details()->delivery_charge;
            }
            $order->min_order_amount = get_basic_details()->min_order_amount;
             $order->save();
            $order_id = $order->id;

             //order summery saving
             foreach ($cart_items as $cart) {
                //save to order summary
                $order_summary = new order_summary();
                $order_summary->order_id = $order_id;
                $order_summary->product_id = $cart->product_id;
                $order_summary->quantity = $cart->quantity;

                if ($cart->get_cart_products->discounted_price) {
                    $order_summary->unit_price = $cart->get_cart_products->discounted_price;
                } else {
                    $order_summary->unit_price = $cart->get_cart_products->price;
                }
                $saved =  $order_summary->save();

                //finding the ordered product and decreesing the quantity
               
                $product = product::where('id', $cart->product_id)->first();
                $product->stock = $product->stock - $cart->quantity;
                $product->save();
                
            }
            $cart_cleared = cart::where('user_id', Auth::user()->id)->delete();
            
             //return here if the payment is cod
             return response()->json([
                'status' => 'success',
                'message' => 'order placed'
            ]);

             }
             else if ($request->payment_type == 'online') {
                   
                    //craete a razorpay instance
                    $client = new Api(Config('razorpay.razor_key'), Config('razorpay.razor_secret'));
                    $order  = $client->order->create([
                        
                        'amount'          => $full_total * 100, // amount in the smallest currency unit
                        'currency'        => 'INR', // <a href="/docs/payment-gateway/payments/international-payments/#supported-currencies"  target="_blank">See the list of supported currencies</a>.)
                    ]);

                    $data = collect($order);

                    return response()->json([
                        'status' => 'online_payment',
                        'order_details' => $data,
                    ]);
                }
            }
            //run when a database error occure or the item is not saved return here
            return response()->json([
                'status' => 'error',
                'message' => 'Something Went Wrong'
            ]);

        
    }

    public function my_orders()
    {
        //getting order of a user
        $user_order = order::with('get_order_details.get_product_from_order_summery.get_images')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $single_product_price = []; //
        $single_order_total = []; //
        $total_charge_of_order_with_delivery_charge = [];

        foreach ($user_order as $key => $value) {
            $single_order_total[$value->id] = $value->total_price;
            //check if delivery charge
            if ($value->min_order_amount > $value->total_price) {
                $total_charge_of_order_with_delivery_charge[$value->id] = $value->total_price +  $value->delivery_charge;
            } else {
                $total_charge_of_order_with_delivery_charge[$value->id] = null;
            }
            //single total
            foreach ($value->get_order_details as $item) {
                $single_product_price[$item->order_id][$item->product_id] = $item->unit_price * $item->quantity;
            }
        }
        return view('frontent.my_orders', ['order_details_user' => $user_order, 'single_product_price' => $single_product_price, 'single_order_total' => $single_order_total, 'total_charge_of_order_with_delivery_charge' => $total_charge_of_order_with_delivery_charge]);
    }
//cancel order refund and all other are occure here
    public function cancel_order($order_id)
    {
        $order = order::find($order_id);
        if ($order->order_status != 'Delivered') {
            $order->order_status = 'Cancelled';
            $saved = $order->save();
           




            //finding of the ordered product and increese its quantity
            $current_order = order::with('get_order_details')->where('id',$order_id)->first();
            
           //getting all the product frome the order and increese with its quantiti
           foreach($current_order->get_order_details as $item){
              $product = product::where('id',$item->product_id)->first();
              $product->stock = $product->stock + $item->quantity;

              $product->save();

           }
           
           //check if payment is done or not if it done refunt the payment
            //if order is payed refund option is here
            if($order->order_type == 'online' && $order->payment_status == 'success'){
                //finding the payment id 
                $pay = payments::where([['order_id','=',$order_id],
                ['payment_status','=','success']
                ] )->first();

                $api= new Api(Config('razorpay.razor_key'), Config('razorpay.razor_secret'));
                $payment = $api->payment->fetch($pay->payment_id);
                $refund_t = $payment->refund();

               $refund_data = collect($refund_t);

                if($refund_data['id']){
                    //save refund details into database
                    $refund = new refund();
                    $refund->user_id = Auth::user()->id;
                    $refund->order_id = $order->id;
                    $refund->payment_id = $pay->id;
                    $refund->refund_id = $refund_data['id'];
                    $refund->amount = $refund_data['amount'];
                    $refund->status = $refund_data['status'];
                    $saved_refund = $refund->save();

                   
                }
                if ($saved_refund) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'order is cancelled The amount will we credited in 5-10 working days',
                        'order_id' => $order_id
                    ]);
                }

            }
           

             if($saved){
                return response()->json([
                    'status'=>'success',
                    'message'=>' your order is cancelled',
                    'order_id' => $order_id
                ]);
            }
            
            
            
            else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong'
                ]);
            }
        }

        return response()->json([
            'status' => 'error'
        ]);
    }

    //order verify
    public function verify(Request $request)
    {

        $api = new Api(Config('razorpay.razor_key'), Config('razorpay.razor_secret'));
        try {
            $attributes = array(
                'razorpay_order_id' => $request->order['order_details']['id'],
                'razorpay_payment_id' => $request->response['razorpay_payment_id'],
                'razorpay_signature' => $request->response['razorpay_signature'],
            );
            $api->utility->verifyPaymentSignature($attributes);
        } catch (SignatureVerificationError $e) {
            $response = 'failure';
            $error = 'Razorpay Error : ' . $e->getMessage();

            //online payment is failed controller hit here

            $order = order::where('id', $request->order['order_details']['receipt']);
            $order->payment_status = 'failed';
            $saved = $order->save();
            //save to payment payment history
            $payment = new payments();
            $payment->order_id = $order->id;
            $payment->user_id = Auth::user()->id;
            $payment->payment_status = 'failed';
            $payment->payment_id = $request->response['razorpay_payment_id'];
            $payment->payment_order_id = $request->order['order_details']['id'];
            $payment->reson = 'Invalid payment signature';
            $payment->save();

            if (!$saved) {
                return response()->json([
                    'status' => 'failed',
                    'status' => 'payment failed'
                ]);
            }
        }
        //if order payment is successfull hit here

        $cart_items =  cart::with('get_cart_products')->where('user_id', Auth::user()->id)->get();

          
            //getting total price
            $full_total = 0;

            foreach ($cart_items  as $key => $value) {

                if ($value->get_cart_products->discounted_price) {
                    $total = $value->get_cart_products->discounted_price * $value->quantity;
                    $full_total += $total;
                } else {
                    $total = $value->get_cart_products->price * $value->quantity;
                    $full_total += $total;
                }
            }

           
        
        $order = new order();
        $order->user_id = Auth::user()->id;
        $order->address_id = $request->adrs_id;
        $order->total_price = $full_total;
        $order->order_type = 'online';
        $order->order_status = 'placed';
        $order->payment_status = 'success';
        if ($full_total < get_basic_details()->min_order_amount) {
            $order->delivery_charge = get_basic_details()->delivery_charge;
        }
        $order->min_order_amount = get_basic_details()->min_order_amount;
         $order->save();
        $order_id = $order->id;

         //order summery saving
         foreach ($cart_items as $cart) {
            //save to order summary
            $order_summary = new order_summary();
            $order_summary->order_id = $order_id;
            $order_summary->product_id = $cart->product_id;
            $order_summary->quantity = $cart->quantity;

            if ($cart->get_cart_products->discounted_price) {
                $order_summary->unit_price = $cart->get_cart_products->discounted_price;
            } else {
                $order_summary->unit_price = $cart->get_cart_products->price;
            }
            $saved =  $order_summary->save();

            //finding the ordered product and decreesing the quantity
           
            $product = product::where('id', $cart->product_id)->first();
            $product->stock = $product->stock - $cart->quantity;
            $product->save();
            
        }
        $cart_cleared = cart::where('user_id', Auth::user()->id)->delete();


        //save to payment history

        $payment = new payments();
        $payment->order_id = $order->id;
        $payment->user_id = Auth::user()->id;
        $payment->payment_status = 'success';
        $payment->payment_id = $request->response['razorpay_payment_id'];
        $payment->payment_order_id = $request->order['order_details']['id'];
        $payment->reson = 'successfull payment';
        $payment->save();







        //check if cart have value

        if ($saved) {
            return response()->json([
                'success' => 'order is placed',
                'message' => 'order_placed'
            ]);
        }
    }

    //handle payment filed in razorpay server

    public function order_failed(Request $request)

    {
       
        //save payment details in payments table
        $payment = new payments();
       
        $payment->user_id = Auth::user()->id;
        $payment->payment_status = 'failed';
        $payment->payment_id = $request->metadata['payment_id'];
        $payment->payment_order_id = $request->metadata['order_id'];
        $payment->reson = $request->reason;

        $payment->save();


        return response()->json([
            'status' => 'error',
            'message' => 'Payment Failed'
        ]);
    }


    public function retry_payment($id){
         //first check if the ordered products are still available
        $current_order = order::with('get_order_details')->where('id',$id)->first();
        
       foreach($current_order->get_order_details as $item){
           $product = product::where('id',$item->product_id)->first();
           if($product->stock < $item->quantity){
               return response()->json([
                   'status'=>'out_of_stock',
                   'message'=>'Products are currently un available Please try after some days'
               ]);
           }
       }
        //fetch razorpay order id frome the table for retry same order
        $payment = payments::where('order_id',$id)->first();


        $client = new Api(Config('razorpay.razor_key'), Config('razorpay.razor_secret'));
        $order  = $client->order->fetch($payment->payment_order_id);

    return response()->json([
        'status'=>'success',
        'order_details'=>collect($order)
    ]);
    }
}
