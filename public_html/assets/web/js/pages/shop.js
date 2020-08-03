get_product();
$(document).on('click','#btn_search',function(){
    var url = location.origin+'/'+$("#rest_url").val()+'?search='+$("#search_product").val();
    window.open(url,'_blank');
});
function get_product(){
    var page=$("#page");
    if(parseInt(page.attr("current_page"))>=parseInt(page.attr("last_page")))
    return;
 
    var obj = new Object();
    obj.search_product = $("#search_product").val();
    console.log(obj);
    var post=new JPost('');
    //
    var url = $("#shop_url").val()+'/get/prooduct/json';
    post.url=url;
    // console.log(url);
    // post.url=page.attr("next_page_url");
    post.success=function(r){
        if(r.result==0)
        {
            console.log(r.msg);
            
            return;
        }
    console.log(r);
    
        var items='';
        for(var i=0;i<r.data.data.length;i++)
        {
            var p=r.data.data[i];
            items+='<div class="col-6 col-md-4 col-xl-3">';
                items+='<div class="grid_item">';
                   if(p.is_discount>0)
                    items+='<span class="ribbon off">-'+p.discount_value+' '+(p.is_discount==1?'฿':'%')+'</span>';                    
                    items+='<figure>';
                        items+='<a href="'+p.link+'">';
                            items+='<img class="img-fluid lazy" src="'+p.photo+'" data-src="'+p.photo+'" alt="'+p.name+'">';
                        items+='</a>';
                    items+='</figure>';
                    items+='<a href="'+p.link+'">';
                        items+='<h3>'+p.name+'</h3>';
                    items+='</a>';
                    items+='<div class="price_box">';
                        items+='<span class="new_price">'+p.discount_price+' ฿</span>';
                       if(p.is_discount!=0)
                        items+='<span class="old_price">'+p.price_format+' ฿</span>';
                    items+='</div>';
                    items+='<ul>';
                        items+='<li><a href="'+p.link+'" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="ซื้อสินค้า"><i class="ti-shopping-cart"></i><span>ซื้อสินค้า</span></a></li>';
                    items+='</ul>';
                items+='</div>';
            items+='</div>';
        }
        $("#product_list").append(items);

        $("#page").attr("current_page",r.data.current_page);
        $("#page").attr("last_page",r.data.last_page);
        $("#page").attr("next_page_url",r.data.next_page_url);


    }
    post.send(obj);
}
