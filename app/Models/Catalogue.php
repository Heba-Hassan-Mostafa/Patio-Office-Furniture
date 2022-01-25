<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    protected $table = 'catalogues';
    public $timestamps = true;

    protected $guarded = [];



   //category
    public function imageCategory()
    {
        return $this->belongsTo('App\Models\ImageCategory');
    }
    public function imageMedia()
    {
        return $this->hasMany('App\Models\ImageMedia');
    }
}