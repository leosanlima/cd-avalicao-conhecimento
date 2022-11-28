<?php

namespace App\Factories\ViewFactory\UserCreateViewFactory;

use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CustomerEmployeeUserCreateViewFactory extends UserCreateViewFactory
{

    public function make(): View
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Customer $customer */
        $customer = Customer::with('addresses')
            ->whereHas('addresses.users', fn (Builder $usersQuery) => $usersQuery->where('id', $user->id))
            ->first();

        $customerAddresses = $customer->addresses;
        $roles = Role::getCustomerEmployeeRoles();

        return view(
            'pages.users.customer-employee.create',
            compact('customer', 'customerAddresses', 'roles'),
        );
    }
}
