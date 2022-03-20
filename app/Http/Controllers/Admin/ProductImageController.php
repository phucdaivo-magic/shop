<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Product;
use App\Models\ProductImage as Obj;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends AdminController
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
                        'view' => function ($object) {
                            return $object->product->name ?? '';
                        },
                        'key' => 'product_id',
                        'title' => 'Sản phẩm',
                        'edit' => [
                            'type' => 'select',
                            'map' => ['id', 'name'],
                            'attrs' => [
                                'readonly' => true
                            ],
                            'dataSource' => Product::get(),
                        ],
                    ],
                    [
                        'view' => [
                            'type' => 'image',
                            'attrs' => ['style' => 'width: 160px'],
                        ],
                        'key' => 'image',
                        'title' => 'Hình ảnh',
                        'edit' => [
                            'type' => 'image',
                            'src' => 'product/image',
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
                                        return url()->action(__CLASS__ . '@actionSort', ['up', $data['id']], true);
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
                    [],
                ],
                'tableData' => [],
            ]
        );

        $this->data['controller'] = __CLASS__;
        $this->data['redirect'] = function ($data) {
            return redirect(url()->action(__CLASS__ . '@main', [$data['product_id']]));
        };
    }

    function main(Request $request, Product $product)
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
                'name' => 'Danh sách hình ảnh',
                'url' => route('admin.product.image', $product->id)
            ],
        ];

        $this->data['tableData'] = Obj::orderBy('sort', 'ASC')
            ->where('product_id', $product->id)
            ->paginate(30);


        $model = Obj::orderBy('sort', 'ASC')
            ->where('product_id', $product->id);
        $this->data['tableData'] = $this->search($model, $request, $this->getListSearch())->paginate(30);



        $this->data['header'][count($this->data['header']) - 1] =  [
            'view' => [
                'type' => 'action',
                'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                'actions' => [
                    [
                        'html' => '<i class="icon-pencil"></i>',
                        'action' => function ($data) {
                            return url()->action(__CLASS__ . '@initForm', [$data['product_id'],  $data['id']]);
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
    public function initForm(Request $request, Product $product, Obj $object)
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
                'name' => 'Danh sách hình ảnh',
                'url' => route('admin.product.image', $product->id)
            ],
            [
                'name' => $object->id ? 'Hình ảnh <strong><a href="' . route('admin.product.image', [$product->id, 'id_eq' => $object->id]) . '">#' . $object->id . '</a></strong>' : 'Thêm mới',
            ],
        ];

        !$object && $object = new Obj();
        $object->product_id = $product->id;

        if (!$object->id) {
            $this->data['header'][2] =  [
                'view' => [
                    'type' => 'image',
                    'attrs' => ['style' => 'width: 160px'],
                ],
                'key' => 'image[]',
                'title' => 'Hình ảnh',
                'edit' => [
                    'multiple' => true,
                    'type' => 'image',
                    'src' => 'product/image',
                ],
            ];
        }

        return parent::generateForm($request, $object);
    }

    /**
     * Action Form.
     */
    public function actionForm(Request $request, Obj $object)
    {
        $validator = Validator::make(Input::all(), $object::$rules, $object::$messages);
        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        }

        if (isset($object->id)) {
            return parent::saveForm($request, $object);
        } else {
            DB::beginTransaction();
            try {
                if (isset($request['image'])) {
                    foreach ($request['image'] as $file) {
                        $data = new Obj();

                        $path = time() . '_' . $file->getClientOriginalName();
                        $data['product_id'] = $request['product_id'];
                        $data['active'] = $request['active'] ? 1 : 0;
                        $data['image'] = $file->move('uploads/images/product/image/', $path);

                        $data->save();
                    }
                }
                $request->session()->flash('status', "Swal.fire(
                    'Thành công!',
                    'Click để tiếp tục',
                    'success'
                )");
                DB::commit();
            } catch (\Exception $e) {
                $request->session()->flash('status', "Swal.fire(
                'Không thành công!',
                'Click để tiếp tục',
                'error'
            )");
                Log::error('Error message: ' . $e->getMessage());
                DB::rollback();
            }

            return  isset($this->data['redirect']) ? call_user_func($this->data['redirect'], $data) : redirect(url()->action($this->data['controller'] . '@index'));
        }
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
                ->where('product_id', $object->product_id);
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
