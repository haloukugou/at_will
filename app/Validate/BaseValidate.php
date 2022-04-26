<?php

namespace App\Validate;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BaseValidate
{
    /**
     * @param $params
     * @param $rule
     * @param $message
     * @throws ValidationException
     */
    public function checkData($params, $rule, $message)
    {
        $validator = Validator::make($params, $rule, $message);
        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->messages());
        }
    }
}
