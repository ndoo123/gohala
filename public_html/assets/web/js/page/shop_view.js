$(document).on('change','#sort_product_shop_view',function(){
    window.location=app.url+'/'+$("#shop_url").val()+"?sort="+$(this).val();
});