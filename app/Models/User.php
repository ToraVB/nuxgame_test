<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $username
 * @property string $phonenumber
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Collection $userLinks
 * @property-read Collection $imfeelingLuckyHistories
 */
class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'phonenumber',
    ];

    public function userLinks(): HasMany
    {
        return $this->hasMany(UserLink::class);
    }

    public function imfeelingluckyHistories(): HasMany
    {
        return $this->hasMany(ImfeelingluckyHistory::class);
    }

}
