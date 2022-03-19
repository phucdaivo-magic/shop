<?php

namespace App\Services\User;

use App\Models\FooterSeting;
use App\Models\HeaderSetting;

class SettingService
{
  public function getHeaderSetting()
  {
    $seting = HeaderSetting::first();

    return $seting;
  }

  public function getFooterSetting()
  {
    $seting = FooterSeting::first();

    return $seting;
  }
}
