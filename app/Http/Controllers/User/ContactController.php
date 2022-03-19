<?php

namespace App\Http\Controllers\User;

use App\Services\User\ContactService;
use Illuminate\Http\Request;


class ContactController extends BaseController
{
    private $service;

    public function __construct(
        ContactService $service
    ) {
        $this->service = $service;
    }

    public function index() {
        $this->meta['title'] = 'Liên hệ';

        return view('user.pages.contact.index', $this->compactSetting());
    }

    public function store(Request $request)
    {
        $this->service->save($request);

        return redirect(route('user.projects'));
    }
}
