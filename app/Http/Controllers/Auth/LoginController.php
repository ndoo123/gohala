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

    public function login(Request $r)
    {
        if((!isset($r->email)||$r->email=="") || (!isset($r->password) || $r->password==""))
        {
            return \LKS::o(0,__('auth.email_password_empty'));
        }

        $u=User::where("email",$r->email)->first();
        if(!$u)
        return LKS::o(0,__('auth.user_not_found'));

        if(!\Hash::check($r->password,$u->password))
        return LKS::o(0,__('auth.wrong_password'));


        \Auth::login($u);

   
        if(isset($r->redirect))
        return LKS::o(1,array('redirect'=>$r->redirect));

        return LKS::o(1,array('redirect'=>url('profile')));
    }
    public function register(Request $r)
    {
        if($r->email=="" || $r->name=="" || $r->password=="" || $r->password_confirm=="")
        return LKS::o(0,__('auth.please_enter_data'));

        if($r->password!=$r->password_confirm)
        return LKS::o(0,__('auth.password_confirm_miss_match'));

        $u=User::where("email",$r->email)->first();
        if($u)
        return LKS::o(0,__("auth.user_exists"));

        
        $u=new User();
        $u->email=$r->email;
        $u->password=\Hash::make($r->password);
        $u->name=$r->name;
        $u->save();

        \Auth::login($u);

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
