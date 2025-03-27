<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepository
{
    public function findByUsername(string $username): ?User;

    public function create(array $data): User;
}
