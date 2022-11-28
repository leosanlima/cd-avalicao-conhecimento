<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('produtos', ProductController::class)
        ->except('show')
        ->parameters([
            'produtos' => 'product'
        ]);
});

