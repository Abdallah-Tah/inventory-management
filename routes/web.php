<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
    Route::put('/products/{id}/restore', [App\Http\Controllers\ProductController::class, 'restore'])->name('products.restore');
    Route::get('/products/{id}/force-delete', [App\Http\Controllers\ProductController::class, 'forceDelete'])->name('products.force-delete');
    Route::get('/product/deleted', [App\Http\Controllers\ProductController::class, 'viewDeletedProducts'])->name('products.deleted');

    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::put('/categories/{id}/restore', [App\Http\Controllers\CategoryController::class, 'restoreCategory'])->name('categories.restore');
    Route::get('/categories/{id}/force-delete', [App\Http\Controllers\CategoryController::class, 'forceDelete'])->name('categories.force-delete');
    Route::get('/categories/deleted', [App\Http\Controllers\CategoryController::class, 'getDeletedCategories'])->name('categories.deleted');
});
