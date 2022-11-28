<?php


namespace App\Factories\ViewFactory\CustomerAddressIndexViewFactory;

use App\Models\CustomerAddress;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DefaultCustomerAddressIndexViewFactory extends CustomerAddressIndexViewFactory
{
    public function make(): View
    {
        $addressesPagination = CustomerAddress::with([
            'customer' => fn(BelongsTo $query) => $query->get('name')
        ])
            ->paginate(10)
            ->withQueryString();

        return view('pages.customer-address.index')->with(compact('addressesPagination'));
    }
}
