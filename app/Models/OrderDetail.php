<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    public $timestamps = true;

    protected $guarded = [];

    //product
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

     //orders
     public function orders()
     {
         return $this->hasMany('App\Models\OrderDetail');
     }

}