<?php
namespace App\Resolvers\CustomerAddress;

use App\Factories\ViewFactory\CustomerAddressIndexViewFactory\CustomerEmployeeCustomerAddressIndexViewFactory;
use App\Factories\ViewFactory\CustomerAddressIndexViewFactory\DefaultCustomerAddressIndexViewFactory;
use App\Resolvers\ResolveAsClosure;
use App\Resolvers\Resolver;
use Illuminate\Support\Facades\Auth;

class CustomerAddressIndexViewResolver implements Resolver
{
    use ResolveAsClosure;

    public static function resolve(): CustomerEmployeeCustomerAddressIndexViewFactory|DefaultCustomerAddressIndexViewFactory
    {
        return Auth::user()->isCustomerEmployee()
            ? new CustomerEmployeeCustomerAddressIndexViewFactory()
            : new DefaultCustomerAddressIndexViewFactory();
    }
}
