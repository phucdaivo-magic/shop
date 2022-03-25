<?php

namespace App\Models;

class ProductPropertyType extends SortModel
{

    public static $rules = [];

    public static $messages = [];

    protected $fillable = [
        'product_id',
        'name',
        'type',
        'type_element',
        'active',
        'sort'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productPropertyDetails()
    {
        return $this->hasMany(ProductPropertyDetail::class, 'product_property_type_id')
            ->orderBy('sort', 'ASC');;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($obj) {
            $obj->productPropertyDetails()->delete();
        });
    }
}
