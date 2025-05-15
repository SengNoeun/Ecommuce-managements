<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
     protected $table = 'brands';

    protected $fillable = [
        'name',
        'status',
        'image',
    ];

    protected $brand = [
        'status' => 'boolean',
    ];
}
