// $(document).ready(function(){
//     let no_home_popup=localStorage.getItem("no_home_popup");
//     if(no_home_popup==undefined)
//     {
//     $("#news_latter_modal").modal('show');
//     }
// });
// $(document).on('hidden.bs.modal','#news_latter_modal',function(){
//    if($("#notshowpopup").is(":checked")==true)
//    {
//        localStorage.setItem("no_home_popup",1);
//    }
    
// });
function load_products_page(){
    var get=new JGet('div.shop-inner');
    get.url='/home/get/products';
    get.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        console.log(r);
        var items='';
        for(var i=0;i<r.data.products.length;i++)
        {
            items+=add_product_to_page(r.data.products[i]);
        }
        $('ul.products-grid').append(items);

    }
    get.send();
}
function add_product_to_page(p){
    var item=' <li class="item col-lg-3 col-md-4 col-sm-6 col-xs-6 ">';
            item+='<div class="product-item">';
            item+='<div class="item-inner">';
                item+='<div style="background-image:url('+app.url+'/images/product/'+p.shop_id+'/'+p.id+'.'+p.default_photo+'.jpg)" class="product-thumbnail">';
                if(p.is_discount==1)
                item+='<div class="icon-sale-label sale-left">ลด</div>';
                // item+='<div class="icon-new-label new-right">New</div>';
                item+='<div class="pr-img-area"> <a title="'+p.name+'" href="'+app.url+'/product/'+p.slug+'.'+p.shop_id+'">';
                    item+='<figure> </figure>';
                    item+='</a>';
                    item+='<button type="button" product_id="'+p.id+'" class="add-to-cart-mt"> <i class="fa fa-shopping-cart"></i><span> ซื้อสินค้า</span> </button>';
                item+='</div>';
  
                item+='</div>';
                item+='<div class="item-info">';
                item+='<div class="info-inner">';
                    item+='<div class="item-title"> <a title="'+p.name+'" href="'+app.url+'/product/'+p.name+'.'+p.shop_id+'">'+p.name+'</a> </div>';
                    item+='<div class="item-content">';
                    // item+='<div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
                    item+='<div class="item-price">';
                        item+='<div class="price-box"> <span class="regular-price"> <span class="price">'+ToMoney(p.price)+'</span> </span> </div>';
                    item+='</div>';
                    item+='</div>';
                item+='</div>';
                item+='</div>';
            item+='</div>';
            item+='</div>';
        item+='</li>';
    return item;
}
load_products_page();