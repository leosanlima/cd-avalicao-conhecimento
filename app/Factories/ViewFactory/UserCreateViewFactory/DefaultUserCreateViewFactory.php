<?php


namespace App\Factories\ViewFactory\UserCreateViewFactory;

use App\Models\Customer;
use App\Models\Role;
use Illuminate\Contracts\View\View;

class DefaultUserCreateViewFactory extends UserCreateViewFactory
{
    public function make(): View
    {
        $roles = Role::all();
        $customerEmployeeRoles = Role::getCustomerEmployeeRoles()
            ->map(fn(Role $role) => $role->id)
            ->toJson();
        $customers = Customer::all();

        return view(
            'pages.users.create',
            compact('roles', 'customerEmployeeRoles', 'customers')
        );
    }
}
