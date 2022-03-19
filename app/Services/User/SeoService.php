<?php

namespace App\Services\User;

use App\Models\Seo;
use Illuminate\Http\Request;

class SeoService
{

  public function getMeta(Request $request)
  {
    $seo = Seo::where('page', $request->fullUrl())->first();

    return $seo;
  }

  public function getMetaByProjectType($projectTypeId)
  {
    $seo = Seo::where('project_type_id', $projectTypeId)->first();

    return $seo;
  }

  public function getMetaByProjectId($projectId)
  {
    $seo = Seo::where('project_id', $projectId)->first();

    return $seo;
  }
}
