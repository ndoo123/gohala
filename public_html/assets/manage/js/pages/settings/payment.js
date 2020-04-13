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
        console.log(r);
        
         $('#payment').prepend(alert_show("success","บันทึกสำเร็จ"));
    }
    post.send(form);
    
});