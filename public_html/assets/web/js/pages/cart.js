
function calculate_cart(){

}
$(document).on('click','button.remove_shop_from_cart',function(){
    var c =confirm("ต้องการจะลบสินค้าร้านนี้ออกจากตระกร้า?");
    if(c==false)
    return;
    
    var btn=$(this);
    var obj=new Object();
    obj.shop_id=btn.attr("shop_id");
    var post=new JPost('#page');
    post.url='/cart/shop/clear';
    post.success=function(res){
        if(res.result==0)
        {
            alert(res.msg);
            return;
        }
        btn.closest('div.card').remove();
    }
    post.send(obj);
});
$(document).on('click','div.button_inc',function(){
    var tr=$(this).closest('tr');
    var qty=parseInt(tr.find('input.qty').val());
  
    
    var obj=new Object();
    obj.product_id=tr.attr("product_id");
    obj.shop_id=tr.attr("shop_id");
    obj.qty=tr.find('input.qty').val();
    var post=new JPost('#page');
    post.url='/product/update_cart';
    post.success=function(res){
        console.log(res);
        if(qty<=0)
        {
            tr.remove();
        }
        if(res.result==0)
        {
            alert(res.msg);
            return;
        }
        else
        {
            for(index in res.data.items)
            {
                obj = res.data.items[index];
                // console.log(obj['product_id']);
                var tr = $("table tr[product_id='" + obj['product_id'] + "']");
                tr.find('.sum_product').html((parseInt(obj['price']) * parseInt(obj['qty'])).toFixed(2));
            }
            $("table").each(function(index , table){
                // console.log(index);
                var sum_res = 0;
                console.log(typeof(sum_res));
                console.log(table);
                var tr = $(table).find('tbody tr');
                tr.each(function(t_index, t){
                    // console.log(t);
                    // console.log($(t).attr('product_id'));
                    // console.log($(t).attr('product_id') !== undefined);
                    if($(t).attr('product_id') !== undefined)
                    {
                        // console.log(t);
                        sum_res += parseFloat($(t).find('.sum_product').html());
                        console.log(parseFloat($(t).find('.sum_product').html()));
                        // console.log(sum_res);
                        // console.log(t_index);
                    }
                    else
                    {
                        console.log(sum_res);
                        $(t).find('.sum_res').html(sum_res.toFixed(2));
                    }
                });
            });
        }
        
    }
 post.send(obj);
    
});