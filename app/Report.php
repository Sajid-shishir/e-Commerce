<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model

{
    protected $guarded = [];
    function order_created_at(){
        return $this->belongsTo('App\Order');
    }
}
