<?php

namespace App\Models;
use App\Models\product_categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function get_product_categories(){
        return $this->hasMany('App\Models\product_categories');
    }
    public function category(){
        return $this->belongsToMany(product_categories::class);
    }
    
  
}
