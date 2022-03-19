<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Concerns\Paginatable;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{

    use Paginatable;

    public function __construct()
    {
    }

    public function detail(Request $request, Product $product)
    {
        $product = Product::with(
            [
                'productPropertyTypes' => function ($query) {
                    return $query->where('active', true)->with([
                        'productPropertyDetails' => function ($query) {
                            return  $query->where('active', true);
                        }
                    ]);
                },
                'images' => function ($query) {
                    return $query->where('active', true)->take(6);
                }
            ]
        )->find($product->id);

        return  view(
            'site.pages.product.detail',
            compact('product')
        );
    }

    public function index(Request $request)
    {
        $loadProduct = route('site.product.all');
        return  view(
            'site.pages.product.index',
            compact('loadProduct')
        );
    }

    public function addToCart(Request $request)
    {
        // $cartList = $_SESSION["favcolor"];
        // $cartList[$request['product_id']] = $request->input('cart');
        // $_SESSION["favcolor"] =     $cartList;
        // dd( $_SESSION);
        Redirect::back();
    }

    public function cart(Request $request)
    {
        return  view(
            'site.pages.cart'
            // compact('projectList', 'imageList')
        );
    }

    public function listCart(Request $request)
    {
        $data = $request->input('data');

        $products = $this->getProducts($data);

        return response()->json($products);
    }

    public function productList(Request $request)
    {

        $productList = Product::with([
            'images' => function ($q) {
                return $q->where('active', true);
            }
        ]);
        if ($request->sort == 'price') {
            $productList =  $productList->orderBy('price', 'ASC');
        } elseif ($request->sort == 'price-desc') {
            $productList =  $productList->orderBy('price', 'DESC');
        } else {
            $productList =  $productList->orderBy('sort', 'ASC');
        }
        $productList = $productList->paginate($this->getPerPage());
        return response()->json($productList);
    }

    private function getProducts($data)
    {
        $products = [];

        foreach ($data as $key => $value) {
            $requestArray = explode('_', $key); //  1_41_1_43_2 as 1,41,1,43,2
            $propArray = array_slice($requestArray, 2); // 1,41,1,43,2 as 41,1, 43,2
            $product = Product::find($requestArray[1]);

            if ($product) {
                $_product = [
                    'id'    => $product['id'],
                    'price' => $product['price'],
                    'name'  => $product['name'],
                    'slug'  => $product['slug'],
                    'mount' => $value,
                    'show'  => true,
                    'image' =>  asset($product->image()->image ?? ''),
                    'propertyDetail' => []
                ];
                //  41,1,43,2 as type is 41 and detail is 1, type is 43 and detail is 2,
                for ($i = 1; $i < count($propArray); $i += 2) {
                    $propId                         = $propArray[$i - 1];
                    $detailId                       = $propArray[$i];
                    $_product['propertyDetail'][]   = $this->getCartDetail($product, $propId, $detailId);
                }
                $products[$key] = $_product;
            }
        }

        return $products;
    }

    private function getCartDetail($product, $propId, $detailId)
    {
        $property   = $product->productPropertyTypes->find($propId);
        $detail     = $property->productPropertyDetails->find($detailId);

        return [
            'propertyTypeId'        => $property['id'],
            'propertyTypeName'      => $property['name'],
            'propertyDetailId'      => $detail['id'],
            'propertyDetailName'    => $detail['name'],
        ];
    }

    public function payment()
    {
        return  view(
            'site.pages.payment'
        );
    }

    public function storePayment(Request $request)
    {
        // TODO TRY CATCH
        $cart = $request->input('cart');
        $address = $request->input('address');

        $products = $this->getProducts($cart);

        $bill = new Bill();
        $bill->save();

        // Save bill address
        $bill->billAddress()->create($address);

        foreach ($products as $product) {

            // Save BillProduct
            $billProduct = $bill->billProducts()->create([
                'product_id'    =>  $product['id'],
                'current_price' =>  $product['price'],
                'mount'         =>  $product['mount'],
                'status'        =>  1,
            ]);

            foreach ($product['propertyDetail'] as $propertyDetail) {

                // Save BillProductDetail
                $billProduct->billProductDetails()->create([
                    'product_property_detail_id'    => $propertyDetail['propertyDetailId'],
                    'product_property_type_id'      => $propertyDetail['propertyTypeId']
                ]);
            }
        }

        $totalPrice = collect($bill->billProducts)->reduce(function ($acc, $cur) {
            $acc = $acc + $cur['current_price'] * $cur['mount'];
            return $acc;
        }, 0);

        // Update Bill
        $bill->payment_method   = $address['payment_method'];
        $bill->shipping_method  = 1; // TODO
        $bill->shipping_price   = 35000; // TODO
        $bill->total_price      = $totalPrice + $bill->shipping_price;
        $bill->save();

        $result = Bill::with([
            'billProducts' => function ($query) {

                return $query->with([
                    'product',
                    'billProductDetails' => function ($query) {

                        return $query->with([
                            'productPropertyDetail',
                            'productPropertyType',
                        ]);
                    }
                ]);
            }
        ])->find($bill->id);

        return response()->json($result);
    }
}
