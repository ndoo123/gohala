<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\User;
use App\Models\UserAddress;
use App\Helper\LKS;
use App\Models\Order;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function order_detail(Request $r)
    {
        // dd($r->all());
        $order = Order::find($r->order_id);
        // dd($r->all(),$order,$order->delivery,$order->shop);
        // return json_encode(['order'=>$order]);
        $detail['วันที่'] = \LKS::to_full_thai_date($order->order_date).' '.date("H:i:s",strtotime($order->order_date));
        $detail['ราคารวม'] = $order->total;
        $detail['ค่าจัดส่ง'] = $order->total_delivery;
        $detail['ราคารวมทั้งหมด'] = number_format(((float)$order->total + (float)$order->total_delivery),2);
        $detail['สถานะออเดอร์'] = $order->get_status_show();

        $cus['ชื่อ'] = !empty($order->delivery->name)?$order->delivery->name:null;
        $cus['เบอร์ติดต่อ'] = !empty($order->delivery->phone)?$order->delivery->phone:null;
        $cus['ที่อยู่'] = !empty($order->delivery->address)?$order->delivery->address:null;
        $cus['จังหวัด'] = Province::find($order->delivery->province_id)->name;
        $cus['รหัสไปรษณีย์'] = !empty($order->delivery->zipcode)?$order->delivery->zipcode:null;

        $rest['ชื่อ'] = !empty($order->shop->name)?$order->shop->name:null;
        $rest['เลขผู้เสียภาษี'] = !empty($order->shop->tax_id)?$order->shop->tax_id:null;
        $rest['เบอร์ติดต่อ'] = !empty($order->shop->phone)?$order->shop->phone:null;
        $rest['ที่อยู่'] = !empty($order->shop->address)?$order->shop->address:null;
        $rest['จังหวัด'] = Province::find($order->shop->province_id)->name;
        $rest['รหัสไปรษณีย์'] = !empty($order->shop->zipcode)?$order->shop->zipcode:null;
        $rest['อีเมล'] = !empty($order->shop->email)?$order->shop->email:null;
        $rest['Facebook'] = !empty($order->shop->facebook)?$order->shop->facebook:null;
        $rest['Line'] = !empty($order->shop->line)?$order->shop->line:null;
        return json_encode(
            [
                // 'delivery' => $order->delivery,
                // 'shop' => $order->shop,
                'order' => $order,
                'items' => $order->items,
                'cus' => $cus,
                'rest' => $rest,
                'detail' => $detail,
            ]
        );
    }
}
