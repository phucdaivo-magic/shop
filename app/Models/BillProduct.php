<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Collective\Html\Eloquent\FormAccessible;

class BillProduct extends Eloquent
{
    public static $rules = [];

    public static $messages = [];

    protected $fillable = [
        'product_id',
        'bill_id',
        'current_price',
        'mount',
        'note',
        'status',
    ];


    public function billProductDetails()
    {
        return $this->hasMany(BillProductDetail::class, 'bill_product_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }
}
