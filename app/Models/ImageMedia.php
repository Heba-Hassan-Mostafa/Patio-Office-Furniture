<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageMedia extends Model
{

    protected $table = 'image_media';
    public $timestamps = true;

    protected $guarded = [];

    public function catalogue()
    {
        return $this->belongsTo('App\Models\Catalogue');
    }
}