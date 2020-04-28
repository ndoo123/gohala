function load_basket()
{
    // $('div.shoppingcart-inner span.cart-total').html("0 รายการ: 0.00");
    // $("#cart-sidebar").html("");
    // var basket=JSON.parse(window.localStorage.getItem('basket'));
  
    // var total=0;
    //  var qty=0;
    // if(basket!=null)
    // {
        
    //     for(var i=0;i<basket.length;i++)
    //     {
    //         qty+=parseInt(basket[i].qty);
    //        var li='<li class="item product_'+basket[i].id+'">';
    //         li+='<a href="'+basket[i].link+'" title="'+basket[i].name+'" class="product-image">';
    //             li+='<img src="'+basket[i].img+'" alt="'+basket[i].name+'" width="65">';
    //         li+='</a>';
    //         li+='<div class="product-details">';
    //         li+='<a href="javascript:;" product_id="'+basket[i].product_id+'" title="ลบสินค้า" class="remove-cart"><i class="icon-close"></i></a>';
    //         li+='<p class="product-name"><a href="'+basket[i].link+'">'+basket[i].name+'</a> </p>';
    //         li+='<span class="price">'+ToMoney(basket[i].price)+'</span> x <strong class="qty">'+basket[i].qty+'</strong>';
    //         li+=' </div>';
    //         li+='</li>';
    //         $("#cart-sidebar").append(li);
    //         total+=parseFloat(basket[i].price)*parseInt(basket[i].qty);
    //     }
    //     $(".top-subtotal span.price").html(ToMoney(total)+" บาท");
    //     $("div.shoppingcart-inner span.cart-total").html(qty+" รายการ: "+ToMoney(total));
    // }
}
function load_cart_page()
{
    var basket=JSON.parse(window.localStorage.getItem('basket'));
   
    $('div.shoppingcart-inner span.cart-total').html("0 รายการ: 0.00");
    var grand_total=0;
    var qty=0;
    if(basket!=null)
    {
        var row='';
        for(var i=0;i<basket.length;i++)
        {
            var total=parseFloat(basket[i].price)*parseInt(basket[i].qty);
            qty+=basket[i].qty;
            row+='<tr>';
                row+='<td class="cart_product"><a href="javascript:;"><img src="'+basket[i].img+'" alt="'+basket[i].name+'"></a></td>';
                row+='<td class="cart_description"><p class="product-name"><a href="'+basket[i].link+'">'+basket[i].name+'</a></p>';
                row+='<td class="price"><span>'+basket[i].price+'</span></td>';
                row+='<td class="qty"><input class="form-control input-sm" type="text" value="'+basket[i].qty+'"></td>';
                row+='<td class="price"><span>'+ToMoney(total)+'</span></td>';
                row+='<td class="action"><a href="javascript:;" class="remove_item_cart" product_id="'+basket[i].product_id+'"><i class="icon-close"></i></a></td>';
            row+='</tr>';
            grand_total+=total;

        }
        $('table.cart_summary tbody').html(row);
        $('table.cart_summary tfoot strong.grand_total').html(ToMoney(grand_total)+" บาท");
        $('div.shoppingcart-inner span.cart-total').html(qty+" รายการ: "+ToMoney(grand_total));
    }
   
}
function calculate_cart_item(){
       
        var qty=0;
        var total=0;
 $('#cart-sidebar li.item').each(function(){
            qty+=parseInt($(this).find('strong').text());
            total+=parseFloat($(this).find('span.price').attr("price"))*parseInt($(this).find('strong').text());
        });
        $('span.cart-total').html(qty+" รายการ: "+ToMoney(total));
        $('div.top-subtotal span.price').html(ToMoney(total));
}
function add_to_cart(product_id,qty)
{
    var basket=JSON.parse(window.localStorage.getItem('basket'));   
    var obj=new Object();
    obj.product_id=product_id;
    obj.qty=qty;
    var post=new JPost('body');
    post.url='/product/add_to_cart';
    post.success=function(res){
        if(res.result==0)
        {
            alert(res.msg);
            return;
        }
        console.log(res);
        
        var item='';
      
        if($('#cart-sidebar li.shop_basket_header[shop_id="'+res.data.shop_id+'"]').length==0)
        {
            var item_head='<li shop_id="'+res.data.shop_id+'" class="shop_basket_header">'+res.data.name+'</li>';
            $('#cart-sidebar').append(item_head);
        }

     
        for(var key in res.data.items)
        {
            var p =res.data.items[key];
           
            
            if($('#cart-sidebar li[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"]').length==0)
            {
                item+='<li shop_id="'+res.data.shop_id+'" product_id="'+p.product_id+'" class="item odd">';
                item+='<a href="'+p.link+'" title="'+p.name+'" class="product-image">';
                item+='<div style="background-image:url('+p.img+')" class="cart_photo"></div>';
                item+='</a>';
                item+='<div class="product-details"> <a href="javascript:;" product_id="'+p.product_id+'" title="ลบสินค้า" class="remove-cart"><i class="icon-close"></i></a>';
                item+='<p class="product-name"><a href="'+p.link+'">'+p.name+'</a> </p><strong>'+p.qty+'</strong> x <span class="price" price="'+p.price+'">'+ToMoney(p.price)+'</span> </div>';
                item+='</li>';
                 $('#cart-sidebar').append(item);
            }
            else
            {
                $('#cart-sidebar li[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"] strong').html(p.qty);
            }
        }
       calculate_cart_item();
       
        
        // $('#cart-sidebar')
        // if(basket==null){
           
            
        //     var items=new Array();
        //     items.push(res.data);
        //     window.localStorage.setItem('basket',JSON.stringify(items));
        // }
        // else
        // {
            
        //      var added=false;
        //     for(var i=0;i<basket.length;i++)
        //     {
        //         if(basket[i].product_id==res.data.product_id){
        //         basket[i].price=res.data.price;
        //         basket[i].qty=parseInt(basket[i].qty)+parseInt(res.data.qty);
        //         added=true;
        //         break;
        //         }
        //     }
        //     if(added==false)
        //     {
        //         basket.push(res.data);
        //         window.localStorage.setItem('basket',JSON.stringify(basket));
        //     }
        //     window.localStorage.setItem('basket',JSON.stringify(basket));
        // }
        toastr.info("เพิ่มสินค้าลงในตะกร้าแล้ว")
       
    
        // load_basket();
       
       
    }
    post.send(obj);
}

