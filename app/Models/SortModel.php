<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SortModel extends Eloquent
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($obj) {
            $obj->sort = $obj->count() + 1;
        });
    }
}
