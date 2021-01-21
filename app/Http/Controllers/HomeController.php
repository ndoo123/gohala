<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\Notify;
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
        // dd('home');
        return view('web.index');
        // return view('web.promote');
    }
    public function email_admin(Request $r){
        return view('web.home.email_admin');
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
    public function shop_category_view(Request $r,$shop_url,$cat_slug)
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
         $data['cat'] = $cat_slug;
         foreach($data['categories'] as $key => $value)
         {
             if($value->id == (int)$data['cat'])
             {
                 $data['cat_data'] = $value;
             }
         }
        //  dd($data);
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

    public function cart(Request $r)
    {
        // $data['categories']=ProductCategory::all();
        $data['cart']=Cart::get_cart();

        return view('web.home.cart',$data);
    }
    public function shop_checkout(Request $r)
    {
        // dd(url(''),$_SERVER['REQUEST_SCHEME']);
        // if(!\Auth::user())
        // {
        //     return redirect('login')->with('redirect',env('APP_URL').'/checkout');
        // }
        $shop=Shop::where("url",$r->shop_url)->first();
        if(!$shop)
        {
            return redirect('error_404');
        }
        $data['categories']=$shop->get_categories(true);
        $data['user'] = \Auth::user() ? \Auth::user() : null;
        $data['user_address'] = \Auth::user() ? \Auth::user()->address : null;
        $data['address_default'] = \Auth::user() ? \Auth::user()->address_default() : null;
        // dd($data);
        $data['provinces']=Province::orderBy('name','asc')->get();
        // dd($data);
        $data['shop']=$shop;
        // if(empty($data['shop']->shop_payment_tranfer()->payment_data))
        $data['delivery_methods']= ShopDelivery::where("shop_id",$shop->id)
        ->leftJoin('ship_method_tb','ship_method_tb.id','shop_shipping_tb.shipping_id')
        ->where('shop_shipping_tb.is_checked',1)
        ->selectRaw('ship_method_tb.id,ship_method_tb.name,shop_shipping_tb.ship_cost,shop_shipping_tb.cal_type')->get();
        $data['payment_methods']= ShopPayment::where("shop_id",$shop->id)
        ->leftJoin('payment_method_tb','payment_method_tb.id','shop_payment_tb.method_id')
        ->where('shop_payment_tb.is_checked',1)
        // ->whereNotNull('shop_payment_tb.payment_data')
        ->selectRaw('payment_method_tb.name,shop_payment_tb.*')->get();
        foreach($data['payment_methods'] as $p_key => $p)
        {
            if($p->method_id == 2)
            {
                if(empty($p->payment_data))
                {
                    unset($data['payment_methods'][$p_key]);
                }
            }
        }
        if($data['payment_methods']->count() < 1 )
            return back()->with(['error'=>'เจ้าของร้านไม่ได้เพิ่มช่องทางการชำระ']);

        $data['cart'] = Cart::get_cart($shop->id);
        $data['totally'] = 0;
        $data['total_qty'] = 0;
        $data['items'] = [];
        $data['shipping'] = ShopDelivery::get_delivery($shop->id);
        // dd($data['cart']);
        if(empty($data['cart']['items']))
            return redirect('');
        foreach($data['cart']['items'] as $item)
        {
            $obj = [];
            $model_item = Product::find($item['product_id']);
            $obj['product_id'] = $model_item->id;
            $obj['shop_id'] = $item['shop_id'];
            $obj['url'] = $item['url'];
            $obj['name'] = $model_item->name;
            $obj['qty'] = $item['qty'];
            $obj['price'] = $model_item->get_discount_price();
            $obj['total'] = (float)$obj['price'] * (int)$obj['qty'];
            $obj['link'] = $item['link'];
            $obj['img'] = $item['img'];
            $data['items'][] = $obj;

            $data['totally'] += $obj['total'];
            $data['total_qty'] += (int)$item['qty'];
        }
        foreach($data['shipping'] as $key => $ship)
        {
            $data['shipping'][$key]['qty'] = $data['total_qty'];
            $data['shipping'][$key]['price'] = $ship->get_price($data['total_qty']);
        }
        $data['url'] = url('').'/'.$data['shop']->url;
        $data['url_current'] = $data['url'].'/checkout';
        $data['url_submit'] = $data['url'].'/checkout/process';
        // dd($data['payment_methods']);
        // dd($data,$data['shop']->shop_payment_tranfer());
        // dd($data['user_address'],$data['address_default']);
        return view('web.home.checkout',$data);
    }
    public function shop_checkout_process(Request $r)
    {
        // dd($r->all(),$r->shop_url);
        if(!$r->ship_method_id)
            return redirect()->back()->with('error','ไม่พบข้อมูลการจัดส่ง');
        if(!$r->payment)
            return redirect()->back()->with('error','ไม่พบข้อมูลการจ่ายเงิน');

        $shop = Shop::where("url",$r->shop_url)->first();
        if(!$shop)
            return redirect()->back()->with('error','ไม่พบข้อมูลร้าน');
            
        $cart = Cart::get_cart($shop->id);
        // dd($cart);
        if(!$cart || $cart==null)
            return redirect()->back()->with('error','ไม่พบข้อมูลสินค้า');

        if(!$r->name_contact || !$r->name_address || !$r->address || !$r->phone || !$r->zipcode || !$r->province_id)
            return redirect()->back()->with('error','กรุณากรอกข้อมูลให้ครบ');
        // $address=UserAddress::where("id",$r->address_id)->first();
        // if(!$address)
        // return redirect()->back()->with('error','ไม่พบข้อมูลจัดส่ง');


        try
        {
            \DB::beginTransaction();

            $order = new Order();
            $order->id = crc32($shop->id.$shop->name.time().rand(10,99));
            $order->shop_id = $shop->id;
            $order->channel_id = 1;
            $order->status = $r->payment != 2 ? 1 : 5;
            $order->payment_type = $r->payment;
            $delivery = ShopDelivery::where("shipping_id",$r->ship_method_id)->where("shop_id",$shop->id)->first();
            if(!$delivery)
                return redirect()->back()->with('error','ดำเนินการไม่สำเร็จ ไม่พบข้อมูลการชำระเงิน');

            $order->shipping_id = $delivery->shipping_id;
            $order->order_date = date('Y-m-d H:i:s');
            $order->total = 0;
            $order->total_delivery = 0;
            $order->buyer_user_id= \Auth::user() ? \Auth::user()->id : null;
            $order->save();
            // dd(crc32($shop->id.$shop->name.time().rand(10,99)),$shop->id,$shop->name,time(),rand(10,99));
            $delivery_cost = 0;
            $qty = 0;
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
                // dd($order,$item);
                $item->save();
                $order->total+=$item->total;
            }

            if($delivery->cal_type == 1) // กำหนดค่าส่ง เฉพาะราคาที่ตั้งไว้อย่างเดียว
            {
                $delivery_cost = $delivery->ship_cost; 
            }
            else if($delivery->cal_type == 2) // หากค่าส่งคิดจาก จำนวน*ราคาที่ตั้งไว้
            {
                $delivery_cost = $qty*$delivery->ship_cost;
            }
            $order->total_delivery = $delivery_cost; // บันทึกค่าส่ง
            $order->save();

            $deli = new OrderDelivery();
            $deli->order_id = $order->id;
            $deli->name = $r->name_contact;
            $deli->address = $r->name_address.' '.$r->address;
            $deli->province_id = $r->province_id;
            $deli->zipcode = $r->zipcode;
            $deli->phone = $r->phone ? str_replace('-','',$r->phone) : null;
            $deli->save();

            $shop = Shop::find($order->shop_id);
            $owner = $shop->user;
            $items = OrderItem::where('order_id',$order->id)->get();
            $mail = [];
            $mail['order'] = $order; 
            $mail['buyer'] = $order->buyer;
            $mail['shop'] = $shop;
            $mail['deli'] = $deli;
            $mail['owner'] = $owner;
            $mail['items'] = $items;
            $mail['payment'] = 
            \DB::table('shop_payment_tb as cat')
            ->join('shop_tb as s', 's.id','=','cat.shop_id')
            ->join('payment_method_tb as m','m.id','=','cat.method_id')
            ->where('shop_id',$mail['shop']->id)
            ->where('method_id',$order->payment->id)
            ->where('is_checked',1)
            ->first();
            $mail['payment_data'] = $mail['payment']->payment_data ? json_decode(json_decode($mail['payment']->payment_data)) : null;
            
            if(!empty($mail['buyer']) && !empty($mail['buyer']->email))
            {
                \Mail::send('email.order_customer', $mail , function($message) use ($mail)
                {
                    $message->from(env('MAIL_USERNAME'),"Gohala Order" );
                    $message->to($mail['buyer']->email, 'M&M')->subject('You have New Order!');
                });
            }

            \Mail::send('email.order_admin', $mail , function($message) use ($mail)
            {
                $message->from(env('MAIL_USERNAME'),"Gohala Order" );
                $message->to($mail['owner']->email, 'M&M')->subject('You have New Order!');

            });
            // dd($order,$deli);
            $notify = new Notify();
            if(\Auth::check())
                $notify->user_id = \Auth::user()->id;
            $notify->shop_id = $order->shop_id;
            $notify->order_id = $order->id;
            $notify->event_id = 1;
            $notify->info = 'ออเดอร์หมายเลข '.$order->id.' จากคุณ '.$deli->name.' ติดต่อ: '.$deli->phone;
            $notify->save();
            \Met::pusher('manage', Notify::$event[1], $shop->url);
            \Met::pusher('account', Notify::$event[1], '');
            

            // dd($order,$order->toArray());
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
        // dd($order->toArray());
        return redirect('/order/status?order_id='.$order->id)->with('order',$order->toArray());


    }
    public function order_status(Request $r)
    {
        // dd($r->all(),session('order'));
        if(!isset($r->order_id)){
            if(!session('order'))
            return redirect('/')->with('error','ไม่พบข้อมูลเลขที่สั่งซื้อ');

            $order=session('order');

            // เมื่อ check มาเข้าตรงนี้
        }
        else
        {
            $order=Order::where("id",$r->order_id)->first();
            if(!$order)
                return redirect('/')->with('error','ไม่พบข้อมูลเลขที่สั่งซื้อ');

        }
        $data['find_order'] = Order::find($order['id']);
        // $r->order_id
        $data['url'] = \LKS::url_subdomain('account','').'/profile';
        $data['shop']=Shop::where("id",$order['shop_id'])->first();
        // $data['categories']=ProductCategory::all();
        $data['categories']=$data['shop']->get_categories(true);
        $data['order']=$order;
        $data['payment'] = [];
        if(!empty($data['order']['payment']) && $data['order']['payment']['id'] == 2)
        {
            $data['payment']= ShopPayment::where('method_id',2)->where('shop_id',$data['shop']->id)->where('is_checked',1)->first();
            $data['payment']= !empty($data['payment']->payment_data) ? json_decode(json_decode($data['payment']->payment_data)) : null;
        }
            // dd($data);
        // dd($r->all(),$data);
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
        // dd($r->all());
        $p=Product::where("id",$r->product_id)->first();
        if(!$p)
        return \LKS::o(0,"ไม่พบสินค้า");

        if($p->shop==null)
        return \LKS::o(0,"ไม่พบข้อมูลร้านค้า");

        // dd($p,$r->all(),!is_numeric($p->p_price));
        if(!is_numeric($p->p_price))
            $p->p_price=0;
            
             $basket_item=array(
                'product_id'=>$p->id,
                'shop_id'=>$p->shop_id,
                'url'=>$p->shop->url,
                'name'=>$p->name,
                'qty'=>$r->qty,
                'price'=>$p->get_discount_price(),
                'link'=>$p->get_link($r->shop_url),
                'img'=>$p->get_photo()
                );
            $resp=Cart::add_to_cart($basket_item,$p->shop);
            return \LKS::o(1,$resp);
    }
    public function dropzone(){
        return view('dropzone.test');
    }
}