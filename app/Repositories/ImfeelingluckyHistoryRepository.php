<?php

namespace App\Repositories;

use App\Models\ImfeelingluckyHistory;
use App\Models\User;
use App\Repositories\Contracts\ImfeelingluckyHistoryRepository as ImfeelingluckyHistoryRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class ImfeelingluckyHistoryRepository implements ImfeelingluckyHistoryRepositoryContract
{

    public function latestForUser(User $user): Collection
    {
        return $user->imfeelingluckyHistories()->latest()->take(3)->orderByDesc('id')->get();
    }

    public function create(array $data): ImfeelingluckyHistory
    {
        return ImfeelingluckyHistory::query()->create($data);
    }
}
