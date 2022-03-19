<?php

use Illuminate\Support\Facades\Input;

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
    ];

    return $menu;
}
