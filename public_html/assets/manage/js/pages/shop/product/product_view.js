function allow_file(file)
{
    if(file.type=="image/jpeg" || file.type=="image/png" || file.type=="image/jpg")
    return true;

    return false;
}
function allow_size(file)
{
    //size in kb
    var mb=file.size*0.000001;
    if(mb>20)
    return false;

    return true;
}
function image_preview(image_data)
{
    var img='<div class="img_preview">';
       
        img+='<img src="'+image_data+'">';
         img+='<button class="btn btn-sm btn-danger remove_btn"><i class="far fa-trash-alt"></i></button>';
          img+='<div class="set_default"><i class="fas fa-star"></i></div>';
        img+='</div>';

    return img;
}
$(document).on('click','#file_selector',function(){
    $("#file_input").click();
});
$(document).on('change','#file_input',function(e){
   
    if (e.target.files.length==0)
    return;

    
    for(var i=0;i<e.target.files.length;i++)
    {
        if(!allow_file(e.target.files[i]))
        continue;

        if(!allow_size(e.target.files[i]))
        continue;

      
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#image_area").append(image_preview( e.target.result));
        }
        reader.readAsDataURL(e.target.files[i]);
    }
  
});