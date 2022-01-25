<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = true;

    protected $guarded = [];


    //category
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    //subcategory
    public function sub_category()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }


     //wish List
    public function wish_lists()
    {
        return $this->hasMany('App\Models\WishList');
    }

     //orders
     public function order_details()
     {
         return $this->hasMany('App\Models\OrderDetail');
     }

    //status
    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}