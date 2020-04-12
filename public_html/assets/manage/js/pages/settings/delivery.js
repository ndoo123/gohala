$(document).on('submit','#delivery form',function(e){
    e.preventDefault();
    var form=$('#delivery form');
    var post=new PostForm('body');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        console.log(r);
         $('#delivery').prepend(alert_show("success","บันทึกสำเร็จ"));
        
    }
    post.send(form);
    
});
$(document).on('click','button.set_ship_method_btn',function(){
    $('#ship_setting_modal').attr("ship_method_id",$(this).attr("ship_method_id"));
    $('#ship_setting_modal').modal('show');
});
$(document).on('hidden.bs.modal','#ship_setting_modal',function(){
    $('#ship_setting_modal input.cost').val("");
    $('#ship_setting_modal select.cal_type').val("1");
});

$(document).on('click','#save_ship_method_info_btn',function(){
    var obj=new Object();
    obj.method_id=$('#ship_setting_modal').attr("ship_method_id");
    obj.cost=$('#ship_setting_modal input.cost').val();
    obj.cal_type=$('#ship_setting_modal select.cal_type').val();
    console.log(obj);
    
    if(obj.cost=="")
    {
        alert("ต้องระบุค่าส่ง");
        return;
    }

    $('#delivery input[name="ship_cost['+obj.method_id+']"]').val(obj.cost);
    $('#delivery input[name="ship_cal['+obj.method_id+']"]').val(obj.cal_type);
    $('#delivery table tr[method_id="'+obj.method_id+'"] td.ship_cost').html(obj.cost);
    $('#delivery table tr[method_id="'+obj.method_id+'"] td.cal_type').html($('#ship_setting_modal select.cal_type option:selected').text());
    $('#ship_setting_modal').modal('hide');

});