<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Concerns\Paginatable;
use App\Http\Controllers\Concerns\Search;
use Log;
use App\Models\Project;

class AdminController extends Controller
{
    use Paginatable, Search;

    public function __construct()
    {
        $this->middleware('auth');
        url()->setRootControllerNamespace('');
    }

    protected $data = [];

    protected function initData($data)
    {
        $this->data = $data;
    }

    protected function index(Request $request)
    {
        method_exists($this, 'onBeforeIndex') && $this->onBeforeIndex($request);

        return view('admin.list')->with('data', $this->data);
    }

    protected function generateForm(Request $request, $data)
    {
        $this->data['form'] = $data;

        return view('admin.form')->with('data', $this->data);
    }

    private function verifyFillable($data, $key)
    {
        return !!count($data->getFillable()) ? collect($data->getFillable())->contains($key) : true;
    }

    protected function saveForm(Request $request, $data, $callBack = null)
    {
        $validator = Validator::make(Input::all(), $data::$rules, $data::$messages);
        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            foreach ($this->data['header'] as $key => $item) {
                if (isset($item['save']) && is_callable($item['save'])) {
                    call_user_func($item['save'], $request, $data);
                } elseif ($this->verifyFillable($data, $item['key'] ?? null) && isset($item['edit']) && !is_callable($item['edit']) && isset($request[$item['key']])) {
                    if (isset($item['edit']['type'])) {
                        switch ($item['edit']['type']) {
                            case 'checkbox':
                                $data[$item['key']] = $request[$item['key']] ? 1 : 0;
                                break;

                            case 'image':
                                if (isset($request[$item['key']])) {
                                    $fileOld = $data[$item['key']];

                                    $file = $request[$item['key']];
                                    $path = time() . '_' . $file->getClientOriginalName();
                                    $data[$item['key']] = $file->move('uploads/images/' . (isset($item['edit']['src']) ? $item['edit']['src'] . '/' : ''), $path);

                                    if (File::exists($fileOld)) {
                                        File::delete($fileOld);
                                    }
                                }
                                break;

                            default:
                                $data[$item['key']] = $request[$item['key']];
                                break;
                        }
                    } else {
                        $data[$item['key']] = $request[$item['key']];
                    }
                }
            }

            $data->save();
            $data->refresh();

            if ($callBack) $callBack($data);
            $request->session()->flash('status', "Swal.fire(
                'Thành công!',
                'Click để tiếp tục',
                'success'
            )");
            DB::commit();
        } catch (\Exception $e) {
            $request->session()->flash('status', "Swal.fire(
            'Không thành công!',
            'Click để tiếp tục',
            'error'
        )");
            Log::error('Error message: ' . $e->getMessage());
            DB::rollback();
        }

        return  isset($this->data['redirect']) ? call_user_func($this->data['redirect'], $data) : redirect(url()->action($this->data['controller'] . '@index'));
    }

    protected function deleteItem(Request $request, $data)
    {
        DB::beginTransaction();
        try {
            $data->delete();
            $request->session()->flash('status', "Swal.fire(
                'Thành công!',
                'Click để tiếp tục',
                'success'
            )");
            DB::commit();
        } catch (\Exception $e) {
            $request->session()->flash('status', "Swal.fire(
                'Không thành công!',
                'Click để tiếp tục',
                'error'
            )");
            DB::rollback();
        }
        return isset($this->data['redirect']) ? call_user_func($this->data['redirect'], $data) : redirect(url()->action($this->data['controller'] . '@index'));
    }

    protected function activeItem(Request $request, $data)
    {
        DB::beginTransaction();
        try {
            $data->active = ($request->data == 'false') ? 1 : 0;
            $data->save();
            DB::commit();

            return  $data->active;
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function sortItem(Request $request, String $type, $data, $cb = null)
    {
        DB::beginTransaction();
        try {

            $sort = $data->sort;
            $next = null;

            if ($type == 'down') {
                $next = $data->where('sort', '>', $sort)->orderBy('sort', 'ASC');
            } else if ($type == 'up') {
                $next = $data->where('sort', '<', $sort)->orderBy('sort', 'DESC');
            } else if ($type == 'first') {
                $next = $data->where('sort', '<', $sort)->orderBy('sort', 'ASC');
            } else  if ($type == 'last') {
                $next = $data->where('sort', '>', $sort)->orderBy('sort', 'DESC');
            }

            if(isset($cb)) {
                $next = call_user_func($cb, $next );
            }
            $next = $next->first();
            $data->sort = $next->sort;
            $next->sort = $sort;

            $data->save();
            $next->save();
            DB::commit();

            $request->session()->flash('status', "Swal.fire(
                'Thành công!',
                'Click để tiếp tục',
                'success'
            )");

        } catch (\Exception $e) {
            $request->session()->flash('status', "Swal.fire(
                'Không thành công!',
                'Click để tiếp tục',
                'error',
            )");

            DB::rollback();
        }
        return \Redirect::back();
    }

    protected function putItem(Request $request, $key, $data)
    {
        DB::beginTransaction();
        try {
            $data->{$key} = ($request->data == 'false') ? 1 : 0;
            $data->save();
            DB::commit();

            return  $data->{$key};
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    protected function getListSearch() {
        return collect($this->data['header'])->reduce(function ($acc, $cur) {
            if (isset($cur['search'])) {
                $acc[] = $cur['search']['name'] ?? $cur['key'];
            }
            return $acc;
        }, []);
    }
}
