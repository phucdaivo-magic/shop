<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
    }

    public function category(Request $request, $category)
    {
        $category = Category::where('slug', $category)->first();
        if ($category) {
            $loadProduct = route('site.category.product', $category->id);
            return  view(
                'site.pages.category',
                compact('loadProduct', 'category')
            );
        } else {
            abort(404);
        }
    }

    public function categoryParent(Request $request, $categoryParent ,$category)
    {
        $category = Category::where('slug', $category)->first();
        if ($category) {
            $loadProduct = route('site.category.product', $category->id);
            return  view(
                'site.pages.category',
                compact('loadProduct', 'category')
            );
        } else {
            abort(404);
        }
    }

    public function categoryList(Request $request,Category $category)
    {

        $ids = collect($category->categories)->reduce(function($acc, $cur) {
            $acc[] = $cur['id'];
            return $acc;
        }, [$category->id]);

        if ($category) {
            $productList = Product::whereIn('category_id', $ids)->with([
                    'images' => function ($q) {
                        return $q->where('active', true);
                    }
            ])->where('active', true);

            if($request->sort == 'price') {
                $productList =  $productList->orderBy('price', 'ASC');
            } elseif($request->sort == 'price-desc') {
                $productList =  $productList->orderBy('price', 'DESC');
            } else {
                $productList =  $productList->orderBy('sort', 'ASC');
            }
            $productList = $productList->paginate(9);
            return response()->json($productList);
        } else {
            abort(404);
        }
    }
}
