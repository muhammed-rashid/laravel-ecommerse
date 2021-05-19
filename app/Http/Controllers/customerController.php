<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class customerController extends Controller
{
    public function get_all_customer(){
        $user = User::all();
       
        return view('admin-area.customers',['user'=>$user]);
    }
}
