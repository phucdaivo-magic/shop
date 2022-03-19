<?php

namespace App\Http\Controllers\User;

use App\Services\User\AboutService;
use App\Services\User\SeoService;
use Illuminate\Http\Request;

class AboutController extends BaseController
{
    private $service;
    private $seoService;

    public function __construct(
        AboutService $service,
        SeoService $seoService
    ) {
        $this->service = $service;
        $this->seoService = $seoService;
    }

    public function index(Request $request)
    {
        $this->meta = $this->seoService->getMeta($request);

        $about['overviews'] = $this->service->getAboutByType(AboutService::OVERVIEW);
        $about['activities'] = $this->service->getAboutByType(AboutService::ACTIVITY);
        $about['visions'] = $this->service->getAboutByType(AboutService::VISION);
        $about['maps'] = $this->service->getAboutByType(AboutService::MAP);

        return  view('user.pages.about.index', compact('about'), $this->compactSetting());
    }
}
