<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function __construct()
    {
    }

    public function detail(Request $request, $slug)
    {
        $about = About::where('slug', $slug)->first();

        if ($about) {
            return view('site.pages.about', compact('about'));
        } else {
            abort(404);
        }
    }
}
