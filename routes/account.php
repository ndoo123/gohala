<?php
Route::get('/','AAccountController@login');
Route::get('login','AAccountController@login')->name('login');
Route::get('login/fb/callback','AAccountController@login_fb_callback');
Route::get('login/fb','AAccountController@login_fb');

//Auth
Route::post('auth','\App\Http\Controllers\Auth\LoginController@login');
Route::post('auth/facebook','\App\Http\Controllers\Auth\LoginController@login_facebook');
Route::post('register','\App\Http\Controllers\Auth\LoginController@register');
Route::get('logout','\App\Http\Controllers\Auth\LoginController@logout');
Route::get('email/verify','AAccountController@verify_email');
Route::post('user/reset_password/send','AAccountController@reset_password_send');
Route::get('user/reset_password','AAccountController@reset_password');
Route::post('user/reset_password/process','AAccountController@reset_password_process');
Route::middleware(['auth'])->group(function(){
    // dd(\Auth::user());
    Route::post('notify_bar','ANotifyController@notify_bar');
    Route::post('notify_update_global','ANotifyController@notify_update_global');
    Route::post('notify_read','ANotifyController@notify_read');
    Route::get('profile','AAccountController@profile');
    Route::post('profile/get_payment_img','AAccountController@get_payment_img');
    Route::post('profile/user_payment','AAccountController@user_payment');
    Route::get('profile/user_order_datatables','AAccountController@user_order_datatables');
    Route::post('profile/save','AAccountController@profile_save');
    Route::post('profile/address/default_change','AAccountController@default_change');
    Route::post('profile/address/get','AAccountController@profile_address_get');
    Route::post('profile/address/update','AAccountController@profile_address_save');
    Route::post('profile/address/delete','AAccountController@profile_address_delete');
    Route::get('send/email/verify','AAccountController@send_verify_email');

    Route::post('profile/update/profile_image','AAccountController@profile_upload_photo');
    
    Route::get('order_detail','AOrderController@order_detail');
});