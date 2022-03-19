<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Collective\Html\Eloquent\FormAccessible;

class Bill extends Eloquent
{
    protected $appends = [
        'date'
    ];

    public static $rules = [];

    public static $messages = [];

    public function billProducts()
    {
        return $this->hasMany(BillProduct::class, 'bill_id');
    }

    public function billAddress()
    {
        return $this->hasMany(BillAddress::class, 'bill_id');
    }


    public function getDateAttribute()
    {
        return $this->created_at->format('d/m/Y  h:m:s');
    }
}
