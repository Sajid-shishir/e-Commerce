<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable =['amounts'];

    function relationtoproducttable(){

        return $this->belongsTo('App\Product','product_id','id');
    }
}
