<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return "ABC";
})->name('home');

Route::get('/category', [CategoryController::class, 'index']);

Route::get('/product', [DashboardController::class, 'index'])->name('api.product');
Route::get('/product/search', [DashboardController::class, 'Search'])->name('api.product.search');
Route::get('/product-detail/{id}', [DashboardController::class, 'productDetail'])->name('api.product.detail');

Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum', 'check_role:user']], function () {

    Route::get('user/success', function () {
        return response()->json([
            "message" => "success"
        ]);
    });

    Route::get('/user/profile', function () {
        return FacadesAuth::user();
    });
    Route::patch('user/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('user/cart', [CartController::class, 'index']);
    Route::post('user/cart', [CartController::class, 'store']);
    Route::post('user/cart/delete/{id}', [CartController::class, 'deleteCartItem']);

    Route::post('user/checkout', [CheckoutController::class, 'index']);
    Route::post('user/checkout/store', [CheckoutController::class, 'storeCod']);

    Route::get('user/order', [OrderController::class, 'index']);


});

Route::group(['middleware' => ['auth:sanctum', 'check_role:admin']], function () {

    Route::get('/admin/profile', function () {
        return response()->json(['message' => 'Chào Admin']);
    });
});

