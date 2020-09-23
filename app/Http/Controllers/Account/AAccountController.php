<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\OrderTranfer;
use App\Helper\LKS;
use App\Models\Order;
use App\Models\Shop;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use DB;
use Met;
use Datatables;

class AAccountController extends Controller
{
   public function login_fb_callback(Request $r)
   {
     \Log::info("fb_login");
   }
   public function login(Request $r){

    // dd(\Hash::make('asdfasdf'),\Auth::check());
      if(\Auth::check())
      return redirect('profile');
 
      return view('account.login');
   }
   public function profile(Request $r)
   {
      $data['user']=\Auth::user();
      $data['address']=\Auth::user()->address;
      $data['provinces']=\DB::table('province_tb')->get();
      $data['orders']=Order::where("buyer_user_id",\Auth::user()->id)->orderBy('order_date','desc')->get();
      
      $data['op'] = !empty($r->op)?$r->op:null;
      // $data['asdf'] = \Auth::user();
      $data['shop'] = Shop::where('user_id',$data['user']->id)->get();
      $data['shop_count'] = $data['shop']->count();
      $data['url'] = url()->current();
        // mkdir(storage_path('app/uploads/bank_tranfer'));
        // mkdir('upload0755n', 755);
        // mkdir('upload0755t', 755, true);
        // mkdir('upload0755f', 755, false);
        // mkdir('upload0777');
        // mkdir('upload0777n',777);
        // mkdir('upload0777f', 777, false);
        // mkdir('upload0777t', 777, true);
      // dd($data,$r->all());
      return view('account.profile',$data);
   }
   public function user_order_datatables(Request $r)
   {
    //  dd($r->all());
     $model = Order::where("buyer_user_id",\Auth::user()->id)->orderBy('order_date','desc');
    //  ->get();
      return Datatables::of($model)
      ->addColumn('shop_name',function($model){
        return $model->shop->name;
      })
      ->editColumn('order_date',function($model){
        return date('d/m/Y H:i:s',strtotime($model->order_date));
      })
      ->editColumn('status',function($model){
        return $model->get_status_show();
      })
      ->addColumn('get_sold_price',function($model){
        return $model->get_sold_price(true);
      })
      ->addColumn('action',function($model){
        $shop_payment = $model->shop_payment_transfer;
        // dd($shop_payment,$shop_payment->payment_data);
        $price = $model->get_sold_price(true);
        $attr = ' 
        order_id="'.$model->id.'" 
        price="'.$price.'"
        payment=\''.$shop_payment->payment_data.'\' 
        ';
        $button = '';
        if($model->status == 5)
        {
            $button = '<button type="button" class="btn btn-sm btn-primary btn_order_payment"'.$attr.'>แจ้งโอนเงิน</button>';
        }
        if($model->status != 5 && $model->payment_type == 2)
        {
            $button = '<button type="button" class="btn btn-sm btn-info btn_order_payment_view"'.$attr.'>ดูการชำระเงิน</button>';
        }
        
        return $button;
      })
      ->make(true);
   }
   public function user_payment(Request $r)
   {

      //  return json_encode($r->input());
      // dd($r->all(),json_decode($r->payment_data),\Auth::user(),isset($r->file)?gettype($r->file):null,uniqid());
      try{
        if(empty($r->order_id) && empty($r->price) && empty($r->payment_date) && empty($r->payment_data) && !\Auth::user() && !$r->file)
          throw new \Exception('ข้อมูลไม่ครบ');
        
        $order = Order::find($r->order_id);
        if(!$order)
          throw new \Exception('ไม่พบออเดอร์');
        
        $r->price = str_replace(',','',$r->price);
        $payment = json_decode($r->payment_data,true);
        $orderTranfer = OrderTranfer::where('order_id',$r->order_id)->first();
        if(!$orderTranfer)
        {
          $orderTranfer = new OrderTranfer();
          $orderTranfer->order_id = $r->order_id;
        }

        // dd($r->file,1,$orderTranfer);
        $orderTranfer->order_id = $r->order_id;
        $orderTranfer->shop_id = $order->shop_id;
        $orderTranfer->user_id = \Auth::user()->id;
        $orderTranfer->bank_name = $payment['bank_name'];
        $orderTranfer->account_name = $payment['account_name'];
        $orderTranfer->account_no = $payment['account_no'];
        $orderTranfer->payment_date = $r->payment_date.':00';
        $orderTranfer->price = $r->price;
        if($r->payment_remark)
          $orderTranfer->payment_remark = $r->payment_remark;

        $payment_file = [];
        foreach($r->file as $file)
        {
          $img_name = uniqid();
          $payment_file = $img_name;
          // $payment_file[] = $img_name;
          // $payment_file[] = $img_name.'.'.$file->getClientOriginalExtension();
          $path = storage_path('app/uploads/bank_tranfer/'.$order->shop_id);
          // dd($payment_file,Met::make_dir('uploads/shop_tranfer/'.$order->shop_id));
          Met::make_dir($path);
          $file->move($path, $img_name);
        }
        $orderTranfer->payment_file = $img_name;
        // $orderTranfer->payment_file = json_encode($img_name);
        // dd($orderTranfer);
        $order->status = 6;
        $order->save();
        $orderTranfer->save();
        DB::commit();
        $result = [ 'result' => 1 , 'msg' => 'Payment Success' ];
      }
      catch(\Exception $e)
      {
        DB::rollback();
        $result = [ 'result' => 0 , 'msg' => $e->getMessage().' On Line:'.$e->getLine().' On File'.$e->getFile()];
      }
      return json_encode($result);

   }
   public function profile_address_get(Request $r)
   {
     $addr=UserAddress::where("user_id",\Auth::user()->id)->where("id",$r->address_id)->first();
     if(!$addr)
     return LKS::o(0,__('view.address_not_found'));

     return LKS::o(1,$addr);
   }
   public function profile_save(Request $r){

        if($r->email=="" || $r->name=="")
        return redirect()->back()->withInput()->with('error',__('auth.please_enter_data'));

        if($r->password!=""){
          if($r->password!=$r->password_confirm)
          return redirect()->back()->withInput()->with('error',__('auth.password_confirm_miss_match'));
        }
        $u=User::where('id',$r->user_id)->first();
        if(!$u)
        return redirect()->back()->withInput()->with('error',__('auth.user_not_exists'));

        if($u->email!=$r->email)
        {
          $check_email=User::where("id",'<>',$u->id)->where("email",$r->email)->first();
          if($check_email)
          return redirect()->back()->withInput()->with('error',__('auth.email_being_use'));


          $u->email=$r->email;
        }

      
       
        if($r->password!=""){
          $u->password=\Hash::make($r->password);
        }

        $u->name=$r->name;
        $u->phone=$r->phone;
        $u->line=$r->line;
        $u->phone=$r->phone;
        $u->facebook=$r->facebook;
        $u->save();


        return redirect()->back()->with('success',__('view.updated'));

   }
   public function verify_email(Request $r)
   {
     $user=User::where("email",$r->email)->where("email_verify_code",$r->code)->first();
     if(!$user)
     {
       if(\Auth::user())
       return redirect('profile')->with('error','การยืนยัน Email ไม่สำเร็จไม่พบผู้ใช้งาน');
       else
       return redirect('login')->with('error','การยืนยัน Email ไม่สำเร็จไม่พบผู้ใช้งาน');
     }
     
     $user->is_verify_email=1;
     $user->save();

     if(\Auth::user())
     return redirect('profile')->with('success','การยืนยัน Email สำเร็จ');
     else
     return redirect('login')->with('success','การยืนยัน Email สำเร็จ');
   }
   public function send_verify_email(Request $r){
        $user=\Auth::user();
        if($user->is_verify_email==1)
        return redirect()->back()->with('error','คุณได้ยืนยัน Email แล้ว');

         \Mail::send([], [], function ($message) use($user){

            $user->email_verify_code=md5($user->id.time());
            $user->save();
            $message->from(env('MAIL_USERNAME'),"Gohala" );
            

            $message->to($user->email)->subject("ยืนยันอีเมล์")
            ->setBody('กรุณายืนยันอีเมล์เพื่อใช้งาน ณ '.date('วันที่ d เดือน m ปี Y เวลา H:i:s').'<br><a href="'.LKS::url_subdomain('account','').'/email/verify?email='.$user->email.'&code='.$user->email_verify_code.'">ยืนยัน</a>','text/html');
        });

        return redirect()->back()->with('success','ส่งยืนยัน Email ไปเรียบร้อยแล้ว');

   }
   public function profile_upload_photo(Request $r)
   {
    //  dd($r->all());
    // dd($r->file('profile_image')->extension());
      $vali=$this->validate($r,[
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
      ]);


      $path=storage_path('app/uploads/profile');
      // dd($path);
      if(!\File::exists($path))
      \File::makeDirectory($path, $mode = 0755, true);

    
      $name=\Auth::user()->id;
      $r->file('profile_image')->move($path,$name);
   

      return redirect()->back()->with('success','เปลี่ยนรูปโปรไฟล์ใหม่');


   }
   public function reset_password_process(Request $r)
   {
     if($r->password=="")
     return redirect()->back()->with('error','กรุณาระบุรหัสผ่านใหม่');

     if($r->password!=$r->password_confirm)
     return redirect()->back()->with('error','รหัสผ่านใหม่และรหัสผ่านยืนยันไม่ตรงกัน');

     $user=User::where("email",$r->email)->first();
     if(!$user)
     return redirect()->back()->with('error','ไม่พบข้อมูลผู้ใช้งาน Email นี้');

     $data=[];
     $reset_check=\DB::table('password_resets')->where("email",$r->email)->where("token",$r->code)->first();
     if(!$reset_check)
     $data['error']='ไม่พบข้อมูล Reset รหัสผ่าน <a href="'.url('login').'">เข้าสู่ระบบ/ลงทะเบียน</a>';

     $currentDate=new \DateTime();
     $resetDate=new \DateTime($reset_check->created_at);

     $sec=$currentDate->getTimestamp()-$resetDate->getTimestamp();
     if($sec>env('RESET_PASSWORD_EXPIRE')){
     \DB::table('password_resets')->where("email",$r->email)->delete();
     $data['error']='การ Reset รหัสผ่านของท่านหมดอายุแล้ว กรุณาขอ Reset รหัสผ่านใหม่ <a href="'.url('login').'">เข้าสู่ระบบ/ลงทะเบียน</a>';
     }
    if(isset($data['error']))
    return view('account.reset_password',$data);

    
    $user->password=\Hash::make($r->password);
    $user->save();
    \DB::table('password_resets')->where("email",$r->email)->delete();  


    return redirect('login')->with('success','เปลี่ยนรหัสผ่านสำเร็จ');

   }
   public function reset_password(Request $r)
   {
     $data=[];
     $reset_check=\DB::table('password_resets')->where("email",$r->email)->where("token",$r->code)->first();
     if(!$reset_check)
     $data['error']='ไม่พบข้อมูล Reset รหัสผ่าน <a href="'.url('login').'">เข้าสู่ระบบ/ลงทะเบียน</a>';

     $currentDate=new \DateTime();
     $resetDate=new \DateTime($reset_check->created_at);

     $sec=$currentDate->getTimestamp()-$resetDate->getTimestamp();
     if($sec>env('RESET_PASSWORD_EXPIRE')){
     \DB::table('password_resets')->where("email",$r->email)->delete();
     $data['error']='การ Reset รหัสผ่านของท่านหมดอายุแล้ว กรุณาขอ Reset รหัสผ่านใหม่ <a href="'.url('login').'">เข้าสู่ระบบ/ลงทะเบียน</a>';
     }

     $data['code']=$r->code;
     $data['email']=$r->email;

     return view('account.reset_password',$data);
   }
   public function reset_password_send(Request $r)
   {
    //  dd($r->all());
     $u=User::where("email",$r->email)->first();
     if(!$u)
     return LKS::o(0,"ไม่พบ Email นี้ลงบะเทียนไว้ในระบบ");
     $token = str_random(64);
      \Mail::send([], [], function ($message) use($u,$token){

          $message->from(env('MAIL_USERNAME'),"Gohala - Reset Password" );
          

          $message->to($u->email)->subject("Reset รหัสผ่าน")
          ->setBody('ท่านได้ทำการข้อ Reset รหัสผ่าน<br>ต้องการดำเนินการต่อ? <a href="'.LKS::url_subdomain('account','').'/user/reset_password?email='.$u->email.'&code='.$token.'">ทำการ Reset รหัสผ่าน</a>','text/html');
      });
    \DB::table('password_resets')->where('email',$u->email)->delete();
    \DB::table('password_resets')->insert(['email'=>$u->email,"token"=>$token,'created_at'=>date('Y-m-d H:i:s')]);

    return LKS::o(1,"");

   }
   public function profile_address_save(Request $r){
   
     if($r->name==""||$r->contact_name==""||$r->contact_phone==""||$r->address==""||$r->zipcode=="")
     return LKS::o(0,__('auth.please_enter_data'));

     if(!isset($r->address_id))
     {
       $address=new UserAddress();
       $address->user_id=\Auth::user()->id;
     }
     else
     {
       $address=UserAddress::where("id",$r->address_id)->where('user_id',\Auth::user()->id)->first();
       
     }

     if(!isset($address))
      return LKS::o(0,__('view.address_not_found'));
    
    $address->name_address=$r->name;
    $address->name_contact=$r->contact_name;
    $address->phone=$r->contact_phone;
    $address->address=$r->address;
    $address->province_id=$r->province;
    $address->zipcode=$r->zipcode;
    $address->save();

    $res=array("id"=>$address->id,"name_address"=>$address->name_address,"is_default"=>$address->is_default,"address"=>$address->address.' '.$address->province->name.' '.$address->zipcode,"contact_name"=>$address->name_contact,"phone"=>$address->phone);
    return LKS::o(1,$res);
    
   }

