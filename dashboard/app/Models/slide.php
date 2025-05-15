<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
     protected $table = 'slide';

    protected $fillable = [
        'name',
        'status',
        'od',
        'image',
    ];

    protected $slide = [
        'status' => 'boolean',
    ];
}
