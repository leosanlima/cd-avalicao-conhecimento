<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn() => redirect(route('dashboard')));

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/web/supplier.php';
require __DIR__.'/web/product.php';
require __DIR__.'/web/budget.php';
require __DIR__.'/web/customer.php';
require __DIR__.'/web/customer-address.php';
require __DIR__.'/web/user.php';
require __DIR__.'/web/customer-address-association.php';
