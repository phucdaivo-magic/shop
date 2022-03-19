<?php

namespace App\Models;

class ProductPropertyDetail extends SlugSortModel
{

    public static $rules = [];

    public static $messages = [];

    // protected $fillable = [];

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
}
