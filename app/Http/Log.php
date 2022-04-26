<?php

namespace App\Http;

trait Log
{
    public static function errLog($msg, $e)
    {
        \Illuminate\Support\Facades\Log::channel('single')->error($msg, self::getLogData($e));
    }

    public static function handlerLog($e, $msg = '')
    {
        \Illuminate\Support\Facades\Log::channel('single')->error($msg ?: '统一异常捕获', self::getLogData($e));
    }

    private static function getLogData($e): array
    {
        return [
            'msg' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ];
    }
}
