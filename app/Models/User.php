<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    /**
     * 模型属性的默认值
     *
     * @var array
     */
    protected $attributes = [
        'login_time' => '',
    ];


    const STATE_0 = 0;
    const STATE_1 = 1;
}
