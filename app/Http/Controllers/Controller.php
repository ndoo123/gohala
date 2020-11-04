<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\User;
use App\Models\OrderTranfer;
use App\Models\OrderDelivery;
use App\Models\UserAddress;
use App\Helper\LKS;
use App\Models\Order;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   public function get_payment_img(Request $r)
   {
    //  dd($r->all());
    if(empty($r->order_id))
      return json_encode(['result' => 0,'msg' => 'ไม่พบข้อมูล']);

     $order_tranfer = OrderTranfer::where('order_id',$r->order_id)->first();
     if(!$order_tranfer)
      return json_encode(['result' => 0,'msg' => 'ไม่พบข้อมูล']);
    $return = ['result' => 1,'img' => $order_tranfer->get_photo(),'btn' => 0,'order_id'=>$order_tranfer->order_id];
    // dd($order_tranfer->order->status);
    if(!empty($r->shop) && $order_tranfer->order->status == 6)
        $return['btn'] = 1;
    return json_encode($return);
   }
    public function order_detail(Request $r)
    {
        // dd($r->all());
        $order = Order::find($r->order_id);
        // dd($r->all(),$order,$order->delivery,$order->shop);
        // return json_encode(['order'=>$order]);
        $detail['สั่งวันที่'] = \LKS::to_full_thai_date($order->order_date).' '.date("H:i:s",strtotime($order->order_date));
        if(!empty($order->delivery->confirm_date))
            $detail['ยืนยันวันที่'] = \LKS::to_full_thai_date($order->delivery->confirm_date).' '.date("H:i:s",strtotime($order->delivery->confirm_date));
        if(!empty($order->delivery->delivery_date))
            $detail['จัดส่งวันที่'] = \LKS::to_full_thai_date($order->delivery->delivery_date).' '.date("H:i:s",strtotime($order->delivery->delivery_date));
        if(!empty($order->delivery->received_date))
            $detail['รับสินค้าวันที่'] = \LKS::to_full_thai_date($order->delivery->received_date).' '.date("H:i:s",strtotime($order->delivery->received_date));
        $detail['ราคารวม'] = $order->total;
        $detail['ค่าจัดส่ง'] = $order->total_delivery;
        $detail['ราคารวมทั้งหมด'] = number_format(((float)$order->total + (float)$order->total_delivery),2);
        $detail['สถานะออเดอร์'] = $order->get_status_show();
        $detail['ชำระโดย'] = '<span class="badge badge-danger">'.$order->get_payment_method_name().'</span>';
        if(!empty($order->cancel_by))
            $detail['เหตุผลที่ยกเลิก'] = $order->cancel_remark ? '<span class="font-14">'.$order->cancel_remark.'</span>' : '';
        // dd($order,$order->delivery);
        $cus['ชื่อ'] = !empty($order->delivery) && !empty($order->delivery->name)?$order->delivery->name:null;
        $cus['เบอร์ติดต่อ'] = !empty($order->delivery) && !empty($order->delivery->phone)?$order->delivery->phone:null;
        $cus['ที่อยู่'] = !empty($order->delivery) && !empty($order->delivery->address)?$order->delivery->address:null;
        $cus['จังหวัด'] = !empty($order->delivery) && !empty($order->delivery->province_id )? Province::find($order->delivery->province_id)->name : null;
        $cus['รหัสไปรษณีย์'] = !empty($order->delivery) && !empty($order->delivery->zipcode) ? $order->delivery->zipcode : null;
        // dd($order,$order->shop);
        $rest = [];
        $rest['ชื่อ'] = !empty($order->shop) && !empty($order->shop->name)?$order->shop->name:'ไม่พบชื่อร้าน';
        $rest['เลขผู้เสียภาษี'] = !empty($order->shop) && !empty($order->shop->tax_id)?$order->shop->tax_id:null;
        $rest['เบอร์ติดต่อ'] = !empty($order->shop) && !empty($order->shop->phone)?$order->shop->phone:null;
        $rest['ที่อยู่'] = !empty($order->shop) && !empty($order->shop->address) ? $order->shop->address : 'ไม่พบที่อยู่';
        $rest['จังหวัด'] = !empty($order->shop) && !empty($order->shop->province_id) ? Province::find($order->shop->province_id)->name : 'ไม่พบจังหวัด';
        $rest['รหัสไปรษณีย์'] = !empty($order->shop) && !empty($order->shop->zipcode)?$order->shop->zipcode:'ไม่พบรหัสไปรษณีย์';
        $rest['อีเมล'] = !empty($order->shop) && !empty($order->shop->email)?$order->shop->email:null;
        $rest['Facebook'] = !empty($order->shop) && !empty($order->shop->facebook)?$order->shop->facebook:null;
        $rest['Line'] = !empty($order->shop) && !empty($order->shop->line)?$order->shop->line:null;

        return json_encode(
            [
                // 'delivery' => $order->delivery,
                // 'shop' => $order->shop,
                'order' => $order,
                'items' => $order->items,
                'cus' => $cus,
                'rest' => $rest,
                'detail' => $detail,
                'btn' => $order->get_primary_btn(),
            ]
        );
    }
    public function order_datatables(Request $r)
    {
        // dd(url()->full());
        $orders = Order::where('shop_id', $r->shop->id);
        $orderBy = 'desc';
        if(isset($r->order_status) && $r->order_status == -1)
        {
            $orders = $orders->whereNotIn('status',[0,4]);
        }
        else if(isset($r->order_status))
        {
            $orders = $orders->where('status',$r->order_status);
        }
        $orders = $orders->orderBy('order_date', $orderBy);
        return \Datatables::of($orders)
        ->addColumn('delivery_name',function($order){
            return !empty($order->delivery) && !empty($order->delivery->name) ? $order->delivery->name : 'ไม่พบข้อมูล';
        })
        ->editColumn('total',function($order){
            return number_format($order->total+$order->total_delivery,2);
        })
        ->addColumn('actions',function($order){

            $shop_payment = $order->shop_payment_transfer;
            $price = $order->get_sold_price(true);
            $attr = ' 
            order_id="'.$order->id.'" 
            price="'.$price.'"
            payment=\''.$shop_payment->payment_data.'\' 
            ';
            $action = '';
            $button = '';
            $status = $order->status < 4 ? $order->status + 1 : '';

            $button = $order->get_primary_btn();
            $button .= $order->btn_view_payment(); 
            $button .= $order->btn_cancel();
            // ในฟังชั่นจะเช็คว่าตรงกับเงื่อนไขหรือไม่ ถ้าไม่ตรง return '';

            return $button;
        })
        ->editColumn('status',function($order){
            return $order->get_status_show();
        })
        ->make(true);
    }
    public function order_cancel(Request $r)
    {
        // dd($r->all());
        DB::beginTransaction();
        try{
            $order = Order::find($r->order_id);
            // dd($order,$r->all());
            $order->cancel_remark = $r->text;
            $order->cancel_by = 1;
            $order->status = 0;
            $order->save();
            DB::commit();
            $return = ['status' => 1];
        }
        catch(\Exception $e)
        {
            DB::rollback();
            $return = ['status' => 0 ,'msg'=>$e->getMessage()];
        }
        return json_encode($return);
    }
    public function update_order_status(Request $r)
    {
        // dd($r->all());
        DB::beginTransaction();
        try{
            $order = Order::find($r->order_id);
            $order->status = $r->status;
            $order->delivery_update();
            $order->save();
            DB::commit();
            $return = ['status' => 1];
        }
        catch(\Exception $e)
        {
            DB::rollback();
            $return = ['status' => 0, 'msg' => $e->getMessage().' online:'.$e->getLine().' onFile:'.$e->getFile()];
        }
        return json_encode($return);
    }
    public function update_trace(Request $r)
    {
        // dd($r->all());
        DB::beginTransaction();
        try{
            $order = Order::find($r->order_id);
            $order->shipping_code = $r->trace;
            $order->status = 3;
            $order->delivery_update();
            $order->save();
            // dd($order,$order->buyer->email);
            if(!empty($order->buyer))
            {
                \Mail::send([], [], function ($message) use ($order) {

                    $message->from(env('MAIL_USERNAME'),"Gohala" );
                    // $message->to("botlaster@gmail.com")->subject("หมายเลขการจัดส่งสินค้า")
                    $message->to($order->buyer->email)->subject("หมายเลขการจัดส่งสินค้า")
                    ->setBody('เลขแทรคกิ้งของหมายเลขออเดอร์ #' .$order->id. ' ตือหมายเลข '.$order->shipping_code.'<br>','text/html');
                });
            }
            DB::commit();      
            $return = ['status' => 1]; 
        }
        catch(\Exception $e)
        {
            DB::rollback();
            $return = ['status' => 0 , 'msg' => $e->getMessage()];
        }
        return json_encode($return);
    }
}
