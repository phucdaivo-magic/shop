<?php

namespace App\Services\User;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactService
{

  public function save(Request $request)
  {
    Contact::create(
      $request->only([
        'project_id',
        'name',
        'email',
        'phone',
        'title',
        'content',
      ])
    );
  }
}
