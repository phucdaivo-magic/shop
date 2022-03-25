<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends SlugSortModel
{
    // use SoftDeletes;

    public static $rules = [];

    public static $messages = [];

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

    public function getAvatarAttribute()
    {
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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($obj) {
            $obj->images()->delete();
            foreach ($obj->productPropertyTypes as $productPropertyType) {
                $productPropertyType->delete();
            }
        });
    }

    public function replicateRow()
    {
        DB::beginTransaction();
        try {

            $clone = $this->replicate();
            $clone->push();

            foreach ($this->images as $image) {
                // CLONE IMAGE
                $image->image = cloneFile(
                    $image->image,
                    'uploads/images/product/' . $clone->id . '/image'
                );
                $clone->images()->create($image->toArray());
            }

            // Create Type
            foreach ($this->productPropertyTypes as $productPropertyType) {
                $cloneProductPropertyType = $clone->productPropertyTypes()->create($productPropertyType->toArray());

                // Create Detail
                foreach ($productPropertyType->productPropertyDetails as $productPropertyDetail) {
                    $productPropertyDetail->product_id = $clone->id;
                    $cloneProductPropertyDetail = $cloneProductPropertyType->productPropertyDetails()->create($productPropertyDetail->toArray());

                    // CLONE IMAGE
                    if ($productPropertyType->type == 'image_property') {
                        $cloneProductPropertyDetail->value = cloneFile(
                            $productPropertyDetail->value,
                            'uploads/images/product/' . $clone->id . '/property-type/' . $cloneProductPropertyType->id . '/property-detail/' . $cloneProductPropertyDetail->id
                        );
                    }

                    $cloneProductPropertyDetail->save();
                }
            }

            $clone->save();
            DB::commit();
            return $clone;
        } catch (\Throwable $th) {
            DB::rollback();
            throw false;
        }
    }
}
