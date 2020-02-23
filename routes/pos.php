<?php

Route::get('/', 'PPosController@index');
Route::get('shop/{id}','PPosController@pos');

Route::get('/pos/read-data/{id}/{shop}','PPosController@readData');
Route::get('/pos/read-barcode/{sku}/{shop}','PPosController@read_barcode');


// autocomplete
Route::get('autocomplete', 'PPosConroller@autocomp')->name('autocomp');


