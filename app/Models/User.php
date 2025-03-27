<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $username
 * @property string $phonenumber
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read UserLink $userLink
 * @property-read Collection $imfeelingLuckyHistories
 * @method static byUsername(string $username)
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

    public function userLink(): HasOne
    {
        return $this->hasOne(UserLink::class)->latest();
    }

    public function imfeelingluckyHistories(): HasMany
    {
        return $this->hasMany(ImfeelingluckyHistory::class);
    }

    public static function scopeByUsername($query, $username)
    {
        return $query->where('username', $username);
    }

}
