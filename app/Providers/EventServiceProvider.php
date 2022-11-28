<?php

namespace App\Providers;

use App\Listeners\SendEmailFirstAccessMail;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Observers\CustomerAddressObserver;
use App\Observers\CustomerObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailFirstAccessMail::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Customer::observe(CustomerObserver::class);
        CustomerAddress::observe(CustomerAddressObserver::class);
    }
}
