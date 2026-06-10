<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/orders', 'orders')->name('orders');
        Route::get('/comments', 'comments')->name('comments.index');
        Route::get('/faq', 'faq')->name('faq.index');
        Route::get('/messages', 'messages')->name('messages.index');
        Route::get('/users', 'users')->name('users.index');
        Route::get('/social', 'social')->name('social.index');
    });

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/users/{user}/roles', [RoleController::class, 'edit'])->name('users.roles.edit');
    Route::put('/users/{user}/roles', [RoleController::class, 'update'])->name('users.roles.update');

    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::prefix('catalog')->name('catalog.')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::delete('products/{product}/images/{productImage}', [AdminProductController::class, 'destroyImage'])
            ->name('products.images.destroy');
        Route::resource('products', AdminProductController::class);
    });

});
