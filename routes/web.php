<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;

Route::view('/', 'dashboard')->name('dashboard');


/*
|--------------------------------------------------------------------------
| Purchase Routes
|--------------------------------------------------------------------------
*/

Route::prefix('purchases')->name('purchases.')->group(function () {

    // Purchase Data Manage
    Route::get('/', [PurchaseController::class, 'index'])
        ->name('manage');

    // Create Purchase
    Route::get('/create', [PurchaseController::class, 'create'])
        ->name('create');

    // Store Purchase
    Route::post('/', [PurchaseController::class, 'store'])
        ->name('store');

    // View Purchase Data
    // IMPORTANT: This must come before /{purchase}
    Route::get('/view-data', [PurchaseController::class, 'viewData'])
        ->name('view-data');

    // View Single Purchase
    Route::get('/{purchase}', [PurchaseController::class, 'show'])
        ->name('show');

    // Edit Purchase
    Route::get('/{purchase}/edit', [PurchaseController::class, 'edit'])
        ->name('edit');

    // Update Purchase
    Route::put('/{purchase}', [PurchaseController::class, 'update'])
        ->name('update');

    // Delete Purchase
    Route::delete('/{purchase}', [PurchaseController::class, 'destroy'])
        ->name('destroy');

});