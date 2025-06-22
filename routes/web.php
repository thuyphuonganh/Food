<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Hiển thị form thêm món ăn
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
// Xử lý lưu món ăn vào database
Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
