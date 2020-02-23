<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Product;
use App\Models\ProductSlug;
use App\Models\ProductPhoto;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

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
       
       $datas = Product::where('qty','>','0')
               ->where('status','1')
               ->where("name","LIKE","%".$req->term."%")
               ->where("shop_id",$req->id)
               ->get();
       
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
        <td class="text-left">'. $pro->name .'</td>
        <td class="text-center" id="num'.$pro->id.'">1</td>
        <td class="text-center" id="price'.$pro->id.'">'. $pro->price .'</td>
        <td class="text-center">
            <a  class="btn-del" pId="'.$pro->id.'" onclick="del_one('.$pro->id.')"><i class="fa fa-trash text-danger"></i></a>
        </td></tr>';

        
        return $txt;
    }


}