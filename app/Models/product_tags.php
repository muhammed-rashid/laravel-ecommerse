<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_tags extends Model
{
    use HasFactory;

   public function all_tags(){
       return $this->hasMany('App\Models\product_tags','tag_id','tag_id');
   }
public function get_product(){
    return $this->hasOne('App\Models\product','id','product_id');
}



}
