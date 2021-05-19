<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Units;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\This;

class product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function brands()
    {
        return $this->hasOne('App\Models\brand', 'id', 'brand_id');
    }

    public function units()
    {
        return $this->hasOne('App\Models\Units', 'id', 'unit_id');
    }

    public function categories()
    {
        return $this->hasManyThrough('App\Models\Category', 'App\Models\product_categories', 'product_id', 'id', 'id', 'category_id');
    }

    public function categories_id()
    {
        return $this->hasMany('App\Models\product_categories', 'product_id', 'id');
    }

    //images
    public function get_images()
    {
        return $this->hasMany('App\Models\images', 'product_id', 'id');
    }



    //get atribute values

    public function get_attr_value()
    {
        return $this->hasMany('App\Models\product_features', 'product_id', 'id');
    }
    //multiple tags

    public function get_tags()
    {
        return $this->HasMany('App\Models\product_tags', 'product_id', 'id');
    }
    public function offers()
    {
        $date = Carbon::now();
        $da = $date->toDateString();
        return $this->hasOne('App\Models\offers', 'product_id', 'id')->whereRaw('"' . $da . '" between `offer_start_at` and `offer_end_at`');
    }

    protected $appends = ['discounted_price'];


    public function getDiscountedPriceAttribute()
    {
        if ($this->offers) {
            $in = $this->price * ($this->offers->offer_percentage / 100);

            return $this->price - $in;
        }
    }

    public function get_tags_name(){
        return $this->hasManyThrough('App\Models\tags','App\Models\product_tags','product_id','id','id','tag_id');
    }

    //getting review of a product
    public function get_reviews(){
        return $this->hasMany('App\Models\review','product_id','id');
    }
}
