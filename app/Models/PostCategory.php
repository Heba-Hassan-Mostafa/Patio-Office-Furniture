<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PostCategory extends Model
{


    protected $table = 'post_categories';
    public $timestamps = true;

    protected $guarded = [];



    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}
