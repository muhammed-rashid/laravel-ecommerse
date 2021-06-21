<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cart extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function get_cart_products(){
        return $this->hasOne('App\Models\product','id','product_id');
    }
}
