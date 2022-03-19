<?php

namespace App\Services\User;

use App\Models\About;

class AboutService
{
  const OVERVIEW = 1;
  const ACTIVITY = 2;
  const VISION = 3;
  const MAP = 4;

  const TYPE_ABOUTS = [
    [
      'id' => AboutService::OVERVIEW,
      'name' => 'THÔNG ĐIỆP TỔNG GIÁM ĐỐC'
    ],
    [
      'id' => AboutService::ACTIVITY,
      'name' => 'LĨNH VỰC HOẠT ĐỘNG'
    ],
    [
      'id' => AboutService::VISION,
      'name' => 'TẦM NHÌN SỨ MỆNH'
    ],
    [
      'id' => AboutService::MAP,
      'name' => 'SƠ ĐỒ TỔ CHỨC'
    ]
  ];

  public function __construct()
  {
    $this->aboutList = About::where('active', true)
    ->get();
  }

  public function getAboutByType($type)
    {
        return collect($this->aboutList)->filter(function ($item, $key) use ($type) {
            return $item->type == $type;
        });
    }
}
