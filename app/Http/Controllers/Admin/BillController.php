<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Category;
use App\Models\Bill as Obj;
use App\Models\Trademark;
use Illuminate\Http\Request;

class BillController extends AdminController
{

    const STATUS_BILL = [
        [
            'id' => 1,
            'name' => 'Đặt hàng',
        ],
        [
            'id' => 2,
            'name' => 'Duyệt đơn (Tiến hành đóng gói)',
        ],
        [
            'id' => 3,
            'name' => 'Đóng gói xong (Tiến hành giao hàng)',
        ],
        [
            'id' => 4,
            'name' => 'Đã nhận hàng và thanh toán',
        ],
        [
            'id' => 5,
            'name' => 'Đã thu tiền',
        ],
        [
            'id' => 6,
            'name' => 'Huỷ đơn hàng',
        ]
    ];

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
                        'search' => [
                            'title' => 'ID',
                            'type' => 'eq'
                        ]
                    ],
                    [
                        'key' => 'name',
                        'view' => [
                            'type' => 'include',
                            'path' => 'admin.custom.field-bill-product'
                        ],
                        'title' => 'Danh sách sản phẩm',
                        // 'search' => []
                    ],
                    [
                        'key' => 'name',
                        'view' => [
                            'type' => 'include',
                            'path' => 'admin.custom.field-bill-address'
                        ],
                        'title' => 'Địa chỉ giao hàng',
                        // 'search' => []
                    ],
                    [
                        'key' => 'shipping_price',
                        'view' => function ($bill) {
                            return getMoney($bill->shipping_price);
                        },
                        'title' => 'Phí ship',
                    ],

                    [
                        'key' => 'total_price',
                        'view' => function ($bill) {
                            return getMoney($bill->total_price);
                        },
                        'title' => 'Tổng tiền',
                    ],
                    [
                        'key' => 'status',
                        'view' => function ($object) {
                            return '<div style="min-width: 150px">'.$this::STATUS_BILL[$object->status ? $object->status - 1 : 0]['name'].'</div>';
                        },
                        'title' => 'Trạng thái',
                        'edit' => [
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => $this::STATUS_BILL,
                            'attrs' => [
                                'data-init-plugin' => 'select2'
                            ]
                        ],
                        'search' => [
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => $this::STATUS_BILL,
                            'attrs' => [
                                'data-init-plugin' => 'select2'
                            ]
                        ],

                    ],
                    [
                        'key' => 'note',
                        'view' => [],
                        'title' => 'Ghi chú',
                        'edit' => [
                            'type' => 'textarea'
                        ],
                        'search' => []
                    ],
                    //     [
                    //         'view' => function ($product) {
                    //             return $product->category->name ?? '';
                    //         },
                    //         'search' => [
                    //             'attrs' => [
                    //                 'data-init-plugin' => 'select2'
                    //             ],
                    //             'type' => 'select',
                    //             'map' => ['id', 'name'],
                    //             'dataSource' => Category::get()
                    //         ],
                    //         'key' => 'category_id',
                    //         'title' => 'Danh mục',
                    //         'edit' => [
                    //             'type' => 'select',
                    //             'map' => ['id', 'name'],
                    //             'dataSource' => function ($data) {
                    //                 return Category::get();
                    //             },
                    //             'attrs' => [
                    //                 'data-init-plugin' => 'select2'
                    //             ]
                    //         ],
                    //     ],
                    //     [
                    //         'view' => function ($product) {
                    //             return $product->trademark->name ?? '';
                    //         },
                    //         'search' => [
                    //             'attrs' => [
                    //                 'data-init-plugin' => 'select2'
                    //             ],
                    //             'type' => 'select',
                    //             'map' => ['id', 'name'],
                    //             'dataSource' => Trademark::get()
                    //         ],
                    //         'key' => 'trademark_id',
                    //         'title' => 'Thương hiệu / Chất liệu',
                    //         'edit' => [
                    //             'type' => 'select',
                    //             'map' => ['id', 'name'],
                    //             'dataSource' => array_merge([
                    //                 ['id' => '', 'name' => 'Không chọn']
                    //             ], collect(Trademark::get())->toArray()),
                    //             'attrs' => [
                    //                 'data-init-plugin' => 'select2'
                    //             ]
                    //         ],
                    //     ],
                    //     [
                    //         'key' => 'name',
                    //         // 'view' => [],
                    //         'title' => 'Tên sản phẩm',
                    //         'edit' => [
                    //             'placeholder' => 'Tên sản phẩm',
                    //         ],
                    //     ],
                    //     [
                    //         'key' => 'price',
                    //         'view' => function ($product) {
                    //             return number_format($product->price);
                    //         },
                    //         'title' => 'Giá',
                    //         'edit' => [
                    //             'placeholder' => 'Giá sản phẩm',
                    //             'type' => 'number'
                    //         ],
                    //     ],
                    //     [
                    //         'key' => 'description',
                    //         // 'view' => [],
                    //         'title' => 'Giới thiệu sản phẩm',
                    //         'edit' => [
                    //             'type' => 'textarea',
                    //             'attrs' => [
                    //                 'style' => 'width: 100%',
                    //                 'data-init-plugin' => 'ckeditor',
                    //             ],
                    //         ],
                    //     ],
                    //     [
                    //         'view' => [
                    //             'type' => 'checkbox',
                    //             'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                    //         ],
                    //         'key' => 'active',
                    //         'title' => 'Hiển thị',
                    //         'edit' => [
                    //             'type' => 'checkbox',
                    //         ],
                    //     ],
                    //     // $this->getSortTemplate(__CLASS__),
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

        $this->data['redirect'] =  function ($data) {
            return redirect(route('admin.bill', ['id_eq' => $data->id]));
        };

        $this->data['breadcrumbs'] = [
            [
                'name' => 'Danh sách đơn hàng',
                'url' => route('admin.bill')
            ]
        ];
    }

    public function onBeforeIndex(Request $request)
    {
        $model = Obj::orderBy('created_at', 'DESC');

        $this->data['tableData'] = $this->search($model, $request, $this->getListSearch())->paginate($this->getPerPage());
    }

    /**
     * Init Form.
     */
    public function initForm(Request $request, Obj $object)
    {
        $this->data['breadcrumbs'] = [
            [
                'name' => 'Danh sách sản phẩm',
                'url' => route('admin.product')
            ],
            [
                'name' => $object->name ? 'Cập nhật sản phẩm: <a href=' . route('admin.product', ['id_eq' => $object->id]) . '>' . $object->name . '</a>' : ($object->id ? 'Cập nhật #' . $object->id : 'Tạo mới'),
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
