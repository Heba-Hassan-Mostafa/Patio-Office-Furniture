<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wish_lists';
    public $timestamps = true;

    protected $guarded = [];

     //product
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

      //user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}