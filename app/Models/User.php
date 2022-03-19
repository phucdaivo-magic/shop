<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{

    public static $rules = [
        'name' => 'sometimes|required',
        'email' => 'sometimes|required|email|unique:users',
        'passwords' => 'required|confirmed',
    ];
    public static $messages = [
        'name.required' => 'Tên không được để trống',
        'email.required' => 'Email không được để trống',
        'email.email' => 'Nhập đúng địa chỉ email',
        'email.unique' => 'Email này đã tồn tại',
        'passwords.required' => 'Mật khẩu không được để trống',
        'passwords.confirmed' => 'Mật khẩu không trùng khớp',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
