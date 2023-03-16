<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SupplierController;
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

Route::get('/', [CompanyController::class, 'index']);

Route::resource('company', CompanyController::class);

Route::get('suppliers/{id}', [SupplierController::class, 'suppliers']);
