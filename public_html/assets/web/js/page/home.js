$(document).ready(function(){
    let no_home_popup=localStorage.getItem("no_home_popup");
    if(no_home_popup==undefined)
    {
    $("#news_latter_modal").modal('show');
    }
});
$(document).on('hidden.bs.modal','#news_latter_modal',function(){
   if($("#notshowpopup").is(":checked")==true)
   {
       localStorage.setItem("no_home_popup",1);
   }
    
});