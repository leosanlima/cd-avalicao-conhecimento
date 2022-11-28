<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $attributes)
 * @property string cep
 * @property string street
 * @property string neighborhood
 * @property string city
 * @property string state
 * @property string address_number
 * @property string complement
 * @property int user_id
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'cep',
        'street',
        'neighborhood',
        'city',
        'state',
        'address_number',
        'complement',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @noinspection PhpUnused used in template*/
    public function getFullAddress(): string
    {
        return "{$this->street}, {$this->address_number}, {$this->neighborhood}, {$this->city}, {$this->state}";
    }
}
