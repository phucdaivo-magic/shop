<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Category;
use App\Models\Product as Obj;
use App\Models\ProductImage;
use App\Models\Trademark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
                        'search' => [
                            'title' => 'ID',
                            'type' => 'eq'
                        ]
                    ],
                    [
                        'key' => 'avatar',
                        'view' => [
                            'type' => 'image'
                        ],
                        'title' => 'Hình ảnh',
                    ],
                    [
                        'key' => 'name',
                        'view' => function ($product) {
                            return '<a class="d-block" style="min-width: 140px" href="' . route('site.product.detail', [$product->id, $product->slug]) . '">' . $product->name . '</a>';
                        },
                        'title' => 'Tên sản phẩm',
                        'search' => []
                    ],
                    [
                        'view' => function ($product) {
                            return $product->category->name ?? '';
                        },
                        'search' => [
                            'attrs' => [
                                'data-init-plugin' => 'select2'
                            ],
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => Category::whereNotNull('category_id')->get()
                        ],
                        'key' => 'category_id',
                        'title' => 'Danh mục',
                        'edit' => [
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => function ($data) {
                                return Category::get();
                            },
                            'attrs' => [
                                'data-init-plugin' => 'select2'
                            ]
                        ],
                    ],
                    [
                        'view' => function ($product) {
                            return $product->trademark->name ?? '';
                        },
                        'search' => [
                            'attrs' => [
                                'data-init-plugin' => 'select2'
                            ],
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => Trademark::get()
                        ],
                        'key' => 'trademark_id',
                        'title' => 'Thương hiệu',
                        'edit' => [
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'dataSource' => array_merge([
                                ['id' => '', 'name' => 'Không chọn']
                            ], collect(Trademark::get())->toArray()),
                            'attrs' => [
                                'data-init-plugin' => 'select2'
                            ]
                        ],
                    ],
                    [
                        'key' => 'name',
                        // 'view' => [],
                        'title' => 'Tên sản phẩm',
                        'edit' => [
                            'placeholder' => 'Tên sản phẩm',
                            'type' => 'textarea'
                        ],
                    ],
                    [
                        'key' => 'price',
                        'view' => function ($product) {
                            return '<div style="min-width: 110px; text-align: right;">' . getMoney($product->price) . '<div>';
                        },
                        'title' => 'Giá',
                        'edit' => [
                            'placeholder' => 'Giá sản phẩm',
                            'type' => 'number'
                        ],
                    ],
                    [
                        'key' => 'description',
                        // 'view' => [],
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
                    $this->getSortTemplate(__CLASS__),
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
                                    'html' => '<i class="fa fa-clone"></i>',
                                    'action' => function ($data) {
                                        return url()->action(__CLASS__ . '@clone', $data['id']);
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
                'formLeft' => 'admin.custom.form-product'
            ]
        );

        $this->data['controller'] = __CLASS__;

        $this->data['redirect'] =  function ($data) {
            return redirect(route('admin.product', ['id_eq' => $data->id]));
        };

        $this->data['breadcrumbs'] = [
            [
                'name' => 'Danh sách sản phẩm',
                'url' => route('admin.product')
            ]
        ];
    }

    public function onBeforeIndex(Request $request)
    {
        $model = Obj::orderBy('sort', 'ASC')->orderBy('created_at', 'DESC');

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

    public function clone(Obj $object)
    {

        $clone = $object->replicateRow();
        return redirect(route('admin.product', ['id_eq' => $clone->id]));
    }

    public function cloneAll()
    {
        $products = Obj::where('sort', '<', 46)->get();
        foreach ($products  as $key => $product) {
            $product->replicateRow();
        }
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


    public function imageList(Obj $object)
    {
        $imageList = $object->images;

        return response()->json($imageList);
    }

    public function storeImage(Request $request, Obj $object)
    {
        $imageList = [];
        foreach ($request['files'] as $file) {
            if ($object->images()->count() >= 9) {
                break;
            }
            $name = time() . '_' . $file->getClientOriginalName();
            $data['product_id'] = $object->id;
            $data['image'] = $file->move('uploads/images/product/' . $object->id . '/image/', $name);
            $imageList[] = $object->images()->create($data);
        }

        return response()->json($imageList);
    }

    public function sortImage(Request $request, Obj $object)
    {
        foreach ($request['ids'] as $key => $id) {
            $image = $object->images()->find($id);
            $image->sort = $key + 1;
            $image->save();
            $ids[] = $image;
        }

        return response()->json([
            'sort'=> true
        ]);
    }


    public function deleteImage(ProductImage $image)
    {
        $image->delete();
        if (File::exists($image->image)) {
            File::delete($image->image);
        }
        return response()->json([
            'delete'=> true
        ]);
    }
}
