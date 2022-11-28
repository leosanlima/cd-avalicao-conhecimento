<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('fornecedores', SupplierController::class)
        ->except('show')
        ->parameters([
            'fornecedores' => 'supplier'
        ]);
});

