<?php

use App\Http\Controllers\CustomerAddressAssociationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('usuarios/{user}/enderecos', [CustomerAddressAssociationController::class, 'edit'])->name('customer-address-association.edit');
    Route::put('usuarios/{user}/enderecos', [CustomerAddressAssociationController::class, 'update'])->name('customer-address-association.update');
});
