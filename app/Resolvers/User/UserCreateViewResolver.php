<?php
namespace App\Resolvers\User;

use App\Factories\ViewFactory\UserCreateViewFactory\CustomerEmployeeUserCreateViewFactory;
use App\Factories\ViewFactory\UserCreateViewFactory\DefaultUserCreateViewFactory;
use App\Models\User;
use App\Resolvers\ResolveAsClosure;
use App\Resolvers\Resolver;
use Illuminate\Support\Facades\Auth;

class UserCreateViewResolver implements Resolver
{
    use ResolveAsClosure;

    public static function resolve(): CustomerEmployeeUserCreateViewFactory|DefaultUserCreateViewFactory
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->isCustomerEmployee()) {
            return new CustomerEmployeeUserCreateViewFactory();
        }

        return new DefaultUserCreateViewFactory();
    }
}
