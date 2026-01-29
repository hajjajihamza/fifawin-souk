<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/products/{product}', [HomeController::class, 'show'])
    ->name('products.show');

// Authentication
Route::controller(AuthController::class)
    ->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'login');
        Route::post('logout', 'logout')->name('logout');
    });

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', static function () {
        return redirect()->route('categories.index');
    })->name('dashboard');

    // Categories
    Route::get('categories/archived', [CategoryController::class, 'archived'])->name('categories.archived');
    Route::patch('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore')->withTrashed();
    Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete')->withTrashed();
    Route::resource('categories', CategoryController::class)->except('show');

    // Products
    Route::get('products/archived', [ProductController::class, 'archived'])->name('products.archived');
    Route::patch('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore')->withTrashed();
    Route::delete('products/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete')->withTrashed();
    Route::resource('products', ProductController::class);
});

