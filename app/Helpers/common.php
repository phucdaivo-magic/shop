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
            'icon' => 'icon-puzzle',
            'childrens' => [
                [
                    'name' => 'Danh sách',
                    'icon' => 'icon-list',
                    'url' => 'App\Http\Controllers\Admin\ProductController@index'
                ], [
                    'name' => 'Thêm mới',
                    'icon' => 'icon-note',
                    'url' => 'App\Http\Controllers\Admin\ProductController@initForm'
                ]
            ]
        ],
        [
            'name' => 'Danh mục',
            'icon' => 'icon-drop',
            'childrens' => [
                [
                    'icon' => 'icon-list',
                    'name' => 'Danh sách',
                    'url' => 'App\Http\Controllers\Admin\CategoryController@index'
                ], [
                    'icon' => 'icon-note',
                    'name' => 'Thêm mới',
                    'url' => 'App\Http\Controllers\Admin\CategoryController@initForm'
                ]
            ]
        ],
        [
            'name' => 'Thương hiệu/Chất liệu',
            'icon' => 'icon-drop',
            'childrens' => [
                [
                    'icon' => 'icon-list',
                    'name' => 'Danh sách',
                    'url' => 'App\Http\Controllers\Admin\TradeMarkController@index'
                ], [
                    'icon' => 'icon-note',
                    'name' => 'Thêm mới',
                    'url' => 'App\Http\Controllers\Admin\TradeMarkController@initForm'
                ]
            ]
        ],
        [
            'name' => 'Đơn hàng',
            'icon' => 'icon-drop',
            'childrens' => [
                [
                    'icon' => 'icon-list',
                    'name' => 'Danh sách',
                    'url' => 'App\Http\Controllers\Admin\BillController@index'
                ], [
                    'icon' => 'icon-note',
                    'name' => 'Thêm mới',
                    'url' => 'App\Http\Controllers\Admin\BillController@initForm'
                ]
            ]
        ],
        [
            'name' => 'Trang thông tin',
            'icon' => 'icon-drop',
            'childrens' => [
                [
                    'icon' => 'icon-list',
                    'name' => 'Danh sách',
                    'url' => 'App\Http\Controllers\Admin\AboutController@index'
                ], [
                    'icon' => 'icon-note',
                    'name' => 'Thêm mới',
                    'url' => 'App\Http\Controllers\Admin\AboutController@initForm'
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
