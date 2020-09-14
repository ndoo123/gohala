function calculate_cart_item(){
       
        var qty=0;
        var total=0;
        $('#cart_top div.dropdown-menu li.item').each(function(){
            // console.log('x1x');
            qty = parseInt($(this).find('span.qty').text());
            total += parseFloat($(this).find('span.price').attr("price"))*qty;
            // console.log(qty);
            // console.log(total);
            // console.log('x2x');
            
        });
        $('#cart_top .total').html(ToMoney(total));
        $('#cart_top a.cart_bt strong').html($('#cart_top div.dropdown-menu li.item').length);
        if($('#cart_top div.dropdown-menu  li.item').length>0)
        {
            $('#cart_top a.cart_bt strong').show();
        }
        else
        {
            $('#cart_top a.cart_bt strong').hide();
        }
}
function remove_from_cart(product_id,shop_id)
{

    var obj=new Object();
    obj.product_id=product_id;
    obj.shop_id=shop_id;
    var post =new JPost('html');
    post.url='/product/remove_cart'
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        console.log(r);
       
        $('#cart_top li.item[product_id="'+product_id+'"]').remove();
        if($('#cart_top ul[shop_id="'+shop_id+'"] li.item').length==0)
        {
            $('#cart_top ul[shop_id="'+shop_id+'"]').remove();
        }
        
        calculate_cart_item();
        
    }
    post.send(obj);
}
function add_to_cart(product_id,qty,shop_url)
{
    var obj=new Object();
    obj.product_id=product_id;
    obj.qty=qty;
    obj.shop_url=shop_url;
    // console.log(obj);
    var post=new JPost('#page');
    post.url='/product/add_to_cart';
    post.success=function(res){
        if(res.result==0)
        {
            alert(res.msg);
            return;
        }
        console.log(res);
        for(var key in res.data.items)
        {
            var p =res.data.items[key];
            if($('#cart_top ul[shop_id="'+res.data.shop_id+'"]').length==0){
                var item_head='<ul shop_id="'+res.data.shop_id+'"><li class="title">'+res.data.name+'</li></ul>';
                $('#cart_top div.dropdown-cart .dropdown-menu').prepend(item_head);
            }

            if($('#cart_top ul[shop_id="'+res.data.shop_id+'"] li[product_id="'+p.product_id+'"]').length==0){
                
                var item='<li class="item" product_id="'+p.product_id+'">';
                item+='<a href="'+p.link+'" title="'+p.name+'">';
                item+='<figure>';
                item+='<img src="'+p.img+'" data-src="'+p.img+'" alt="" width="50" height="50" class="lazy loaded" data-was-processed="true">';
                           item+='</figure>';
                item+='<strong><span class="price" price="'+p.price+'"><span class="qty">1</span>x '+p.name+'</span> '+ToMoney(p.price)+'</strong>';
     
                item+='</a>';
                item+='<a href="javascript:;" onclick="remove_from_cart('+p.product_id+','+res.data.shop_id+')" class="action"><i class="ti-trash"></i></a>';
                item+='</li>';
                $('#cart_top ul[shop_id="'+res.data.shop_id+'"]').append(item);
            }
            else
            {
                $('#cart_top ul[shop_id="'+res.data.shop_id+'"] li[product_id="'+p.product_id+'"] span.qty').html(p.qty);
            }
            
        }

        // var item='';
      
        // if($('#cart_top ul[shop_id="'+res.data.shop_id+'"]').length==0)
        // {
        //     var item_head='<ul shop_id="'+res.data.shop_id+'"><li class="title">'+res.data.name+'</li>';
        //     var item='';
        //     for(var key in res.data.items)
        //     {
        //         var p =res.data.items[key];
               
        //         item+='<li product_id="'+p.product_id+'" class="item">';
        //         item+='<a href="'+p.link+'" title="'+p.name+'">';
        //         item+='<figure>';
        //         item+='<img src="'+p.img+'" data-src="'+p.img+'" alt="" width="50" height="50" class="lazy loaded" data-was-processed="true">';
        //         item+='<strong><span class="price" price="'+p.price+'"><span class="qty">1</span>x '+p.name+'</span> '+ToMoney(p.price)+'</strong>';
        //         item+='</figure>';
        //         item+='</a>';
        //         item+='<a href="javascript:;" onclick="remove_from_cart('+p.product_id+','+res.data.shop_id+')" class="action"><i class="ti-trash"></i></a>';
        //         item+='</li>';
        //     }
        //     item_head+=item+'</ul>';
        //     $('#cart_top div.dropdown-menu').append(item_head);
        // }
        // else
        // {
        //         for(var key in res.data.items)
        //         {
        //             var p =res.data.items[key];
        //             if($('#cart_top ul[shop_id="'+res.data.shop_id+'"] li[product_id="'+p.product_id+'"]').length==0){
                        
        //                 var item='<li product_id="'+p.product_id+'">';
        //                 item+='<a href="'+p.link+'" title="'+p.name+'">';
        //                 item+='<figure>';
        //                 item+='<img src="'+p.img+'" data-src="'+p.img+'" alt="" width="50" height="50" class="lazy loaded" data-was-processed="true">';
        //                 item+='<strong><span class="price" price="'+p.price+'"><span class="qty">1</span>x '+p.name+'</span> '+ToMoney(p.price)+'</strong>';
        //                 item+='</figure>';
        //                 item+='</a>';
        //                 item+='<a href="javascript:;" onclick="remove_from_cart('+p.product_id+','+res.data.shop_id+')" class="action"><i class="ti-trash"></i></a>';
        //                 item+='</li>';
        //                 $('#cart_top ul[shop_id="'+res.data.shop_id+'"]').append(item);
        //             }
        //             else
        //             {
        //                 $('#cart_top ul[shop_id="'+res.data.shop_id+'"] li[product_id="'+p.product_id+'"] span.qty').html(p.qty);
        //             }
                    
        //         }
                    
        // }

     
        // for(var key in res.data.items)
        // {
        //     var p =res.data.items[key];
           
            
        //     if($('#cart-sidebar li[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"]').length==0)
        //     {
        //         item+='<li shop_id="'+res.data.shop_id+'" product_id="'+p.product_id+'" class="item odd">';
        //         item+='<a href="'+p.link+'" title="'+p.name+'" class="product-image">';
        //         item+='<div style="background-image:url('+p.img+')" class="cart_photo"></div>';
        //         item+='</a>';
        //         item+='<div class="product-details"> <a href="javascript:;" product_id="'+p.product_id+'" title="ลบสินค้า" class="remove-cart"><i class="icon-close"></i></a>';
        //         item+='<p class="product-name"><a href="'+p.link+'">'+p.name+'</a> </p><strong>'+p.qty+'</strong> x <span class="price" price="'+p.price+'">'+ToMoney(p.price)+'</span> </div>';
        //         item+='</li>';
        //          $('#cart-sidebar').append(item);
        //     }
        //     else
        //     {
        //         $('#cart-sidebar li[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"] strong').html(p.qty);
        //     }
        // }
       calculate_cart_item();
       
       toastr.info("เพิ่มสินค้าลงในตะกร้าแล้ว")
    }
    post.send(obj);
}
// $(document).on('change','.inc.button_inc',function(){
//     console.log($(this));
// });
// $(document).on('change','.dec.button_inc',function(){
//     console.log($(this));
// });