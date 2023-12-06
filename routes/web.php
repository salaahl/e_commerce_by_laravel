<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\StripePaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/404', function () {
    abort(404);
});

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/products/manage', [ProductController::class, 'manage']);
    Route::post('/products/create', [ProductController::class, 'create']);
    Route::post('/products/update', [ProductController::class, 'update']);
    Route::post('/products/destroy', [ProductController::class, 'destroy']);
});
Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/products/{slug}', [ProductController::class, 'product'])->name('product');

Route::middleware('auth')->group(function () {
    Route::get('/order', [BasketController::class, 'order'])->name('order');
    Route::get('/order/confirmation/{slug}', [BasketController::class, 'confirmation'])->name('confirmation');
    Route::get('/basket', [BasketController::class, 'show'])->name('basket');
    Route::put('/basket/store', [BasketController::class, 'store']);
    Route::patch('/basket/update', [BasketController::class, 'update']);
    Route::delete('/basket/destroy', [BasketController::class, 'destroy']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/orders', [HomeController::class, 'profile'])->name('commands');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('checkout/', [StripePaymentController::class, 'checkout'])->name('checkout');
Route::post('checkout/', [StripePaymentController::class, 'checkoutPost'])->name('checkout.post');
Route::post('status/', [StripePaymentController::class, 'status'])->name('status.post');
Route::get('return/', [StripePaymentController::class, 'return'])->name('return');

require __DIR__ . '/auth.php';
