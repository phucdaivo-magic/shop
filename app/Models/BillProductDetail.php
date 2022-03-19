<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Collective\Html\Eloquent\FormAccessible;

class BillProductDetail extends Eloquent
{
    public static $rules = [];

    public static $messages = [];

    protected $fillable = [
        'product_property_detail_id',
        'product_property_type_id'
    ];

    public function productPropertyDetail()
    {
        return $this->belongsTo(ProductPropertyDetail::class, 'product_property_detail_id');
    }

    public function productPropertyType()
    {
        return $this->belongsTo(ProductPropertyType::class, 'product_property_type_id');
    }

}
