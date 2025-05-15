<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
   protected $table = 'user'; // Specify the table name if it's not the plural of the model name
   protected $fillable = ['name', 'phone', 'gender', 'dob', 'pass', 'email', 'status', 'image'];
}
