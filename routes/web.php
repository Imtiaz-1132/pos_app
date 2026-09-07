<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseDataController;
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
| POS
|--------------------------------------------------------------------------
*/

Route::get('/pos', [POSController::class, 'index'])
    ->name('pos');


/*
|--------------------------------------------------------------------------
| Purchase Data
|--------------------------------------------------------------------------
*/

Route::prefix('purchase-data')->name('purchase-data.')->group(function () {

    // Existing Purchase Data page
    Route::get('/', [PurchaseDataController::class, 'index'])
        ->name('index');

    // Purchase Data Manage / Information Entry Form
    Route::get('/create', [PurchaseDataController::class, 'create'])
        ->name('create');

    // Separate Saved Purchase Data List
    Route::get('/list', [PurchaseDataController::class, 'list'])
        ->name('list');

    // Store Purchase Data
    Route::post('/', [PurchaseDataController::class, 'store'])
        ->name('store');

    // View Single Purchase Data
    Route::get('/{purchaseData}', [PurchaseDataController::class, 'show'])
        ->name('show');

    // Edit Purchase Data
    Route::get('/{purchaseData}/edit', [PurchaseDataController::class, 'edit'])
        ->name('edit');

    // Update Purchase Data
    Route::put('/{purchaseData}', [PurchaseDataController::class, 'update'])
        ->name('update');

    // Delete Purchase Data
    Route::delete('/{purchaseData}', [PurchaseDataController::class, 'destroy'])
        ->name('destroy');
});


/*
|--------------------------------------------------------------------------
| Purchases
|--------------------------------------------------------------------------
*/

Route::prefix('purchases')->name('purchases.')->group(function () {

    // Purchase List
    Route::get('/', [PurchaseController::class, 'index'])
        ->name('manage');

    // Add Purchase
    Route::get('/create', [PurchaseController::class, 'create'])
        ->name('create');

    // Store Purchase
    Route::post('/', [PurchaseController::class, 'store'])
        ->name('store');

    // Existing View Purchase Data
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
| Purchase Orders
|--------------------------------------------------------------------------
*/

Route::prefix('purchase-orders')->name('purchase-orders.')->group(function () {

    // List Purchase Orders
    Route::get('/', [PurchaseOrderController::class, 'index'])
        ->name('index');


    // Create Purchase Order
    Route::get('/create', [PurchaseOrderController::class, 'create'])
        ->name('create');


    /*
    |--------------------------------------------------------------------------
    | Export Purchase Orders
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    | These routes must stay BEFORE /{purchaseOrder}
    |
    */

    // Export Purchase Orders to CSV
    Route::get('/export-csv', [PurchaseOrderController::class, 'exportCsv'])
        ->name('export-csv');


    // Export Purchase Orders to Excel
    Route::get('/export-excel', [PurchaseOrderController::class, 'exportExcel'])
        ->name('export-excel');


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