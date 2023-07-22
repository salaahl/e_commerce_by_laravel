<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BasketController;

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
Route::get('/articles/{slug}', [ArticlesController::class, 'article'])->name('article');
Route::get('/articles', [ArticlesController::class, 'articles'])->name('articles');

Route::middleware('auth')->group(function () {
    Route::get('/user-profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/order', [BasketController::class, 'order'])->name('order');
    Route::get('/order/confirmation/{slug}', [BasketController::class, 'confirmation'])->name('confirmation');
    Route::get('/basket', [BasketController::class, 'show'])->name('basket');
    Route::post('/basket/store', [BasketController::class, 'store']);
    Route::post('/basket/update', [BasketController::class, 'update']);
    Route::post('/basket/destroy', [BasketController::class, 'destroy']);
    Route::get('CRUD/create', [CRUDController::class, 'create']);
    Route::get('CRUD/store', [CRUDController::class, 'store']);
    Route::get('CRUD/update', [CRUDController::class, 'update']);
    Route::get('CRUD/show', [CRUDController::class, 'show']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
