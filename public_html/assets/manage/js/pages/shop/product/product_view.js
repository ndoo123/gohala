
$( "#image_area" ).sortable();
function allow_file(file)
{
    if(file.type=="image/jpeg" || file.type=="image/png" || file.type=="image/jpg")
    return true;

    return false;
}
function allow_size(file)
{
    //size in kb
    var mb=file.size*0.000001;
    if(mb>20)
    return false;

    return true;
}
function image_preview(image_data)
{
  
    var img_id="n"+Math.floor(Math.random() * 99)+10+""+new Date().getTime();
    var img='<div class="img_preview" tem_img_id="'+img_id+'">';
       
    
        img+='<input type="hidden" name="position[]" value="'+img_id+'">';
        img+='<input type="hidden" name="upload_image['+img_id+']" value="'+image_data+'"><img src="'+image_data+'">';
         img+='<button type="button" class="btn btn-sm btn-danger remove_btn"><i class="far fa-trash-alt"></i></button>';
          img+='<div class="set_default"><i class="fas fa-star"></i></div>';
        img+='</div>';

    return img;
}
function calculate_price(){
    var price=currency($('#product_view_form input[name="price"]').val());
    console.log(price);
    
    if($("#discount_switch").prop("checked")==true)
    {
        var discount_type=$('#product_view_form select[name="discount_type"]').val();
        var discount_amount=currency($('#product_view_form input[name="discount_amount"]').val());
        console.log(discount_amount);
        
        if(discount_type==1)
        {
            if(price-discount_amount<=0){
            discount_amount=0;
             $('#product_view_form input[name="discount_amount"]').val(currency(discount_amount));

            }

            price-=discount_amount;
           
        }
        else if(discount_type==2)
        {
            if(discount_amount>100){
            discount_amount=100;
            $('#product_view_form input[name="discount_amount"]').val(currency(discount_amount));

            }
            else if(discount_amount<0){
            discount_amount=0;
            $('#product_view_form input[name="discount_amount"]').val(currency(discount_amount));

            }
            
            price-=(price*(discount_amount/100));

        }
    }
    if(price<=0)
    price=0;

    $("#product_price_total").val(currency(price,',').format());
}
$(document).on('change','#discount_switch,#product_view_form input[name="price"],#product_view_form select[name="discount_type"],#product_view_form input[name="discount_amount"]',function(){
   
    
calculate_price();
});
$(document).on('click','#file_selector',function(){
    $("#file_input").click();
});
$(document).on('change','#file_input',function(e){
   
    if (e.target.files.length==0)
    return;

    
    for(var i=0;i<e.target.files.length;i++)
    {
        if(!allow_file(e.target.files[i]))
        continue;

        if(!allow_size(e.target.files[i]))
        continue;

        var reader = new FileReader();
        reader.onload = function(e) {
            $("#image_area").append(image_preview( e.target.result));
        }
        reader.readAsDataURL(e.target.files[i]);
    }
  
});
$(document).on('click','div.set_default',function(){
    $('div.set_default').removeClass('active_default');
    $(this).addClass('active_default');
    var img=$(this).parent();
    if(img.attr("tem_img_id")!=undefined)//new upload image
    {
        $('input[name="set_default"]').val(img.attr("tem_img_id"));
    }
    else if(img.attr("img_id")!=undefined)//uploaded image
    {
        $('input[name="set_default"]').val(img.attr("img_id"));
    }
    
});
$(document).on('click','button.remove_btn',function(){
    var img_preview=$(this).closest('div.img_preview');
    if(img_preview.attr("img_id")==undefined)
    {
        img_preview.remove();
        return;
    }
    $("#image_area").append('<input type="hidden" name="delete_image[]" value="'+img_preview.attr("img_id")+'">');
    img_preview.hide();

});
$(document).on('change','#discount_switch',function(){
   if($(this).prop('checked')==false)
   {
       $("#discount_price_panel").hide();
   }
   else
   {
        $("#discount_price_panel").show();
   }
    
});
$(document).on('keyup','#product_view_form input[name="name"]',function(){
    $("#product_title_name").html($(this).val());
});
$(document).on('submit','#product_view_form',function(e){
    e.preventDefault();

    var post=new PostForm('body');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
    
      console.log(r);
      
       if($('#product_view_form input[name="product_id"]').val()=="")
       {
           Load('body',true);
           window.top.location=app.url+'/product/'+r.data.product.id;
       }
       else
       {
           alert('บันทึกสำเร็จ');
           $("#slug span").html(r.data.product.slug);

           //check upload image
           if(r.data.upload_image_response!=undefined)
           {
               for(var i=0;i<r.data.upload_image_response.length;i++)
               {
                    var img=r.data.upload_image_response[i];
               
                    
                    var img_dom=$('input[name="upload_image['+img.ref_id+']"]');
                  
                    
                    var img_preview=img_dom.closest('div.img_preview');
                    img_preview.attr("img_id",img.name);
                    img_dom.remove();
                 
               }
           }
       }
        
    }
    post.send($(this));
});
$(document).ready(function(){
calculate_price();
});
