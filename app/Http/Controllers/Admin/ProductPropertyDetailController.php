<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Product;
use App\Models\ProductPropertyDetail as Obj;
use App\Models\ProductPropertyType;
use Illuminate\Http\Request;

class ProductPropertyDetailController extends AdminController
{
    const TYPE_PROPERTY = [
        [
            'name' => 'Màu sắc',
            'id' => 'color_property'
        ],
        [
            'name' => 'Chữ',
            'id' => 'text_property'
        ],
        [
            'name' => 'Hình ảnh',
            'id' => 'image_property'
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
                        'key' => 'product_property_type_id',
                        'title' => 'Thuộc tính',
                        'edit' => [],
                    ],
                    [
                        'key' => 'name',
                        'view' => [],
                        'title' => 'Tên',
                        'edit' => [
                            'placeholder' => 'Tên',
                        ],
                    ],
                    [
                        'key' => 'slug',
                        'view' => [],
                        'title' => 'Slug',
                        'edit' => [
                            'attrs' => [
                                'readonly' => true
                            ]
                        ],
                    ],
                    [
                        'key' => 'value',
                        'view' => [],
                        'title' => 'Giá trị',
                        'edit' => [
                            'placeholder' => 'Giá trị',
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
                        'view' => function($object) {
                            return $object->price ? '<strong>'.getMoney($object->price).'</strong>' : 'Giá mặc định : <strong>'.getMoney($object->product->price).'</strong>';
                        },
                        'key' => 'price',
                        'title' => 'Giá',
                        'edit' => [
                            'type' => 'number',
                        ],
                    ],
                    [
                        'view' => function ($propertyDetail) {

                            return $propertyDetail->productImage ?
                                '<img data-fancybox="gallery-a" data-src="' . $propertyDetail->productImage->avatar . '" style="width: 100px" src="' . $propertyDetail->productImage->avatar . '"></img>' :
                                'Không chọn';;
                        },
                        'key' => 'product_image_id',
                        'title' => 'Sử dụng hình ảnh',
                        'edit' => [
                            'type' => 'include',
                            'path' => 'admin.custom.form-connect-field'
                        ]
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
                                        return url()->action(__CLASS__ . '@initForm', [$data['product_id'], $data['product_property_type_id'], $data->id]);
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
            return redirect(url()->action(__CLASS__ . '@main', [$data['product_id'], $data['product_property_type_id']]));
        };


        $this->data['breadcrumbs'] = [
            [
                'name' => 'DS Seo',
            ],
        ];
    }

    public function main(Request $request, Product $product, ProductPropertyType $productPropertyType)
    {

        $this->data['breadcrumbs'] = [
            [
                'name' => 'Danh sách sản phẩm',
                'url' => route('admin.product')
            ],
            [
                'name' => $product->name,
                'url' => route('admin.product', ['id_eq' => $product->id])
            ],
            [
                'name' => 'Danh sách thuộc tính',
                'url' => route('admin.product.property-type', $product->id)
            ],
            [
                'name' => $productPropertyType->name,
                'url' => route('admin.product.property-type', [$product->id, 'id_eq' => $productPropertyType->id])
            ],
            [
                'name' => 'Danh sách giá trị thuộc tính',
                'url' => route('admin.product.property-detail', [$product->id, $productPropertyType->id])
            ],
        ];

        if ($productPropertyType->type == ProductPropertyTypeController::TYPE_PROPERTY_IMAGE) {

            $this->data['header'][5] = [
                'key' => 'value',
                'title' => 'Hình ảnh',
                'view' => [
                    'type' => 'image',
                    'attrs' => ['style' => 'width: 160px'],
                ],
                'edit' => [],
            ];
        }

        // COLOR
        if ($productPropertyType->type == ProductPropertyTypeController::TYPE_PROPERTY_COLOR) {

            $this->data['header'][5] = [
                'key' => 'value',
                'title' => 'Màu sắc',
                'view' => [
                    'type' => 'color',
                ],
                'edit' => [
                    'type' => 'color'
                ],
            ];
        }

        $model = Obj::orderBy('sort', 'ASC')
            ->where('product_id', $product->id)
            ->where('product_property_type_id', $productPropertyType->id);
        $this->data['tableData'] = $this->search($model, $request, $this->getListSearch())->paginate($this->getPerPage());


        return parent::index($request);
    }

    /**
     * Init Form.
     */
    public function initForm(Request $request, Product $product, ProductPropertyType $productPropertyType, Obj $object)
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

        $this->data['header'][2] = [
            'key' => 'product_property_type_id',
            'title' => 'Thuộc tính',
            'edit' => [
                'type' => 'select',
                'map' => ['id', 'name'],
                'dataSource' => [$productPropertyType],
                'attrs' => [
                    'readonly' => true
                ]
            ],
        ];

        // IMAGE
        if ($productPropertyType->type == ProductPropertyTypeController::TYPE_PROPERTY_IMAGE) {

            $this->data['header'][5] = [
                'key' => 'value',
                'title' => 'Hình ảnh',
                'view' => [
                    'type' => 'image',
                    'attrs' => ['style' => 'width: 160px'],
                ],
                'edit' => [
                    'type' => 'image',
                    'src' => 'product/' . $object['product_id'] . '/property-type/' . $object['product_property_type_id'] . '/property-detal/' . $object['product_property_detail_id'],
                ],
            ];
        }

        // COLOR
        if ($productPropertyType->type == ProductPropertyTypeController::TYPE_PROPERTY_COLOR) {

            $this->data['header'][5] = [
                'key' => 'value',
                'title' => 'Màu sắc',
                'view' => [
                    'type' => 'color',
                ],
                'edit' => [
                    'type' => 'color'
                ],
            ];
        }

        $this->data['breadcrumbs'] = [
            [
                'name' => 'Danh sách sản phẩm',
                'url' => route('admin.product')
            ],
            [
                'name' => $product->name,
                'url' => route('admin.product', ['id_eq' => $product->id])
            ],
            [
                'name' => 'Danh sách thuộc tính',
                'url' => route('admin.product.property-type', $product->id)
            ],
            [
                'name' => $productPropertyType->name,
                'url' => route('admin.product.property-type',  [$product->id, 'id_eq' => $productPropertyType->id])
            ],
            [
                'name' => 'Danh sách giá trị thuộc tính',
                'url' => route('admin.product.property-detail', [$product->id, $productPropertyType->id])
            ],
            [
                'name' => $object->name ? 'Cập nhật <strong><a href="' . route('admin.product.property-detail', [$product->id, $productPropertyType->id, 'id_eq' => $object->id]) . '">' . $object->name . '</strong></a>' : ($object->id ? 'Cập nhật <strong><a href="' . route('admin.product.property-detail', [$product->id, $productPropertyType->id, 'id_eq' => $object->id]) . '">#' . $object->id . '</strong></a>' : 'Thêm mới'),
                'url' => route('admin.product.property-detail', [$product->id, $productPropertyType->id, 'id_eq' => $object->id])
            ],
        ];

        $object->product_id = $product->id;

        return parent::generateForm($request, $object);
    }

    /**
     * Action Form.
     */
    public function actionForm(Request $request, Obj $object)
    {

        $productPropertyType = ProductPropertyType::find($request->product_property_type_id);

        if ($productPropertyType->type == ProductPropertyTypeController::TYPE_PROPERTY_IMAGE) {

            $this->data['header'][5] = [
                'key' => 'value',
                'title' => 'Hình ảnh',
                'view' => [
                    'type' => 'image',
                    'attrs' => ['style' => 'width: 160px'],
                ],
                'edit' => [
                    'type' => 'image',
                    'src' => 'product/' . $productPropertyType['product_id'] . '/property-type/' . $productPropertyType['id'] . '/property-detal/' . $object['product_property_detail_id'],
                ],
            ];
        }

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
                ->where('product_id', $object->product_id)
                ->where('product_property_type_id', $object->product_property_type_id);
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
