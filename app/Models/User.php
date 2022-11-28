<?php

namespace App\Models;

use App\Exceptions\CustomerEmployeeWithoutCustomerAddressAssociatedException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as IAuditable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $cpf
 * @property int role_id
 * @property bool is_first_access
 * @property bool disabled
 * @property Role role
 * @property Collection|CustomerAddress[] customerAddresses
 * @method static create(array $attributes)
 * @method static accordingToRolePermission()
 * @method static where(string $column, int $value)
 */
class User extends Authenticatable implements CanResetPassword, IAuditable
{
    use HasFactory, Notifiable, Auditable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dispatchRegistered(bool $withInitialPassword = false)
    {
        if ($withInitialPassword) {
            return;
        }

        event(new Registered($this));
    }

    public function isAdministrator(): bool
    {
        return $this->role->identifier === Role::ADMIN;
    }

    public function isTechnician(): bool
    {
        return $this->role->identifier === Role::TECHNICAL;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isCustomerEmployee(): bool
    {
        return Role::getCustomerEmployeeRoles()
            ->contains(fn(Role $role) => $role->identifier === $this->role->identifier);
    }

    public function isTechnicalEmployee(): bool
    {
        return !($this->isCustomerEmployee() || $this->isAdministrator());
    }

    /**
     * Gets the customer assuming that a customer employee can only be
     * associated to one at time through a customer address.
     * @param bool $invariant
     * @return ?Customer
     * @throws CustomerEmployeeWithoutCustomerAddressAssociatedException
     */
    public function customer($invariant = false): ?Customer
    {
        /** @var CustomerAddress $firstCustomerAddress */
        $firstCustomerAddress = $this->customerAddresses()->first();

        if ($invariant && is_null($firstCustomerAddress)) {
            throw new CustomerEmployeeWithoutCustomerAddressAssociatedException();
        }

        return $firstCustomerAddress?->customer;
    }

    public function hasCustomerAddressAssociated(CustomerAddress $customerAddress): bool
    {
        return $this->customerAddresses?->contains(fn(CustomerAddress $it) => $it->id === $customerAddress->id);
    }

    /**
     * @param  Builder  $query
     * @return Builder
     * @throws \Exception
     */
    public function scopeAccordingToRolePermission(Builder $query): Builder
    {
        /** @var self $user */
        $user = Auth::user();

        if ($user->isTechnicalEmployee()) {
            return $query->where('role_id', '!=', 1);
        }

        if (!$user->isCustomerEmployee()) {
            return $query;
        }

        $customer = $user->customer(true);

        return $query->whereHas(
            'customerAddresses',
            fn (Builder $customerAddressesQuery) => $customerAddressesQuery->where('customer_id', $customer->id)
        );
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function customerAddresses(): BelongsToMany
    {
        return $this->belongsToMany(CustomerAddress::class, 'allocations')
            ->withTimestamps()
            ->as('allocation');
    }
}
