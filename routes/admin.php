<?php
Route::get('/',function(){
    return redirect('/dashboard');
});
Route::get('/dashboard','AdminController@dashboard');