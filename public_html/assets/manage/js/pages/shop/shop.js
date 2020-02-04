$(document).on('submit',"#new_shop_form",function(e){
    e.preventDefault();
   
    var post=new PostForm('div.modal-content');
    post.success=function(r){
        if(r.result==0)
        {
            alert(r.msg);
            return;
        }
       $("#new_shop_modal").modal('hide');
       Load('html');
      location.reload(true);
        
    }
    post.send($("#new_shop_form"));
});