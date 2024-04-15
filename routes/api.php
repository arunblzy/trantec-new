<?php

use App\Http\Controllers\Api\SupplierServiceController;
use App\Http\Controllers\Api\Select2Controller;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource('suppliers', SupplierServiceController::class)->except(['create', 'edit', 'show']);
    Route::get('get/{table}', [Select2Controller::class,'getData'])->name('get.select2');
});