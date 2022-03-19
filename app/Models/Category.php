<?php

namespace App\Models;

class Category extends SlugSortModel
{

    public static $rules = [];

    public static $messages = [];

    // protected $fillable = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'category_id');
    }
}
