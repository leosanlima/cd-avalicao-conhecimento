<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\LayoutMessageService;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
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
        return view('pages.product.index')
            ->with('productsPagination', Product::paginate(10)->withQueryString());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        Product::create($request->all());
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('produtos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('pages.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->all();
        $product->update($data);
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('produtos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $this->layoutMessageService->flashSuccessMessage();
        return redirect('produtos');
    }
}
