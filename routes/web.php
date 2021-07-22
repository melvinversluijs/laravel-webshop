<?php

declare(strict_types=1);

use App\Http\Controllers\CategoryController;
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

Route::middleware(['middleware' => 'auth:sanctum', 'verified'])->group(static function (): void {
    Route::view('/', 'dashboard')->name('dashboard');

    Route::group(['prefix' => 'products'], static function (): void {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::get('/{product}/edit/', [ProductController::class, 'edit'])->name('products.edit');
    });

    Route::group(['prefix' => 'categories'], static function (): void {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('/{category}/edit/', [CategoryController::class, 'edit'])->name('categories.edit');
    });
});
