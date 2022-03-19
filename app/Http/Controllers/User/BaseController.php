<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Services\User\AboutService;
use App\Services\User\SettingService;
use Illuminate\Http\Request;


abstract class BaseController extends Controller
{
    protected $meta = [];
    protected function compactSetting()
    {
        $meta = $this->meta;

        return compact(
            'meta'
        );
    }
}
