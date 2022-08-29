<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageUploadController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
});

Route::middleware(['auth'])->group(function () {
    //category
    Route::name('category.')->prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/all', [CategoryController::class, 'getData']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::name('product.')->prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });

    Route::name('carts.')->prefix('cart')->group(function () {
        Route::get('/exists/{id}', [CartController::class, 'itemIsInCart']);
        Route::get('/', [CartController::class, 'index']);
        Route::get('/{id}', [CartController::class, 'addToCart']);
        Route::post('/', [CartController::class, 'store']);
        Route::delete('/{id}', [CartController::class, 'destroy']);
    });

});


Route::get('/products/all', [ProductController::class, 'getData']);
Route::post('image-upload', [ImageUploadController::class, 'upload']);
