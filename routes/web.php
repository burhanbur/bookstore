<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicationController;

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
Route::get('publication', [HomeController::class, 'publication'])->name('publication');
Route::get('publication/{slug}', [HomeController::class, 'showPublication'])->name('show.publication');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

Route::get('product-detail/{slug}', [HomeController::class, 'detail'])->name('shop.detail');

Route::group(['prefix' => 'download', 'as' => 'download.'], function() {
	Route::get('/', [PublicationController::class, 'download'])->name('repository');

	Route::get('protein_representation.pdf', [HomeController::class, 'downloadProteinRepresentation'])->name('protein.representation');
	Route::get('sequence_model.pdf', [HomeController::class, 'downloadSequenceModel'])->name('sequence.model');
	Route::get('convolutional_neural_network.pdf', [HomeController::class, 'downloadConvolutionalNeuralNetwork'])->name('convolutional.neural.network');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function() {

	});

	Route::group(['prefix' => 'publication', 'as' => 'publication.'], function() {
		Route::get('create', [PublicationController::class, 'create'])->name('create');
		Route::get('edit/{slug}', [PublicationController::class, 'edit'])->name('edit');
		Route::post('store', [PublicationController::class, 'store'])->name('store');
		Route::put('update/{slug}', [PublicationController::class, 'update'])->name('update');
		Route::delete('delete/{id}', [PublicationController::class, 'delete'])->name('delete');	
	});
});
