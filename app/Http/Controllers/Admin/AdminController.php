<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Shop;

class AdminController extends Controller
{
   public function dashboard()
   {
       return view('admin.dashboard.dashboard');
   }

   public function info_shop()
   {
        $output['shops'] = Shop::all();
        // dd($output);
        return view('admin.test.test_ex',$output);    
   }
}