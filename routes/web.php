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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('product.show');

Route::prefix('/cart')->group(function() {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/quantity/update', [\App\Http\Controllers\CartController::class, 'updateQuantity']);
    Route::delete('/delete/{cart}', [\App\Http\Controllers\CartController::class, 'deleteCartItem'])->name('cart.destroy');
});

Route::post('like', [\App\Http\Controllers\LikeController::class, 'like'])
    ->middleware(['auth'])->name('like');

require __DIR__.'/auth.php';
