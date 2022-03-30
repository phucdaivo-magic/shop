<?php

use Illuminate\Support\Facades\File;

function generateAtribute($attributes)
{
    $htmlAttributes = '';
    if (isset($attributes)) {
        foreach ($attributes as $key => $attr) {
            $htmlAttributes .= ($key . '="' . $attr . '"');
        }
    }

    return $htmlAttributes;
}

function slidebar()
{
    $menu = [
        [
            'name' => 'Sản phẩm',
            'icon' => 'cui-file',
            'childrens' => [
                [
                    'name' => 'Sản phẩm',
                    'icon' => 'cui-file',
                    'url' => 'App\Http\Controllers\Admin\ProductController@index'
                ],
                [
                    'name' => 'Danh mục',
                    'icon' => 'cui-inbox',
                    'url' => 'App\Http\Controllers\Admin\CategoryController@index'
                ],
                [
                    'name' => 'Nhà sản xuất',
                    'icon' => 'icon-list',
                    'url' => 'App\Http\Controllers\Admin\TradeMarkController@index'
                ],
            ]
        ],
        [
            'name' => 'Đơn hàng',
            'icon' => 'cui-cart',
            'childrens' => [
                [
                    'icon' => 'cui-cart',
                    'name' => 'Danh sách',
                    'url' => 'App\Http\Controllers\Admin\BillController@index'
                ]
            ]
        ],
        [
            'name' => 'Website',
            'icon' => 'cui-layers',
            'childrens' => [
                [
                    'icon' => 'cui-layers',
                    'name' => 'Trang thông tin',
                    'url' => 'App\Http\Controllers\Admin\AboutController@index'
                ]
            ]
        ],
    ];

    return $menu;
}

function getQuery()
{
    $query = '';
    foreach (request()->query() as $key => $value) {

        if ($key !== 'page') {
            $query = $query . '&' . $key . '=' . $value;
        }
    }
    return $query;
}

function getMoney($num)
{
    return number_format($num) . ' VND';
}

function cloneFile($from, $to)
{
    $basename = basename(public_path($from));
    if (File::exists($from)) {
        File::makeDirectory($to, $mode = 0777, true, true);
        $to =  $to . '/' . $basename;
        $res = File::copy(public_path($from), public_path($to));
        if ($res) {
            return $to;
        }
    }

    return '';
}
