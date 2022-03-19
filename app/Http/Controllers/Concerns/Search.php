<?php

namespace App\Http\Controllers\Concerns;

trait Search
{
    /**
     * Convert param a__b to a.b
     */
    private function convertParam($param)
    {
        return str_replace('__', '.', $param);
    }

    /**
     * Search _eq, _cont, _min, _max
     */
    public function search($model, $request, $filter)
    {

        // Search.
        foreach ($request->input() as $param => $search) {
            $isset = (is_numeric($search) || isset($search));
            if (count(explode('_eq', $param)) == 2 && in_array($this->convertParam(explode('_eq', $param)[0]), $filter) && $isset) {
                $model->where($this->convertParam(explode('_eq', $param)[0]), $search);
            }
            if (count(explode('_cont', $param)) == 2 && in_array($this->convertParam(explode('_cont', $param)[0]), $filter) && $isset) {
                $model->where($this->convertParam(explode('_cont', $param)[0]), 'like', '%' . $search . '%');
            }
            if (count(explode('_min', $param)) == 2 && in_array($this->convertParam(explode('_min', $param)[0]), $filter) && $isset) {
                $model->where($this->convertParam(explode('_min', $param)[0]), '>=', $search);
            }
            if (count(explode('_max', $param)) == 2 && in_array($this->convertParam(explode('_max', $param)[0]), $filter) && $isset) {
                $model->where($this->convertParam(explode('_max', $param)[0]), '<=', $search);
            }
        }

        if ($request->has('active_eq')) {
            if ($request->get('active_eq')) {
                $model->where('active', true);
            } else {
                $model->where('active', false);
            }
        }

        return $model;
    }
}
