<?php

namespace App\Http\Controllers\Pos;

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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
       $data['pcats']=ProductCategory::get();
       $data['products']=Product::where("shop_id",$req->id)->get();
       return view('pos.pos',$data);
   }

   public function autocomp(Request $req)
   {
       $res = array();

       $datas = Product::get();
       
    //    $datas = Product::where('qty','>','0')
    //            ->where('status','1')
    //            ->where("name","LIKE","%".$req->term."%")
    //            ->where("shop_id",$req->id)
    //            ->get();
       
       foreach($datas as $data){
           $res[] = ['id'=>$data->id, 'value'=>$data->name, 'sku'=>$data->sku ];
       }
       
       return response()->json($res);

       //return response()->json($data);
   }

    // jquery
    public function readData($id, $shop)
    {
        //return $id;
        if($id != '0')
        {
            $data = Product::where('shop_id',$shop)
                ->where('category_id',$id)
                ->where('status','1')
                ->orderBy('name','asc')
                ->get();
        }
        else
        {
            $data = Product::where('shop_id',$shop)
                ->where('status','1')
                ->orderBy('category_id','asc')
                ->orderBy('name','asc')
                ->get();
        }
        

        return view('pos.pos_product',[
            'data'=>$data
            ]);
    }

    // jquery
    public function read_barcode($sku,$shopid)
    {
        //$pro = TbProduct::where('p_id',$id)->first();
        $pro = Product::where('shop_id','=',$shopid)
                ->where('sku',$sku)
                ->first();

        $txt = '<tr>
        <input type="hidden" name="h_id[]" value="'.$pro->id.'">
        <input type="hidden" name="h_name[]" value="'.$pro->name.'">
        <input type="hidden" name="h_price[]" value="'.$pro->price.'">
        <input type="hidden" id="h_num'.$pro->id.'" name="h_num[]" value="1">
        <td class="text-left">'. $pro->name .'</td>
        <td class="text-center" id="num'.$pro->id.'">1</td>
        <td class="text-center" id="price'.$pro->id.'">'. $pro->price .'</td>
        <td class="text-center">
            <a  class="btn-del" pId="'.$pro->id.'" onclick="del_one('.$pro->id.')"><i class="fa fa-trash text-danger"></i></a>
        </td></tr>';

        
        return $txt;
    }

    // เมื่อคลิกปุ่ม บันทึก/พิมพ์ หน้า POS
    public function pos_save(Request $req)
    {
        
        // try
        // {
            $shop = Shop::where("user_id",Auth::user()->id)->first();

            // เลขที่ใบเสร็จ
            $rec_no = 'R'.$shop->id.'#'.date('ym').$shop->run_receipt_id;
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
                $od->run_item_id = '1';
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
                $pay->id = $od->run_item_id;
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

                // update no_tb
                $upd_no = Shop::where('id', $shop->id)->firstOrFail();
                $upd_no->run_order_id = $shop->run_order_id + 1;
                $upd_no->run_receipt_id = $shop->run_receipt_id + 1;
                $upd_no->save();
            }

            // สั่งพิมพ์ใบเสร็จ
            return $this->go_to_bill($rec_no, $ord_no);

        // }
        // catch(Exception $e)
        // {
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
    }

    private function go_to_bill($rec_no, $ord_no)
    {
        $order = Order::where('id', $ord_no)->first();

        $ord_item = OrderItem::where('order_id', $ord_no)->get();

        $receipt = Receipt::where('id', $rec_no)->first();

        $payment = OrderPayment::where('order_id', $ord_no)->first();

        $shop = Shop::where("user_id",Auth::user()->id)->first();

        //$rec = array('','sale.rec_mini3','sale.rec_mini3_vat','sale.rec_a5','sale.rec_a5_vat');
        
        return view('pos.receive.rec_mini3_vat',[
            'order'=>$order,
            'ord_item'=>$ord_item,
            'receipt'=>$receipt,
            'payment'=>$payment,
            'shop'=>$shop
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
        $pro = Product::select('qty')
                ->where('shop_id','=',$shopid)
                ->where('sku',$id)
                ->where('status','1')
                ->first();
        
        return $pro->qty;
    }


}