<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product_features extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function get_val(){
        return $this->hasOne('App\Models\atributes','id','atribute_id')->withTrashed();
    }
}
