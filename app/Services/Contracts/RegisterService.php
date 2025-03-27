<?php

namespace App\Services\Contracts;

use App\Models\User;
use Spatie\LaravelData\Data;

interface RegisterService
{
    public function register(Data $data): User;
}
