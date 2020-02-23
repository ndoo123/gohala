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

Route::group(['middleware' => ['shop_manage_check'],'prefix'=>'{shop_id}'],function () {
    //สามารถเรีย $request->shop เพื่อ ดึงข้อมูลของ Shop มาได้เลย ในทุกๆฟังชั่นในนี้
    Route::get('/', "MShopController@shop_manage");
    Route::get('products', "MShopController@product_list");
    Route::get('products/create','MShopController@product_view');
    Route::post('products/save','MShopController@product_save');
    Route::get('product/{product_id}','MShopController@product_view');
    
});
