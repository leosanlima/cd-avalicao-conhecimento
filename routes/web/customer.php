<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('clientes', CustomerController::class)
        ->except('show')
        ->parameters([
            'clientes' => 'customer'
        ]);

    Route::get('clientes/{id}/enderecos', [CustomerController::class, 'getCustomerAddresses']);
});

