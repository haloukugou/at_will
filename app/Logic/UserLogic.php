<?php

namespace App\Logic;

use App\Constant\ModelConstant;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserLogic
{
    public function register($params)
    {
        try {
            $userModel = app(UserRepository::class);
            $existsMap = [
                ['account', '=', $params['account']]
            ];
            $exists = $userModel->isExists($existsMap);
            if ($exists) {
                return fail('账号已存在');
            }
            $salt = randStr(6);
            $data = [
                'account' => $params['account'],
                'salt' => $salt,
                'password' => createPwd($salt, $params['password']),
                'nickname' => $params['nickname'],
            ];

            $userModel->insert($data);
            return success([], '注册成功');
        } catch (\Exception $exception) {
            Log::error('错误:' . $exception->getMessage());
        }
        return fail('注册失败');
    }

    public function login($params)
    {
        $map = [
            ['account', '=', $params['account']],
            ['state', '=', User::STATE_1],
            ['data_state', '=', ModelConstant::DATA_NORMAL],
        ];
        $model = app(UserRepository::class);
        $user = $model->findFields($map, ['id', 'salt', 'password']);
        if (!$user) {
            throw new HttpException(200, '账号信息不存在');
        }

    }
}
