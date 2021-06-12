<?php

use App\Http\Livewire\ProductForm;
use App\Http\Livewire\ProductsGrid;
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
        Route::get('/', ProductsGrid::class)->name('products');
        Route::get('/create', ProductForm::class)->name('products.create');
        Route::get('/edit/{product}', ProductForm::class)->name('products.edit');
    });
});
