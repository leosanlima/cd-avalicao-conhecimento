<?php

namespace App\Http\Controllers;

use App\Factories\ViewFactory\CustomerAddressIndexViewFactory\CustomerAddressIndexViewFactory;
use App\Http\Requests\CustomerAddressRequest;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Services\LayoutMessageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    public function __construct(private LayoutMessageService $layoutMessageService)
    {
        $this->authorizeResource(CustomerAddress::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(CustomerAddressIndexViewFactory $customerAddressIndexViewFactory): View
    {
        return $customerAddressIndexViewFactory->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $customers = Customer::all(['name', 'id']);
        return view('pages.customer-address.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerAddressRequest $request)
    {
        CustomerAddress::create($request->all());
        $this->layoutMessageService->flashSuccessMessage();
        return redirect(route('enderecos.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CustomerAddress $customerAddress
     * @return View
     */
    public function edit(CustomerAddress $customerAddress)
    {
        $customers = Customer::all(['name', 'id']);
        return view('pages.customer-address.edit')
            ->with(compact('customerAddress', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerAddressRequest $request
     * @param CustomerAddress $customerAddress
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerAddressRequest $request, CustomerAddress $customerAddress)
    {
        $customerAddress->update($request->all());
        $this->layoutMessageService->flashSuccessMessage();
        return redirect(route('enderecos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CustomerAddress $customerAddress
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(CustomerAddress $customerAddress)
    {
        $customerAddress->delete();
        $this->layoutMessageService->flashSuccessMessage();
        return redirect(route('enderecos.index'));
    }

}
