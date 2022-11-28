<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('usuarios', UserController::class)
    ->except('show')
    ->parameters([
        'usuarios' => 'user'
    ])
    ->middleware(['auth']);
