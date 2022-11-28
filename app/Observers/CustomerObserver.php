<?php

namespace App\Observers;

use App\Models\Customer;
use Exception;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     *
     * @param Customer $customer
     * @return void
     * @throws Exception
     * @noinspection PhpUnusedParameterInspection
     */
    public function created(Customer $customer)
    {
        cache()->forget('customer:all:name-id');
        cache()->forget('customer:all:*');
    }

    public function deleting(Customer $customer)
    {
        $customer->addresses()->delete();
    }
}
