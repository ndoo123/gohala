<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\Product;
use App\Models\ProductSlug;
use App\Models\ProductPhoto;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Datatables;
use LKS;
use DB;

class MOrderController extends Controller
{
    protected $url;
    private function url($r)
    {
        if(!empty($r))
        {
            $this->url = url($r->shop->url);
            // dd($r)
            // dd(1,$r->shop->url,$this->url);
            return $this->url;
        }
    }
	public function index(Request $r)
	{
		// dd(intval($r->order_status));
        $data['shop']=$r->shop;
        $data['summary']=(object)array(
            "order"=>\DB::table('order_tb')->where('shop_id',$r->shop->id)->count(),
            "product"=>\DB::table('product_tb')->where('shop_id',$r->shop->id)->count(),
            "profit"=>0
		);
		$order_status = null;
		if(isset($r->order_status))
		{
			// $order_status = intval($r->order_status);
			// $label = Order::$label_status[$r->order_status] ? Order::$label_status[$r->order_status] :  'ไม่พบ'  : 'ทั้งหมด';
		}
		$data['label'] = 'a';
		// $data['label'] = "ออเดอร์ $label ของร้าน | <span style='color:blue'>".$data['shop']->name."</span>";
		$data['url'] = $url = self::url($r);
		$data['remote_url'] = $url.'/order_datatables';

		return view('manage.shop.shop_all_manage',$data);
	}
}