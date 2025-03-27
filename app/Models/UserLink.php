<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property-read int $user_id
 * @property-read User $user
 * @property string $link
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property Carbon $expires_at
 * @property-read Carbon $deleted_at
 * @method static byLink(string $link)
 */
class UserLink extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'link';
    }

    protected $fillable = [
        'link',
        'user_id',
        'expires_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function scopeByLink($query, string $link)
    {
        return $query->where('link', $link);
    }

    public function isExpired(): bool
    {
        return $this->expires_at <= Carbon::now();
    }

    public function isDeleted(): bool
    {
        return (bool) $this->deleted_at;
    }
}
