<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Order extends Model
{
    protected $fillable = ['user_id',
    'total',
    'full_name',
    'email_address',
    'address',
    'paid_status',
    'currency',
    'city_id',
    'note',
    'coupon_name',
    'country_id',
    'phone_number',
    'payment_method',
    'transaction_id'];


   public function relationtocity(){
        return $this->belongsTo('App\City','city_id',);
    }
   public function city(){
        return $this->belongsTo('App\City','city_id',);
    }
   public function relationtocountry(){
        return $this->belongsTo('App\Country','country_id',);
    }

    function relationtoproduct(){
        return $this->belongsToMany('App\Order_list');
    }
    function user(){
        return $this->belongsTo('App\User');
    }
     



}
