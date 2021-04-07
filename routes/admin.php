<?php
Route::get('/',function(){
    return redirect('/dashboard');
});
Route::get('/dashboard','AdminController@dashboard');
// Route::get('/test',function(){
//     $output['shops'] = App\Models\Shop::all();
//     // $output['name'] = 'asdf';
//     // $output['json'] = json_decode(json_encode(['a'=>'a']));
//     // DD('ADMIN',$output);
//   return view('test.test_ex',$output);
// });
Route::get('/test','AdminController@info_shop');