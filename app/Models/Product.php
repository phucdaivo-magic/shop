<?php

namespace App\Models;

class Product extends SlugSortModel
{

    public static $rules = [];

    public static $messages = [];

    // protected $fillable = [];

    public function trademark()
    {
        return $this->belongsTo(Trademark::class, 'trademark_id');
    }

    protected $appends = [
        'avatar',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id')
            ->orderBy('sort', 'ASC');
    }

    public function getAvatarAttribute() {
        return asset($this->image()->image ?? 'http://localhost:8000/uploads/images/product/image/1647509549_ban-le-macbook-pro-15inch-2011-570x740.jpeg');
    }

    public function image()
    {
        return $this->images()->first();
    }

    public function productPropertyTypes()
    {
        return $this->hasMany(ProductPropertyType::class, 'product_id')
            ->orderBy('sort', 'ASC');
    }
}
