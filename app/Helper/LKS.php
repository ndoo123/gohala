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
    public static function redirect_subdomain2($sub,$url)
    {
        $to_url=$_SERVER['REQUEST_SCHEME']."://".$sub.'.'.env('APP_DOMAIN');
        if($url!="")
        $to_url.='/'.$url;

        return redirect($to_url);
    }
    public static function url_subdomain($sub,$url = null)
    {
        if(!$sub)
            return $_SERVER['REQUEST_SCHEME']."://".env('APP_DOMAIN');
        $to_url=$_SERVER['REQUEST_SCHEME']."://".$sub.'.'.env('APP_DOMAIN');
        if($url!="")
        $to_url.='/'.$url;

        return $to_url;
    }
    public static function url_subdomain2($sub,$url)
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
        $alert= '<div class="alert alert-'.$state.'" role="alert">';
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
    public static function convertToSlug($string)
    {

        $s=preg_replace('/[^A-Za-z0-9ก-๙\-]/u', '-',str_replace('&', '-and-', $string));
        return substr($s,0,255);
    }
    public static function error_404_url()
    {
        return url('').'/error_404';
    }
    public static function base64_to_image($base64)
    {

        $image = $base64;  // your base64 encoded
        $data=explode(';',$image);
        if($data[0]!="data:image/png" && $data[0]!="data:image/jpg"&& $data[0]!="data:image/jpeg")
        return null;

        $image = str_replace('base64,', '', $data[1]);
        $image = str_replace(' ', '+', $image);
        return base64_decode($image);
    }

    public static function txt_receipt($id)
    {
        $txt = array('', 'ขนาด 3 นิ้ว ไม่มี VAT', 'ขนาด 3 นิ้ว แสดง VAT');        
        return $txt[$id];
    }

    public static function price_discount($dis, $price)
    {
        $per = ($price * $dis) / 100;
        return $price - $per;
    }


}
?>