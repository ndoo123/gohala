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
Route::get('testmail',function(){
   \Mail::send([], [], function ($message){

        
        $message->from(env('MAIL_USERNAME'),"Gohala" );
        

        $message->to("botlaster@gmail.com")->subject("ยืนยันอีเมล์")
        ->setBody('กรุณายืนยันอีเมล์เพื่อใช้งาน<br>','text/html');
    });
        
});
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
Route::get('profile/image/{user_id}',function($user_id){
  $path=storage_path('app/uploads/profile/'.$user_id);
  if(!file_exists($path))
  $path=public_path('assets/images/no_user.png');

  $file = File::get($path);

  $type = File::mimeType($path);

  $response = Response::make($file, 200);

  $response->header("Content-Type", $type);
  
  return $response;
});
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
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('clear-cart',function(){
  \Cart::clear();
});
Route::get('login',function(Illuminate\Http\Request $r){

  if(session('redirect'))
  return redirect(LKS::url_subdomain('account','login'))->with('redirect',session('redirect'));
  
  return redirect(LKS::url_subdomain('account','login'));
  });
Route::get('logout',function(){return redirect(LKS::url_subdomain('account','logout'));});
Route::get('search','HomeController@search');
Route::get('category/{slug}','HomeController@category');
// Route::get('product/{slug}.{shop_id}','HomeController@product_single');
Route::get('{shop_url}/product/{slug}.{shop_id}','HomeController@product_single');

Route::get('hoome/get/products','HomeController@get_products');

//SHOP
Route::get('cart','Shop\ShopController@cart');

Route::post('product/add_to_cart','HomeController@product_add_to_cart');
Route::post('product/update_cart','HomeController@cart_update_item');
Route::post('product/remove_cart','HomeController@product_remove_from_cart');
//END SHOP
Route::post('cart/shop/clear','HomeController@cart_shop_clear');
// Route::post('cart/item/update','HomeController@cart_update_item');
// Route::get('checkout','HomeController@checkout');



Route::get('/{shop_url}/cat/{cat_slug}','HomeController@shop_category_view');
Route::get('/', "HomeController@home");

Route::get('/{shop_url}/checkout','HomeController@shop_checkout');
Route::group(['middleware'=>'auth'],function(){
  Route::post('/{shop_url}/checkout/process','HomeController@shop_checkout_process');
  Route::get('/order/status','HomeController@order_status');
  //Account
  Route::post('/account/user/add_address','\App\Http\Controllers\Account\AAccountController@profile_address_save');

});
