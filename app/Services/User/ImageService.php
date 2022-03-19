<?php

namespace App\Services\User;

use App\Models\ProjectImage;

class ImageService
{

  public function getImageList()
  {
    return ProjectImage::where('active', true)
      ->orderBy('created_at', 'DESC')
      ->paginate(20);
  }
}
