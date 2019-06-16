<?php

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

Route::namespace('Api')->group(function () {
    Route::post('/test/stackExample', 'TestController@stackExample');
    Route::post('/test/sumExample', 'TestController@sumExample');
    Route::post('/test/childExample', 'TestController@childExample');

    Route::namespace('Auth')->group(function () {
        //Route::post('/login', 'LoginController@login');
        Route::post('register', 'UserController@register');
        Route::post('login', 'UserController@authenticate');
        Route::get('logout', 'UserController@logout')->middleware('jwt.verify');
    });
    Route::apiResource('restaurant', 'RestaurantController')->middleware('jwt.verify');
    Route::apiResource('restaurant.product', 'ProductController')->middleware('jwt.verify');
    Route::apiResource('restaurant.order', 'OrderController')->middleware('jwt.verify');
    Route::apiResource('order.orderItem', 'OrderItemController')->middleware('jwt.verify');
});
