<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Trademark;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        return  view(
            'site.pages.contact'
        );
    }
}
