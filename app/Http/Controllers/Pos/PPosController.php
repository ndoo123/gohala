<?php

namespace App\Http\Controllers\Pos;

use App\Helper\LKS as HelperLKS;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\Shop;
use App\Models\Product;
use App\Models\ProductSlug;
use App\Models\ProductPhoto;
use App\Models\ProductCategory;
use App\Models\Receipt;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LKS;
class PPosController extends Controller
{
   public function index()
   {       
    //    $data['shops']=Shop::where("user_id",\Auth::user()->id)->get();
    //    return view('pos.layout',$data);
   }

   public function pos(Request $req)
   {       
        $data['shop']=Shop::where("id",$req->id)->first();
        //$data['pcats']=ProductCategory::get();
        $pcats = DB::table('product_tb')
                    ->join('category_tb','product_tb.category_id','=','category_tb.id')
                    ->select('product_tb.category_id','category_tb.*')
                    ->where('product_tb.status','!=','0')
                    ->get();
        $data['pcats']= $pcats->unique();
        $data['product']=Product::where("shop_id",$req->id)->get();
        return view('pos.pos',$data);
   }


    // jquery
    public function read_barcode($sku,$shopid)
    {
        //$pro = TbProduct::where('p_id',$id)->first();
        $pro = Product::where('shop_id','=',$shopid)
                ->where('sku',$sku)
                ->first();

        if($pro->is_discount == '0'){
            $price = $pro->price;
        }elseif($pro->is_discount == '1'){
            $price = $pro->discount_value;
        }elseif($pro->is_discount == '2'){
            $price = HelperLKS::price_discount($pro->discount_value, $pro->price);
        }

        $txt = '<tr>
        <input type="hidden" name="h_id[]" value="'.$pro->id.'">
        <input type="hidden" name="h_name[]" value="'.$pro->name.'">
        <input type="hidden" name="h_price[]" value="'.$price.'">
        <input type="hidden" id="h_num'.$pro->id.'" name="h_num[]" value="1">
        <td class="text-left">'. $pro->name .'</td>
        <td class="text-center" id="num'.$pro->id.'">1</td>
        <td class="text-center" id="price'.$pro->id.'">'. number_format($price,2,'.',',') .'</td>
        <td class="text-center">
            <a  class="btn-del" pId="'.$pro->id.'" onclick="del_one('.$pro->id.')"><i class="fa fa-trash text-danger"></i></a>
        </td></tr>';

        
        return $txt;
    }

