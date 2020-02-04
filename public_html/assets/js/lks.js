function LKS() {
    this.debug = true;
    this.token = function() {
        return $('meta[name="csrf-token"]').attr('content');
    }

    this.sendData = function(obj, method, load_id, data_type,token) {
        var url=obj.url;
    
        
       
     
        if (load_id != undefined && load_id != "") {
            Load(load_id, true);
        }

        var dataToSend = Object();
        if (method == "post") {

            dataToSend._token = this.token;
           
            
            

            if(data_type=="form")
            {
               
                obj.json=true;
                data_type="json";
                url=obj.url;
                dataToSend=obj.data;

   
                
              
            }
            else
            {
                dataToSend=obj.data;
               
                if(token==undefined)
                dataToSend._token=this.token;
                //dataToSend.data = JSON.stringify(obj.data);
            }
        }
        

        if (obj.success != undefined)
            var dataSuccess = obj.success;

        if (this.debug) {
          
            
            obj.error = function(data) {
                if(data.responseText!="")
                {
                    var debugWindow = window.open("", "Debug");
                    debugWindow.document.write(data.responseText);
                }
                
                
            }
        }

        if (obj.json) {
           
            if (obj.success != undefined) {
                dataSuccess = function(data) {
                    //var json = get_json(data);
                    obj.success(data);
                };
            }
        }
       
       
        
        $.ajax({
            type: method,
            url: url,
            cache: false,
            data: dataToSend,
            success: dataSuccess,
            error: obj.error,
            dataType: data_type,
            complete: function() {

                if (load_id != undefined && load_id != "") {
                    Load(load_id, false);
                }

            }
        });


    }
    this.sendDataForm = function(obj, load_id, method) {
        if (load_id != "") {

            Load(load_id, true);
        }

        var dataSuccess = obj.success;

        if (obj.debug) {
            obj.error = function(data) {
                var debugWindow = window.open("", "Debug");
                debugWindow.document.write(data.responseText);
                //  $('html').html(data.responseText);
            }
        }

        if (obj.json) {
            dataSuccess = function(data) {
                var json = get_json(data);
                obj.success(json);
            };
        }

        $.ajax({
            url: this.url + "" + obj.url,
            type: method,
            data: obj.data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: dataSuccess,
            error: obj.error,
            complete: function() {
                Load(load_id, false);

            }
        });

    }

}
function alert_show(status,msg,is_hide)
{
   
    var error="";
    if(Array.isArray(msg)==true)
    {
       
        for(var i=0;i<msg.length;i++)
        {
        
            error+="- "+msg[i]+"<br>";
        }
    }
    else
    {
        error=msg;
    }
    if(error!="")
    {
        if(is_hide==false)
        {
            return '<div class="alert alert-'+status+' alert-dismissible fade show   m-alert m-alert--air" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>'+error+'</div>';
        }
        else
        {
            return '<div class="alert alert-'+status+' alert-dismissible fade show   m-alert m-alert--air" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>'+error+'<script>setTimeout(function(){$(".alert").remove();},5000);</script></div>';
        }
    }
}
function Load(element_ID, isload) {
    if (isload) {

        //mApp.block(element_ID,{})
        $(element_ID).block({  message:'กรุณารอสักครู่',css: { 
            border: 'none', 
            padding: '10px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff',
           
        } });
       
    } else {

        $(element_ID).unblock();
    }
}

function JPost(load_id) {


    this.json = true;
    this.send = function(data) {
        if (data) {
            this.data = data;
        }
        else
        {
            this.data={};
        }
        lks.sendData(this, "post", load_id, 'json');
    }
}
function JGet(load_id) {


    this.json = true;
    this.send = function(data) {
        if (data) {
            this.data = data;
        }
        lks.sendData(this, "get", load_id, 'json');
    }
}
function JPostHTML(load_id) {


    this.json = true;
    this.send = function(data) {
        if (data) {
            this.data = data;
        }
        lks.sendData(this, "post", load_id, 'html');
    }
}
function PostForm(load_id)
{
    this.send=function(form)
    {
        if(form)
        {
           
            this.data=form.serialize();
            this.url=form.attr("action");
           
            
        }
        lks.sendData(this,"post",load_id,"form");
    }
}
$.fn.validate_clear=function(){
    $(this).find('input[data-require]').each(function(){
        $(this).removeClass('is-invalid');
        $(this).parent().find('div.invalid-feedback').remove();
    });
}

$.fn.validate=function(){
    var is_valid=true;

    $(this).find('input[data-require]').each(function(){
        $(this).removeClass('is-invalid');
        $(this).parent().find('div.invalid-feedback').remove();

        if($(this).is("input"))
        {
   
            if($(this).val()=="")
            {
                is_valid=false;
                $(this).addClass("is-invalid");
                $(this).parent().append('<div class="invalid-feedback animated fadeIn">'+$(this).attr("data-require")+'</div>');
            }
        }
       
        
    });

    return is_valid;
}



// $(document).on('hidden.bs.modal', function () {
  
//     if(!$('body').hasClass('modal-open'))
//     {
//  $('body').addClass('modal-open');
//     }
   
// });
function bind_data_date()
{
    
    $('input[data-date]').each(function(){
        $(this).inputmask($(this).attr("data-date"),{autoUnmask:false,removeMaskOnSubmit:false});
    });
    $('input.date_picker').each(function(){
        $(this).attr('readonly',true);
      
    
        
        $(this).datepicker({
            todayHighlight: true,
            orientation: "top right",
            autoclose:true,
            format: 'dd/mm/yyyy'
        });
    });

    $('input.month_picker').each(function(){
        $(this).attr('readonly',true);

        $(this).inputmask("mm/yyyy",{autoUnmask:!0});
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            viewMode: "months", 
            minViewMode: "months",
            showButtonPanel: true,
            orientation: "bottom right",
            autoclose:true,
            format: 'mm/yyyy'
        });
       
    });
}


$(document).on('keyup','input.input_upper',function(){
    this.value=this.value.toLocaleUpperCase();
    this.value=this.value.replace(/\s/g, '');
});

//ทำให้ Enter ทำหน้าที่เหมือน Tab
$(document).on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
      if(self.hasClass("skipnext"))
      return;
      
    if (e.keyCode == 13) {
        focusable = form.find('input[type="text"],input[type="money"],input[type="number"],textarea').filter(':visible:not([readonly]):not([disabled])');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
            
        } 
        return false;
    }
});
$(document).ready(function(){

    bind_data_date();
});

var lks=new LKS();
