<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Bill as Obj;
use App\Models\Trademark;
use Illuminate\Http\Request;

class IndexController extends Controller
{



    public function __construct()
    {
        url()->setRootControllerNamespace('');
    }

    public function index() {
        return view('admin.pages.index');
    }
}
