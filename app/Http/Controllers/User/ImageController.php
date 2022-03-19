<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\ImageService;
use Illuminate\Http\Request;


class ImageController extends BaseController
{
    private $service;

    public function __construct(
        ImageService $service
    ) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $this->meta['title'] = 'Hình ảnh';
        $imageList = $this->service->getImageList();

        return  view('user.pages.image.index', compact('imageList'), $this->compactSetting());
    }
}
