<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemController;



Route::redirect('/', '/login');
Route::get('/login', [AuthLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthLoginController::class, 'login']);
Route::post('/logout', [AuthLoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/report', [SaleController::class, 'index'])->name('report');
    Route::get('/sales/export', [SaleController::class, 'export'])->name('sales.export');
    Route::get('/sales/report', [SaleController::class, 'index'])->name('sales.report');


    Route::middleware('can:isPegawai')->prefix('pegawai')->group(function () {
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
        Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
        Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
        // Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        // Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        Route::resource('items', ItemController::class)->names('pegawai.items');;
    });

    Route::middleware('can:isPemilik')->prefix('pemilik')->group(function () {
        Route::get('/dashboard/line-chart', [DashboardController::class, 'lineChart'])->name('pemilik.dashboard');
        Route::get('/sales/report', [SaleController::class, 'report'])->name('pemilik.sales.report');
        Route::get('/sales/export', [SaleController::class, 'export'])->name('pemilik.sales.export');
        Route::get('/transactions', [TransactionController::class, 'index'])->name('pemilik.transactions');
        Route::get('/inventory', [InventoryController::class, 'index'])->name('pemilik.inventory');
    });

    Route::middleware('can:isAdmin')->prefix('admin')->group(function () {
        Route::get('/transactions', [TransactionController::class, 'index'])->name('admin.transactions');
        Route::resource('/users', UserController::class, ['as' => 'admin']); // route admin.users.*
        Route::get('/inventory', [InventoryController::class, 'index'])->name('admin.inventory');
    });
});
