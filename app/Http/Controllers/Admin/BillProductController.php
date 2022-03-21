<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Bill;
use App\Models\BillProduct as Obj;
use Illuminate\Http\Request;

class BillProductController extends AdminController
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
                        'view' => function ($object) {
                            return $object->product->name;
                        },
                        'key' => 'id',
                        'title' => 'Tên sản phẩm',
                    ],
                    [
                        'view' => [],
                        'key' => 'mount',
                        'title' => 'Số lượng',
                        'edit' => [
                            'type' => 'number'
                        ],
                    ],
                    [
                        'view' => function ($object) {
                            return getMoney($object->current_price);
                        },
                        'key' => 'current_price',
                        'title' => 'Đơn giá',
                        'edit' => [
                            'type' => 'number'
                        ],
                    ],
                    [
                        'view' => function ($object) {
                            return getMoney($object->current_price * $object->mount);
                        },
                        'key' => 'id',
                        'title' => 'Tổng tiền',
                    ],

                ],
                'tableData' => []
            ]
        );

        $this->data['redirect'] =  function ($data) {
            return redirect(route('admin.bill.product', [$data->bill_id]));
        };

        $this->data['controller'] = __CLASS__;
    }

    function main(Request $request, Bill $bill)
    {


        $this->data['breadcrumbs'] = [
            [
                'name' => 'Danh sách đơn hàng',
                'url' => route('admin.bill')
            ],
            [
                'name' => '#' . $bill->id,
                'url' => route('admin.bill', ['id_eq' => $bill->id])
            ],
            [
                'name' => 'Danh sách sản phẩm',
                'url' => route('admin.bill.product', [$bill->id])
            ],
        ];

        $model = Obj::orderBy('created_at', 'ASC')
            ->where('bill_id', $bill->id);
        $this->data['tableData'] = $this->search($model, $request, $this->getListSearch())->paginate($this->getPerPage());


        $this->data['header'][count($this->data['header']) - 1] =  [
            'view' => [
                'type' => 'action',
                'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                'actions' => [
                    [
                        'html' => '<i class="icon-pencil"></i>',
                        'action' => function ($data) {
                            return url()->action(__CLASS__ . '@initForm', [$data['bill_id'], $data['id']]);
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
        ];

        return parent::index($request);
    }

    /**
     * Init Form.
     */
    public function initForm(Request $request, Bill $bill, Obj $object)
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
