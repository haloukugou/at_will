<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Logic\UserLogic;
use App\Services\RedisConnectService;
use App\Validate\BaseValidate;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * @param UserLogic $userLogic
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(UserLogic $userLogic)
    {
//        $config = config('database.redis.default');
//        $redis = RedisConnectService::getRedisInstance($config)->getRedisConn();
//        $redis->setex('aaa',10,'asdfasdf');
//        return 1;
//        $redis = Redis::connection();
//        $a = $redis->set('dj','halou');
//        $redis->setnx();
//        dump($a);
//        dd($redis);

        $params = $this->getParams([]);
        $rule = [
            'nickname' => 'required|min:2|max:20',
            'account' => 'required|min:6|max:20',
            'password' => 'required',
        ];
        $message = [
            'nickname.required' => '请输入名称',
            'account.required' => '请输入账号',
            'password.required' => '请输入密码',
            'nickname.min' => '名称最短2位',
            'account.min' => '账号最短6位',
            'nickname.max' => '名称最长20位',
            'account.max' => '账号最长20位',
        ];
        app(BaseValidate::class)->checkData($params, $rule, $message);
        return $userLogic->register($params);
    }

    public function login(UserLogic $userLogic)
    {
        $params = $this->getParams(['account', 'password']);
        $rule = [
            'account' => 'required|min:6|max:20',
            'password' => 'required',
        ];
        $message = [
            'account.required' => '请输入账号',
            'password.required' => '请输入密码',
            'account.min' => '账号最短6位',
            'account.max' => '账号最长20位',
        ];
        app(BaseValidate::class)->checkData($params, $rule, $message);
        return $userLogic->login($params);
    }
}
