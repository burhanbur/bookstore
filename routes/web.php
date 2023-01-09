<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('shop', [HomeController::class, 'shop'])->name('shop');
Route::get('blog', [HomeController::class, 'blog'])->name('blog');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

Route::get('product-detail/{slug}', [HomeController::class, 'detail'])->name('shop.detail');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function() {

	});
});
