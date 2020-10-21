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
use Met;

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
        $data['shop']=$r->shop;
        $data['summary']=(object)array(
            "order"=>\DB::table('order_tb')->where('shop_id',$r->shop->id)->count(),
            "product"=>\DB::table('product_tb')->where('shop_id',$r->shop->id)->count(),
            "profit"=>0
		);
		$order_status = null;
		$data['order_status'] = '';
		$label = 'ทั้งหมด';
		if(isset($r->order_status))
		{
			$order_label = Order::$label_status;
			$order_status = intval($r->order_status);
			if(array_key_exists($order_status,$order_label))
			{
				$data['order_status'] = $order_status;
				$label = $order_label[$order_status];
			}
			// dd($data['order_status'],$label,$order_label);
		}
		// $data['label'] = $label;
		$data['label'] = "ออเดอร์ $label ของร้าน | <span style='color:blue'>".$data['shop']->name."</span>";
		$data['url'] = $url = self::url($r);
		$data['remote_url'] = $url.'/order_datatables';

		// dd(date('H:i:s'),__DIR__,__FILE__,file_exists('/vendor/autoload.php'),(url('/vendor/autoload.php')),file_exists( __DIR__.'/../vendor/autoload.php'),basename(__FILE__) , basename($_SERVER["SCRIPT_FILENAME"]),basename('asdf'), basename('/vendor/autoload.php'),get_included_files());
		$p = Met::pusher('sell','มีการสั่งซื้อใหม่');
		return view('manage.shop.shop_all_manage',$data);
	}
}