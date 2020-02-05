<?php
Route::get('/','AAccountController@login');
Route::get('login','AAccountController@login')->name('login');

//Auth
Route::post('auth','\App\Http\Controllers\Auth\LoginController@login');
Route::post('register','\App\Http\Controllers\Auth\LoginController@register');
Route::get('logout','\App\Http\Controllers\Auth\LoginController@logout');

Route::middleware(['auth'])->group(function(){
    Route::get('profile','AAccountController@profile');
    Route::post('profile/save','AAccountController@profile_save');
    Route::post('profile/address/get','AAccountController@profile_address_get');
    Route::post('profile/address/update','AAccountController@profile_address_save');
    Route::post('profile/address/delete','AAccountController@profile_address_delete');
    
});