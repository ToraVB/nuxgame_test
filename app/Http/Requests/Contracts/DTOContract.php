<?php

namespace App\Http\Requests\Contracts;

use Spatie\LaravelData\Data;

interface DTOContract
{
    public function getDto(): Data;
}
