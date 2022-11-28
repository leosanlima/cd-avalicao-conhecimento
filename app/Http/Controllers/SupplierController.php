<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\LayoutMessageService;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class SupplierController extends Controller
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
        return view('pages.supplier.index')
            ->with('suppliersPagination', Supplier::paginate(10)->withQueryString());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request): RedirectResponse
    {
        Supplier::create($request->all());
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('fornecedores');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Supplier $request
     * @return View
     */
    public function edit(Supplier $supplier): View
    {
        return view('pages.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SupplierRequest $request
     * @param Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, Supplier $supplier): RedirectResponse
    {
        $data = $request->all();
        $supplier->update($data);
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('fornecedores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier): RedirectResponse
    {
        $supplier->delete();
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('fornecedores');
    }
}
