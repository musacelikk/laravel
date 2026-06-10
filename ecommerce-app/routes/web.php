<?php

use App\Http\Controllers\Account\UserPanelController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/category/{category:slug}', [ShopController::class, 'category'])->name('shop.category');
Route::get('/sales', [ShopController::class, 'sales'])->name('shop.sales');

Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::post('/product/{product:slug}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{product}/link', [CartController::class, 'addFromLink'])->name('cart.add.link');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/complete/{order}', [CheckoutController::class, 'complete'])->name('checkout.complete');
});

Route::view('/wishlist', 'store.pages.wishlist')->name('wishlist');
Route::view('/compare', 'store.pages.compare')->name('compare');

Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/', [UserPanelController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserPanelController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password', [UserPanelController::class, 'updatePassword'])->name('password.update');
    Route::get('/orders', [UserPanelController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [UserPanelController::class, 'showOrder'])->name('orders.show');
    Route::get('/reviews', [UserPanelController::class, 'reviews'])->name('reviews');
    Route::delete('/reviews/{comment}', [UserPanelController::class, 'destroyReview'])->name('reviews.destroy');
    Route::get('/products', [UserPanelController::class, 'products'])->name('products');
});

Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::post('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/faq', [PageController::class, 'faq'])->name('pages.faq');
Route::get('/newsletter', [PageController::class, 'newsletter'])->name('pages.newsletter');
Route::post('/newsletter', [PageController::class, 'subscribe'])->name('pages.newsletter.subscribe');

require __DIR__.'/admin.php';

Route::redirect('/dashboard', '/')->name('dashboard');
