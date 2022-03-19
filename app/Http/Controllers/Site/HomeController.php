<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function __construct(
    ) {
    }

    public function index(Request $request)
    {
        return  view(
            'site.pages.index'
            // compact('projectList', 'imageList')
        );
    }

    public function pushCart() {

    }
}
