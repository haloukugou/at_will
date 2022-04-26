<?php

// todo dj 公告方法文件,添加此文件后,在composer.json加入以下代码,可自动加载
// "autoload":{
//"files":[
//"app/Common/common.php"
//]
//}

if (!function_exists('success')) {
    function success($data = [], $msg = 'success', $obj = false)
    {
        if (empty($data) && $obj) {
            $data = new \stdClass();
        }
        $result = [
            'code' => 200,
            'state' => true,
            'msg' => $msg,
            'data' => $data
        ];
        return response()->json($result);
    }
}

if (!function_exists('fail')) {
    function fail($msg, $data = [], $obj = false)
    {
        if (empty($data) && $obj) {
            $data = new \stdClass();
        }
        $result = [
            'code' => 200,
            'state' => false,
            'msg' => $msg,
            'data' => $data
        ];
        return response()->json($result);
    }
}

if (!function_exists('randStr')) {
    function randStr(int $len): string
    {
        if (empty($len)) {
            return '';
        }
        $str = 'qwertyuiopasdfghjklzxcvbnm123456789';
        $strLen = strlen($str);
        $result = '';
        for ($a = 0; $a < $len; $a++) {
            $result .= $str[mt_rand(0, $strLen)];
        }
        return $result;
    }
}

if (!function_exists('createPwd')) {
    function createPwd($salt, $md5Pwd): string
    {
        return md5($salt . $md5Pwd . $salt);
    }
}
