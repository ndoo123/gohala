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
use Exception;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LKS;
class ShopController extends Controller
{
    public function home(Request $r)
    {
   
        return view('web.ecommerce.shop',$r->data);
    }
    public function product_view(Request $r)
    {
        $product=Product::where("id",$r->product_id)->where('shop_id',$r->data['shop']->id)->first();
        if(!$product)
        {
            return redirect(env('APP_URL').'/error_404')->with('error',__('view.shop_not_found'));
        }
       $data= $r->data;
       $data['product']=$product;

        return view('web.ecommerce.product',$data);
    }

    public function product_remove_from_cart(Request $r)
    {
        $resp=Cart::remove_item($r->shop_id,$r->product_id);
        return \LKS::o(1,$resp);
    }
    public function cart_shop_clear(Request $r)
    {
        $resp=Cart::clear_shop($r->shop_id);
        return \LKS::o(1,$resp);
    }
    public function cart_update_item(Request $r)
    {
        $resp=Cart::update_item($r->shop_id,$r->product_id,$r->qty);
        return \LKS::o(1,$resp);
    }
    public function product_add_to_cart(Request $r)
    {
        $p=Product::where("id",$r->product_id)->first();
        if(!$p)
        return \LKS::o(0,"ไม่พบสินค้า");

        if($p->shop==null)
        return \LKS::o(0,"ไม่พบข้อมูลร้านค้า");


        if(!is_numeric($p->p_price))
            $p->p_price=0;
            
             $basket_item=array(
                'product_id'=>$p->id,
                'shop_id'=>$p->shop_id,
                'url'=>$p->shop->url,
                'name'=>$p->name,
                'qty'=>$r->qty,
                'price'=>$p->get_discount_price(),
                'link'=>$p->get_link(),
                'img'=>$p->get_photo()
                );
            $resp=Cart::add_to_cart($basket_item,$p->shop);
            return \LKS::o(1,$resp);
    }

    //JSON
    public function get_product_json(Request $r)
    {
        $collection=Product::where("shop_id",$r->data['shop']->id)->paginate(30);
        $collection->getCollection()->transform(function ($p) use($r) {
            // Your code here
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
                "link"=>$p->get_link($r->data['shop']->url)
            ];
        });
        
        return LKS::o(1,$collection);
    }

}