<?php

namespace App\Services\User;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectType;

const PAGINATE = 9;

class ProjectService
{

  public function getProjectTypeList()
  {

    return ProjectType::where('active', true)
      ->orderBy('sort', 'ASC')
      ->get();
  }

  public function getProjectType($type)
  {
    return ProjectType::where('slug', $type)
      ->where('active', true)
      ->first();
  }

  public function getProjectList($conditions = [], $paginate = PAGINATE)
  {
    $projectList = Project::where('active', true)
      ->orderBy('sort', 'ASC')
      ->orderBy('created_at', 'DESC');
    foreach ($conditions as $key => $value) {
      $projectList->where($key, $value);
    }

    return $projectList->paginate($paginate);
  }

  public function getProject($slug)
  {
    return Project::where('slug', $slug)->first();
  }

  public function getImageHomeList()
  {
    return ProjectImage::where('active', true)
      ->orderBy('created_at', 'DESC')
      ->paginate(12);
  }
}
