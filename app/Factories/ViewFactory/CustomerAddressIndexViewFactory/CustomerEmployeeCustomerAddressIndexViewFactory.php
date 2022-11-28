<?php

namespace App\Factories\ViewFactory\CustomerAddressIndexViewFactory;

use App\Models\CustomerAddress;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class CustomerEmployeeCustomerAddressIndexViewFactory extends CustomerAddressIndexViewFactory
{
    public function make(): View
    {
        $addressesPagination = CustomerAddress::with([
            'customer' => fn(BelongsTo $query) => $query->get('name')
        ])
            ->where('customer_id', Auth::user()->customer(true)->id)
            ->paginate()
            ->withQueryString();

        return view('pages.customer-address.index')->with(compact('addressesPagination'));
    }
}
