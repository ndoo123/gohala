<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;

class MDashboardController extends Controller
{
   public function dashboard()
   {
       return view('manage.dashboard.dashboard');
   }
}