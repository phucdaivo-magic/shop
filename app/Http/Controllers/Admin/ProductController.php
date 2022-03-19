<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Category;
use App\Models\Product as Obj;
use App\Models\Trademark;
use Illuminate\Http\Request;

class ProductController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        parent::initData(
            [
                'header' => [
                    [
                        'view' => [
                            'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                        ],
                        'key' => 'id',
                        'title' => '#',
                    ],
                    [
                        'key' => 'category_id',
                        'title' => 'Danh mục',
                        'edit' => [
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => function ($data) {
                                return Category::get();
                            }
                        ],
                    ],
                    [
                        'key' => 'trademark_id',
                        'title' => 'Thương hiệu/Chất liệu',
                        'edit' => [
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => array_merge([
                                ['id' => '', 'name' => 'Không chọn']
                            ], collect(Trademark::get())->toArray())
                        ],
                    ],
                    [
                        'key' => 'name',
                        'view' => [],
                        'title' => 'Tên sản phẩm',
                        'edit' => [
                            'placeholder' => 'Tên sản phẩm',
                        ],
                    ],
                    [
                        'key' => 'price',
                        'view' => function ($product) {
                            return number_format($product->price);
                        },
                        'title' => 'Giá',
                        'edit' => [
                            'placeholder' => 'Giá sản phẩm',
                            'type' => 'number'
                        ],
                    ],
                    [
                        'key' => 'description',
                        'view' => [],
                        'title' => 'Giới thiệu sản phẩm',
                        'edit' => [
                            'type' => 'textarea',
                            'attrs' => [
                                'style' => 'width: 100%',
                                'data-init-plugin' => 'ckeditor',
                            ],
                        ],
                    ],
                    [
                        'view' => [
                            'type' => 'checkbox',
                            'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                        ],
                        'key' => 'active',
                        'title' => 'Hiển thị',
                        'edit' => [
                            'type' => 'checkbox',
                        ],
                    ],
                    [
                        'view' => [
                            'type' => 'action',
                            'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                            'actions' => [
                                [
                                    'html' => '<i class="cui-chevron-bottom"></i>',
                                    'action' => function ($data) {
                                        return url()->action(__CLASS__ . '@actionSort', ['down', $data['id']]);
                                    },
                                    'attrs' => [
                                        'class' => 'btn bg-gray-200 btn-sm btn-sort'
                                    ],
                                ],
                                [
                                    'html' => '<i class="cui-chevron-top"></i>',
                                    'action' => function ($data) {
                                        return url()->action(__CLASS__ . '@actionSort', ['up', $data['id']]);
                                    },
                                    'attrs' => [
                                        'class' => 'btn bg-gray-200 btn-sm btn-sort'
                                    ],
                                ],
                            ],
                        ],
                        'key' => 'sort',
                        'title' => 'Sắp xếp',
                    ],
                    [
                        'view' => [
                            'type' => 'action',
                            'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                            'actions' => [
                                [
                                    'html' => '<i class="fa fa-file-image-o"></i>',
                                    'action' => function ($data) {
                                        return url()->action(ProductImageController::class . '@main', $data['id']);
                                    },
                                ],
                                [
                                    'html' => '<i class="icon-list"></i>',
                                    'action' => function ($data) {
                                        return url()->action(ProductPropertyTypeController::class . '@main', $data['id']);
                                    },
                                ],
                                [
                                    'html' => '<i class="icon-pencil"></i>',
                                    'action' => function ($data) {
                                        return url()->action(__CLASS__ . '@initForm', $data['id']);
                                    },
                                ],
                                [
                                    'html' => '<i class="icon-trash"></i>',
                                    'attrs' => [
                                        'class' => 'btn btn-danger btn-sm',
                                        'action-delete' => 'button',
                                    ],
                                    'action' => function ($data) {
                                        return url()->action(__CLASS__ . '@delete', $data['id']);
                                    },
                                ],
                            ],
                        ],
                        'key' => 'id',
                        'title' => '',
                    ],
                ],
                'tableData' => Obj::orderBy('sort', 'ASC')
                    ->paginate(10),
                // 'tableData' => Obj::paginate(10),
            ]
        );

        $this->data['controller'] = __CLASS__;


        $this->data['breadcrumbs'] = [
            [
                'name' => 'DS Seo',
            ],
        ];
    }

    private function renderTreeTrademark($trademark, $tree = '')
    {

        $check = 0;
        $trade = $trademark;
        $tree .= '<strong class="text-primary">' . $trademark->name . '</strong>';
        while ($trade->trademark && $check < 10) {
            $check++;
            $trade = $trade->trademark;
            $tree = $trade->name . ' / ' . $tree;
        }

        return $tree;
    }

    /**
     * Init Form.
     */
    public function initForm(Request $request, Obj $object)
    {
        $this->data['breadcrumbs'] = [
            [
                'name' => 'DS Seo',
                'url' => route('admin.trademark')
            ],
            [
                'name' => $object->page ?? $object->title ?? 'Tạo mới',
            ],
        ];
        return parent::generateForm($request, $object);
    }

    /**
     * Action Form.
     */
    public function actionForm(Request $request, Obj $object)
    {
        return parent::saveForm($request, $object);
    }

    /**
     * Delete.
     */
    public function delete(Request $request, Obj $object)
    {
        return parent::deleteItem($request, $object);
    }

    /**
     * Acitve.
     */
    public function active(Request $request, Obj $object)
    {
        return parent::activeItem($request, $object);
    }

    /**
     * Sort
     */
    public function actionSort(Request $request, String $type, Obj $object)
    {
        return parent::sortItem($request, $type, $object);
    }

    /**
     * Put.
     */
    public function put(Request $request, String $key, Obj $object)
    {
        return parent::putItem($request, $key, $object);
    }
}
