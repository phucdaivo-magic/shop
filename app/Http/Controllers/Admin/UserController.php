<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\User as Obj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UserController extends AdminController
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
                        'view' => [],
                        'key' => 'name',
                        'title' => 'Tên',
                        'edit' => [],
                    ],
                    [
                        'view' => [],
                        'key' => 'email',
                        'title' => 'Email( đăng nhập)',
                        'edit' => [],
                    ],
                    [
                        'key' => 'passwords',
                        'title' => 'Mật khẩu',
                        'edit' => [
                            'attrs'=>[
                                'type'=>'password'
                            ]
                        ],
                    ],
                    [
                        'key' => 'passwords_confirmation',
                        'title' => 'Nhập lại mật khẩu',
                        'edit' => [
                            'attrs'=>[
                                'type'=>'password'
                            ]
                        ],
                    ],
                    [
                        'key' => 'password',
                        'title' => 'Nhập lại mật password',
                        'edit' => [
                            'type' => 'hidden'
                        ],
                    ],
                    [
                        'view' => function ($object) {
                            return $object->created_at->format('d/m/Y');
                        },
                        'key' => 'created_at',
                        'title' => 'Ngày phát hành',
                    ],
                    [
                        'view' => [
                            'type' => 'action',
                            'attrs' => ['style' => 'width: 1px; font-weight: bold'],
                            'actions' => [
                                [
                                    'html' => '<i class="icon-pencil"></i>',
                                    'action' => function ($data) {
                                        return url()->action('Admin\UserController@initForm', $data['id']);
                                    },
                                ],
                                [
                                    'html' => '<i class="icon-trash"></i>',
                                    'attrs' => [
                                        'class' => 'btn btn-danger btn-sm',
                                        'action-delete' => 'button',
                                    ],
                                    'action' => function ($data) {
                                        return url()->action('Admin\UserController@delete', $data['id']);
                                    },
                                ],
                            ],
                        ],
                        'key' => 'id',
                        'title' => '',
                    ],
                ],
                'tableData' => Obj::where('id', '<>', 1)
                    ->paginate(10),
            ]
        );

        $this->data['controller'] = "Admin\UserController";


        $this->data['breadcrumbs'] = [
            [
                'name' => 'DS quản trị viên',
            ],
        ];


    }

    private function checkAdmin(Request $request) {
        if(!$request->user() || $request->user()->id != 1) {
            abort(404);
        }
    }

    /**
     * Init Form.
     */
    public function initForm(Request $request, Obj $object)
    {
        $this->checkAdmin($request);

        if($object->id) {
            $this->data['header'][1] = null;
            $this->data['header'][2] = null;
        }
        // $object->password = '';
        $this->data['breadcrumbs'] = [
            [
                'name' => 'DS quản trị viên',
                'url' => route('admin.seo')
            ],
            [
                'name' => $object->name ?? 'Tạo mới',
            ],
        ];
        return parent::generateForm($request, $object);
    }

    /**
     * Action Form.
     */
    public function actionForm(Request $request, Obj $object)
    {
        $this->checkAdmin($request);

        $request->merge([
            'password' => Hash::make($request->input('passwords')),
        ]);

        return parent::saveForm($request, $object);
    }

    /**
     * Delete.
     */
    public function delete(Request $request, Obj $object)
    {
        $this->checkAdmin($request);

        return parent::deleteItem($request, $object);
    }

    /**
     * Acitve.
     */
    public function active(Request $request, Obj $object)
    {
        return parent::activeItem($request, $object);
    }
}