   public function profile_address_delete(Request $r)
   {
    
     $addr=UserAddress::where("user_id",\Auth::user()->id)->where("id",$r->address_id)->first();
     if(!$addr)
     {
       return LKS::o(0,__('view.address_not_found'));
     }
      $addr->delete();

      return LKS::o(1,"");

   }
   public function default_change(Request $r)
   {
    //  dd($r->all(),$r->address_id,\Auth::user());
      // dd(UserAddress::where('user_id',\Auth::user()->id)->get());
      DB::beginTransaction();
      try{
        $address_id = (int)$r->address_id;
        if(!\Auth::check())
          throw new \Exception('กรุณาล็อคอิน');
        $user_address = UserAddress::where('user_id',\Auth::user()->id)->get();
        foreach($user_address as $addr)
        {
          // dd($user_address,$addr->id,$address_id);
          if($addr->id == $address_id)
          {   
            $addr->is_default = 1;
          }
          else
          {
            $addr->is_default = 0;
          }
          $addr->save();
        }
        DB::commit();
        $return = ['result' => 1, 'msg'=> 'บันทึกเรียบร้อย' ];
      }
      catch(\Exception $e)
      {
        DB::rollback();
        $return = ['result' => 0, 'msg'=> $e->getMessage() ];
      }
      return json_encode($return);
   }
}