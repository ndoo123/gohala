<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
class HomeController extends Controller
{
    public function home(){
        $data['categories']=ProductCategory::all();
        return view('web.home.home',$data);
    }
}