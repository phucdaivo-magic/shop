<?php

namespace App\Models;

class ProductImage extends SortModel
{

    public static $rules = [];

    public static $messages = [];

    // protected $fillable = [];
    protected $appends = [
        'avatar',
    ];


    protected $fillable = [
        'image',
        'product_id',
        'active',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getAvatarAttribute() {
        return asset($this->image);
    }
}
