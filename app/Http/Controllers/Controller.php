<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getParams($params): array
    {
        if (empty($params)) {
            return request()->all();
        }
        $result = [];
        foreach ($params as $v) {
            $result[$v] = request()->only($v)[$v] ?? '';
        }
        return $result;
    }
}
