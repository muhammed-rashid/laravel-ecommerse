<?php

namespace App\Models;
use App\Models\product;
use App\Models\banner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function products(){
        return $this->hasMany(product::class);
    }
    public function banners(){
        return $this->hasMany(banner::Class,'product_id','id');
    }
   
    static function booted(){
        parent::boot();
        
        brand::deleted(function($brand){
           
           
            $brand->banners()->delete();
        });
    }
   

   
}
