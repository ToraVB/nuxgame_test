<?php

namespace App\Repositories\Contracts;

use App\Models\ImfeelingluckyHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface ImfeelingluckyHistoryRepository
{
    public function latestForUser(User $user): Collection;
    public function create(array $data): ImfeelingluckyHistory;
}
