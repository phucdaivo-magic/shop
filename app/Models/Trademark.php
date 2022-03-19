<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Collective\Html\Eloquent\FormAccessible;

class Trademark extends SlugSortModel 
{

    public static $rules = [];

    public static $messages = [];

    // protected $fillable = [];

    public function trademark() {
        return $this->belongsTo(Trademark::class, 'trademark_id');
    }

    public function trademarks() {
        return $this->hasMany(Trademark::class, 'trademark_id');
    }
}
