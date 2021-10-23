<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    dd(Cart::get(3));
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('product.show');

Route::prefix('/cart')->group(function() {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index']);
    Route::post('/add/{product}', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/quantity/update', 'CartController@quantityChange');
    Route::delete('/delete/{cart}', 'CartController@deleteFromCart')->name('cart.destroy');
});

require __DIR__.'/auth.php';

////Cart
//Route::post('/cart/{product}/add', [CartController::class, 'addToCart'])->name('cart.add');
//Route::get('/cart', [CartController::class, 'index'])->name('cart');
//Route::patch('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
//Route::delete('/cart/{cart}/delete', [CartController::class, 'deleteCartItem'])->name('cart.destroy');
