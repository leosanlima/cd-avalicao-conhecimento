<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $identifier
 * @method static whereIn(string $string, string[] $array)
 * @method static customerEmployee()
 * @method static notCustomerEmployee()
 */
class Role extends Model
{
    const ADMIN = 'admin';
    const TECHNICAL = 'technical';
    const CUSTOMER_EMPLOYEE_INSPECTOR = 'customer_employee_inspector';
    const CUSTOMER_EMPLOYEE_DIRECTOR = 'customer_employee_director';
    const CUSTOMER_EMPLOYEE_SUPERVISOR = 'customer_employee_supervisor';
    const CUSTOMER_EMPLOYEE_COORDINATOR = 'customer_employee_coordinator';
    const CUSTOMER_EMPLOYEE_ENGINEER = 'customer_employee_engineer';

    /**
     * Roles which are allowed association if user has only one association with customer address
     */
    const ALLOWED_ONLY_WITH_ONE_CUSTOMER_ADDRESS_ROLES_IDENTIFIER = [
        self::CUSTOMER_EMPLOYEE_INSPECTOR,
        self::CUSTOMER_EMPLOYEE_DIRECTOR,
    ];

    use HasFactory;

    /**
     * @return Collection
     * @throws \Exception
     */
    public static function getCustomerEmployeeRoles(): Collection
    {
        return cache()->remember(
            'role:customer-employees',
            now()->addHours(5),
            fn() => Role::customerEmployee()->get()
        );
    }

    /**
     * Gets available options of role base on User actual role business rules
     * @param User $user
     * @return Collection
     * @throws \Exception
     */
    public static function getRolesAvailableToChanges(User $user): Collection
    {
        if (!$user->isCustomerEmployee()) {
            return self::notCustomerEmployee()->get();
        }

        $roles = self::getCustomerEmployeeRoles();
        $hasOneAddress = $user->customerAddresses()->count() === 1;

        if ($hasOneAddress) {
            return $roles;
        }

        return $roles->filter(fn(Role $role) =>
            !in_array($role->identifier, self::ALLOWED_ONLY_WITH_ONE_CUSTOMER_ADDRESS_ROLES_IDENTIFIER)
        );
    }

    public function scopeCustomerEmployee(Builder $query): Builder
    {
        return $query->whereIn('identifier', [
            self::CUSTOMER_EMPLOYEE_INSPECTOR,
            self::CUSTOMER_EMPLOYEE_DIRECTOR,
            self::CUSTOMER_EMPLOYEE_SUPERVISOR,
            self::CUSTOMER_EMPLOYEE_COORDINATOR,
            self::CUSTOMER_EMPLOYEE_ENGINEER,
        ]);
    }

    public function scopeNotCustomerEmployee(Builder $query): Builder
    {
        return $query->whereNotIn('identifier', [
            self::CUSTOMER_EMPLOYEE_INSPECTOR,
            self::CUSTOMER_EMPLOYEE_DIRECTOR,
            self::CUSTOMER_EMPLOYEE_SUPERVISOR,
            self::CUSTOMER_EMPLOYEE_COORDINATOR,
            self::CUSTOMER_EMPLOYEE_ENGINEER,
        ]);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
