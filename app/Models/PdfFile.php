<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdfFile extends Model
{
    protected $table = 'pdf_files';
    public $timestamps = true;

    protected $guarded = [];
}
