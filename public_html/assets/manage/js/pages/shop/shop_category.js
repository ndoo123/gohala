$(document).on('click','#add_shop_category_btn',function(){
    $('#save_category_btn').html("เพิ่ม");
    $('#shop_category_modal').modal('show');
});
$(document).on('click','#save_category_btn',function(){
   
    if($('#shop_category_modal input[name="name"]').val()=="")
    {
        alert("กรุณาระบุชื่อ");
        return;
    }
    var form=$('#shop_category_modal form');
    var post=new PostForm('#shop_category_modal div.modal-content');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        if($('#shop_category_table tbody tr[category_id="'+r.data.id+'"]').length>0)
        {
            $('#shop_category_table tbody tr[category_id="'+r.data.id+'"] td').eq(0).html(r.data.name);
        }
        else
        {
            var tr='<tr category_id="'+r.data.id+'">';
            tr+='<td>'+r.data.name+'</td>';
            tr+='<td>0</td>';
            tr+='<td><input class="category_active" type="checkbox" data-width="90" data-on="แสดง" data-off="ไม่แสดง" data-toggle="toggle" data-offstyle="light"></td>';
        
            tr+='<td><button type="button" class="btn btn-sm btn-primary edit_category">แก้ไข</button> <button type="button" class="btn btn-sm btn-danger delete_category">ลบออก</button></td>';
            tr+='</tr>';
            $('#shop_category_table tbody').append(tr);

            $('input[type="checkbox"][data-toggle="toggle"]').bootstrapToggle();
        }
       
        $('#shop_category_modal').modal('hide');

    }
    post.send(form);
});
$(document).on('hidden.bs.modal','#shop_category_modal',function(){
    $('#shop_category_modal input.input_txt').val("");
});

$(document).on('click','.edit_category',function(){
    var tr=$(this).closest('tr');
    var obj=new Object();
    obj.category_id=tr.attr("category_id");
    
    var post=new JPost('html');
    post.url='/'+$("#shop_url").val()+'/categories/get/json';
    
    post.success=function(r){
        if(r.result==0)
        return alert(r.msg);

        $('#shop_category_modal input[name="name"]').val(r.data.name);
        $('#shop_category_modal input[name="category_id"]').val(r.data.id);
        $('#save_category_btn').html("บันทึก");
        $('#shop_category_modal').modal('show');
    }
    post.send(obj);

});

$(document).on('click','.delete_category',function(){
    var c=confirm("ยืนยันการลบหมวดหมู่?");
    if(c==false)
    return;
    var tr=$(this).closest('tr');
    var obj=new Object();
    obj.category_id=tr.attr("category_id");
    
    var post=new JPost('html');
    post.url='/'+$("#shop_url").val()+'/categories/delete/json';
    
    post.success=function(r){
        if(r.result==0)
        return alert(r.msg);

        $('#shop_category_table tbody tr[category_id="'+obj.category_id+'"]').remove();
    }
    post.send(obj);

});

$(document).on('change','#shop_category_table .category_active',function(){
    var tr=$(this).closest('tr');
    var obj=new Object();
    obj.category_id=tr.attr("category_id");
    obj.is_active=$(this).is(':checked');

    var post=new JPost('html');
    post.url='/'+$("#shop_url").val()+'/categories/update/active/json';
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }

    }
    post.send(obj);
});