<?php
namespace App\Http\Controllers\Concerns;
use Config;

trait Paginatable
{
    public function getPerPage(int $perPageMax = 100, int $perPageMin = 1, $default = 10)
    {
        $perPage = request('per_page', $default);
        return min(max($perPage, $perPageMin), $perPageMax);
    }
}