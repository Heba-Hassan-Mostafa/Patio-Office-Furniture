<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{


    protected $table = 'posts';
    public $timestamps = true;

    protected $guarded = [];



   //category
    public function postCategory()
    {
        return $this->belongsTo('App\Models\PostCategory');
    }
}
