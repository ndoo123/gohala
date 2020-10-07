<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\Shop;
use App\Models\Product;
use App\Models\ProductSlug;
use App\Models\ProductPhoto;
use App\Models\ProductCategory;
use App\Models\Receipt;
use App\Models\User;
use App\Models\ShopCat;
use Exception;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cart;
use LKS;
class ShopController extends Controller
{
    public function home(Request $r)
    {
        // dd(\Auth::user());
        $output['search'] = !empty($r->search)?$r->search:null;
        foreach($r->data as $key => $data)
        {
            $output[$key] = $data;
        }
        // dd($output,\Cart::get_cart());
        // dd($output,\Auth::user());
        return view('web.ecommerce.shop',$output);
    }
    public function product_view(Request $r)
    {
        $product=Product::where("id",$r->product_id)->where('shop_id',$r->data['shop']->id)->with('photos')->first();
        if(!$product)
        {
            return redirect(env('APP_URL').'/error_404')->with('error',__('view.shop_not_found'));
        }
       $data= $r->data;
       $data['product']=$product;
       $data['link'] = $data['product']->id.',1,"'.$data['shop']->url.'"';
        // dd($data['product']->photos);
        return view('web.ecommerce.product',$data);
    }
    public function cart(Request $r)
    {
        // dd(\Cart::get_cart());
        return view('web.ecommerce.cart');
    }



    //JSON
  
    public function get_product_json(Request $r)
    {
        // dd($r->all());
        $collection = Product::
        where("shop_id",$r->data['shop']->id);
        if(!empty($r->cat))
        {
            $collection = ShopCat::where('shop_id',$r->data['shop']->id)
            ->where('category_id',$r->cat);
            // dd($r->all(),$collection->get());
        }
        else if(!empty($r->search_product))
        {
            $search = '%'.$r->search_product.'%';
            $collection = $collection
            ->where('name','like',$search)
            ->orWhere('info_short','like',$search)
            ->orWhere('info_full','like',$search);
        }
        // dd($collection->get());
        $count = $collection->count();
        $collection = $collection->paginate($count);
        // $collection = $collection->paginate(30);
        // dd($r->all(),!empty($r->cat));
        // dd($r->cat,$count,$collection);
        // dd($collection->get());
        if(!empty($r->cat)) // กรณีกดเลือกประเภท
        {
            $collection->getCollection()->transform(function ($p) use($r) {
                // Your code here
                // dd($p->product);
                return [
                    "product_id"=>$p->product->id,
                    "name"=>$p->product->name,
                    "price"=>$p->product->price,
                    "price_format"=>number_format($p->product->price,2),
                    "sku"=>$p->product->sku,
                    "info_short"=>$p->product->info_short,
                    "discount_value"=>$p->product->discount_value,
                    "discount_price"=>$p->product->get_discount_price(true),
                    "photo"=>$p->product->get_photo(),
                    "is_discount"=>$p->product->is_discount,
                    "link"=>$p->product->get_link($r->data['shop']->url),
                    'search' => $r->all(),
                ];
            });
        }
        else // กรณีไม่กดเลือกประเภท
        {
            $collection->getCollection()->transform(function ($p) use($r) {
                // Your code here
                // dd($p,$p->get_photo());
                return [
                    "product_id"=>$p->id,
                    "name"=>$p->name,
                    "price"=>$p->price,
                    "price_format"=>number_format($p->price,2),
                    "sku"=>$p->sku,
                    "info_short"=>$p->info_short,
                    "discount_value"=>$p->discount_value,
                    "discount_price"=>$p->get_discount_price(true),
                    "photo"=>$p->get_photo(),
                    "is_discount"=>$p->is_discount,
                    "link"=>$p->get_link($r->data['shop']->url),
                    'search' => $r->all(),
                ];
            });
        }
        // dd($collection);
        return LKS::o(1,$collection);
    }

    public function login(Request $r)
    {
        // dd($r->all());
        if((!isset($r->email)||$r->email=="") || (!isset($r->password) || $r->password==""))
        {
            return \LKS::o(0,__('auth.email_password_empty'));
        }

        $u=User::where("email",$r->email)->where("facebook_id",null)->first();
        if(!$u)
        return LKS::o(0,__('auth.user_not_found'));

        if(!\Hash::check($r->password,$u->password))
        return LKS::o(0,__('auth.wrong_password'));

        // dd(\Auth::user(),\Auth::check(),LKS::o(1,array('redirect'=>url('profile'))),$r->all(),$r->redirect);
        \Auth::login($u);
        // dd(\Auth::user());
        if(isset($r->redirect))
        return LKS::o(1,array('redirect'=>$r->redirect));


        // dd(1,$r->all());
        return LKS::o(1,array('redirect'=>url('profile')));
    }
}