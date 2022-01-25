<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;


class Category extends Model
{
    use SearchableTrait;

    protected $table = 'categories';
    public $timestamps = true;

    protected $guarded = [];


    protected $searchable = [

        'columns' => [
            'categories.name' => 10,
        ]
    ];


     public function subCategories()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

     public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}