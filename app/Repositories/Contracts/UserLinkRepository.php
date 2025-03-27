<?php

namespace App\Repositories\Contracts;

use App\Models\UserLink;

interface UserLinkRepository
{
    public function findByLink(string $link): ?UserLink;
    public function create(array $data): UserLink;

    public function delete(UserLink $userLink): void;
}
