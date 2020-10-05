<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\OrderTranfer;
use App\Models\Product;
use App\Models\ProductSlug;
use App\Models\ProductPhoto;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Datatables;
use LKS;
use DB;

class MShopController extends Controller
{
    protected $url;
    private function url($r)
    {
        if(!empty($r))
        {
            $this->url = url($r->shop->url);
            // dd($r)
            // dd(1,$r->shop->url,$this->url);
            return $this->url;
        }
    }
   public function shops(Request $r)
   {
       $data['shops']=Shop::where("user_id",\Auth::user()->id)->get();
       return view('manage.shop.shops',$data);
   }
   public function shop_create(Request $r)
   {
    
       if($r->name=="" || $r->shop_url=="")
       return LKS::o(0,"กรุณาระบุข้อมูลให้ครบ");

       $r->shop_url=trim(strtolower($r->shop_url));

       if(strpos($r->shop_url, ' ')!=0)
       return LKS::o(0,"ต้องไม่มีช่องว่างใน URL");

       if(strpos($r->shop_url, '.')!=0)
       return LKS::o(0,"ต้องไม่มี . (จุด) ใดๆ ใน URL");

       $shop=Shop::where("url",$r->shop_url)->first();
       if($shop)
       return LKS::o(0,"URL นี้มีผู้ใช้แล้ว");

       $shop=new Shop();
       $shop->user_id=\Auth::user()->id;
       $shop->name=$r->name;
       $shop->url=$r->shop_url;
       $shop->province_id=1;
       $shop->save();

       return LKS::o(1,$shop);

   }



