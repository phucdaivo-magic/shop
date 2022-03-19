<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Collective\Html\Eloquent\FormAccessible;

class BillAddress extends Eloquent
{
    public static $rules = [
    ];

    public static $messages = [
    ];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'city',
        'district',
        'ward',
        'address',
        'note',
    ];
}
