<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ImageCategory extends Model
{
    use SearchableTrait;

    protected $table = 'image_categories';
    public $timestamps = true;

    protected $guarded = [];


    protected $searchable = [

        'columns' => [
            'image_categories.name' => 10,
        ]
    ];


     public function catalogues()
    {
        return $this->hasMany('App\Models\Catalogue');
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}