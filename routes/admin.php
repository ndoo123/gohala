<?php
Route::get('/',function(){
    return redirect('/dashboard');
});
Route::get('/dashboard','AdminController@dashboard');

Route::get('shops','AdminController@info_shop');
Route::get('shop/datatables','AdminController@shop_datatables');
// Route::post('/shop_create','AdminController@shop_create');

Route::get('users','AdminController@info_user');
Route::get('user/datatables','AdminController@user_datatables');
Route::get('edit_user','AdminController@edit_user');

Route::get('edit_shop','AdminController@edit_shop');
Route::post('edit_shop/change_profile','AdminController@settings_change_profile');
Route::post('edit_shop/info/save/json','AdminController@setting_info_save_json');
Route::post('edit_shop/delivery/save/json','AdminController@setting_delivery_save_json');
Route::post('edit_shop/payment/save/json','AdminController@setting_payment_save_json');
Route::post('edit_shop/pos/save/json','AdminController@setting_pos_save_json');


