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
 */
class UserLink extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected $fillable = [
        'link',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
