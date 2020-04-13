$(document).on('submit','#info',function(e){
    e.preventDefault();
    var form=$('#info form');
    var post=new PostForm('body');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        $('#info div.alert').remove();
        $('#info').prepend(alert_show("success","บันทึกสำเร็จ"));
        $('.shop_name').html($('#info form input[name="name"]').val());
        
    }
    post.send(form);
    
});