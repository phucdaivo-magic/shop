<?php

namespace App\Models;

class ProductPropertyType extends SortModel
{

    public static $rules = [];

    public static $messages = [];

    // protected $fillable = [];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productPropertyDetails() {
        return $this->hasMany(ProductPropertyDetail::class, 'product_property_type_id')
            ->orderBy('sort', 'ASC');;
    }
}
