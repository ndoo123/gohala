$(document).on('submit','#pos',function(e){
    e.preventDefault();
    var form=$('#pos form');
    var post=new PostForm('body');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
        $('#pos div.alert').remove();
        $('#pos').prepend(alert_show("success","บันทึกสำเร็จ"));
        $('.shop_name').html($('#pos form input[name="name"]').val());
        
    }
    post.send(form);
    
});