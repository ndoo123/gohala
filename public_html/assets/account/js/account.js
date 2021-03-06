
$(document).on('submit',"#login_form",function(e){
    e.preventDefault();
   
    var post=new PostForm('div.wrapper-page');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        
        Load('div.wrapper-page');
        window.top.location=r.data.redirect;
        // console.log(r);
        // console.log(r.data.redirect);
        
    }
    post.send($("#login_form"));
});
$(document).on('submit',"#register_form",function(e){
    e.preventDefault();
   
    var post=new PostForm('div.wrapper-page');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        
        Load('div.wrapper-page');
        window.top.location=r.data.redirect;
        
    }
    post.send($("#register_form"));
});

$(document).on('click','#add_new_address_btn',function(){
    $('#new_address_modal').modal('show');
});
$(document).on('click','#save_address_btn',function(){
    var form=$("#address_info_form");
    var post=new PostForm('div.modal-content');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }

        var check='';
        var check_btn='btn-outline-success';
        if(r.data.is_default==1){
        check='<i class="fas fa-check"></i>';
        check_btn='btn-success';
        }

        var card='<div user_address_id="'+r.data.id+'" class="card card_user_address p-10" style="border:1px solid #bdbcbc">';
                card+='<div class="card-body m-b-0">';
                    card+='<div class="address_action float-right text-center">';
                        card+='<button address_default="'+r.data.is_default+'" type="button" style="margin-bottom:5px" class="btn btn-sm '+check_btn+' waves-effect waves-light">'+check+' ที่อยู่หลัก</button>';
                        card+='<br>';
                        card+='<button type="button" class="btn btn-sm btn-outline-danger delete_user_address"><i class="far fa-trash-alt"></i> ลบ</button>';
                        card+='<button type="button" class="btn btn-sm btn-outline-info edit_user_address"><i class="far fa-edit"></i> แก้ไข</button>';
                    card+='</div>';
                    card+=r.data.name_address;
                    card+='<h6 style="margin-bottom:0px">'+r.data.address+'</h6>';
                    card+='<span class="text-muted" style="margin-bottom:0px"><i class="fas fa-user-tag"></i> '+r.data.contact_name+' เบอร์ติดต่อ '+r.data.phone+'</span>';
                card+='</div>';
            card+='</div>';
       

       if($('div.card_user_address[user_address_id="'+r.data.id+'"]').length>0)
       {
           $('div.card_user_address[user_address_id="'+r.data.id+'"]').replaceWith(card);
       }
       else
       {
            $("#add_new_address_btn").before(card);
       }
        $("#new_address_modal").modal('hide');

    }
    post.send(form);
});
$(document).on('hidden.bs.modal','#new_address_modal',function(){
    $("#new_address_modal input.input_address").val("");
     $('#new_address_modal select[name="province"]').val("1");
});
$(document).on('click','button.edit_user_address',function(){
    var card=$(this).closest('div.card');
    var post =new JPost('html');
    post.url=app.url+'/profile/address/get';
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }

        $('#new_address_modal input[name="address_id"]').val(r.data.id);
        $('#new_address_modal input[name="name"]').val(r.data.name_address);
        $('#new_address_modal input[name="contact_name"]').val(r.data.name_contact);
        $('#new_address_modal input[name="contact_phone"]').val(r.data.phone);
        $('#new_address_modal input[name="address"]').val(r.data.address);
        $('#new_address_modal input[name="zipcode"]').val(r.data.zipcode);
        $('#new_address_modal select[name="province"]').val(r.data.province_id);
        $('#new_address_modal').modal('show');
    }

    
    post.send({"address_id":card.attr("user_address_id")});
});
$(document).on('click','button.delete_user_address',function(){
    var card=$(this).closest('div.card');
    var con=confirm('ยืนยันการลบที่อยู่?');
    if(con==false)
    return;

    var obj=new Object();
    obj.address_id=card.attr("user_address_id");
   

    var post=new JPost('html');
    post.url=app.url+'/profile/address/delete';
    
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        card.remove();
    }
    post.send(obj);

});
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
     console.log(e.target.result);
     
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}
$(document).on('change','#profile_image',function(){
    Load('body',true);
  console.log($(this).closest('form').submit());
//   console.log($(this).closest('form'));
});
$(document).on('click','#change_profile_image',function(){
    $('#profile_image').click();
});

$(document).on('click','#reset_password_btn',function(){
    var obj=new Object();
    obj.email=$('#forgot_pass_modal input.register_email').val();
    if(obj.email=="")
    {
        alert("กรุณาระบุ Email");
        return;
    }
    var post=new JPost('#forgot_pass_modal div.modal-content');
    post.url='/user/reset_password/send';
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        alert('Reset รหัสผ่านจะถูกส่งไปยังอีเมล์ที่ท่านระบุไว้ ท่านมีเวลา 60 นาทีในการดำเนินการ');
        $('#forgot_pass_modal input.register_email').val("");
        $('#forgot_pass_modal').modal('hide');
    }
    post.send(obj);
});
$(document).on('click','.default_addr',function(){
    var btn = $(this);
    var address_id = $(this).attr('address_id');
    var address_default = $(this).attr('address_default');
    // console.log(address_id);

    var url = location.origin+'/profile/address/default_change';
    // console.log(url);
    // return;
    var obj = new Object();
    obj.address_id = address_id;
    obj._token = $('meta[name=csrf-token]').attr('content');
    // console.log(obj);
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function(res){
            // console.log(res);
            $(".default_addr").addClass('btn-outline-success');
            $(".default_addr").removeClass('btn-success');
            // $(".default_addr").addClass('btn-success');
            if(res.result == 1)
            {
                btn.removeClass('btn-outline-success');
                btn.addClass('btn-success');
            }
        }
    });
});