    // เมื่อคลิกปุ่ม บันทึก/พิมพ์ หน้า POS
    public function pos_save(Request $req)
    {
        
        try
        {
            $shop = Shop::where("user_id",Auth::user()->id)->first();

            // เลขที่ใบเสร็จ
            $rec_no = 'R'.$shop->id.date('ym').$shop->run_receipt_id;
            // เลขที่ order
            $ord_no = 'O'.date('ym').$shop->id.$shop->run_order_id;
            // วันที่
            $ddate = date("Y-m-d H:i:s");
            
            if(is_array($req->h_id) || is_object($req->h_id)){

                // บันทึก order_tb
                $od = new Order();
                $od->id = $ord_no;
                $od->shop_id = $shop->id;
                $od->channel_id = '2';
                $od->status = '4';
                $od->shipping_id = '0';
                $od->order_date = $ddate;
                $od->total = $req->h_total;
                $od->seller_user_id = Auth::user()->id;
                $od->qty = array_sum($req->h_num);
                $od->save();

                $i = '1';
                // บันทึกรายการสินค้าลง order_item_tb
                foreach($req->h_id as $key => $value){
                    $oditem = new OrderItem();
                    $oditem->order_id = $ord_no;
                    $oditem->id = $i++;
                    $oditem->product_id = $req->h_id[$key];
                    $oditem->product_name = $req->h_name[$key];
                    $oditem->remark = '';
                    $oditem->qty = $req->h_num[$key];
                    $oditem->price = $req->h_price[$key];
                    $oditem->total = $req->h_num[$key] * $req->h_price[$key];
                    $oditem->status = '2';
                    $oditem->save();
                }

                // บันทึก order_payment_tb
                $pay = new OrderPayment();
                $pay->order_id = $ord_no;
                $pay->id = $shop->id;
                $pay->payment_method_id = '1';
                $pay->amount = $req->h_amount;
                $pay->save();

                // บันทึกใบเสร็จ receipt_tb
                $rec = new Receipt();
                $rec->id = $rec_no;
                $rec->shop_id = $shop->id;
                $rec->order_id = $ord_no;
                $rec->bill_title = '-';
                $rec->bill_address = '-';
                $rec->bill_tax = '-';
                $rec->receipt_type = '1';
                $rec->channel_id = '2';
                $rec->status = '1';
                $rec->order_date = $ddate;
                $rec->paid_date = $ddate;
                $rec->total = $req->h_total;
                $rec->seller_user_id = Auth::user()->id;
                $rec->save();


                // update product_tb
                foreach($req->h_id as $key => $value){
                    $upd_product = Product::where('id', $req->h_id[$key])->firstOrFail();
                    $upd_product->qty = $upd_product->qty - $req->h_num[$key];
                    $upd_product->save();
                }

                // update no_tb
                $upd_no = Shop::where('id', $shop->id)->firstOrFail();
                $upd_no->run_order_id = $shop->run_order_id + 1;
                $upd_no->run_receipt_id = $shop->run_receipt_id + 1;
                $upd_no->save();
            }

            // สั่งพิมพ์ใบเสร็จ
            //return $this->print_slip($rec_no);
            return redirect('/print_slip/'.$rec_no.'/'.$shop->receipt_number)->header('Cache-Control', 'no-store, no-cache, must-revalidate');

        }
        catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // พิมพ์ใบเสร็จ
    public function print_slip($rec_no,$rec_num)
    {
        //dd($rec_no);
        $receipt = Receipt::where('id', $rec_no)->first();
        $order = Order::where('id', $receipt->order_id)->first();
        $ord_item = \DB::table('order_item_tb')
                    ->leftJoin('product_tb', 'order_item_tb.id', 'product_tb.id')
                    ->select('order_item_tb.*','product_tb.sku')
                    ->where('order_id', $receipt->order_id)
                    ->get();
        $payment = OrderPayment::where('order_id', $receipt->order_id)->first();
        $shop = Shop::where("user_id",Auth::user()->id)->first();
        $seller = User::where('id', $receipt->seller_user_id)->first();

        $rec = array('','pos.receive.rec_mini3','pos.receive.rec_mini3_vat');
        if(!$rec_num){
            $rec_num = $shop->receipt_number - 1;
        }else{
            $rec_num -= 1;
        }
        
        return view($rec[$shop->receipt_type],[
            'order'=>$order,
            'ord_item'=>$ord_item,
            'receipt'=>$receipt,
            'payment'=>$payment,
            'shop'=>$shop,
            'seller'=>$seller,
            'rec_num'=>$rec_num
            ]);
    }


    // เช็คจำนวนสินค้าในสต๊อก กับจำนวนซื้อ
    // public function check_product(Request $req)
    // {
    //     $over = [];
    //     foreach($req->h_psn as $key => $value){
    //         $prod = $this->type_stock($key);
    //         if($prod[0]->p_stock == '1'){
    //             // เป็นสินค้าที่ต้องตัดสต๊อก
    //             if($prod[0]->psnum < $value){
    //                 $over[$prod[0]->p_name] = $prod[0]->psnum;
    //             }
    //         }
    //     }

    //     return $over;
    // }

    public function check_barcode($shopid,$id)
    {
        $pro = Product::select('id','qty')
                ->where('shop_id','=',$shopid)
                ->where('sku',$id)
                ->where('status','1')
                ->first();
        
        return [$pro->qty, $pro->id];
    }


    // jquery คลิกหมวดหมู่สินค้า
    public function readData($id,$shop)
    {
        //return $id;
        if($id == '0')
        {
            $data = Product::where("shop_id",$shop)->get();
        }
        else
        {
            $data = Product::where("shop_id",$shop)
                            ->where('category_id', $id)
                            ->get();
        }       
        
        return view('pos.pos_product',[
            'shop'=>$shop,
            'product'=>$data
            ]);
    }


}