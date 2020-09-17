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

Route::get('order_detail', 'MSettingController@order_detail');

Route::group(['middleware' => ['shop_manage_check'],'prefix'=>'{shop_id}'],function () {
    //สามารถเรีย $request->shop เพื่อ ดึงข้อมูลของ Shop มาได้เลย ในทุกๆฟังชั่นในนี้
    Route::get('/', "MShopController@shop_manage");
    Route::post('/profit', "MShopController@shop_profit");
    Route::get('/all', "MShopController@shop_manage_all");
    Route::get('/order_datatables', "MShopController@order_datatables");
    Route::post('/order_cancel', "MShopController@order_cancel");
    Route::post('/update_order_status', "MShopController@update_order_status");
    Route::post('/update_trace', "MShopController@update_trace");

    // Product
    Route::get('products', "MShopController@product_list");
    Route::get('products/datatables', "MShopController@product_datatables");
    Route::post('products/update_position', "MShopController@product_update_position");
    Route::get('products/create','MShopController@product_view');
    Route::post('products/save','MShopController@product_save');
    Route::get('product/{product_id}','MShopController@product_view');

    //Category
    Route::get('categories','MShopController@shop_categories');
    Route::post('categories/update_position','MShopController@shop_categories_update_position');
    Route::get('categories/datatables','MShopController@shop_categories_datatables');
    Route::post('categories/update/json','MShopController@shop_categories_update_json');
    Route::post('categories/get/json','MShopController@shop_categories_get_json');
    Route::post('categories/delete/json','MShopController@shop_categories_delete_json');
    Route::post('categories/update/active/json','MShopController@shop_categories_active_json');

    // Order
    Route::get('order','MOrderController@index');
    Route::get('order/{order_status}','MOrderController@index');
    
    Route::get('setting_shop', 'MShopController@setting_shop');
    
    Route::get('settings','MSettingController@settings');
    Route::post('settings/change_profile','MSettingController@settings_change_profile');
    Route::post('setting/info/save/json','MSettingController@setting_info_save_json');
    Route::post('setting/delivery/save/json','MSettingController@setting_delivery_save_json');
    Route::post('setting/payment/save/json','MSettingController@setting_payment_save_json');
    Route::post('setting/pos/save/json','MSettingController@setting_pos_save_json');
    
});
