$(document).ready(function(){
    datatables();
});
function datatables()
{
    var shop_category_table = $('#shop_category_table').DataTable({
        serverSide: true,
        processing: true,
        destroy: true,
        // order: [[ 1, "asc" ]],
        ajax: {
            url: $('#shop_category_table').attr('remote_url'),
            data: {},
        },
        columns: [
            { data: 'position', name: 'position', class: 'text-center' },
            { data: 'name', name: 'name', class: 'text-center' },
            { data: 'product_count', name: 'product_count', class: 'text-center' },
            { data: 'is_active', name: 'is_active', class: 'text-center' },
            { data: 'edit_del', name: 'edit_del', class: 'text-center' },
            { data: 'p_position', name: 'p_position', class: 'text-center' },
        ],
        createdRow: function( row, data, dataIndex ) {
            $.each($('td',row),function(index){
                if(index == 0)
                {
                    // $(this)
                    $(this).attr('category_id', data.id);
                }
            });
            // console.log(data);
            $(row).attr('category_id', data.id);
        },
    });
}
$(document).on('click','#add_shop_category_btn',function(){
    $('#save_category_btn').html("เพิ่ม");
    $('#shop_category_modal').modal('show');
});
$(document).on('submit','#shop_category_form',function(event){
    event.preventDefault();
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
        else{
            datatables();
        }

        // if($('#shop_category_table tbody tr[category_id="'+r.data.id+'"]').length>0)
        // {
        //     $('#shop_category_table tbody tr[category_id="'+r.data.id+'"] td').eq(0).html(r.data.name);
        // }
        // else
        // {
        //     var tr='<tr category_id="'+r.data.id+'">';
        //     tr+='<td>'+r.data.name+'</td>';
        //     tr+='<td>0</td>';
        //     tr+='<td><input class="category_active" type="checkbox" data-width="90" data-on="แสดง" data-off="ไม่แสดง" data-toggle="toggle" data-offstyle="light"></td>';
        
        //     tr+='<td><button type="button" class="btn btn-sm btn-primary edit_category">แก้ไข</button> <button type="button" class="btn btn-sm btn-danger delete_category">ลบออก</button></td>';
        //     tr+='</tr>';
        //     $('#shop_category_table tbody').append(tr);

        //     $('input[type="checkbox"][data-toggle="toggle"]').bootstrapToggle();
        // }
        Load('#shop_category_modal div.modal-content',false);
        $('#shop_category_modal').modal('hide');

    }
    post.send(form);
    // alert(1);
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

        datatables();
        // $('#shop_category_table tbody tr[category_id="'+obj.category_id+'"]').remove();
    }
    post.send(obj);

});

$(document).on('change','#shop_category_table .category_active',function(){
    var tr=$(this).closest('tr');
    var obj=new Object();
    obj.category_id=tr.attr("category_id");
    obj.is_active=$(this).is(':checked');
    console.log(obj);
    var post=new JPost('html');
    post.url='/'+$("#shop_url").val()+'/categories/update/active/json';
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        else{
            // alert('suc');
        }

    }
    post.send(obj);
});


$(document).on('click','.btn_sort',function(){
    // alert(1);
    if($("#position").val() == 0)
    {
        $("#position").val(1);
    }
    else
    {
        $("#position").val(0);
    }
    datatables();
});

$(document).on('change','.p_position',function(){
        
    var url = $("#current_url").val() + '/update_position';
    var obj = new Object();
    obj._token = $('meta[name=csrf-token]').attr('content');
    obj.current_p = parseInt($(this).attr('current_p'));
    obj.current_v = parseInt($(this).val());
    console.log(obj);
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function(res){
            console.log(res);
            if(res.result == 1)
            {
                datatables();
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: res.msg,
                })
            }
        }
    });

});
$(document).on('click','.p_position_up',function(){
    var element = $(this).closest('td').find('.p_position');
    var val = parseInt(element.val()) - 1;
    element.val(val);
    element.change();
});
$(document).on('click','.p_position_down',function(){
    var element = $(this).closest('td').find('.p_position');
    var val = parseInt(element.val()) + 1;
    element.val(val);
    element.change();
});

