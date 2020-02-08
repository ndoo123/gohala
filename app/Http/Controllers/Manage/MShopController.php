<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Product;
use App\Models\ProductSlug;
use App\Models\ProductPhoto;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

use LKS;
class MShopController extends Controller
{
   public function shops()
   {
       
       $data['shops']=Shop::where("user_id",\Auth::user()->id)->get();
       return view('manage.shop.shops',$data);
   }
   public function shop_create(Request $r)
   {
    
       if($r->name=="" || $r->shop_url=="")
       return LKS::o(0,"กรุณาระบุข้อมูลให้ครบ");

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
         
        if(!isset($r->name)||$r->name==""||!isset($r->price)||!isset($r->qty)||!isset($r->sku)||$r->sku=="")
        return LKS::o(0,__('view.require_data'));

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
        }

        if(!isset($p))//NEW Product
        {
            $check_sku=Product::where("sku",$r->sku)->where("shop_id",$r->shop->id)->first();
            if($check_sku)
            return LKS::o(0,__('view.product.sku_exists'));


            $p=new Product();
            $p->sku=$r->sku;
            $p->rate=0;
            $p->run_photo_id=1;
            $p->shop_id=$r->shop->id;
            $p->cost=0;
           
        }



        if(!is_numeric($r->qty))
        $r->qty=1;
        if(!is_numeric($r->price))
        $r->price=0;

       

        $current_name_for_check_slug=$p->name;

        $p->price=$r->price;
        $p->name=$r->name;
        $p->info_short=$r->info_short;
        $p->info_full=$r->info;
        $p->category_id=$r->category;
        $p->qty=$r->qty;
        $p->is_discount=0;
        if(isset($r->is_discount)){
            $p->is_discount=1;
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
                    $photo=ProductPhoto::where("product_id",$p->id)->where("id",$delete_image)->where("shop_id",$p->shop_id)->first();
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

                    $img_name=md5(rand(10,99).time().$img_id.$p->id.($p->run_photo_id++).$r->shop->id.\Auth::user()->id);
                    \File::put($path.'/'.$img_name, $img);

                    $photo=new ProductPhoto();
                    $photo->product_id=$p->id;
                    $photo->id=$p->run_photo_id++;
                    $photo->shop_id=$r->shop->id;
                    $photo->name=$img_name;
                    $photo->photo_type=1;
                    $photo->is_default=0;
                    if(isset($r->set_default)&& $r->set_default==$img_id)
                    {
                        ProductPhoto::where("product_id",$p->id)->where("shop_id",$r->shop->id)->update(['is_default'=>0]);
                        $photo->is_default=1;
                        $has_check_default_image=true;
                        $p->default_photo=$photo->id;
                    }
                    
                    $photo->save();
                   
                    $upload_image_response[]=array("id"=>$photo->id,"ref_id"=>$img_id);

                    
                }
            }

            if(!$has_check_default_image &&isset($r->set_default))
            {
                //ถ้าไม่พบการตั้งค่า default image ที่รูปที่อัพใหม่ แสดงว่าอาจจะใช้รูปเดิม
                ProductPhoto::where("product_id",$p->id)->where("shop_id",$r->shop->id)->update(['is_default'=>0]);//ปรับให้ทั้งหมดเป็น ไม่มีค่า defaultก่อน
                $photo= ProductPhoto::where("product_id",$p->id)->where("shop_id",$r->shop->id)->where("id",$r->set_default)->first();
                if($photo)
                {
                    $p->default_photo=$photo->id;
                    $photo->is_default=1;
                    $photo->save();
                }
            }

            $p->save();

         

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
       $data['summary']=(object)array(
           "order"=>0,
           "product"=>\DB::table('product_tb')->where('shop_id',$r->shop->id)->count(),
           "profit"=>0
       );
    
       return view('manage.shop.shop_manage',$data);
   }
   public function product_list(Request $r)
   {
        $data['shop']=$r->shop;
        $data['products']=Product::where("shop_id",$r->shop->id)->get();
       return view('manage.shop.product.product_list',$data);
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

       $data['product_categories']=ProductCategory::all();

       return view('manage.shop.product.product_view',$data);
   }
}