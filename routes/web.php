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

Route::get('/', 'App\Http\Controllers\FrontController@index');
Route::get('/shop', 'App\Http\Controllers\FrontController@shop');
Route::get('/cart', 'App\Http\Controllers\FrontController@cart');

Route::post('/addToCart/{id}', 'App\Http\Controllers\FrontController@addToCart')->name('addToCart');
Route::get('/changeAmount/{id}/{amount}', 'App\Http\Controllers\FrontController@changeAmount')->name('changeAmount');
Route::get('/removeFromCart/{id}', 'App\Http\Controllers\FrontController@removeFromCart')->name('removeFromCart');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
Route::post('/setDiscount/{id}', 'App\Http\Controllers\DashboardController@setDiscount')->name('setDiscount');
Route::get('/addToCart/{id}', 'App\Http\Controllers\FrontController@addToCart')->name('addToCart');

Auth::routes();

