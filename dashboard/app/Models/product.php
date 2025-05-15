<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name', 'price', 'discount', 'description', 'price_after_discount',
        'status', 'brand', 'category', 'slide', 'od', 'name_link', 'image'
    ];

    protected $casts = [
        'image' => 'array',
    ];

    public function slide()
    {
        return $this->belongsTo(Slide::class, 'slide');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    

}
