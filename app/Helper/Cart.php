<?php
namespace App\Helper;
use Session;
class Cart{
    
    public static function add_to_cart($p,$shop)
    {
        $cart=array();
        if(Session::get('cart'))
        $cart=Session::get('cart');
        
        // dd($p,$shop,$cart);
        if(!isset($cart[$p['shop_id']]))
        {
            
            $cart[$p['shop_id']]=array("shop_id"=>$p['shop_id'],"name"=>$shop->name,'url'=>$shop->url,"items"=>array());
        }

        if(!isset($cart[$p['shop_id']]['items'][$p['product_id']]))
        {
            $cart[$p['shop_id']]['items'][$p['product_id']]=$p;
        }
        else
        {
            // $qty = $p['qty'];
            $old_qty = $cart[$p['shop_id']]['items'][$p['product_id']]['qty'];
            $cart[$p['shop_id']]['items'][$p['product_id']]=$p;
            $cart[$p['shop_id']]['items'][$p['product_id']]['qty']+=$old_qty;
            // $cart[$p['shop_id']]['items'][$p['product_id']]['qty']+=$p['qty'];
        }

        Session::put('cart',$cart);

        return $cart[$p['shop_id']];

    }
    public static function remove_item($shop_id,$product_id)
    {
        if(!Session::get('cart'))
        return null;

        $cart=Session::get('cart');

        if(!isset($cart[$shop_id]))
        return null;

        if(!isset($cart[$shop_id]['items'][$product_id]))
        return null;

        $cart[$shop_id]['items'][$product_id]['qty']=0;

        $data_return=$cart[$shop_id];
        unset($cart[$shop_id]['items'][$product_id]);
        if(count($cart[$shop_id]['items'])==0)
        {
            unset($cart[$shop_id]);
        }
        
        Session::put('cart',$cart);

        return $data_return;
    }
    public static function update_item($shop_id,$product_id,$qty)
    {
         if(!Session::get('cart'))
        return null;

        $cart=Session::get('cart');

        if(!isset($cart[$shop_id]))
        return null;

        $cart[$shop_id]['items'][$product_id]['qty']=$qty;
        $data_return=$cart[$shop_id];
        if($qty<=0)
        {
            unset($cart[$shop_id]['items'][$product_id]);
            if(count($cart[$shop_id]['items'])==0)
            {
                unset($cart[$shop_id]);
            }
        }
        Session::put('cart',$cart);
        return $data_return;
    }
    public static function clear_shop($shop_id){
        if(!Session::get('cart'))
        return null;

        $cart=Session::get('cart');

        if(!isset($cart[$shop_id]))
        return null;

        foreach($cart[$shop_id]['items'] as $product_id=>$data){
            $cart[$shop_id]['items'][$product_id]['qty']=0;
        }
        
        $data_return=$cart[$shop_id];
        unset($cart[$shop_id]);

        Session::put('cart',$cart);

        return $data_return;


    }
    public static function clear()
    {
        Session::put('cart',null);
    }
    public static function get_cart($shop_id=null){
         $cart=array();
        if(Session::get('cart')){
            
            $cart=Session::get('cart');
            // dd($cart);
            if($shop_id!=null)
            {
                if(isset($cart[$shop_id]))
                return $cart[$shop_id];
            }
           
        }

        return $cart;
    }
}