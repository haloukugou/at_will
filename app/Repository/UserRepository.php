<?php

namespace App\Repository;

use App\Models\User;

class UserRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(app(User::class));
    }
}
