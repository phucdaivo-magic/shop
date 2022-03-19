<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Str;

class SlugModel extends Eloquent
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($obj) {
            $obj->slug = Str::slug($obj->name);
        });

        static::updating(function ($obj) {
            $obj->slug = Str::slug($obj->name);
        });
    }
}
