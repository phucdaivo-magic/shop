<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Product;
use App\Models\ProductPropertyType as Obj;
use Illuminate\Http\Request;

class ProductPropertyTypeController extends AdminController
{

    const TYPE_PROPERTY_COLOR = 'color_property';
    const TYPE_PROPERTY_TEXT = 'text_property';
    const TYPE_PROPERTY_IMAGE = 'image_property';

    const TYPE_PROPERTY = [
        [
            'name' => 'Màu sắc',
            'id' => ProductPropertyTypeController::TYPE_PROPERTY_COLOR
        ],
        [
            'name' => 'Chữ',
            'id' => ProductPropertyTypeController::TYPE_PROPERTY_TEXT
        ],
        [
            'name' => 'Hình ảnh',
            'id' => ProductPropertyTypeController::TYPE_PROPERTY_IMAGE
        ]
    ];

    const TYPE_PROPERTY_HTML = [
        [
            'name' => 'Radio',
            'id' => 'radio'
        ],
        [
            'name' => 'Checkbox',
            'id' => 'checkbox'
        ],
        [
            'name' => 'Selectbox',
            'id' => 'selecbox'
        ]
    ];

    public function __construct()
    {
        parent::__construct();

        $getValue = function ($collection, $key) {
            $text = '';
            foreach ($collection as $value) {
                $text = $value['id'] == $key ? $value['name'] : $text;
            }
            return  $text;
        };

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
                        'key' => 'product_id',
                        'title' => 'Sản phẩm',
                        'edit' => [],
                    ],
                    [
                        'key' => 'name',
                        'view' => [],
                        'title' => 'Tên thuộc tính',
                        'edit' => [
                            'placeholder' => 'Tên thuộc tính',
                        ],
                    ],
                    [
                        'key' => 'type',
                        'view' => function ($object) use ($getValue) {
                            return  $getValue(ProductPropertyTypeController::TYPE_PROPERTY, $object->type);
                        },
                        'title' => 'Loại',
                        'edit' => [
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => ProductPropertyTypeController::TYPE_PROPERTY,
                        ],
                    ],
                    [
                        'key' => 'type_element',
                        'view' => function ($object) use ($getValue) {
                            return $getValue(ProductPropertyTypeController::TYPE_PROPERTY_HTML, $object->type_element);
                        },
                        'edit' => [
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => ProductPropertyTypeController::TYPE_PROPERTY_HTML,
                        ],
                        'title' => 'Loại HTML',
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
                                        return url()->action(ProductPropertyDetailController::class . '@main', [$data['product_id'], $data->id]);
                                    },
                                ],
                                [
                                    'html' => '<i class="icon-pencil"></i>',
                                    'action' => function ($data) {
                                        return url()->action(__CLASS__ . '@initForm', [$data['product_id'], $data->id]);
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
                // 'tableData' => Obj::paginate(10),
            ]
        );

        $this->data['controller'] = __CLASS__;
        $this->data['redirect'] = function ($data) {
            return redirect(url()->action(__CLASS__ . '@main', [$data['product_id']]));
        };


        $this->data['breadcrumbs'] = [
            [
                'name' => 'DS Seo',
            ],
        ];
    }

    public function main(Request $request, Product $product)
    {

        $this->data['breadcrumbs'] = [
            [
                'name' => 'Danh sách sản phẩm',
                'url' => route('admin.product')
            ],
            [
                'name' => $product->name,
                'url' => route('admin.product', ['id_eq' => $product->id ])
            ],
            [
                'name' => 'Danh sách thuộc tính',
                'url' => route('admin.product.property-type', $product->id)
            ],
        ];

        $model = Obj::orderBy('sort', 'ASC')
            ->where('product_id', $product->id);
        $this->data['tableData'] = $this->search($model, $request, $this->getListSearch())->paginate($this->getPerPage());

        return parent::index($request);
    }

    /**
     * Init Form.
     */
    public function initForm(Request $request, Product $product, Obj $object)
    {
        $this->data['header'][1] = [
            'key' => 'product_id',
            'title' => 'Sản phẩm',
            'edit' => [
                'type' => 'select',
                'map' => ['id', 'name'],
                'dataSource' => [$product],
                'attrs' => [
                    'readonly' => true
                ]
            ],
        ];

        $this->data['breadcrumbs'] = [
            [
                'name' => 'Danh sách sản phẩm',
                'url' => route('admin.product')
            ],
            [
                'name' => $product->name,
                'url' => route('admin.product', ['id_eq' => $product->id ])
            ],
            [
                'name' => 'Danh sách thuộc tính',
                'url' => route('admin.product.property-type', $product->id)
            ],
            [
                'name' => $object->name ? 'Cập nhật thuộc tính <strong>'.$object->name.'</strong>' : ($object->id ? 'Cập nhât thuộc tính <strong>#'.$object->id.'</strong>' : 'Thêm mới'),
                'url' => route('admin.product.property-type', $product->id, ['id_eq' => $object->id])
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
            return $next
                // ->where('trademark_id', $object->trademark_id)
                ->where('product_id', $object->project_id);
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
