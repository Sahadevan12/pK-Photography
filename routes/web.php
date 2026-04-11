<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HeroImageController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerUploadController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;

// ═══════════════════════════════════════════════════
// ✅ PUBLIC ROUTES — NO AUTH REQUIRED
// ═══════════════════════════════════════════════════

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages
Route::get('/about',       [HomeController::class, 'about'])->name('about');
Route::get('/services',    [HomeController::class, 'services'])->name('services');
Route::get('/pre-wedding', [HomeController::class, 'preWedding'])->name('pre-wedding');
Route::get('/contact',     [HomeController::class, 'contact'])->name('contact');
Route::post('/contact',    [HomeController::class, 'sendContact'])->name('contact.send');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Shop
Route::get('/shop',         [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}',  [ShopController::class, 'show'])->name('shop.show');

// Cart
Route::get('/cart',                     [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add',                [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{rowId}',    [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{rowId}',   [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear',            [CartController::class, 'clear'])->name('cart.clear');

// Checkout & Orders
Route::get('/checkout',              [OrderController::class, 'index'])->name('checkout.index');
Route::post('/checkout/place',       [OrderController::class, 'place'])->name('checkout.place');
Route::get('/checkout/whatsapp/{order}', [OrderController::class, 'whatsapp'])->name('checkout.whatsapp');
Route::get('/checkout/success/{order}',  [OrderController::class, 'success'])->name('checkout.success');

// ═══════════════════════════════════════════════════
// ✅ AUTH ROUTES (Login/Logout Only)
// ═══════════════════════════════════════════════════
Route::get('/login',  [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ═══════════════════════════════════════════════════
// ✅ ADMIN ROUTES — AUTH REQUIRED
// ═══════════════════════════════════════════════════
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Hero Images
    Route::resource('hero-images', HeroImageController::class);
    Route::patch('hero-images/{heroImage}/toggle', [HeroImageController::class, 'toggle'])
         ->name('hero-images.toggle');

    // Categories
    Route::resource('categories', AdminCategoryController::class);

    // Products
    Route::resource('products', AdminProductController::class);
    Route::patch('products/{product}/toggle', [AdminProductController::class, 'toggle'])
         ->name('products.toggle');

    // Orders
    Route::get('orders',              [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}',      [AdminOrderController::class, 'show'])->name('orders.show');
    Route::delete('orders/{order}',   [AdminOrderController::class, 'destroy'])->name('orders.destroy');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
         ->name('orders.status');

    // Gallery
    Route::resource('gallery', AdminGalleryController::class);

    // Customer Uploads
    Route::get('uploads',                    [CustomerUploadController::class, 'index'])->name('uploads.index');
    Route::delete('uploads/{upload}',        [CustomerUploadController::class, 'destroy'])->name('uploads.destroy');
    Route::patch('uploads/{upload}/status',  [CustomerUploadController::class, 'updateStatus'])->name('uploads.status');
});