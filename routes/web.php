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
Route::get('migrate',function(){
  
  if(!isset($_GET["cmd"]))
  return "no CMD";

    \Artisan::call($_GET["cmd"], [
    '--force' => true,
    ]);
    return redirect('/')->with('success','เริ่มฐานข้อมูลใหม่สำเร็จ');
});
Route::get('lang?lang={lang}',function(){
  App::setLocale('en');
});
Route::get('/error_404',function(){
  return view('error.error_404');
})->name('error_404');

Route::get('images/product/{shop_id}/{product_id}.{photo_name}.jpg',function($shop_id,$product_id,$photo_name){
  // $photo=\App\Models\ProductPhoto::where("product_id",$product_id)->where("id",$image_id)->first();
  // if(!$photo)
  // $path=public_path('assets/images/no_image_available.jpeg');
  // else
  $path=storage_path('app/uploads/shop/'.$shop_id.'/product/'.$product_id.'/'.$photo_name);
  if(!file_exists($path))
  $path=public_path('assets/images/no_image_available.jpeg');

  $file = File::get($path);

  $type = File::mimeType($path);

  $response = Response::make($file, 200);

  $response->header("Content-Type", $type);
  
  return $response;

});
Route::get('login',function(Illuminate\Http\Request $r){

  if(session('redirect'))
  return redirect(LKS::url_subdomain('account','login'))->with('redirect',session('redirect'));
  
  return redirect(LKS::url_subdomain('account','login'));
  });
Route::get('logout',function(){return redirect(LKS::url_subdomain('account','logout'));});
Route::get('category/{slug}','HomeController@category');
Route::get('product/{slug}.{shop_id}','HomeController@product_single');
Route::post('product/add_to_cart','HomeController@product_add_to_cart');
Route::get('checkout','HomeController@checkout');

Route::get('/{shop_url}','HomeController@shop_view');
Route::get('/{shop_url}/cat/{cat_slug}','HomeController@shop_category_view');
Route::get('/', "HomeController@home");


Route::group(['middleware'=>'auth'],function(){
  //Account
  Route::post('/account/user/add_address','\App\Http\Controllers\Account\AAccountController@profile_address_save');

});
