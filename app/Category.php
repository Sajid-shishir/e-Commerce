<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    function connect_to_user_table(){

        return $this->belongsTo('App\User');
        
    }
    function connect_to_product_table(){

        return $this->hasMany('App\Product');
    }
}
