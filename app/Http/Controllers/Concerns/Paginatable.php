<?php
namespace App\Http\Controllers\Concerns;
use Config;

trait Paginatable
{
    public function getPerPage(int $perPageMax = 100, int $perPageMin = 1)
    {
        $perPage = request('per_page', 10);
        return min(max($perPage, $perPageMin), $perPageMax);
    }
}