<?php

namespace App\Models;

class ProductPropertyDetail extends SlugSortModel
{

    public static $rules = [];

    public static $messages = [];

    protected $fillable = [
        'product_id',
        'product_property_type_id',
        'name',
        'slug',
        'active',
        'value',
        'product_image_id',
        'price'
    ];

    protected $appends = [
        'image',
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productPropertyType() {
        return $this->belongsTo(ProductPropertyType::class, 'product_property_type_id');
    }

    public function getImageAttribute() {
        return asset($this->value);
    }

    public function productImage()
    {
        return $this->belongsTo(ProductImage::class, 'product_image_id');
    }
}
