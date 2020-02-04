<?php

/*
|--------------------------------------------------------------------------
| Manage Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "MDashboardController@dashboard");
Route::get('dashboard', "MDashboardController@dashboard");

Route::get('shops','MShopController@shops');
Route::post('shops/create','MShopController@shop_create');
