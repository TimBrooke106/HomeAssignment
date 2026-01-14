<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'category', 'price', 'stock', 'condition', 'description', 'image'
    ];

    protected static function booted()
    {
        static::saving(function ($product) {
            if (blank($product->slug) || $product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
