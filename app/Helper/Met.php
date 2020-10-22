<?php
namespace App\Helper;

use Illuminate\Support\Facades\Schema;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\DB;
class Met
{
    public $pusher;
    public static function pusher($msg){
        try{
            $pusher = new \Pusher\Pusher(env("PUSHER_APP_KEY"), env("PUSHER_APP_SECRET"), env("PUSHER_APP_ID"), array('cluster' => env('PUSHER_APP_CLUSTER')));
            $pusher->trigger('my-channel', 'my-event', $msg );
            return true;
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    public static $messageValidate = [
        '*image*.required'       => 'โปรดเลือกรูปภาพก่อน :attribute <br>',
        '*category_id*.required' => 'โปรดเลือก :attribute <br>',
        '*.required'             => 'โปรดระบุ :attribute <br>',
        '*image*.max'            => 'ขนาดรูปภาพต้องไม่เกิน :max kilobytes. <br>',
        '*.max'                  => 'ขนาดข้อความต้องไม่เกิน :max ตัวอักษร. <br>',
        '*.min'                  => 'ขนาดข้อความมีไม่น้อยกว่า :min ตัวอักษร. <br>',
        '*link_url*.regex'       => 'รูปแบบลิ้งไม่ถูกต้องกรุณาลองใหม่ <br>',
        '*map*.regex'            => 'รูปแบบลิ้งไม่ถูกต้องกรุณาลองใหม่ <br>',
        '*pw*.same'              => 'รหัสผ่านไม่เหมือนกัน <br>',
        '*email*.email'          => 'กรุณาตรวจสอบรูปแบบอีเมล <br>',
    ];
    
    public static function MessageAlert()
    {
        $res = '';

        if (session('message'))
        {
            if (session('state') == true)
            {
                $res = '
                <div class="alert alert-success" role="alert">
                    <p class="mb-0">' . session('message') . ' </p>
                </div>';
            }
            else
            {
                $res = '
                <div class="alert alert-danger" role="alert">
                    <p class="mb-0">' . session('message') . ' </p>
                </div>';
            }
        }

        return $res;
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
    public static function image64($base64,$path='', $prefix = null, $model=null,$field=null)
    {
        $path_default=str_replace('/','',$path);
        $path=$path_default. '/' . date('Y-m-d').'/';
        $prefix= $prefix != null ? $prefix : public_path();
        if(!is_dir($prefix))
        {
            mkdir($prefix);
        }
        if(!is_dir($prefix.$path_default))
        {
            mkdir($prefix.$path_default);
        }
        if(!is_dir($prefix.$path))
        {
            mkdir($prefix.$path);
        }
        $image_parts = explode(";base64,", $base64);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $path . uniqid() . '.'.$image_type;
        file_put_contents($prefix.$file, $image_base64);
        if(!empty($model->$field))
        {
            $exists = Storage::disk('public_uploads')->exists($model->$field);
            if ($exists)
            {
                Storage::disk('public_uploads')->delete($model->$field);
            }
        }
        $model->$field=$file;
        $model->save();
        return $file;
    }
    public static function upload_files(Request $request, $collection=null, $module_name = null)
    {
        $res = [];

        $folder_target = $module_name . '/' . date('Y-m-d');

        $files = $request->file();
        foreach ($files as $input_name => $file)
        {
            $new_name = uniqid() . '.' . File::extension($file->getClientOriginalName());
            $file->storeAs($folder_target, $new_name, 'public_uploads');
            $res[$input_name] = $folder_target . '/' . $new_name;

            // If pass collection model old file will remove old file
            if (!empty($collection->$input_name))
            {
                $exists = Storage::disk('public_uploads')->exists($collection->$input_name);
                if ($exists)
                {
                    Storage::disk('public_uploads')->delete($collection->$input_name);
                }
            }
        }

        return $res;
    }
    public static function model_update_only($r,$model)
    {
        //update only input text
        $data=$r->input();
        unset($data['_token']);
        unset($data['id']);
        $columns = Schema::getColumnListing($model->getTable());
        foreach($data as $key=>$val)
        {
            if(in_array($key,$columns))
            {
                $model->$key=$val;
            }
        }
        $model->save();
    }
    public static function model_update($r,$model,$path='')
    {
        //mean update input(),file()
        $data=self::upload_files($r,$model,$path);

        //data = return name file
        //loop for keep data to field and update in model_update(in here has model->save())
        foreach ($data as $k => $v)
        {
            $model->$k = $v;
        }
        self::model_update_only($r,$model);
    }
    public static function model_insert($r,$model)
    {
        //insert only input text
        $data=$r->input();
        unset($data['_token']);
        $columns = Schema::getColumnListing($model->getTable());
        foreach($data as $key=>$val)
        {
            if(in_array($key,$columns))
            {
                $model->$key=$val;
                    
                if($val==="null")
                {
                    $model->$key=null;
                }
            }
        }
        $model->save();
    }
    public static function model_insert2($r,$model,$folder)
    {
        //insert only input text
        $data=$r->input();
        $file = self::upload_files($r,$model,$folder);
        foreach ($file as $k => $v)
        {
            $model->$k = $v;
        }
        unset($data['_token']);
        $columns = Schema::getColumnListing($model->getTable());
        foreach($data as $key=>$val)
        {
            if(in_array($key,$columns))
            {
                $model->$key=$val;
                    
                if($val==="null")
                {
                    $model->$key=null;
                }
            }
        }
        $model->save();
    }
    public static function model_insert_bank_tranfer($r,$model,$folder)
    {
        //insert only input text
        $data=$r->input();
        $res=[];
        // dd($r->file("purchase_file"));
        foreach($r->file("purchase_file") as $input_name => $file)
        {
            $folder_target = $folder . '/' . date('Y-m-d');
            $new_name = uniqid() . '.' . File::extension($file->getClientOriginalName());
            $file->storeAs($folder_target, $new_name, 'public_uploads');
            $res[$input_name] = $folder_target . '/' . $new_name;
        }
        // dd(json_encode($res),$data,$r->file());
        foreach ($file as $k => $v)
        {
            $model->$k = $v;
        }
        unset($data['_token']);
        $columns = Schema::getColumnListing($model->getTable());
        foreach($data as $key=>$val)
        {
            if(in_array($key,$columns))
            {
                $model->$key=$val;
                    
                if($val==="null")
                {
                    $model->$key=null;
                }
            }
        }
        $model->purchase_file = json_encode($res);
        $model->save();
    }
    public static function has_session()
    {
        if(session('success'))
        {
            echo Met::alert('success',session('success'));
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
                   
                    echo Met::alert('danger',$errors);
                }
            }
            else
            { 
                echo Met::alert('danger',session('error'));
            }
        }
        
    }
    public static function alert($alert,$msg)
    {
        $time=time();
        $alert='<div alert_time="'.$time.'" class="alert alert-'.$alert.'" role="alert">'.$msg.'<script>setTimeout(function(){$(".alert[alert_time=\''.$time.'\']").fadeOut();},20000);</script></div>';

         echo $alert;
    }
    public static function get_month($month)
    {
      $months=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
      return $months[intval($month)-1];
    }
    public static function get_thai_date($month="",$is_thai_year=false,$is_full=false)
    {
        $m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
        
        if($month=='m')
        return $m[intval(date('m'))];

        if($is_thai_year && $is_full)
         return date('d ').$m[intval(date('m'))].' '.(date('Y')+543);
        else if($is_thai_year)
        return $m[intval(date('m'))].' '.(date('Y')+543);
        else
        return date('d ').$m[intval(date('m'))].' '.date('Y');

    }
    public static function get_short_month_thai($month="")
    {
        $months=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        
     
        return $months[$month];
    }
    public static function get_short_month_eng($month="")
    {
        $months=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
        
  
        return $months[$month];
    }
    public static  function file_size($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
    
    public static function ucf_name_sur($name,$sur)
    {
        $name=ucfirst(strtolower(trim($name)));
        $sur=ucfirst(strtolower(trim($sur)));
        return $name.' '.$sur;
    }
    public static function make_dir($str)
    {
        // $str รับมาเป็น public_path, storage_path
        try{
            $arr = explode('/',$str);
            foreach($arr as $key => $val)
            {
                // วนรอบแรกเพื่อเอา path ของที่ไม่ใช่โปรเจคออกไป เช่น XAMPP,htdocs
                if($val == "storage" || $val == "public_html")
                {
                    $permission = $val;
                    array_shift($arr);
                    break;
                }
                array_shift($arr);
            }
            $str_cat = '';
            foreach($arr as $key => $val)
            {
                $str_cat .= $val.'/';
                if($permission == "storage")
                {
                    if(!file_exists(storage_path($str_cat)))
                        mkdir(storage_path($str_cat), 0777, true);
                }
                else
                {
                    if(!file_exists(public_path($str_cat)))
                        mkdir(public_path($str_cat), 0777, true);
                }
            }
            $return = $permission == "storage" ? storage_path($str_cat) : public_path($str_cat);
            // dd($str,$arr,$str_cat,$permission);
            return $return;
        }
        catch(\Exception $e)
        {
            dd('Met make_dir error on Line :'.$e->getLine().' <br>Message: '.$e->getMessage());
        }
    }
    // protected function setKeysForSaveQuery(Builder $query)
    // {
    //     // use Illuminate\Database\Eloquent\Builder;

    //     // dd($this->getKeyName());
    //     foreach($this->getKeyName() as $key)
    //     {
    //         $query->where($key,$this->getAttribute($key));
    //     }
    //     return $query;
    // }

    // Route::get('images/product/{shop_id}/{product_id}.{photo_name}.jpg',function($shop_id,$product_id,$photo_name){
    //   $path=storage_path('app/uploads/shop/'.$shop_id.'/product/'.$product_id.'/'.$photo_name);
    //   if(!file_exists($path))
    //   $path=public_path('assets/images/no_image_available.jpeg');

    //   $file = File::get($path);

    //   $type = File::mimeType($path);

    //   $response = Response::make($file, 200);

    //   $response->header("Content-Type", $type);
    
    //   return $response;

    // });
}

