<?php

namespace App\Services\Contracts;

use App\Models\ImfeelingluckyHistory;
use App\Models\User;

interface ImfeelingluckyService
{
    public function checkIsWinNumber(int $number): bool;
    public function getRandomNumber(): int;
    public function imfeelinglucky(User $user): ImfeelingluckyHistory;
    public function calculateWinAmount(int $number): float|int;
}
