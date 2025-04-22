<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class,'index'])->name('home');
Route::get('/viewproduct/{id}', [PagesController::class,'viewproduct'])->name('viewproduct');
Route::get('/categoryproduct/{id}', [PagesController::class,'categoryproduct'])->name('categoryproduct');
Route::get('/search', [PagesController::class,'search'])->name('search');


Route::middleware('auth')->group(function () {
    Route::post('cart/store', [CartController::class,'store'])->name('cart.store');
    Route::get('mycart', [CartController::class,'mycart'])->name('mycart');
    Route::get('cart/{id}/destroy', [CartController::class,'destroy'])->name('cart.destroy');
    Route::get('checkout/{cartid}', [PagesController::class,'checkout'])->name('checkout');
    Route::get('order/{cartid}/store', [orderController::class,'store'])->name('order.store');

});
Route::middleware(['auth','admin'])->group(function () {
    //Category
    Route::get('/category', [CategoryController::class,'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class,'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class,'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class,'edit'])->name('category.edit');
    Route::post('/category/{id}/update', [CategoryController::class,'update'])->name('category.update');
    Route::delete('/category/destroy', [CategoryController::class,'destroy'])->name('category.destroy');


    //Product
    Route::get('/product', [ProductController::class,'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class,'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class,'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class,'edit'])->name('product.edit');
    Route::post('/product/{id}/update', [ProductController::class,'update'])->name('product.update');
    Route::delete('/product/destroy', [ProductController::class,'destroy'])->name('product.destroy');

    //Order
    Route::get('/orders', [orderController::class,'index'])->name('orders.index');
    Route::get('/orders/{id}/status/{status}', [orderController::class,'status'])->name('order.status');

});

Route::get('/dashboard', [DashboardController::class,'dashboard'])->middleware(['auth', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';