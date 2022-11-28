<?php

namespace App\Observers;

use App\Models\CustomerAddress;

class CustomerAddressObserver
{
    /**
     * Handle the CustomerAddress "created" event.
     *
     * @param \App\Models\CustomerAddress $customerAddress
     * @return void
     * @throws \Exception
     */
    public function created(CustomerAddress $customerAddress)
    {
        cache()->forget('customer-address:all:*');
    }

    /**
     * Handle the CustomerAddress "updated" event.
     *
     * @param  \App\Models\CustomerAddress  $customerAddress
     * @return void
     */
    public function updated(CustomerAddress $customerAddress)
    {
        //
    }

    /**
     * Handle the CustomerAddress "deleted" event.
     *
     * @param  \App\Models\CustomerAddress  $customerAddress
     * @return void
     */
    public function deleted(CustomerAddress $customerAddress)
    {
        //
    }

    /**
     * Handle the CustomerAddress "restored" event.
     *
     * @param  \App\Models\CustomerAddress  $customerAddress
     * @return void
     */
    public function restored(CustomerAddress $customerAddress)
    {
        //
    }

    /**
     * Handle the CustomerAddress "force deleted" event.
     *
     * @param  \App\Models\CustomerAddress  $customerAddress
     * @return void
     */
    public function forceDeleted(CustomerAddress $customerAddress)
    {
        //
    }
}
