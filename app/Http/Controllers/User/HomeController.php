<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Form;
use App\Models\FormData;
use App\Models\FormProperty;
use App\Services\User\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class HomeController extends BaseController
{
    private $projectService;

    public function __construct(
        ProjectService $projectService
    ) {
        $this->projectService = $projectService;
    }

    public function index(Request $request)
    {
        $projectList = $this->projectService->getProjectList([], 6);
        $imageList = $this->projectService->getImageHomeList();

        return  view(
            'user.pages.home.index',
            $this->compactSetting(),
            compact('projectList', 'imageList')
        );
    }

    public function getForm(Request $request, Form $form)
    {

        $forms = $form->property->where('active', true);

        return view('form', $this->compactSetting(), compact('forms'));
    }

    public function putForm(Request $request, Form $form)
    {

        $rules = [];
        $messages = [];
        foreach ($form->property as $key => $property) {
            if ($property->validate) {
                $rules[$property->name] = $property->validate;
                $messages[$property->name . '.' . $property->validate] = $property->message;
            }
        }
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->to(url()->previous() . '#' . $form->slug)->withErrors($validator)->withInput();
        }


        $formData = new FormData();

        $formData->data = json_encode($request->except(['_token']));

        $form->data()->save($formData);

        return redirect()->to(url()->previous());
    }
}
