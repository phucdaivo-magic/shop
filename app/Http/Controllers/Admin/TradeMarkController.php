<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Trademark as Obj;
use Illuminate\Http\Request;

class TradeMarkController extends AdminController
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
                        'key' => 'trademark_id',
                        'title' => 'Thương hiệu cha',
                        'edit' => [
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => function ($data) {
                                $trademarks = [[
                                    'name' => 'Thương hiệu cha',
                                    'id' => ''
                                ]];

                                $trademarks = array_merge($trademarks, Obj::where('id', '<>', $data->id)->get()->toArray());
                                return $trademarks;
                            }
                        ],
                    ],
                    [
                        'key' => 'name',
                        'view' => function ($trademark) {
                            return $this->renderTreeTrademark($trademark);
                        },
                        'title' => 'Tên thương hiệu',
                        'edit' => [
                            'placeholder' => 'Tên thương hiệu',
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
                                    'html' => '<i class="icon-list"></i>',
                                    'action' => function ($data) {
                                        return route('admin.product', ['trademark_id_eq' => $data->id]);
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
                'tableData' => [],
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
        $this->data['tableData'] = Obj::orderBy('trademark_id', 'ASC')
            ->orderBy('sort', 'ASC')
            ->paginate($this->getPerPage());
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
        return parent::sortItem($request, $type, $object, function ($next) use ($object) {
            return $next->where('trademark_id', $object->trademark_id);
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
