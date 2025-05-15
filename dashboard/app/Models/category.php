<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   

    protected $table = 'categories';

    protected $fillable = ['name', 'status', 'image']; // use 'image', not 'images'

    protected $casts = [
        'image' => 'array', // decode JSON from 'image' column
    ];
}

