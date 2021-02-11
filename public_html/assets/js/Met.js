
// let baseurl = location.origin;
var met = new Object();
// alert(1);
// if(location.href.split('/').indexOf('insurance') != -1)
//     met.baseurl = location.origin+'/insurance';
// else
met.baseurl = location.origin;
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Readme novalidate in form
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
})();
getSubDomain();
function getSubDomain()
{
    var array = window.location.host.split('.');
    // console.log(array);
    // console.log(array.length);
    if(array.length == 3)
    {
        // console.log('Met getSubDomain()');
        // console.log(array[0]);
        return array[0];
    }
    return null;
}
// Object.keys(obj).forEach(function (item) {
//     console.log(item); // key
//     console.log(obj[item]); // value
// });
$(document).on('change','.check_one',function(){
    $('input:checkbox.check_one').not(this).prop('checked', false);
    // console.log($('input:checkbox.check_one'));
});
// console.log(met.baseurl);
function formToObj(form)
{
    var form = form.serializeArray();
    var obj = new Object();
    for(index in form)
    {
        // console.log("name: "+form[index].name+" value: "+form[index].value);
        name = form[index].name;
        // console.log(name);
        obj[name] = form[index].value;
    }
    return obj;
}

if ($('.num-only').length) {
    $(document).on('keypress', '.num-only', function(event) {
        if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    }).on('paste', function(event) {
        event.preventDefault();
    });
}

function chkAll() {
    if ($('#check-all').prop('checked')) {
        $('.del').each(function() {
            $('.del:not("#undropable")').prop('checked', true);
        });
    } else { //uncheck all
        $('.del').each(function() {
            $('.del').prop('checked', false);
        });
    }
}


$.fn.digits = function(){ 
    return this.each(function(){ 
        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
    })
}
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
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
function examFileReader(){
    // delete function examFileReader() can use below
$(document).on('change','#menu_image_file_edit',function(e){
    if (e.target.files.length==0)
    return;

    
    if(!allow_file(e.target.files[0]))
    {
        alert('Only image accepted!');
        return;
    } 

    if(!allow_size(e.target.files[0]))
    {
        alert('File is too big!');
        return;
    }

    var reader = new FileReader();
    reader.onload = function(e) {
        $("#modal_edit_menu img").attr('src',e.target.result);
        $("#menu_image_edit").val(e.target.result);
        $("#delete_photo_edit").show();
    }
    reader.readAsDataURL(e.target.files[0]);
});
}

// $(document).on('click','.custom_rating',function(){
// 	var leng = ($(this).attr('leng'));
//     $('.custom_rating').each(function(index){
// 	    $(this).removeClass('rating_checked');
//     });
// 	$('.custom_rating').each(function(index){
//     	if(index<=leng){    
// 	    	$(this).addClass('rating_checked');
//         }
//     });
// });
// $(document).on('mouseover','.custom_rating',function(){
// 	var leng = ($(this).attr('leng'));
// 	$('.custom_rating').each(function(index){
//     	if(index<=leng){    
// 	    	$(this).addClass('text-warning');
//         }
//     });
// });
// $(document).on('mouseout','.custom_rating',function(){
// 	$('.custom_rating').each(function(index){
// 	    	$(this).removeClass('text-warning');
//     });
// });