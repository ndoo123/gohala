
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
        if(res.result==0)
        {
            alert(res.msg);
            return;
        }
         if(qty<=0)
        {
            tr.remove();
        }
        
    }
 post.send(obj);
    
});