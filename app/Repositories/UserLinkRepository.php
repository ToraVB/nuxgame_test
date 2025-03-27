<?php

namespace App\Repositories;

use App\Models\UserLink;
use App\Repositories\Contracts\UserLinkRepository as UserLinkRepositoryContract;

class UserLinkRepository implements UserLinkRepositoryContract
{
    public function findByLink(string $link): ?UserLink
    {
        return UserLink::byLink($link)->first();
    }

    public function create(array $data): UserLink
    {
        return UserLink::query()->create($data);
    }

    public function delete(UserLink $userLink): void
    {
        $userLink->delete();
    }
}
