<?php
use App\Models\wishlist;
use Illuminate\Support\Facades\Auth;

function get_wishlist_count(){
if(Auth::check()){
    $count = wishlist::where('user_id',Auth::user()->id)->count();
    return $count;
}else{
    return '0';
}
}
