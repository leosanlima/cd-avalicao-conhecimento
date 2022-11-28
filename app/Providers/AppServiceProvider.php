<?php

namespace App\Providers;

use App\Factories\ViewFactory\{
    UserCreateViewFactory\UserCreateViewFactory,
    CustomerAddressIndexViewFactory\CustomerAddressIndexViewFactory,
};
use App\Resolvers\{
    CustomerAddress\CustomerAddressIndexViewResolver,
    User\UserCreateViewResolver,
};
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->viewFactories();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale( config('app.locale'));
    }

    private function viewFactories()
    {
        $this->app->singleton(UserCreateViewFactory::class, UserCreateViewResolver::resolveAsClosure());
        $this->app->singleton(CustomerAddressIndexViewFactory::class, CustomerAddressIndexViewResolver::resolveAsClosure());
    }
}
