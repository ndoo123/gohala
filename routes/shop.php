<?php

	Route::get('/','ShopController@home');
	Route::get('product/{product_id}','ShopController@product_view');

	Route::post('get/prooduct/json','ShopController@get_product_json');
	Route::get('get/prooduct/json','ShopController@get_product_json');