<?php

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('search');
// Product Detail
Route::get('/dashboard/product-detail/{id}', [DashboardController::class, 'productDetail'])->name('productDetail');
// User
Route::middleware('auth', 'verified')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Infor
    Route::get('/dashboard/infor', [DashboardController::class, 'infor'])->name('infor');

    // Cart
    Route::resource('/dashboard/cart', CartController::class);
    Route::post('/dashboard/cart/delete/{id}', [CartController::class, 'deleteCartItem'])->name('cart.delete');

    //Checkout
    Route::post('/dashboard/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/dashboard/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/dashboard/checkout/callback', [CheckoutController::class, 'callback'])->name('checkout.callback');
    Route::get('/dashboard/checkout/notify', [CheckoutController::class, 'notify'])->name('checkout.notify');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/{id}/profile', [UserController::class, 'show'])->name('user.profile');
    Route::put('/user/{id}/profile', [UserController::class, 'update'])->name('user.update');

    // Thêm route cho danh sách đơn hàng và chi tiết đơn hàng
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';
