<?php

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
    Route::get('/products', ProductsGrid::class)->name('products');
});
