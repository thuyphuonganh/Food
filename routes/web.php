<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('search');
// Product Detail
Route::get('/dashboard/product-detail/{id}', [DashboardController::class, 'productDetail'])->name('productDetail');

    // Infor
Route::get('/dashboard/infor', [DashboardController::class, 'infor'])->name('infor');

// User

Route::group(['middleware' => ['auth', 'verified', 'check_role:user']], function() {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Cart
    Route::resource('/dashboard/cart', CartController::class);
    Route::post('/dashboard/cart/delete/{id}', [CartController::class, 'deleteCartItem'])->name('cart.delete');
    //Checkout
    Route::post('/dashboard/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/dashboard/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/dashboard/checkout/callback', [CheckoutController::class, 'callback'])->name('checkout.callback');
    Route::get('/dashboard/checkout/notify', [CheckoutController::class, 'notify'])->name('checkout.notify');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/{id}/profile', [UserController::class, 'show'])->name('user.profile');
    Route::put('/user/{id}/profile', [UserController::class, 'update'])->name('user.update');
    // Thêm route cho danh sách đơn hàng và chi tiết đơn hàng
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

Route::group(['middleware' => ['auth', 'verified', 'check_role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
    // Quản lý category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    // Quản lý product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    // Quản lý orders
    Route::get('/order', [AdminOrderController::class, 'index'])->name('order.index');
    Route::get('/order/{id}', [AdminOrderController::class, 'show'])->name('order.show'); // /admin/orders/{order}
    //Route::get('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/auth.php';
