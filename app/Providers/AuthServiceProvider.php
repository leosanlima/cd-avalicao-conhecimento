<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\User;
use App\Policies\AppliancePolicy;
use App\Policies\CustomerAddressPolicy;
use App\Policies\CustomerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       
        Customer::class => CustomerPolicy::class,
        CustomerAddress::class => CustomerAddressPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerGates();


    }

    private function registerGates()
    {
        Gate::define('associate-customer-address', function (User $user, User $userToAssociate) {
            return  $userToAssociate->isCustomerEmployee()
                && $user->isAdministrator()
                || ($user->isCustomerEmployee() && $user->customer()?->id === $userToAssociate->customer()?->id);
        });

        Gate::define('administrator', function (User $user) {
            return $user->isAdministrator();
        });
    }
}
