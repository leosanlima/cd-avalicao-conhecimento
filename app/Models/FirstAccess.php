<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Handles the first access token used in
 * email sent to users created without initial password
 *
 * @property int $id
 * @property string $token
 * @property int $user_id
 * @property User user
 * @property mixed created_at
 */
class FirstAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'user_id',
    ];

    public function isExpired(): bool
    {
        /** @var Carbon $createdAt */
        $createdAt = $this->created_at;

        $timeHasPassed = $createdAt->diffInMinutes(Carbon::now());
        $expirationTime = config('auth.first_access.expire');

        return $timeHasPassed > $expirationTime;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
