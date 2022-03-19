<?php

namespace App\Http\Controllers\User;

use App\Services\User\ProjectService;
use App\Services\User\SeoService;
use Illuminate\Http\Request;

const PAGINATE = 9;

class ProjectController extends BaseController
{
    private $service;
    private $seoService;

    public function __construct(
        ProjectService $service,
        SeoService $seoService
    ) {
        $this->service = $service;
        $this->seoService = $seoService;
    }

    public function index(Request $request)
    {

        $this->meta = $this->seoService->getMeta($request);
        $projectList = $this->service->getProjectList();

        $projectTypeList = $this->service->getProjectTypeList();

        return view(
            'user.pages.project.list',
            compact(
                'projectList',
                'projectTypeList'
            ),
            $this->compactSetting()
        );
    }

    public function projectType(Request $request, String $type)
    {
        $projectType = $this->service->getProjectType($type);

        if ($projectType) {
            $this->meta = $this->seoService->getMetaByProjectType($projectType->id);

            $projectList = $this->service->getProjectList([
                'project_type_id' => $projectType->id ?? null
            ]);

            $projectTypeList = $this->service->getProjectTypeList();

            return view(
                'user.pages.project.list',
                compact('projectList', 'projectTypeList', 'projectType'),
                $this->compactSetting()
            );
        } else {
            abort(404);
        }
    }

    public function projectDetail(Request $request ,String $slug)
    {
        $project = $this->service->getProject($slug);
        if ($project) {
            $this->meta = $this->seoService->getMetaByProjectId($project->id);
            $this->meta->image = $project->image;
            return view('user.pages.project.detail', compact('project'), $this->compactSetting());
        } else {
            abort(404);
        }
    }
}
