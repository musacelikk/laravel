<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/orders', 'orders')->name('orders');
        Route::get('/comments', 'comments')->name('comments.index');
        Route::get('/faq', 'faq')->name('faq.index');
        Route::get('/messages', 'messages')->name('messages.index');
        Route::get('/users', 'users')->name('users.index');
        Route::get('/social', 'social')->name('social.index');
        Route::get('/settings', 'settings')->name('settings.index');
    });

    Route::prefix('catalog')->name('catalog.')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::delete('products/{product}/images/{productImage}', [AdminProductController::class, 'destroyImage'])
            ->name('products.images.destroy');
        Route::resource('products', AdminProductController::class);
    });

});
