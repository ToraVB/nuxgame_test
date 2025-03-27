<?php

namespace App\Services\Contracts;

use App\Models\User;
use App\Models\UserLink;

interface LinkService
{
    public function generateLink(User $user): UserLink;

    public function deactivateLink(UserLink $userLink): void;
}
