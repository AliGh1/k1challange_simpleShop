<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web, auth, auth.admin" middleware group. Now create something great!
|
*/

Route::resource('products', ProductController::class);
Route::resource('products.gallery', ProductGalleryController::class);
Route::resource('categories', CategoryController::class);
