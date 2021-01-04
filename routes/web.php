<?php

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

Auth::routes();

Route::get('/', 'ProductController@home')->name('home');

Route::get('/productTypes', 'ProductTypeController@index')->name('productTypes.index');
Route::get('/products/{product}', 'productController@show')->name('products.show');

Route::middleware('auth')->group(function(){


    Route::get('/products', 'productController@index')->name('products.index');
    Route::get('/products/create/{productType}', 'productController@create')->name('products.create');
    Route::post('/products/{productType}', 'productController@store')->name('products.store');

    Route::get('/products/{product}/edit', 'productController@edit')->name('products.edit');
    Route::put('/products/{product}', 'productController@update')->name('products.update');

    Route::delete('/products/{product}', 'productController@destroy')->name('products.destroy');

    Route::get('/carts/', 'CartController@index')->name('carts.index');
    Route::post('/carts/{product}', 'CartController@addToCart')->name('carts.atc');
    Route::put('/carts/{product}', 'CartController@update')->name('carts.update');

    Route::delete('/carts/{product}', 'CartController@destroy')->name('carts.destroy');

    Route::get('/transactions', 'TransactionController@index')->name('transactions.index');
    Route::post('/transactions', 'TransactionController@create')->name('transactions.create');
    Route::get('/transactions/{transaction}', 'TransactionController@show')->name('transactions.show');
});


