<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class SubCategory extends Model
{
    use SearchableTrait;

    protected $table = 'sub_categories';

    public $timestamps = true;


    protected $guarded = [];


    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    //category
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
      //status
    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}