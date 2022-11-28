<?php

use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('orcamentos', BudgetController::class)
        ->except('show')
        ->parameters([
            'orcamentos' => 'budget'
        ]);
});

