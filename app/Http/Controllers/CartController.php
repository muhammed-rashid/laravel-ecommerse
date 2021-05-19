<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\product;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        if(Auth::Check()){
            $cart_products = cart::with('get_cart_products.get_images')->where('user_id', Auth::user()->id)->get();
           
           
            
            $single_total = [];
            $full_total = 0;
            $out_of_stock = false;

            foreach($cart_products  as $key => $value){

                if($value->get_cart_products->discounted_price){
                 
                   $total = $value->get_cart_products->discounted_price * $value->quantity;
                   $single_total[$value->get_cart_products->id] = $total;
                    //check if the product is in stock
                    if($value->get_cart_products->stock >= $value->quantity){
                    $full_total += $total;
                    }else{
                        $out_of_stock = true;
                    }

                   $total = 0;
                }else{
                    $total = $value->get_cart_products->price * $value->quantity;
                    $single_total[$value->get_cart_products->id] = $total;
                     //check if the product is in stock
                     if($value->get_cart_products->stock >= $value->quantity){
                        $full_total += $total;
                    }else{
                        $out_of_stock = true;
                    }
                   
                    $total = 0;
                }
             
              
            }
            

            return view('frontent.cart', ['cart_products' => $cart_products,'single_total'=>$single_total,'sub_total'=>$full_total,'out'=>$out_of_stock]);

        }
       
     
    }


















    public function add_to_cart(Request $request, $id)
    {
        //if that user is logged in
        if (Auth::check()) {
            //check product already in stock

          $stock_have = product::where('id',$id)->first();
          if($stock_have->stock > 0){

         



            //checking if that product is already exist in the database
            $product_in_cart = cart::where('product_id', $id)->first();

            if ($product_in_cart) {
                if ($request->quantity) {
                    $product_in_cart->quantity = $product_in_cart->quantity + $request->quantity;
                } else {
                    $product_in_cart->quantity = $product_in_cart->quantity + 1;
                }

                $product_in_cart->save();
                return response()->json([
                    'status' => 'success',
                    'type'=>'updated',
                    'message' => 'Item Added To Cart'
                ]);
            }
            $new_cart_item = new cart();
            $new_cart_item->product_id = $id;
            $new_cart_item->user_id = Auth::user()->id;
            if ($request->quantity) {
                $new_cart_item->quantity = $request->quantity;
            } else {
                $new_cart_item->quantity = 1;
            }

            $saved = $new_cart_item->save();

            if (!$saved) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'something went wrong'
                ]);
            }
            return response()->json([
                'status' => 'success',
                'type'=>'added',
                'message' => 'Item Added to cart'
            ]);





            }else{
                return response()->json([
                    'status'=>'out_of_stock',
                    'message'=>'The selected item is currently out od stock'
                ]);
            }
           

        } 
    }

    //delete an item frome cart

    public function delete_cart($id)
    {
        //if the cart item is on db he is logged in
        if (Auth::check()) {
            $deleted = cart::where([
                ['user_id' ,'=', Auth::user()->id],
                ['id','=', $id]
            ])->delete();

            if(!$deleted){
                return response()->json([
                    'status'=>'error',
                    'message'=>'something ent wrong'
                ]);
            }
            return response()->json([
                'status'=>'success',
                'message'=>'successfully deleted the item'
            ]);
        }
        //write the logic for gust




    }

    //update cart

    public function update_cart($id,$qty){
        $item = cart::find($id);
       
        $item->quantity = $qty;
        $saved = $item->save();
        if(!$saved){
            return response()->json([
                'status'=>'error'
            ]);
        }else{
            return response()->json([
                'status'=>'success'
            ]);
        }
    }
}
