<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product_categories extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function get_category(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
    public function get_product(){
        return $this->hasOne('App\Models\product','id','product_id');
    }
   
}
