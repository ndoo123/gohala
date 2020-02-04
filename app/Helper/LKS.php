<?php
namespace App\Helper;

class LKS
{
    public static function redirect_subdomain($sub,$url)
    {
        $to_url="http://".$sub.'.'.env('APP_DOMAIN');
        if($url!="")
        $to_url.='/'.$url;

        return redirect($to_url);
    }
    public static function url_subdomain($sub,$url)
    {
        $to_url="http://".$sub.'.'.env('APP_DOMAIN');
        if($url!="")
        $to_url.='/'.$url;

        return $to_url;
    }
    public static function o($result,$data)
    {
        if($result==0){
        //return json_encode(array("result"=>$result,"msg"=>$data));
        return response()->json(
                ["result"=>$result,"msg"=>$data],
            200);
        }
        else{
       // return json_encode(array("result"=>$result,"data"=>$data));
       return response()->json(
                ["result"=>$result,"data"=>$data], 200);
        }
    }
    public static function alert($state,$msg)
    {
        $alert= '<div class="alert alert-'.$state.' alert-dismissible fade show" role="alert">';
        $alert.=$msg;
        $alert.='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
        $alert.='</div>';
       echo $alert;
    }
    
    public static function has_alert()
    {
        if(session('success'))
        {
            echo LKS::alert('success',session('success'));
        }
        else if(session('error'))
        {
            if(is_array(session('error')))
            {
                $errors="";
                foreach(session('error') as $err)
                {
                    $errors.='- '.$err.'<br>';
                }
                if($errors!="")
                {
                   
                    echo LKS::alert('danger',$errors);
                }
            }
            else
            { 
                echo LKS::alert('danger',session('error'));
            }
        }
    }
     public static function to_full_thai_date($date)
    {
        $time=strtotime($date);
        $m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
       
       
       
        return date('d ', $time).$m[intval(date('m', $time))-1].' '.(date('Y', $time)+543);

    }
}
?>