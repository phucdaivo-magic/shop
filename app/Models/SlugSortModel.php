<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Str;

class SlugSortModel extends Eloquent
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($obj) {
            $obj->slug = Str::slug($obj->name);
            $obj->sort = $obj->count() + 1;
        });

        static::updating(function ($obj) {
            $obj->slug = Str::slug($obj->name);
        });
    }
}
