function select_address(address,is_change){

    if($('#address_card input[name="address_id"]').length==0)
        $('#address_card').prepend('input type="hidden" name="address_id" value="'+address.id+'">');
    else
        $('#address_card input[name="address_id"]').val(address.id);

    $('#address_card p.title').html(address.name_address);
    var contact_row='<div class="col-md-4">';
         contact_row+='<i class="icon fa fa-user"></i>'+address.contact_name;
         contact_row+='</div>';
        contact_row+='<div class="col-md-4">';
        contact_row+='<i class="icon fa fa-phone"></i>'+address.phone;
        contact_row+='</div>';
     $('#address_card div.contact').html(contact_row);
     $('#address_card p.address').html(address.address);

    if(is_change==undefined){
    var addr_row='<tr>';
        addr_row+='<td class="name_address">'+address.name_address+'</td>';
        addr_row+='<td ><span class="address">'+address.address+'</span>';
            addr_row+='<div class="row" style="margin-top:5px">';
                addr_row+='<div class="col-md-4"><i class="icon fa fa-user "></i><span class="contact_name">'+address.contact_name+'</span></div>';
                addr_row+='<div class="col-md-4"><i class="icon fa fa-phone "></i><span class="contact_phone">'+address.phone+'</span></div>';
                addr_row+='</div>';
        addr_row+='</td>';
        addr_row+='<td><button address_id="'+address.id+'" type="button" class="btn btn-sm btn-info select_user_address">เลือก</button></td>';
        addr_row+='</tr>';
    $('#user_address_select tbody').append(addr_row);
    }

     $("#user_address_add").modal('hide');
     $("#user_address_add input").val("");

}
$(document).on('click','#add_new_address_to_select',function(){

    $("#user_address_add").modal('show');
});

$(document).on('click','#add_new_address_btn',function(){
    var obj=new Object();
    obj.name=$("#user_address_add input.address_name").val();
    obj.address=$("#user_address_add input.address").val();
    obj.contact_name=$("#user_address_add input.contact_name").val();
    obj.contact_phone=$("#user_address_add input.contact_phone").val();
    obj.zipcode=$("#user_address_add input.zipcode").val();
    obj.province=$("#user_address_add select.province").val();

    
    if(obj.name =="" || obj.address=="" || obj.contact_name==""||obj.contact_phone==""||obj.zipcode=="")
    {
        alert("กรุณาระบุข้อมูลให้ครบ");
        return;
    }

    var post=new JPost('#user_address_add div.modal-content');
    post.url='/account/user/add_address';
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }

        select_address(r.data);
    }
    post.send(obj);
});

$(document).on('click','#change_address',function(){
    $("#user_address_select").modal('show');
});
$(document).on('click','.select_user_address',function(){
    var tr=$(this).closest('tr');
    var obj=new Object();
    obj.id=$(this).attr("address_id");
    obj.name_address=tr.find('td.name_address').text();
    obj.address=tr.find('span.address').text();
    obj.contact_name=tr.find('span.contact_name').text();
    obj.phone=tr.find('span.contact_phone').text();
    select_address(obj,1);
$("#user_address_select").modal('hide');

});