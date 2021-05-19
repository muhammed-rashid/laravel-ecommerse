<?php

namespace App\Models;
use App\Models\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class offers extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function product_frome_offer(){
        return $this->hasOne(product::class,'id','product_id');
    }
}
