<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;

class dashboard extends Controller
{
    public function index(){
        //get new orders
        $order_count = order::where('order_status','placed')->count();
        //ger all order
        $total_order = order::count();
        $cancelled = order::where('order_status','cancelled')->count();
      
        //total users
        $total_users = User::count();
        return view('admin-area.dashboard',['total_order'=>$total_order,'total_users'=>$total_users,'new_order'=>$order_count,'cancelled'=>$cancelled]);

    }
}
