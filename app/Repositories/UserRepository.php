<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepository as UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    public function findByUsername(string $username): ?User
    {
        return User::byUsername($username)->first();
    }

    public function create(array $data): User
    {
        return User::query()->create($data);
    }
}
