<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Services\LayoutMessageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    public function __construct(private LayoutMessageService $layoutMessageService)
    {
        $this->authorizeResource(Customer::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.customer.index')
            ->with('customersPagination', Customer::paginate(10)->withQueryString());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CustomerRequest  $request
     * @return RedirectResponse
     */
    public function store(CustomerRequest $request): RedirectResponse
    {
        Customer::create($request->all());
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('clientes');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return View
     */
    public function edit(Customer $customer): View
    {
        return view('pages.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CustomerRequest $request
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $data = $request->all();
        $customer->update($data);
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('clientes');
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getCustomerAddresses(int $id): JsonResponse
    {
        $customer = Customer::with('addresses')
            ->whereId($id)
            ->first();

        return response()->json($customer->addresses);
    }
}
