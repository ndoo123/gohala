<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notify;
use App\Models\Shop;
use DB;
use Datatables;

class MNotifyController extends Controller
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
    public function notify_page(Request $r)
    {
        // dd($r->all());
        $data['shop'] = $r->shop;
        $data['url'] = $this->url($r);
        $data['current_url'] = $data['url'].'/notify';
        $data['remote_url'] = $data['current_url'].'/datatables';
        // dd($data);
        return view('manage.shop.notify',$data);
    }
    public function notify_datatables(Request $r)
    {
        // dd($r->all());
        $model = Notify::where('shop_id',$r->shop->id)->orderBy('id','desc');
        // dd($model->first()->created_show);
        return Datatables::of($model)
        ->editColumn('is_read',function ($model){
            if($model->is_read == 1)
            {
                $return = '<button type="button" class="btn btn-outline-success"><i class="fas fa-check-circle"></i> 
                อ่านเรียบร้อย
                </button>';
            }
            else
            {
                $return = '<button type="button" class="btn btn-outline-danger"><i class="fas fa-minus-circle"></i> 
                ยังไม่อ่าน
                </button>';
            }
            return $return;
        })
        ->addColumn('go_to',function($model){
            return '<button type="button" class="btn btn-sm btn-success notify-item" order_id="'.$model->order_id.'" shop_url="'.$model->shop->url.'">View</button>';
        })
        ->make(true);
    }
    public function notify_bar(Request $r)
    {
        try{
            if(!empty($r->shop)) // $r->shop manage domain ได้จาก middleware กรณีเข้าจัดการร้าน
            {
                $model = Notify::where('shop_id',$r->shop->id);
                // สำหรับกระดิ่ง
                $notify_unread_global = Notify::where('shop_id',$r->shop->id)->where('is_read_global',0)->count(); 
                // สำหรับแจ้งเตือนทั้งหมด
                $notify_unread_element = Notify::where('shop_id',$r->shop->id)->where('is_read',0)->count(); 
                $notify = $model->limit(3)->orderBy('created_at','desc')->get();
                $shop_url = Shop::find($r->shop->id)->url;
                // dd($shop_url,$notify,$notify[0],$notify[0]->created_show);
            }
            if(empty($notify) || !isset($notify_unread_global))
            {
                throw new \Exception('ไม่พบข้อมูล');
            }
            return [ 'result' => 1, 'notify' => $notify, 'notify_unread_global' => $notify_unread_global, 'notify_unread_element' => $notify_unread_element ,'event_name' => Notify::$event ,'shop_url' => $shop_url ? $shop_url : null];
        }
        catch(\Exception $e)
        {
            return [ 'result' => 0, 'msg' => $e->getMessage() ];
        }
    }
    public function notify_update_global(Request $r)
    {
        // dd($r->all());
        try{
            if(!empty($r->shop))
            {
                // DB::table('')->get();
                Notify::where('shop_id',$r->shop->id)->update(['is_read_global' => 1]);
                // dd($notify);
            }
            return [ 'result' => 1, 'msg' => '' ];
        }
        catch(\Exception $e)
        {
            return [ 'result' => 0, 'msg' => $e->getMessage() ];
        }
    }
}
