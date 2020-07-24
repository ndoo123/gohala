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
use Cart;
use LKS;
class ShopController extends Controller
{
    public function home(Request $r)
    {
        $output['search'] = !empty($r->search)?$r->search:null;
        foreach($r->data as $key => $data)
        {
            $output[$key] = $data;
        }
        // dd($output,1);
        return view('web.ecommerce.shop',$output);
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
        if(!empty($r->search_product))
        {
            $search = '%'.$r->search_product.'%';
            $collection = $collection
            ->where('name','like',$search)
            ->orWhere('info_short','like',$search)
            ->orWhere('info_full','like',$search);
        }
        // dd($collection->get());
        $collection = $collection->paginate(30);

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
                "link"=>$p->get_link($r->data['shop']->url),
                'search' => $r->all(),
            ];
        });
        
        return LKS::o(1,$collection);
    }

}