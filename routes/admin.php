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
Route::get('/' , function() {
    return view('admin.index');
});
Route::resource('products', ProductController::class)->except('show');
Route::resource('products.gallery', ProductGalleryController::class)->except('show');
Route::resource('categories', CategoryController::class);
