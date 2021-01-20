<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    function relationtocity(){
        return $this->belongsTo('App\City','city_id',);
    }

    function relationtoproduct(){
        return $this->belongsToMany('App\Order_list');
    }


}
