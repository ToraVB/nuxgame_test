<?php

namespace App\Services;

use App\Models\ImfeelingluckyHistory;
use App\Models\User;
use App\Repositories\Contracts\ImfeelingluckyHistoryRepository;
use App\Services\Contracts\ImfeelingluckyService as ImfeelingluckyServiceContract;

class ImfeelingluckyService implements ImfeelingluckyServiceContract
{

    public function __construct(
        readonly protected ImfeelingluckyHistoryRepository $imfeelingluckyHistoryRepository,
    )
    {
    }

    public function calculateWinAmount(int $number): float|int
    {
        $percent = match (true) {
            $number > 900 => 0.7,
            $number > 600 => 0.5,
            $number > 300 => 0.3,
            default => 0.1,
        };

        return $number * $percent;
    }

    public function getRandomNumber(): int
    {
        return rand(1, 1000);
    }

    public function checkIsWinNumber(int $number): bool
    {
        return $number % 2 === 0;
    }

    public function imfeelinglucky(User $user): ImfeelingluckyHistory
    {
        $number = $this->getRandomNumber();

        return $this->imfeelingluckyHistoryRepository->create([
            'user_id' => $user->id,
            'result' => $this->checkIsWinNumber($number) ? $this->calculateWinAmount($number) : 0,
        ]);
    }
}
