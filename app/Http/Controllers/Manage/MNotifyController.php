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
        $this->url = url('');
        if(!empty($r->shop))
        {
            $this->url = url($r->shop->url);
            // dd($r)
            // dd(1,$r->shop->url,$this->url);
        }
        return $this->url;
    }
    public function notify_page(Request $r)
    {
        // dd($r->all());
        $data['shop'] = $r->shop ? $r->shop : null;
        $data['url'] = $this->url($r);
        $data['current_url'] = $data['url'].'/notify';
        $data['remote_url'] = $data['current_url'].'/datatables';
        if(!empty($r->shop))
        {
            $model = Notify::where('shop_id',$r->shop->id);
            // $model = Notify::where('shop_id',$r->shop->id)->orderBy('id','desc');
        }
        else
        {
            $model = Shop::where('user_id',\Auth::user()->id)->pluck('id');
            $model = Notify::whereIn('shop_id',$model);
        }
        $data['notify_count'] = $model->count();
        $data['notify_unread'] = $model->where('is_read',0)->count();
        // dd($data);
        return view('manage.shop.notify',$data);
    }
    public function notify_read(Request $r)
    {
        // dd($r->all());
        try
        {
            DB::beginTransaction();
            $notify = Notify::where('order_id',$r->order_id)->where('event_id',$r->event_id)->first();
            if(!$notify)
                throw new \Exception('ไม่พบการแจ้งเตือน');

            $notify->is_read = 1;
            $notify->save();
            DB::commit();
            $return = ['result' => 1, 'notify' => $notify];
        }
        catch(\Exception $e)
        {
            DB::rollback();
            $return = ['result' => 0, 'msg' => $e->getMessage()];
        }
        return $return;
    }
    public function notify_datatables(Request $r)
    {
        // dd($r->all());
        if(!empty($r->shop))
        {
            $model = Notify::where('shop_id',$r->shop->id);
            // $model = Notify::where('shop_id',$r->shop->id)->orderBy('id','desc');
        }
        else
        {
            $model = Shop::where('user_id',\Auth::user()->id)->pluck('id');
            $model = Notify::whereIn('shop_id',$model);
        }
        if(isset($r->is_read) && $r->is_read !== null)
        {
            $model = $model->where('is_read',$r->is_read);
        }
        $model->orderBy('id','desc');
        // dd($model->get());
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
        ->addColumn('event_name',function($model){
            return Notify::$event[$model->event_id];
        })
        ->editColumn('order_id',function($model){
            return '<span style="color:#CB0A0A">'.$model->order_id.'</span>';
        })
        ->editColumn('info',function($model) use ($r){
            $info = $model->info;
            if(empty($r->shop))
                $info = 'ร้าน '.$model->shop_name.' - '.$model->info;
            return $info;
        })
        ->editColumn('created_show',function($model){
            return '<span style="color:#008CBA">'.$model->created_show.'</span>';
        })
        ->addColumn('go_to',function($model){
            return '<button type="button" class="btn btn-sm btn-primary notify-item" order_id="'.$model->order_id.'" shop_url="'.$model->shop->url.'">View</button>';
        })
        ->make(true);
    }
    public function notify_bar(Request $r)
    {
        // dd('notify_bar',$r->all());
        try{
            if(!empty($r->shop)) // $r->shop manage domain ได้จาก middleware กรณีเข้าจัดการร้าน สำหรับต่อร้าน
            {
                $model = Notify::where('shop_id',$r->shop->id)->with(['shop']);
                $notify_unread_global = Notify::where('shop_id',$r->shop->id)->where('is_read_global',0)->count(); 
                $notify_unread_element = Notify::where('shop_id',$r->shop->id)->where('is_read',0)->count(); 
                $notify_all_element = Notify::where('shop_id',$r->shop->id)->count(); 
                $from_shop = 0;
            }
            else
            {
                $shop = Shop::where('user_id',\Auth::user()->id)->pluck('id');
                $model = Notify::whereIn('shop_id',$shop);
                $notify_unread_global = Notify::whereIn('shop_id',$shop)->where('is_read_global',0)->count(); 
                $notify_unread_element = Notify::whereIn('shop_id',$shop)->where('is_read',0)->count();
                $notify_all_element = Notify::whereIn('shop_id',$shop)->count(); 
                $from_shop = 1; // สำหรับเช็คเพื่อแสดงชื่อร้าน (หน้าแสดงร้านค้าทั้งหมด)
            }
            
            // สำหรับแจ้งเตือนทั้งหมด
            $notify = $model->limit(5)->orderBy('created_at','desc')->get();
            if(!isset($model))
            {
                throw new \Exception('ไม่พบข้อมูล');
            }
            return [ 'result' => 1, 'notify' => $notify, 'notify_unread_global' => $notify_unread_global, 'notify_unread_element' => $notify_unread_element, 'notify_all_element' => $notify_all_element ,'event_name' => Notify::$event, 'from_shop' => $from_shop];
        }
        catch(\Exception $e)
        {
            return [ 'result' => 0, 'msg' => 'on file: '.$e->getFile().' on line: '.$e->getLine().' Message: '.$e->getMessage() ];
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
            else
            {
                $shop = Shop::where('user_id',\Auth::user()->id)->pluck('id');
                Notify::whereIn('shop_id',$shop)->update(['is_read_global' => 1]);
            }
            return [ 'result' => 1, 'msg' => '' ];
        }
        catch(\Exception $e)
        {
            return [ 'result' => 0, 'msg' => $e->getMessage() ];
        }
    }
}
