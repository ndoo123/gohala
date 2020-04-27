$(document).on('submit','#payment form',function(e){
    e.preventDefault();
    var form=$('#payment form');
    var post=new PostForm('body');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }

        $('#payment').prepend(alert_show("success","บันทึกสำเร็จ"));
    }
    post.send(form);
    
});
$(document).on('click','#edit_payment_bank_transfer_btn',function(){
    $('tr.bank_acc_transfer_row').remove();
    var bank_acc=$('input[name="payment_data[2]"]').val();
    if(bank_acc!="")
    {
        bank_acc=JSON.parse(bank_acc);
    }
    if(bank_acc!="")
    {
        var row='';
        for(var i=0;i<bank_acc.length;i++)
        {
            if(bank_acc[i].bank_name!="" && bank_acc[i].account_name!="" &&bank_acc[i].account_no!="")
            {
            row+='<tr class="bank_acc_transfer_row">';
                row+='<td><input type="text" class="form-control bank_name"  value="'+bank_acc[i].bank_name+'"></td>';
                row+='<td><input type="text" class="form-control account_name"  value="'+bank_acc[i].account_name+'"</td>';
                row+='<td><input type="text" class="form-control account_no"  value="'+bank_acc[i].account_no+'"></td>';
                row+='<td><button type="button" class="btn btn-sm btn-danger remove_bank_transfer_btn">X</button></td>';
            row+='</tr>';
            }
        }
        $('#shop_payment_bank_transfer_modal tr.add_row').before(row);
    }
    
    $('#shop_payment_bank_transfer_modal').modal('show');
});
$(document).on('click','#add_bank_row',function(){
    var row='<tr class="bank_acc_transfer_row">';
        row+='<td><input type="text" class="form-control bank_name"  value=""></td>';
        row+='<td><input type="text" class="form-control account_name"  value=""</td>';
        row+='<td><input type="text" class="form-control account_no"  value=""></td>';
        row+='<td><button type="button" class="btn btn-sm btn-danger remove_bank_transfer_btn">X</button></td>';
    row+='</tr>';
    $('#shop_payment_bank_transfer_modal tr.add_row').before(row);
});
$(document).on('click','.remove_bank_transfer_btn',function(){
    $(this).closest('tr').remove();
});
$(document).on('click','#save_shop_payment_bank_transfer',function(){
    var obj=new Array();
    $('tr.bank_acc_transfer_row').each(function(){
        var acc={
            "bank_name":$(this).find('input.bank_name').val(),
            "account_name":$(this).find('input.account_name').val(),
            'account_no':$(this).find('input.account_no').val()
            };
        obj.push(acc);
    });

    $('input[name="payment_data[2]"]').val(JSON.stringify(obj));
    $('#shop_payment_bank_transfer_modal').modal('hide');
});