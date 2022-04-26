<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class RequestLog
{
    public function handle(Request $request, Closure $next)
    {
        $params = $request->all();
        $url = $request->getRequestUri();
        $dir = '/storage/request_log';
        $path = base_path() . $dir;
        if (!is_dir($path)) {
            mkdir($path);
        }
        Log::channel('req')->info('请求地址=' . $url . '|请求参数=' . json_encode($params));
        return $next($request);
    }
}