   //SHOP MAnage
    public function product_save(Request $r)
    {
        // dd($r->all());
        /* dd(preg_match('/[\/\'^£$%&*()}{@#~?><>"\\\.!,|=_+¬-]/', $r->sku) , 
        preg_match('/[\/\'^£$%&*()}{@#~?><>"\\\.!,|=_+¬-]/', $r->barcode)); */
        if(!isset($r->name)||$r->name==""||!isset($r->price)||!isset($r->qty)||!isset($r->sku)||$r->sku=="")
        return LKS::o(0,__('view.require_data'));

        if(preg_match('/[\/\'^£$%&*()}{@#~?><>"\\\.!,|=_+¬-]/', $r->sku) || preg_match('/[\/\'^£$%&*()}{@#~?><>"\\\.!,|=_+¬-]/', $r->barcode))
            return LKS::o(0,'ห้ามมีอักขระพิเศษ');
            
        if(!preg_match('/^[a-z0-9]+$/i',$r->sku) || !preg_match('/^[a-z0-9]+$/i', $r->barcode))
            return LKS::o(0,'ห้ามเป็นภาษาไทย');
        $r->price=str_replace(',','',$r->price);
        $r->qty=str_replace(',','',$r->qty);
        $r->discount_amount=str_replace(',','',$r->discount_amount);
        $r->name=trim($r->name);


        if(isset($r->product_id))//Update Product
        {
            $p=Product::where("id",$r->product_id)->first();
            if(!$p)
            return LKS::o(0,__('view.product.product_not_found'));

            if($p->sku!=$r->sku)
            {
                //Check  change sku
                $check_sku=Product::where("sku",$r->sku)->where("shop_id",$r->shop->id)->where('id','<>',$p->id)->first();
                if($check_sku)
                return LKS::o(0,__('view.product.sku_exists'));
            }
            if($p->barcode!=$r->barcode)
            {
                //check barcode
                $check_barcode=Product::where("barcode",$r->barcode)->where("shop_id",$r->shop->id)->where('id','<>',$p->id)->first();
                if($check_barcode)
                return LKS::o(0,"Barcode มีอยู่ในระบบแล้ว");
            }

            $p->barcode=$r->barcode;
            $p->sku=$r->sku;
        }

        if(!isset($p))//NEW Product
        {
            $check_sku=Product::where("sku",$r->sku)->where("shop_id",$r->shop->id)->first();
            if($check_sku)
            return LKS::o(0,__('view.product.sku_exists'));

            $check_barcode=Product::where("barcode",$r->barcode)->where("shop_id",$r->shop->id)->first();
            if($check_barcode)
            return LKS::o(0,"Barcode มีอยู่ในระบบแล้ว");


            $position=Product::where('shop_id',$r->shop->id)->get()->count() + 1;
            // dd($position);
            $p=new Product();
            
            $p->rate=0;
            // $p->run_photo_id=1;
            $p->barcode=$r->barcode;
            $p->sku=$r->sku;
            $p->shop_id=$r->shop->id;
            $p->cost=0;
            $p->position = $position;
           
        }

        

        if(!is_numeric($r->qty))
        $r->qty=1;
        if(!is_numeric($r->price))
        $r->price=0;

       

        $current_name_for_check_slug=$p->name;
        $p->unit=$r->unit;
        $p->price=$r->price;
        $p->name=$r->name;
        $p->info_short=$r->info_short;
        $p->info_full=$r->info;
     
        $p->qty=$r->qty;
        $p->is_discount=0;
  
        if(isset($r->is_discount)){
            $p->is_discount=$r->discount_type;
            $p->discount_value=$r->discount_amount;
        }

        $p->status=1;
        $p->is_pos=1;
        $p->is_ecom=1;
       
       $has_check_default_image=false;
       \DB::beginTransaction();
        try
        {

            $p->save();

            //Slug
        
            $slug=LKS::convertToSlug($r->name);
            $check_slug=ProductSlug::where("shop_id",$r->shop->id)->where("slug",$slug)->first();
            if($check_slug)
            {
                if($check_slug->product_id!=$p->id)
                {
                    $slug.=$p->id.'-'.$p->run_photo_id++;
                    \DB::table('product_slug_tb')->insert(['shop_id'=>$r->shop->id,'product_id'=>$p->id,'slug'=>$slug]);
                }
            }
            else
            {
                \DB::table('product_slug_tb')->insert(['shop_id'=>$r->shop->id,'product_id'=>$p->id,'slug'=>$slug]);
            }
            $p->slug=$slug;
            
            //End Slug

            //Image 
            $path=storage_path('app/uploads/shop/'.$r->shop->id.'/product/'.$p->id);

            //Delete Iamge
            if(isset($r->delete_image) && count($r->delete_image)>0)
            {
                foreach($r->delete_image as $delete_image)
                {
                    $photo=ProductPhoto::where("product_id",$p->id)->where("name",$delete_image)->where("shop_id",$p->shop_id)->first();
                    if(!$photo)
                    continue;


                    if(file_exists($path.'/'.$photo->name))
                    {
                        \File::delete($path.'/'.$photo->name);
                       
                    }
                     $photo->delete();
                }
            }
            //Upload New Image
            $upload_image_response=array();
            if(isset($r->upload_image) && count($r->upload_image)>0)
            {
                
                if(!\File::exists($path))
                \File::makeDirectory($path, $mode = 0755, true);

                foreach($r->upload_image as $img_id=>$upload_img)
                {
                    $img= LKS::base64_to_image($upload_img);
                    if($img==null)
                    continue;

                    $img_name=$img_id;
                    // $img_name=md5(rand(10,99).time().$img_id.$p->id.$r->shop->id.\Auth::user()->id);
                    \File::put($path.'/'.$img_name, $img);

                    $photo=new ProductPhoto();
                    $photo->product_id=$p->id;
                    // $photo->id=$p->run_photo_id++;
                    $photo->shop_id=$r->shop->id;
                    $photo->name=$img_name;
                    $photo->photo_type=1;
                    $photo->is_default=0;
                    if(isset($r->set_default)&& $r->set_default==$img_id)
                    {
                        ProductPhoto::where("product_id",$p->id)->where("shop_id",$r->shop->id)->update(['is_default'=>0]);
                        $photo->is_default=1;
                        $has_check_default_image=true;
                        $p->default_photo=$photo->name;
                    }
                    
                    $photo->save();
                   
                    $upload_image_response[]=array("name"=>$photo->name,"ref_id"=>$img_id);

                    
                }
            }
            
            if(!$has_check_default_image &&isset($r->set_default))
            {
                //ถ้าไม่พบการตั้งค่า default image ที่รูปที่อัพใหม่ แสดงว่าอาจจะใช้รูปเดิม
                ProductPhoto::where("product_id",$p->id)->where("shop_id",$r->shop->id)->update(['is_default'=>0]);//ปรับให้ทั้งหมดเป็น ไม่มีค่า defaultก่อน
                $photo= ProductPhoto::where("product_id",$p->id)->where("shop_id",$r->shop->id)->where("name",$r->set_default)->first();
                if($photo)
                {
                    $p->default_photo=$photo->name;
                    $photo->is_default=1;
                    $photo->save();
                }
            }
            $p->save();
            foreach($r->position as $posi_key => $posi)
            {
                $photo = ProductPhoto::where('name',$posi)->first();
                if(!$photo)
                    continue;
                
                $photo->position = $posi_key+1;
                $photo->save();
            }
         //Assign Category
         ProductCategory::where("product_id",$p->id)->where("shop_id",$r->shop->id)->delete();
         $add_categories=[];
         if(isset($r->category))
         {
             for($i=0;$i<count($r->category);$i++)
             {
                 $add_categories[]=["product_id"=>$p->id,"shop_id"=>$r->shop->id,"category_id"=>$r->category[$i]];
             }
         }
         if(count($add_categories)>0)
         ProductCategory::insert($add_categories);

         \DB::commit();
        }
        catch(\FatalErrorException $e)
        {
            \DB::rollback();
            return LKS::o(0,$e->getMessage());
        }
        catch(\QueryException $e)
        {
            \DB::rollback();
            return LKS::o(0,$e->getMessage());
        }

       
      
        return LKS::o(1,array('product'=>$p,'upload_image_response'=>$upload_image_response));
        
    }
   public function shop_manage(Request $r)
   {
        $data['shop']=$r->shop;
    //    $data['orders'] = \DB::table('order_tb')
    //                 ->join('order_item_tb', 'order_item_tb.order_id', 'order_tb.id')
    //                 ->selectRaw('order_tb.id, order_tb.order_date, order_tb.buyer_user_id, order_tb.total, SUM(order_item_tb.qty) as qty')
    //                 ->groupBy(\DB::raw('order_tb.id, order_tb.order_date, order_tb.buyer_user_id, order_tb.total'))
    //                 ->where('order_tb.shop_id', $r->shop->id)->get();
        $data['orders'] = Order::where('order_tb.shop_id', $r->shop->id)
                    ->limit(10)
                    ->orderBy('created_at', 'desc')
                    ->get();
        $data['summary']=(object)array(
            "order"=>\DB::table('order_tb')->where('shop_id',$r->shop->id)->whereNotIn('status',[0,4])->count(),
            "product"=>\DB::table('product_tb')->where('shop_id',$r->shop->id)->count(),
            "profit"=>0
       );
       $data['url'] = $url = self::url($r);
       $data['remote_url'] = $url.'/order_datatables';
    //    dd($data);
       return view('manage.shop.shop_manage',$data);
   }
   public function shop_profit(Request $r)
   {
    //    dd($r->all(),
    //    Order::where('shop_id',$r->shop->id)
    //    ->whereDate('order_date',date('Y-m-d'))
    //    ->where('status',4)
    //    ->select(DB::raw('total + total_delivery as sum_total,total,total_delivery'))
    //    ->sum(DB::raw('total + total_delivery'))
    //    ->get()
    //     );
    
       $order = Order::where('shop_id',$r->shop->id)
       ->whereDate('order_date',date('Y-m-d'))
       ->where('status','!=',0)
    //    ->where('status',4)
       ->select(DB::raw('total + total_delivery as sum_total,total,total_delivery'))
       ->sum(DB::raw('total + total_delivery')); // ราคาขาย รวมราคาส่ง
    //    ->sum('total'); // เฉพาะราคาขาย
    //    ->get();
        // dd($order);
        if(!$order)
            $return = ['result' => 0, 'msg' => 'ไม่พบข้อมูล'];
       
        $return = ['result' => 1, 'data' => $order];
        // $return = ['result' => 1, 'data' => floatval($order)];
        return $return;
   }
   public function shop_manage_all(Request $r)
   {
        $data['shop']=$r->shop;
        $data['summary']=(object)array(
            "order"=>\DB::table('order_tb')->where('shop_id',$r->shop->id)->count(),
            "product"=>\DB::table('product_tb')->where('shop_id',$r->shop->id)->count(),
            "profit"=>0
       );
       $data['url'] = $url = self::url($r);
       $data['remote_url'] = $url.'/order_datatables';
        
       return view('manage.shop.shop_all_manage',$data);
   }
   public function shop_categories(Request $r)
   {
       $data['shop']=$r->shop;
       $data['categories']=ShopCategory::where("shop_id",$r->shop->id)
       
       ->selectRaw('shop_category_tb.*,(select count(product_id) from shop_category_product_tb where shop_category_product_tb.category_id=shop_category_tb.id and shop_category_product_tb.shop_id="'.$r->shop->id.'" ) as product_count')
       ->get();
       $data['url'] = url($data['shop']->url);
       $data['current_url'] = $data['url'].'/categories';
        // dd($data);
       return view('manage.shop.shop_category',$data);
   }
   public function shop_categories_datatables(Request $r)
   {
    //    dd($r->all());
       
        $c_count = ShopCategory::where('shop_id',$r->shop->id)->count();
       $model = ShopCategory::where("shop_id",$r->shop->id)
       
       ->selectRaw('shop_category_tb.*,(select count(product_id) from shop_category_product_tb where shop_category_product_tb.category_id=shop_category_tb.id and shop_category_product_tb.shop_id="'.$r->shop->id.'" ) as product_count')
       ->orderBy('position','asc')
       ->get();

        // dd($model,$r->all(),$r->position);
        return Datatables::of($model)
        ->addColumn('p_position',function($model) use ($r,$c_count){
            //i up
            $style_up = '';
            if($model->position == 1)
                $style_up = "style='visibility:hidden'";
            $input = '<i class="ti-arrow-circle-up font-24 text-success p_position_up"  type="button" '.$style_up.'></i>';

            //select
            $input .= '<select class="form-control p_position mx-3" current_p="'.$model->position.'" style="width:auto;display:inline-block">';
            for($i=1;$i<=$c_count;$i++)
            {
                $check = '';
                if($i == $model->position)
                    $check = 'selected';
                $input .= '<option value="' . $i . '" '.$check.'>'.$i.'</option>';
            }
            $input .= '</select>';
            
            // i down
            $style_down = '';
            if($c_count == $model->position)
                $style_down = "style='visibility:hidden'";
            $input .= '<i class="ti-arrow-circle-down p_position_down font-24 text-danger" type="button" '.$style_down.'></i>';

            if(empty($r->position))
            {
                $input = '';
            }
            return $input;
        })
        ->editColumn('is_active',function($model){
            // $input = '<input type="checkbox" class="category_active" '.($model->is_active==1?'checked':'').' data-width="90" data-on="แสดง" data-off="ไม่แสดง" data-toggle="toggle" data-offstyle="light">';
            $input = '
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input category_active" data-width="90" data-on="แสดง" data-off="ไม่แสดง" data-toggle="toggle" data-offstyle="light" id="switch_active_'.$model->id.'" '.($model->is_active==1?'checked':'').'>
                    <label class="custom-control-label" for="switch_active_'.$model->id.'"></label>
                </div>';
            return $input;
        })
        ->addColumn('edit_del',function($model){
            $input = '<button type="button" class="btn btn-sm btn-primary edit_category">แก้ไข</button> 
            <button type="button" class="btn btn-sm btn-danger delete_category">ลบออก</button>';
            return $input;
        })
        // ->rawColumns(['is_active'])
        ->make(true);
   }
   public function shop_categories_update_position(Request $r)
   {
    //    dd($r->all());
        // dd($r->all());
        DB::beginTransaction();
        if(empty($r->shop))
            throw new \Exception('ไม่พบร้านค้า');
        try
        {
            if($r->current_p < $r->current_v) // เมื่อย้ายจากตำแหน่งน้อยกว่า ไปสูงกว่า เช่น จาก 1 ไป 4
            {
                $model = ShopCategory::where('shop_id',$r->shop->id)
                ->where('position','>=',$r->current_p)
                ->where('position','<=',$r->current_v)
                ->orderBy('position','asc')
                ->get();
                foreach($model as $p)
                {
                    $position = $p->position - 1;
                    
                    if($p->position == $r->current_p)
                    {
                        $p->position = $r->current_v;
                        // dd($r->all(),$p->position,$position,'$r->current_p',$r->current_p,'$r->current_v',$r->current_v,$p);
                        // dd();
                    }
                    else
                    {
                        $p->position = $position;
                    }
                    $p->save();
                }
            }
            else // เมื่อย้ายจากตำแหน่งสูงกว่า ไปน้อยกว่า เช่น จาก 4 ไป 1
            {
                $model = ShopCategory::where('shop_id',$r->shop->id)
                ->where('position','>=',$r->current_v)
                ->where('position','<=',$r->current_p)
                ->orderBy('position','asc')
                ->get();
                foreach($model as $p)
                {
                    $position = $p->position + 1;

                    if($p->position == $r->current_p)
                    {
                        $p->position = $r->current_v;
                    }
                    else
                    {
                        $p->position = $position;
                    }
                    $p->save();
                }
            }
            // dd($model);
            $result = ['result' => 1, 'msg' => 'บันทึกสำเร็จ'];
            DB::commit();
        }
        catch(\Excpetion $e)
        {
            DB::rollBack();
            $result = ['result' => 0, 'msg' => $e->getMessage()];
        }
        // dd($product);
        return json_encode($result);
   }
   public function shop_categories_active_json(Request $r)
   {
        $c=ShopCategory::where("id",$r->category_id)->where("shop_id",$r->shop->id)->first();
       if(!$c)
       return LKS::o(0,"ไม่พบข้อมูลหมวดหมู่");

       $c->is_active = $r->is_active == "true" ? 1 : 0;
       $c->save();
        
        // dd($c,$r->is_active, $r->is_active == "true" ? 1 : 0);
       return LKS::o(1,"");
   }
   public function shop_categories_get_json(Request $r)
   {
       $c=ShopCategory::where("id",$r->category_id)->where("shop_id",$r->shop->id)->first();
       if(!$c)
       return LKS::o(0,"ไม่พบข้อมูลหมวดหมู่");

       return LKS::o(1,$c);
   }
   public function shop_categories_delete_json(Request $r)
   {
        $r=ShopCategory::where("id",$r->category_id)->where("shop_id",$r->shop->id)->delete();
        if($r==0)
        return LKS::o(0,"ไม่พบข้อมูลหมวดหมู่");

        return LKS::o(1,"");
   }
   public function shop_categories_update_json(Request $r)
   {
       if($r->name=="")
       {
           return LKS::o(0,"กรุณาระบุชื่อ");
       }
       $c=null;
        if($r->category_id!="")
        {
            $c=ShopCategory::where("id",$r->category_id)->where("shop_id",$r->shop->id)->first();
            if(!$c)
            return LKS::o(0,"ไม่พบข้อมูลหมวดหมู่");
        }
        if($c==null)
        {
            $count = ShopCategory::where('shop_id',$r->shop->id)->get()->count()+1;
            // dd($r->all(),$count);
             $c=new ShopCategory();
             $c->user_id=\Auth::user()->id;
             $c->shop_id=$r->shop->id;
             $c->position=$count;
        }
      
       $c->name=$r->name;
       $c->slug=LKS::convertToSlug( $c->name);
       
       $c->save();

       return LKS::o(1,$c);
   }
   public function product_list(Request $r)
   {
        $data['shop']=$r->shop;
        $data['products']=Product::where("shop_id",$r->shop->id)->get();
       $data['categories']=ShopCategory::where("shop_id",$r->shop->id)->get();
        // dd($data,DB::table('product_tb')->get(),Product::all()); 
       return view('manage.shop.product.product_list',$data);
   }
    public function product_datatables(Request $r)
    {
        // dd($r->all());
        $data['shop']=$r->shop;
        $products =  
            DB::table('product_tb as p')
            ->leftJoin('shop_category_product_tb as m', 'm.product_id', '=', 'p.id')
            ->leftJoin('shop_category_tb as c', 'c.id', '=', 'm.category_id')
            ->select('p.*', 'c.*', 'm.*','c.name as c_name','p.name as p_name','p.id as p_id','p.position as p_position','c.position as c_position')
            ->groupBy('p_id')
            ->where('p.shop_id',$r->shop->id);
            // ->get();
        $p_count = Product::where('shop_id',$r->shop->id)->count();
        // dd($p_count);
        if(!empty($r->p_id))
        {
            $products = $products->where('m.category_id',$r->p_id);
        }
        $products = $products
            ->orderBy('p_position','asc')
            ->get();
        // dd($products);
        return Datatables::of($products)
        ->editColumn('name',function($products){
            $cats=$products->c_name;
            // $cats=mb_substr($products->c_name,0,2);
            $name = $products->p_name;
            $str = '<span class="text-muted">'.$cats.'</span>';
            return $name.'<br>'.$str;
        })
        ->addColumn('img',function($products){
            $img = env('APP_URL').'/assets/images/no_image_available.jpeg';
            if($products->default_photo!="")
            {
                $img = env('APP_URL').'/images/product/'.$products->shop_id.'/'.$products->p_id.'.'.$products->default_photo.'.jpg';
            }

            return '<img src="'.$img.'" alt="" class="rounded thumb-lg">';
            // return '<img src="'.$products->get_photo().'" alt="" class="rounded thumb-lg">';
        })
        ->editColumn('price',function($products){
            return number_format($products->price,2);
        })
        ->addColumn('edit',function($products) use ($data){
            return '<a class="btn btn-sm btn-primary" href="'.url($data['shop']->url.'/product/'.$products->p_id).'">
            '.__('view.product.edit_product').'</a>';
        })
        ->editColumn('p_position',function($products) use ($r,$p_count){
            //i up
            $style_up = '';
            if($products->p_position == 1)
                $style_up = "style='visibility:hidden'";
            $input = '<i class="ti-arrow-circle-up font-24 text-success p_position_up"  type="button" '.$style_up.'></i>';

            //select
            $input .= '<select class="form-control p_position mx-3" current_p="'.$products->p_position.'" style="width:auto;display:inline-block">';
            for($i=1;$i<=$p_count;$i++)
            {
                $check = '';
                if($i == $products->p_position)
                    $check = 'selected';
                $input .= '<option value="' . $i . '" '.$check.'>'.$i.'</option>';
            }
            $input .= '</select>';
            
            // i down
            $style_down = '';
            if($p_count == $products->p_position)
                $style_down = "style='visibility:hidden'";
            $input .= '<i class="ti-arrow-circle-down p_position_down font-24 text-danger" type="button" '.$style_down.'></i>';

            if(empty($r->position))
            {
                $input = '';
            }
            return $input;
        })
        ->addColumn('p_sort',function($products) use ($r,$p_count){
            $input = $products->p_position;
            return $input;
        })
        ->make(true);
    }
    public function product_update_position(Request $r)
    {
        // dd($r->all());
        DB::beginTransaction();
        if(empty($r->shop))
            throw new \Exception('ไม่พบร้านค้า');
        try
        {
            if($r->current_p < $r->current_v) // เมื่อย้ายจากตำแหน่งน้อยกว่า ไปสูงกว่า เช่น จาก 1 ไป 4
            {
                $product = Product::where('shop_id',$r->shop->id)
                ->where('position','>=',$r->current_p)
                ->where('position','<=',$r->current_v)
                ->orderBy('position','asc')
                ->get();
                foreach($product as $p)
                {
                    $position = $p->position - 1;
                    
                    if($p->position == $r->current_p)
                    {
                        $p->position = $r->current_v;
                        // dd($r->all(),$p->position,$position,'$r->current_p',$r->current_p,'$r->current_v',$r->current_v,$p);
                        // dd();
                    }
                    else
                    {
                        $p->position = $position;
                    }
                    $p->save();
                }
            }
            else // เมื่อย้ายจากตำแหน่งสูงกว่า ไปน้อยกว่า เช่น จาก 4 ไป 1
            {
                $product = Product::where('shop_id',$r->shop->id)
                ->where('position','>=',$r->current_v)
                ->where('position','<=',$r->current_p)
                ->orderBy('position','asc')
                ->get();
                foreach($product as $p)
                {
                    $position = $p->position + 1;

                    if($p->position == $r->current_p)
                    {
                        $p->position = $r->current_v;
                    }
                    else
                    {
                        $p->position = $position;
                    }
                    $p->save();
                }
            }
            // dd($product);
            $result = ['result' => 1, 'msg' => 'บันทึกสำเร็จ'];
            DB::commit();
        }
        catch(\Excpetion $e)
        {
            DB::rollBack();
            $result = ['result' => 0, 'msg' => $e->getMessage()];
        }
        // dd($product);
        return json_encode($result);
    }
   public function product_view(Request $r)
   {
       $data['shop']=$r->shop;
       $data['product']=new Product();
       if(isset($r->product_id)){
       
        $data['product']=Product::where("id",$r->product_id)->first();
   
        
        if(!$data['product'])
        return redirect()->back()->with('error',__('view.product.product_not_found'));

       }
       $data['categories']=ShopCategory::where("shop_id",$r->shop->id)->get();
        // dd($data,$data['product']->photos);
       return view('manage.shop.product.product_view',$data);
   }

    // ตั้งค่าข้อมูลร้าน
    public function setting_shop(request $r){
        $data['shop']=$r->shop;

        return view('manage.shop.shop_setting',$data);

    }
}