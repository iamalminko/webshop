<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::get('cart/{id}', 'App\Http\Controllers\Api\CartController@cart');
Route::get('products', 'App\Http\Controllers\Api\CartController@products');
Route::get('addToCart/{user_id}/{id}', 'App\Http\Controllers\Api\CartController@addToCart');
Route::get('removeFromCart/{id}', 'App\Http\Controllers\Api\CartController@removeFromCart');
Route::get('changeAmount/{id}/{amount}', 'App\Http\Controllers\Api\CartController@changeAmount');
