<?php

Route::get('/', 'PPosController@index');
Route::get('shop/{id}','PPosController@pos');

Route::get('/pos/read-data/{id}/{shop}','PPosController@readData');
Route::get('/pos/read-barcode/{sku}/{shop}','PPosController@read_barcode');


// autocomplete
Route::get('/autocomplete', 'PPosConroller@autocomp')->name('autocomp');

// submit form barcode
Route::get('/check-barcode/{shopid}/{id}','PPosController@check_barcode');

// กดปุ่ม บันทึก/พิมพ์
//Route::get('save_print','PPosController@check_product');
Route::post('{shop_id}/pos/save','PPosController@pos_save');

// สั่งพิมพ์ใบเสร็จ
Route::get('print_slip/{rec_no}/{rec_num}','PPosController@print_slip');