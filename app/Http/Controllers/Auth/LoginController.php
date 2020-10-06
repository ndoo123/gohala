<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use LKS;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login_facebook(Request $r)
    {
        // dd($r->all());
        if((!isset($r->email)||$r->email=="") || (!isset($r->name) || $r->name=="") || (!isset($r->fb_id)||$r->fb_id==""))
        {
            return \LKS::o(0,"ไม่ระบุ Email หรือ Facebook ID และ ชื่อ ");
        }

        $u=User::where("facebook_id",$r->fb_id)->first();
        if(!$u)
        {
            //Register
            $u=new User();
            $u->email=$r->email;
            $u->password=\Hash::make($r->facebook_id.rand(100,999).time());
            $u->name=$r->name;
            $u->facebook_id=$r->fb_id;

            $u->save();
            //send mail
            \Mail::send([], [], function ($message) use($u){

                $u->email_verify_code=md5($u->id.time());
                $u->save();
                $message->from(env('MAIL_USERNAME'),"Gohala" );
                

                $message->to($u->email)->subject("ยืนยันอีเมล์")
                ->setBody('กรุณายืนยันอีเมล์เพื่อใช้งาน<br><a href="'.LKS::url_subdomain('account','').'/email/verify?email='.$u->email.'&code='.$u->email_verify_code.'">ยืนยัน</a>','text/html');
            });

            
            //get photo
            $pic_url='http://graph.facebook.com/'.$r->fb_id.'/picture?type=large';
            $contents = file_get_contents($pic_url);
            $path=storage_path('app/uploads/profile');
            if(!\File::exists($path))
            \File::makeDirectory($path, $mode = 0755, true);

        
            $name=$u->id;
            file_put_contents($path.'/'.$name,$contents);
            
            

        }

        \Auth::login($u);
        return LKS::o(1,"");
    }
    public function login(Request $r)
    {
        dd($r->all());
        if((!isset($r->email)||$r->email=="") || (!isset($r->password) || $r->password==""))
        {
            return \LKS::o(0,__('auth.email_password_empty'));
        }

        $u=User::where("email",$r->email)->where("facebook_id",null)->first();
        if(!$u)
        return LKS::o(0,__('auth.user_not_found'));

        if(!\Hash::check($r->password,$u->password))
        return LKS::o(0,__('auth.wrong_password'));

        // dd(\Auth::user(),\Auth::check(),LKS::o(1,array('redirect'=>url('profile'))),$r->all(),$r->redirect);
        \Auth::login($u);
        // dd(\Auth::user());
        if(isset($r->redirect))
        return LKS::o(1,array('redirect'=>$r->redirect));


        // dd(1,$r->all());
        return LKS::o(1,array('redirect'=>url('profile')));
    }
    public function register(Request $r)
    {
        if($r->email=="" || $r->name=="" || $r->password=="" || $r->password_confirm=="")
        return LKS::o(0,__('auth.please_enter_data'));

        if($r->password!=$r->password_confirm)
        return LKS::o(0,__('auth.password_confirm_miss_match'));

        $u=User::where("email",$r->email)->where("facebook_id",null)->first();
        if($u)
        return LKS::o(0,__("auth.user_exists"));

        
        $u=new User();
        $u->email=$r->email;
        $u->password=\Hash::make($r->password);
        $u->name=$r->name;
        $u->save();
        //send mail
        \Mail::send([], [], function ($message) use($u){

            $u->email_verify_code=md5($u->id.time());
            $u->save();
            $message->from(env('MAIL_USERNAME'),"Gohala" );
            

            $message->to($u->email)->subject("ยืนยันอีเมล์")
            ->setBody('กรุณายืนยันอีเมล์เพื่อใช้งาน<br><a href="'.LKS::url_subdomain('account','').'/email/verify?email='.$u->email.'&code='.$u->email_verify_code.'">ยืนยัน</a>','text/html');
        });
        

        \Auth::login($u);
        

        return redirect()->back()->with('success','ส่งยืนยัน Email ไปเรียบร้อยแล้ว');

         if(isset($r->redirect))
        return LKS::o(1,array('redirect'=>$r->redirect));

       return LKS::o(1,array('redirect'=>url('profile')));

    }
    public function logout(Request $r)
    {
        if(\Auth::check())
        {
            \Auth::logout();
        }

        return redirect(env('APP_URL'));
    }
}
