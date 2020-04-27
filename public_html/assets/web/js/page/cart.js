function calculate_cart_page_total(){
    var total=0;
    var qty=0;
    $('tr.cart_item').each(function(){
        var row_qty=parseInt($(this).find('td.qty input').val());
        qty+=row_qty;
        total+=row_qty*parseFloat($(this).find('td.price').attr('price'));
    });

    $('span.grand_total').html(ToMoney(total));

}
function update_cart_page_items(data)
{
    var shop_total=0;
    for(var key in data.items)
    {
        var p =data.items[key];
        if($('tr[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"]').length!=0)
        {
            if(p.qty==0)
            {
                $('tr[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"]').remove();
                if($('tr[shop_id="'+p.shop_id+'"]').length==0)
                {
                    $('div.shop_card[shop_id="'+p.shop_id+'"]').remove();
                }
            }
            else
            {
                var total=parseInt(p.qty)*parseFloat(p.price);
                shop_total+=total;
                $('tr[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"] td.qty input').val(p.qty);
                $('tr[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"] td.qty input').attr("default",p.qty);
     
                $('tr[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"] td.total').attr("total",total);
                $('tr[shop_id="'+p.shop_id+'"][product_id="'+p.product_id+'"] td.total span').html(ToMoney(total));
            }
            
        }
    }
    $('div.shop_card[shop_id="'+data.shop_id+'"] tfoot strong.shop_total').html(ToMoney(shop_total));
    
    update_header_cart_item(data);
    calculate_cart_page_total();
}
$(document).on('click','a.remove_cart_item',function(){
    var tr=$(this).closest('tr');
    var obj=new Object();
    obj.product_id=tr.attr("product_id");
    obj.shop_id=tr.attr("shop_id");
    var post =new JPost('body');
    post.url='/product/remove_cart'
    post.success=function(r){
        console.log(r);
        
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }

        if(r.data==null)
        {
            tr.remove();
            if($('tr[shop_id="'+obj.shop_id+'"]').length==0)
            {
                $('div.shop_card[shop_id="'+obj.shop_id+'"]').remove();
            }
        }
        else
        {
            update_cart_page_items(r.data);
           

        }
      
        
    }
    post.send(obj);
});
$(document).on('click','button.remove_all_cart_shop',function(){
    var card=$(this).closest('div.shop_card');
    var obj=new Object();
    obj.shop_id=card.attr("shop_id");
    var post=new JPost('body');
    post.url='/cart/shop/clear';
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        card.remove();
        update_header_cart_item(r.data);
        
    }
    post.send(obj);
});
calculate_cart_page_total();

$(document).on('change','tr.cart_item td.qty input',function(){
    var tr=$(this).closest('tr');
    var qty_default=$(this).attr("default");
    var qty=parseInt($(this).val());
    var obj=new Object();
    obj.qty=qty;
    obj.shop_id=tr.attr("shop_id");
    obj.product_id=tr.attr("product_id");

    if(isNaN(qty))
    {
        alert("ระบุจำนวนไม่ถูกต้อง");
        $(this).val(qty_default);
        return;
    }

    var post=new JPost('body');
    post.url='/cart/item/update';
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }

        update_cart_page_items(r.data);
        
    }
    post.send(obj);
});