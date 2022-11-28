<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as IAuditable;

/**
 * @method static create(array $all)
 * @property string cep
 * @property string street
 * @property string neighborhood
 * @property string city
 * @property string state
 * @property string address_number
 * @property string complement
 * @property int customer_id
 * @property Customer customer
 */
class CustomerAddress extends Model implements IAuditable
{
    use HasFactory;
    use Auditable;

    protected $fillable = [
        'cep',
        'street',
        'neighborhood',
        'city',
        'state',
        'address_number',
        'complement',
        'customer_id',
    ];

    /**
     * @param array|mixed|string[] $columns
     * @return Customer[]|Collection
     * @throws \Exception
     */
    public static function all($columns = ['*']): Collection|array
    {
        return cache()
            ->remember(
                'customer-address:all:' . implode('-', $columns),
                86400,
                fn() => parent::all($columns)
            );
    }

    /** @noinspection PhpUnused used in template*/
    public function getFullAddress(): string
    {
        return "{$this->street}, {$this->address_number}, {$this->neighborhood}, {$this->city}, {$this->state}";
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'allocations')
            ->withTimestamps()
            ->as('allocation');
    }

}
