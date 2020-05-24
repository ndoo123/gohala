<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;
use App\Helper\LKS;
use App\Models\Order;
class AAccountController extends Controller
{
  
   public function login(Request $r){
      if(\Auth::check())
      return redirect('profile');
 
       return view('account.login');
   }
   public function profile()
   {
     
      $data['user']=\Auth::user();
      $data['address']=\Auth::user()->address;
      $data['provinces']=\DB::table('province_tb')->get();
      $data['orders']=Order::where("buyer_user_id",\Auth::user()->id)->get();
      return view('account.profile',$data);
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
            ->setBody('กรุณายืนยันอีเมล์เพื่อใช้งาน<br><a href="'.LKS::url_subdomain('account','').'/email/verify?email='.$user->email.'&code='.$user->email_verify_code.'">ยืนยัน</a>','text/html');
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
}