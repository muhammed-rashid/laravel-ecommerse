<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\product;

class Units extends Model
{
    use HasFactory;
    use SoftDeletes;
public function products()
{
    return $this->hasMany(product::class,'unit_id','id');
}
    static function booted(){
        parent::boot();
        Units::deleted(function($unit){
           
            $unit->products()->delete();
        });
    }
}
