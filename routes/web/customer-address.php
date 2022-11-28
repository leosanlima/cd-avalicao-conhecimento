<?php

use App\Http\Controllers\CustomerAddressController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('enderecos', CustomerAddressController::class)
        ->except('show')
        ->parameters([
            'enderecos' => 'customer_address'
        ]);

});
