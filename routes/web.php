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

// Route::get('bert',function(){
//   try {
//     // dd(env('MAIL_HOST'),env('MAIL_USERNAME'),env('MAIL_PASSWORD'));
//     $email = "bot_laster@hotmail.com";
//             $mail = new \PHPMailer(true);
//             $mail->isSMTP(true); // tell to use smtp
//             $mail->CharSet = "utf-8"; // set charset to utf8
//             $mail->SMTPAuth = true; // use smpt auth
//             $mail->IsHTML(true);
//             $mail->SMTPSecure = "tsl"; // or ssl
//             $mail->Host = env('MAIL_HOST');
//             $mail->Port = "25";
//             $mail->Username = env('MAIL_USERNAME');
//             $mail->Password = env('MAIL_PASSWORD');
//             $mail->setFrom(env('MAIL_USERNAME'), 'Programmer /bert');
//             $mail->Subject = 'Test Send mail';
//             $mail->SMTPOptions = array(
//                 'ssl' => array(
//                     'verify_peer' => false,
//                     'verify_peer_name' => false,
//                     'allow_self_signed' => true
//                 )
//             );
//             // $mail->MsgHTML($template);
//             $mail->addAddress($email);
//             $mail->Body = $email;
//             $mail->send();
//         } catch (Exception $e) {
//             \Log::info('mail:Exception:' . json_encode($e->getMessage()));
//             dd(2,$e);
//         }
//         dd(123);
//         return true; 
// });
Route::get('testmail',function(){
   \Mail::send([], [], function ($message){

        
        $message->from(env('MAIL_USERNAME'),"Gohala /testmail" );
        

        $message->to("bot_laster@hotmail.com")->subject("ยืนยันอีเมล์")
        ->setBody('กรุณายืนยันอีเมล์เพื่อใช้งาน<br>','text/html');
        // ->setBody('กรุณายืนยันอีเมล์เพื่อใช้งาน<br> remote_addr'.$_SERVER['REMOTE_ADDR'].'<br> server_addr'.$_SERVER['SERVER_ADDR'],'text/html');
    });
        
});
Route::get('/db/migrate', function() {
  Artisan::call('migrate');
    return "migrate!";
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
Route::get('shop_profile/image/{shop_id}',function($shop_id){
  $path=storage_path('app/uploads/shop_profile/'.$shop_id);
  if(!file_exists($path))
  $path=public_path('assets/images/shop_icon.png');
  // $path=public_path('assets/images/no_user.png');

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
Route::get('images/bank_tranfer/{shop_id}/{photo_name}.jpg',function($shop_id,$photo_name){
  // $photo=\App\Models\ProductPhoto::where("product_id",$product_id)->where("id",$image_id)->first();
  // if(!$photo)
  // $path=public_path('assets/images/no_image_available.jpeg');
  // else
  $path=storage_path('app/uploads/bank_tranfer/'.$shop_id.'/'.$photo_name);
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
Route::get('/email_admin', "HomeController@email_admin");

Route::get('/{shop_url}/checkout','HomeController@shop_checkout');
Route::get('dropzone','HomeController@dropzone');
Route::group(['middleware'=>'auth'],function(){
  Route::post('/{shop_url}/checkout/process','HomeController@shop_checkout_process');
  Route::get('/order/status','HomeController@order_status');
  //Account
  Route::post('/account/user/add_address','\App\Http\Controllers\Account\AAccountController@profile_address_save');


});
