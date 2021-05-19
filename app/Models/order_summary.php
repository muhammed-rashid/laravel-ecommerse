<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_summary extends Model
{
    use HasFactory;
    public function get_product_from_order_summery(){
        return $this->hasone('App\Models\product','id','product_id')->withTrashed();
    }
}
