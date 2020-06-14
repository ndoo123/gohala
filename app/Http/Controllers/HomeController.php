<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Province;
use App\Models\ProductSlug;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\ShopDelivery;
use App\Models\ShopPayment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use App\Models\OrderDelivery;
use App\Models\ShopCategory;
use LKS;
use Cart;
class HomeController extends Controller
{
    public function home(){
        // $data['categories']=ProductCategory::all();
        // $data['show_menu']=0;
        return view('web.promote');
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
        $shop=Shop::where("url",$r->shop_url)->first();
        if(!$shop)
        return redirect('error_404');

        $slug=ProductSlug::where("shop_id",$r->shop_id)->where("slug",$r->slug)->first();
        if(!$slug)
        return redirect('error_404');
        $data['shop']=$shop;
        $data['product']=Product::where("shop_id",$slug->shop_id)->where("id",$slug->product_id)->first();
        $data['categories']=$shop->get_categories(true);
        // $data['category']=ShopCategory::where("id",$data['product']->category_id)->first();
        
        return view('web.home.single_product',$data);
    }
    public function shop_category_view(Request $r)
    {
        $shop=Shop::where("url",$r->shop_url)->first();
        if(!$shop)
        return redirect('error_404');

        $cat=ShopCategory::where('shop_id',$shop->id)->where("slug",$r->cat_slug)->first();

        $data['shop']=$shop;
        $data['categories']=$shop->get_categories(true);
     
        $data['discount_items']=Product::where("shop_id",$shop->id)->where("is_discount",1)->take(6)->get();
        $data['products']=array();
        if($cat)
        $data['products']=Product::join('shop_category_product_tb','shop_category_product_tb.product_id','product_tb.id')
                                            ->where('shop_category_product_tb.category_id',$cat->id)
                                            ->where('shop_category_product_tb.shop_id',$shop->id)
                                            ->selectRaw('product_tb.*')
                                            ->get();
         $data['count_product']=count($data['products']);
         return view('web.home.shop_view',$data);
    }
    public function shop_view(Request $r)
    {
        $shop=Shop::where("url",$r->shop_url)->first();
        if(!$shop)
        return redirect('error_404');

        $data['shop']=$shop;
        $data['categories']=$shop->get_categories(true);

        $data['discount_items']=Product::where("shop_id",$shop->id)->where("is_discount",1)->take(6)->get();

        $product=Product::where("shop_id",$shop->id);
        if(isset($r->sort))
        {
            if($r->sort=="price_lower")
            $product->orderBy('price','asc');
            else if($r->sort=="price_higher")
            $product->orderBy('price','desc');
            else if($r->sort=="name")
            $product->orderBy('name','asc');
        }
        else
        {
            $product->orderBy('price','asc');
        }
        $data['products']=$product->get();
        $data['count_product']=count($data['products']);

        return view('web.ecommerce.shop',$data);
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
    public function cart(Request $r)
    {
        // $data['categories']=ProductCategory::all();
        $data['cart']=Cart::get_cart();

        return view('web.home.cart',$data);
    }
    public function shop_checkout(Request $r)
    {
  
        if(!\Auth::user())
        {
            return redirect('login')->with('redirect',env('APP_URL').'/checkout');
        }
        $shop=Shop::where("url",$r->shop_url)->first();
        if(!$shop)
        {
            return redirect('error_404');
        }
        $data['categories']=$shop->get_categories(true);
        $data['user_address']=\Auth::user()->address;
        $data['provinces']=Province::all();
   
        $data['shop']=$shop;
        $data['delivery_methods']= ShopDelivery::where("shop_id",$shop->id)
        ->leftJoin('ship_method_tb','ship_method_tb.id','shop_shipping_tb.shipping_id')
        ->where('shop_shipping_tb.is_checked',1)
        ->selectRaw('ship_method_tb.id,ship_method_tb.name,shop_shipping_tb.ship_cost,shop_shipping_tb.cal_type')->get();
        $data['payment_methods']= ShopPayment::where("shop_id",$shop->id)
        ->leftJoin('payment_method_tb','payment_method_tb.id','shop_payment_tb.method_id')
        ->where('shop_payment_tb.is_checked',1)
        ->selectRaw('payment_method_tb.name,shop_payment_tb.*')->get();

        $data['cart']=Cart::get_cart($shop->id);
    
        return view('web.home.checkout',$data);
    }
    public function shop_checkout_process(Request $r)
    {
        // dd($r->all());
        $shop=Shop::where("url",$r->shop_url)->first();
        if(!$shop)
        return redirect()->back()->with('error','ไม่พบข้อมูลร้าน');
        $cart=Cart::get_cart($shop->id);
        if($cart==null ||!$cart)
        return redirect()->back()->with('error','ไม่พบข้อมูลสินค้า');

        $order=new Order();
        $order->id=crc32($shop->id.$shop->name.time().rand(10,99));
        $order->shop_id=$shop->id;
        $order->channel_id=1;
        $order->status=1;
        $delivery=ShopDelivery::where("shipping_id",$r->delivery_method)->where("shop_id",$shop->id)->first();
        if(!$delivery)
        return redirect()->back()->with('error','ดำเนินการไม่สำเร็จ ไม่พบข้อมูลการชำระเงิน');

        $order->shipping_id=$delivery->shipping_id;
        $order->order_date=date('Y-m-d H:i:s');
        $order->total=0;
        $order->total_delivery=0;
        $order->buyer_user_id=\Auth::user()->id;
        $order->payment_type=$r->payment;
        //$order->save();
        $address=UserAddress::where("id",$r->address_id)->first();
        if(!$address)
        return redirect()->back()->with('error','ไม่พบข้อมูลจัดส่ง');


        try
        {
            \DB::beginTransaction();
            $delivery_cost=0;
            $qty=0;
            foreach($cart['items'] as $index=>$it)
            {
                $qty+=intval($it['qty']);
                $item=new OrderItem();
                $item->order_id=$order->id;
                $item->id=($index+1);
                $item->product_id=$it['product_id'];
                $item->product_name=$it['name'];
                $item->qty=$it['qty'];
                $item->price=$it['price'];
                $item->total=intval($it['qty'])*floatval($it['price']);
                $item->status=1;
                $item->remark="";
                $item->save();
                $order->total+=$item->total;
            }

            if($delivery->cal_type==1)
            {
                $delivery_cost=$delivery->ship_cost; 
            }
            else if($delivery->cal_type==2)
            {
                $delivery_cost=$qty*$delivery->ship_cost;
            }
            $order->total_delivery=$delivery_cost;
            $order->save();

            $deli=new OrderDelivery();
            $deli->order_id=$order->id;
            $deli->name=$address->name_address;
            $deli->address=$address->address;
            $deli->province_id=$address->province_id;
            $deli->zipcode=$address->zipcode;
            $deli->phone=$address->phone;
            $deli->save();

            \DB::commit();

            Cart::clear_shop($order->shop_id);
        }
        catch(\Exception $e)
        {
            \DB::rollback();
            return redirect()->back()->with('error',$e->getMessage());
        }
        catch(\FatalErrorException $e)
        {
            \DB::rollback();
            return redirect()->back()->with('error',$e->getMessage());
        }


        return redirect('/order/status')->with('order',$order);


    }
    public function order_status(Request $r)
    {
        if(!isset($r->order_id)){
            if(!session('order'))
            return redirect('/');

            $order=session('order');
        }
        else
        {
            $order=Order::where("id",$r->order_id)->where("buyer_user_id",\Auth::user()->id)->first();
            if(!$order)
            return redirect('/')->with('error','ไม่พบข้อมูลเลขที่สั่งซื้อ');

        }

        $data['categories']=ProductCategory::all();
        $data['order']=$order;
        return view('web.home.order_status',$data);
    }
    public function get_products(Request $r)
    {
   
        $offset=0;
        $take=50;
        $data['products']=Product::where('is_ecom',1)->where('status',1)->offset($offset)->take($take)->get();
        for($i=0;$i<count($data['products']);$i++)
        {
            $data['products'][$i]->price=$data['products'][$i]->get_discount_price(false);
        }
        return LKS::o(1,$data);
    }
    public function search(Request $r)
    {
        
        $products=Product::where("name",'like','%'.$r->s.'%')->orWhere('info_full','like','%'.$r->S.'%');
        if($r->category_id!='')
        $products->where('category_id',$r->category_id);

        $data['products']=$products->get();
        $data['categories']=ProductCategory::all();

        return view('web.home.search',$data);
    }
}