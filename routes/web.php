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

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');

Auth::routes();

