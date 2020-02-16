<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductSlug;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function home(){
        $data['categories']=ProductCategory::all();
        return view('web.home.home',$data);
    }
    public function category(Request $r)
    {
        $cat=\DB::table('category_tb')->where("slug",$r->slug)->first();
        if($cat)
        {
            $data['category']=$cat;
            $data['categories']=ProductCategory::all();
            $data['products']=Product::where("category_id",$cat->id)->get();
         
            return view('web.home.category',$data);
        }

        return redirect('error_404');
    }
    public function product_single(Request $r)
    {
      
        $slug=ProductSlug::where("shop_id",$r->shop_id)->where("slug",$r->slug)->first();
        if(!$slug)
        return redirect('error_404');

        $data['product']=Product::where("shop_id",$slug->shop_id)->where("id",$slug->product_id)->first();
        $data['categories']=ProductCategory::all();
        $data['category']=ProductCategory::where("id",$data['product']->category_id)->first();
        
        return view('web.home.single_product',$data);
    }
}