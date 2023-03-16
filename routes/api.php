<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('company')->group(function() {
    Route::post('store', [CompanyController::class, 'store']);
});

Route::prefix('supplier')->group(function() {
    Route::post('store', [SupplierController::class, 'store']);
    Route::get('delete/{id}', [SupplierController::class, 'destroy']);
    Route::get('show/{id}', [SupplierController::class, 'show']);
});
