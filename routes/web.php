<?php

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth', 'as' => 'admin.'], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('suppliers', SupplierController::class)->except(['store', 'update', 'destroy', 'show']);
    Route::group(['prefix' => 'suppliers', 'as' => 'suppliers.'], function() {
        Route::post('generate-code', [SupplierController::class, 'generateCode'])->name('generate-code');
    });
});
Auth::routes();
