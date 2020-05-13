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