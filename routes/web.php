<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StockHistoryController;
use App\Http\Controllers\PublicProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ProductReturnController;

// Halaman publik/customer tanpa login
Route::get('/', [PublicProductController::class, 'home'])->name('home');
Route::get('/produk', [PublicProductController::class, 'index'])->name('public.products.index');
Route::get('/produk/{product}', [PublicProductController::class, 'show'])->name('public.products.show');

// Redirect dashboard sesuai role
Route::get('/dashboard', [DashboardController::class, 'redirect'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])
            ->name('dashboard');

        Route::get('/stock-histories', [StockHistoryController::class, 'index'])
            ->name('stock_histories.index');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);

        Route::resource('sales', SaleController::class)->only([
            'index',
            'create',
            'store',
            'show',
        ]);

        Route::get('/sales/{sale}/status', [SaleController::class, 'editStatus'])
            ->name('sales.edit_status');

        Route::put('/sales/{sale}/status', [SaleController::class, 'updateStatus'])
            ->name('sales.update_status');

        Route::resource('returns', ProductReturnController::class)->only([
            'index',
            'create',
            'store',
            'show',
        ]);
    });

// Route Owner
Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'owner'])
            ->name('dashboard');

        Route::get('/laporan/export', [DashboardController::class, 'exportOwnerReport'])
            ->name('reports.export');
    });

// Route Profile bawaan Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';