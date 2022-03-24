<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function __construct()
    {
    }

    public function index() {
        return view('site.pages.favorite');
    }


    public function favoriteList(Request $request)
    {

        $ids = $request->input('ids', []);

            $productList = Product::whereIn('id', $ids)->with([
                    'images' => function ($q) {
                        return $q->where('active', true);
                    }
                ]);

            $productList = $productList->paginate(9);
            return response()->json($productList);

    }
}
