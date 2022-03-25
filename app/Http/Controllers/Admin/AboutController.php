<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Category;
use App\Models\About as Obj;
use App\Models\Trademark;
use Illuminate\Http\Request;

class AboutController extends AdminController
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
                        'key' => 'name',
                        'view' => [],
                        'title' => 'Tên',
                        'edit' => []
                    ],
                    [
                        'key' => 'slug',
                        'view' => [],
                        'title' => 'Slug',
                        'edit' => [
                            'attrs'=> [
                                'readonly'=> true
                            ]
                        ]
                    ],
                    [
                        'key' => 'meta_description',
                        'view' => [],
                        'title' => 'Mô tả',
                        'edit' => [
                            'type' => 'textarea',
                        ],
                    ],
                    [
                        'key' => 'meta_keywords',
                        'view' => [],
                        'title' => 'Từ khoá',
                        'edit' => [
                            'type' => 'textarea',
                        ],
                    ],
                    [
                        'key' => 'content',
                        'view' => [],
                        'title' => 'Mô tả',
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
                    $this->getSortTemplate(__CLASS__),
                    [
                        'view' => [
                            'type' => 'action',
                            'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                            'actions' => [
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
            ]
        );

        $this->data['controller'] = __CLASS__;

        $this->data['breadcrumbs'] = [
            [
                'name' => 'Danh sách trang thông tin',
                'url' => route('admin.about')
            ]
        ];
    }

    public function onBeforeIndex(Request $request)
    {
        $model = Obj::orderBy('created_at', 'DESC')->orderBy('sort', 'ASC');

        $this->data['tableData'] = $this->search($model, $request, $this->getListSearch())->paginate($this->getPerPage());
    }

    /**
     * Init Form.
     */
    public function initForm(Request $request, Obj $object)
    {
        $this->data['breadcrumbs'] = [
            [
                'name' => 'Danh sách trang thông tin',
                'url' => route('admin.about')
            ],
            [
                'name' => $object->name ? 'Cập nhật trang: <a href=' . route('admin.about', ['id_eq' => $object->id]) . '>' . $object->name . '</a>' : ($object->id ? 'Cập nhật #' . $object->id : 'Tạo mới'),
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
