<?php

use App\Models\cart;
use Illuminate\Support\Facades\Auth;

function get_cart_count(){
    if(Auth::check()){
        $cart_items = cart::where('user_id',Auth::user()->id)->get();

        return count($cart_items);
    }else{
        return '0';
    }
  
}
?>