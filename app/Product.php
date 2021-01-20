<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_thumbnail_photo'];

    function get_multiple_photos(){

        return $this->hasMany('App\Product_multiple_photo','product_id','id');
    }
}
