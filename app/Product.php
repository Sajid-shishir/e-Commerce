<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['product_thumbnail_photo'];

    function get_multiple_photos(){

        return $this->hasMany('App\Product_multiple_photo','product_id','id');
    }
    function relation_to_category(){
        return $this->belongsTo('App\Category','category_id',);
    }
    public function order(){

        return $this->hasOne(Order_list::class,'product_id');
    }
}
