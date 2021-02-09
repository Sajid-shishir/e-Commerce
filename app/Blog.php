<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];
    function connect_to_user(){

        return $this->belongsTo('App\User','blog_added_by');
    }
}
