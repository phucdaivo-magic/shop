<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Category as Obj;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends AdminController
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
                                $categories = [[
                                    'name' => 'Danh mục cha',
                                    'id' => ''
                                ]];

                                $categories = array_merge(
                                    $categories,
                                    Category::where('id', '<>', $data->id)
                                        ->whereNull('category_id')
                                        ->get()
                                        ->toArray()
                                );
                                return $categories;
                            }
                        ],
                    ],
                    [
                        'key' => 'name',
                        'view' => function ($category) {
                            return $this->renderTreeCategory($category);
                        },
                        'title' => 'Tên',
                        'edit' => [
                            'placeholder' => 'Tên danh mục',
                        ],
                    ],
                    [
                        'key' => 'url',
                        'view' => [],
                        'title' => 'URL',
                        'edit' => [
                            'placeholder' => 'http://...',
                        ],
                    ],
                    [
                        'view' => [
                            'type' => 'checkbox',
                            'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                        ],
                        'key' => 'active',
                        'title' => 'Hiển thị danh mục',
                        'edit' => [
                            'type' => 'checkbox',
                        ],
                    ],
                    [
                        'view' => [
                            'type' => 'checkbox',
                            'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                        ],
                        'key' => 'home',
                        'title' => 'Hiển thị đầu trang',
                        'edit' => [
                            'type' => 'checkbox',
                        ],
                    ],
                    $this->getSortTemplate(__CLASS__),
                    [
                        'view' => [
                            'type' => 'action',
                            'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                            'actions' => [
                                [
                                    'html' => '<i class="icon-list"></i>',
                                    'action' => function ($data) {
                                        return route('admin.product', ['category_id_eq' => $data->id]);
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
                'tableData' => []
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

    public function onBeforeIndex()
    {
        $this->data['tableData'] = Obj::orderBy('category_id', 'ASC')
            ->orderBy('sort', 'ASC')
            ->paginate(50);
    }

    private function renderTreeCategory($category, $tree = '')
    {

        $check = 0;
        $cate = $category;
        $tree .= '<strong class="text-primary">' . $category->name . '</strong>';
        while ($cate->category && $check < 10) {
            $check++;
            $cate = $cate->category;
            $tree = $cate->name . ' / ' . $tree;
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
                'url' => route('admin.category')
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
        return parent::sortItem($request, $type, $object, function ($next) use ($object) {
            return $next->where('category_id', $object->category_id);
        });
    }

    /**
     * Put.
     */
    public function put(Request $request, String $key, Obj $object)
    {
        return parent::putItem($request, $key, $object);
    }
}
