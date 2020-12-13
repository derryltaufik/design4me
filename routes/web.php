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

Route::get('/', 'DesignController@home')->name('home');


Route::get('/designs', 'DesignController@index')->name('designs.index');
Route::get('/designs/create', 'DesignController@create')->name('designs.create');
Route::post('/designs', 'DesignController@store')->name('designs.store');

Route::get('/designs/{design}', 'DesignController@show')->name('designs.show');

Route::get('/designs/{design}/edit', 'DesignController@edit')->name('designs.edit');
Route::put('/designs/{design}', 'DesignController@update')->name('designs.update');

Route::delete('/designs/{design}', 'DesignController@destroy')->name('designs.destroy');
