<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Enums\BudgetStatus;
use Illuminate\Http\Request;
use App\Services\LayoutMessageService;
use App\Http\Requests\BudgetRequest;
use Illuminate\Http\RedirectResponse;

class BudgetController extends Controller
{

    public function __construct(private LayoutMessageService $layoutMessageService)
    {
        #$this->authorizeResource(Supplier::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.budget.index')
            ->with('budgetsPagination', Budget::paginate(10)->withQueryString());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $budgetStatusOptions = BudgetStatus::pluck();
       
        return view('pages.budget.create')
            ->with(compact('customers', 'budgetStatusOptions', 'suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetRequest $request): RedirectResponse
    {
        Budget::create($request->all());
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('orcamentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        $customers = Customer::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $budgetStatusOptions = BudgetStatus::pluck();
        return view('pages.budget.edit', compact('budget', 'customers', 'budgetStatusOptions', 'suppliers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(BudgetRequest $request, Budget $budget): RedirectResponse
    {
        $data = $request->all();
        $budget->update($data);
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('orcamentos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('orcamentos');
    }
}
