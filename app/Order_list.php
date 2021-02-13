<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Order_list extends Model
{

    protected  $fillable =['review','star'];

    public function products(){

        return $this->hasMany(Product::class);
    }

}
