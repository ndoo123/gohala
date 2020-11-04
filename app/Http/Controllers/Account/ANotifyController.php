<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notify;
use App\Models\Shop;
use DB;
use Datatables;

class ANotifyController extends Controller
{
    
    public function notify_bar(Request $r)
    {
        // dd('notify_bar',$r->all());
        try{
            $model = Notify::where('user_id',\Auth::user()->id);
            $notify_unread_global = Notify::where('user_id',\Auth::user()->id)->where('user_is_read_global',0)->count(); 
            $notify_unread_element = Notify::where('user_id',\Auth::user()->id)->where('user_is_read',0)->count(); 
            $notify_all_element = Notify::where('user_id',\Auth::user()->id)->count(); 
            $from_shop = 1;
            
            // สำหรับแจ้งเตือนทั้งหมด
            $notify = $model->orderBy('created_at','desc')->get();
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
            Notify::where('user_id',\Auth::user()->id)->update(['user_is_read_global' => 1]);
            return [ 'result' => 1, 'msg' => '' ];
        }
        catch(\Exception $e)
        {
            return [ 'result' => 0, 'msg' => $e->getMessage() ];
        }
    }
    public function notify_read(Request $r)
    {
        // dd($r->all());
        try
        {
            DB::beginTransaction();
            $notify = Notify::where('order_id',$r->order_id)->where('event_id',$r->event_id)->first();
            // $notify = Notify::where('order_id',$r->order_id)->where('shop_id',$r->shop->id)->first();
            // dd($notify);
            if(!$notify)
                throw new \Exception('ไม่พบการแจ้งเตือน');
            $notify->user_is_read = 1;
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
}
