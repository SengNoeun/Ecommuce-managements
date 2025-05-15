<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
// ***********************************************************
// Route Products
// ***********************************************************
Route::get('/', function () {
    return view('admin.user.login');
})->name('admin.user.login');
Route::get('admin/dashboard',[DashboardController::class ,'index'])->name('admin.dashboard.index');
Route::get('admin/products',[ProductController::class ,'index'])->name('admin.products.index');
Route::get('admin/products/create',[ProductController::class ,'create'])->name('admin.products.create');
Route::get('admin/products/{id}',[ProductController::class ,'edit'])->name('admin.products.edit');
Route::POST('admin/products/store',[ProductController::class ,'store'])->name('admin.products.store');
Route::put('admin/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
Route::DELETE('admin/products/destroy/{id}',[ProductController::class ,'destroy'])->name('admin.products.destroy');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');

Route::get('admin/categorys',[CategoryController::class ,'index'])->name('admin.categorys.index');
Route::get('admin/categorys/create',[CategoryController::class ,'create'])->name('admin.categorys.create');
Route::get('admin/categorys/{id}',[CategoryController::class ,'edit'])->name('admin.categorys.edit');
Route::POST('admin/categorys/store',[CategoryController::class ,'store'])->name('admin.categorys.store');
Route::DELETE('admin/categorys/destroy/{id}',[CategoryController::class ,'destroy'])->name('admin.categorys.destroy');
Route::PUT('admin/categorys/update/{id}',[CategoryController::class ,'update'])->name('admin.categorys.update');

Route::get('admin/brands',[BrandController::class ,'index'])->name('admin.brands.index');
Route::get('admin/brands/create',[BrandController::class ,'create'])->name('admin.brands.create');
Route::POST('admin/brands/store',[BrandController::class ,'store'])->name('admin.brands.store');
Route::get('admin/brands/{id}',[BrandController::class ,'edit'])->name('admin.brands.edit');
Route::PUT('admin/brands/update/{id}',[BrandController::class ,'update'])->name('admin.brands.update');
Route::DELETE('admin/brands/destroy/{id}',[BrandController::class ,'destroy'])->name('admin.brands.destroy');

Route::get('admin/slide',[SlideController::class ,'index'])->name('admin.slide.index');
Route::get('admin/slide/create',[SlideController::class ,'create'])->name('admin.slide.create');
Route::get('admin/slide/{id}',[SlideController::class ,'edit'])->name('admin.slide.edit');
Route::POST('admin/slide/store',[SlideController::class ,'store'])->name('admin.slide.store');
Route::PUT('admin/slide/update/{id}',[SlideController::class ,'update'])->name('admin.slide.update');
Route::DELETE('admin/slide/destroy/{id}',[SlideController::class ,'destroy'])->name('admin.slide.destroy');

Route::get('admin/user', [UserController::class, 'index'])->name('admin.user.index');
Route::get('admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
Route::get('admin/user/{user}', [UserController::class, 'show'])->name('admin.user.show');
Route::get('admin/user/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
Route::post('admin/user', [UserController::class, 'store'])->name('admin.user.store');
Route::put('admin/user/{user}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('admin/user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');