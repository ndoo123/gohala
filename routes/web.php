<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/error_404',function(){
  return view('error.error_404');
})->name('error_404');
Route::get('images/product/{product_id}/{image_id}.jpg',function($product_id,$image_id){
  $photo=\App\Models\ProductPhoto::where("product_id",$product_id)->where("id",$image_id)->first();
  if(!$photo)
  $path=public_path('assets/images/no_image_available.jpeg');
  else
  $path=storage_path('app/uploads/shop/'.$photo->shop_id.'/product/'.$photo->product_id.'/'.$photo->name);

  $file = File::get($path);

  $type = File::mimeType($path);

  $response = Response::make($file, 200);

  $response->header("Content-Type", $type);
  
  return $response;

});
Route::get('login',function(){return redirect(LKS::url_subdomain('account','login'));});
Route::get('logout',function(){return redirect(LKS::url_subdomain('account','logout'));});

Route::get('/', "HomeController@home");

Route::get('category/{slug}','HomeController@category');
Route::get('product/{slug}.{shop_id}','HomeController@product_single');

