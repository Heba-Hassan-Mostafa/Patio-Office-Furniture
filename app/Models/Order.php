<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = true;

    protected $guarded = [];

    //user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}