function summary_payment()
{
    var basket=JSON.parse(window.localStorage.getItem('basket'));
   
    
    var grand_total=0;
    if(basket!=null)
    {
        var row='';
        for(var i=0;i<basket.length;i++)
        {
            var total=parseFloat(basket[i].price)*parseInt(basket[i].qty);
            grand_total+=total;
        }

        $('#payment_form span.summary_total').html(ToMoney(grand_total));
    }
      $('table.cart_summary tfoot strong.grand_total').html(ToMoney(grand_total)+" บาท");
}
$(document).on('change','#is_bill_different',function(){
    if($(this).is(':checked'))
    {
        $('#bill_address').show();
    }
    else
    {
        $('#bill_address').hide();
    }
});

// $(document).on('click','.remove_item_cart',function(){
//     var basket=JSON.parse(window.localStorage.getItem('basket'));
   
//     if(basket!=null)
//     {
//         for(var i=0;i<basket.length;i++)
//         {
           
            
//             if(basket[i].product_id==$(this).attr("product_id"))
//             {
               
                
//                 remove_from_cart(basket[i].product_id);
//                 summary_payment();
            
//                 $(this).closest('tr').remove();
//                 break;
//             }
//         }
//     }
// });

$(document).on('click','button.add-to-cart-mt',function(){

   add_to_cart($(this).attr('product_id'),1)

});

$(document).on('click','button.pro-add-to-cart',function(){
    var qty=$("#qty").val();
    if(isNaN(qty))
    {
        alert("ระบุจำนวนไม่ถูกต้อง");
        return;
    }
    add_to_cart($(this).attr('product_id'),$("#qty").val());
});
function update_header_cart_item(data)
{
    for(var key in data.items)
    {
        var p =data.items[key];
        if($('#cart-sidebar li[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"]').length!=0)
        {
            if(p.qty==0)
            {
                $('#cart-sidebar li[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"]').remove();
                if($('#cart-sidebar li.item[shop_id="'+data.shop_id+'"]').length==0)
                {
                    $('#cart-sidebar li.shop_basket_header[shop_id="'+data.shop_id+'"]').remove();
                }
            }
            else
            {
                $('#cart-sidebar li[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"] strong').html(p.qty);
            }
            
        }
    }
    calculate_cart_item();
    
   
}
$(document).on('click','#cart-sidebar a.remove-cart',function(){

    var li=$(this).closest('li');
    var obj=new Object();
    obj.product_id=li.attr("product_id");
    obj.shop_id=li.attr("shop_id");
    var post =new JPost('#cart-sidebar');
    post.url='/product/remove_cart'
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        console.log(r);
        if(r.data==null)
        {
            li.remove();
            if($('#cart-sidebar li.item[shop_id="'+obj.shop_id+'"]').length==0)
            {
                $('#cart-sidebar li.shop_basket_header[shop_id="'+obj.shop_id+'"]').remove();
            }
        }
        else
        {
            update_header_cart_item(r.data);
        }
        
    }
    post.send(obj);
});