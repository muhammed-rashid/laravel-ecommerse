<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    public function get_user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function get_order_details(){
        return $this->hasMany('App\Models\order_summary','order_id','id');
    }

    public function get_order_adress(){
        return $this->hasOne('App\Models\adress','id','address_id')->withTrashed();
    }
    //get product direct frome orders to avoid one relation

    public function get_products(){
        return $this->hasOneThrough('App\Models\product','App\Models\order_summary','order_id','id','id','id');
    }
}
