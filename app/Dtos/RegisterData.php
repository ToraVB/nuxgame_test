<?php

namespace App\Dtos;

use Spatie\LaravelData\Data;

class RegisterData extends Data
{
    public function __construct(
        readonly public string $username,
        readonly public string $phonenumber,
    )
    {
    }
}
