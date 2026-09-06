<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\POSController;


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| POS Route
|--------------------------------------------------------------------------
*/

Route::get('/pos', [POSController::class, 'index'])
    ->name('pos');


/*
|--------------------------------------------------------------------------
| Purchase Routes
|--------------------------------------------------------------------------
*/

Route::prefix('purchases')->name('purchases.')->group(function () {

    // Purchase Data Manage
    Route::get('/', [PurchaseController::class, 'index'])
        ->name('manage');

    // Add Purchase
    Route::get('/create', [PurchaseController::class, 'create'])
        ->name('create');

    // Store Purchase
    Route::post('/', [PurchaseController::class, 'store'])
        ->name('store');

    // View Purchase Data
    // IMPORTANT: Must come before /{purchase}
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


/*
|--------------------------------------------------------------------------
| Purchase Order Routes
|--------------------------------------------------------------------------
*/

Route::prefix('purchase-orders')->name('purchase-orders.')->group(function () {

    // List Purchase Orders
    Route::get('/', [PurchaseOrderController::class, 'index'])
        ->name('index');

    // Create Purchase Order
    Route::get('/create', [PurchaseOrderController::class, 'create'])
        ->name('create');

    // Store Purchase Order
    Route::post('/', [PurchaseOrderController::class, 'store'])
        ->name('store');

    // View Purchase Order
    Route::get('/{purchaseOrder}', [PurchaseOrderController::class, 'show'])
        ->name('show');

    // Edit Purchase Order
    Route::get('/{purchaseOrder}/edit', [PurchaseOrderController::class, 'edit'])
        ->name('edit');

    // Update Purchase Order
    Route::put('/{purchaseOrder}', [PurchaseOrderController::class, 'update'])
        ->name('update');

    // Delete Purchase Order
    Route::delete('/{purchaseOrder}', [PurchaseOrderController::class, 'destroy'])
        ->name('destroy');

});