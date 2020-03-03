    // $(document).ready(function(){
    //     let path = app.url+'/pos/read-data/0/'+$shop->id;
    //     $.get(path, function(data){
    //         $('#block-product').empty().html(data)                
    //     })
    // })

    // $(document).on('click','button.open_modal',function(){
    //     let path = $(this).attr('data-href');
    //     $.get(path, function(data){
    //         $('#modalAdd div.modal-content').html(data);
    //         $('#modalAdd').modal('show');
    //     });
    // });

    // $(document).on('show.bs.modal', '.modal', function (event) {
    //     var zIndex = 1040 + (10 * $('.modal:visible').length);
    //     $(this).css('z-index', zIndex);
    //     setTimeout(function() {
    //         $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    //     }, 0);
    // });


    // เพิ่มรายการสินค้าลงตารางขาย โดยคลิกจากภาพสินค้า
    function click_product(id)
    {
        //alert(id);
        let pid = $('#pid'+id).attr("get_product");
        let list = $('#list_body').html();
        let search_id = $(list).find('#num'+id).html();
        //console.log(search_id);

        //let list_prod = $('#list_product').html();

        if(search_id){
            let num = parseInt(search_id) + 1;
            $('#num'+id).html(num);
            $('#psn'+id).val(num);
            //alert('เพิ่มสินค้าแล้ว');
            //Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'เพิ่มสินค้าแล้ว'});
                
            sum_total(id);
            clear_all();

        }else{
        
            $.get(pid, function(txt){
                list += txt;
                $('#list_body').html(list);

                //alert('เพิ่มสินค้าแล้ว');
                //Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'เพิ่มสินค้าแล้ว'});
                
                sum_total(id);
                clear_all();
            })            
        }

    }

    function sum_total(id)
    {
        let sumcash = $('#sum_cash').html().replace(",", "");
        let price = $('#price'+id).html();
        let total = parseFloat(sumcash) + parseFloat(price);
        $('.sum_cash').html(addCommas(total));
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

    function list_del()
    {
        $('#list_body').empty();
        $('.sum_cash').html(0);
        $('.other-pay').empty();
        $('.pay-etc').empty();
        alert('ยืนยันการลบทั้งหมด');
        //Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'ลบรายการทั้งหมดแล้ว'});
    }

    function del_one(pssn)
    {
        let pnum = $('#num'+pssn).html();
        let pprice = $('#price'+pssn).html();
        let sumcash = $('#sum_cash').html().replace(",","");
        let total = parseFloat(sumcash) - (parseFloat(pnum) * parseFloat(pprice));
        $('.sum_cash').html(addCommas(total));
        //console.log(pnum);

        let tr = $('#num'+pssn).closest('tr');
        tr.remove();
        alert('ยืนยันการลบ');
        //Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'ลบแล้ว'});
        //console.log(tr);

    }


    $('#t_search').on('keyup',function(){
        if($(this).val() == ""){
            clear_all();
        }
    })

    $('#t_search').on('keydown',function(e){
        if(e.which == 8){
            console.log('ลบ');
            $('#t_sku').val(''); 
            $('#t_pid').val('');
        }
    })


    $('#frm_barcode').on('submit',function(e){
        e.preventDefault(); 
        // let list = $('#list_body').html();  // รายการสินค้าที่มีอยู่
        // let tsku = $('#t_sku').val(); // p_sku
        // let tid = $('#t_id').val(); // p_id
        let key = $('#t_search').val(); // p_name
        let shopid = $('#shopid').val(); // shop_id

        //$.get("{{ URL::to('sale/check-barcode') }}"+'/'+sn, function(num){
        $.get(app.url+"/check-barcode"+'/'+shopid+'/'+key, function(num){
            console.log(num);
            if(num > 0){
                click_product(key);
                clear_all();
            }else{
                alert('ไม่พบสินค้า');
                //Dashmix.helpers('notify', {type: 'warning', icon: 'fa fa-times mr-1', message: 'ไม่พบสินค้ารหัส '+sn});
                clear_all();
            }                
        })

    })

    function clear_all(){
        $('.clear_end').val('');
        $('#t_search').focus();
    }

    // autocomplete

    //let path = app.url+"/shop/"+shopid+'/autocomplete';
    let path = app.url+'/autocomplete';
    $('#t_search').autocomplete({
        source : path,
        minlenght:1,
        autoFocus:true,
        select:function(e,ui){
            $('#t_search').val(ui.item.value);  // name
            $('#t_id').val(ui.item.id);  // id
            $('#t_sku').val(ui.item.id);   // sku       
        }
    });

    function click_pay()
    {
        let total_pay = $('#sum_cash').html();

        // รวมเงิน
        $('#pricetotal').val(total_pay);

        // รวมเงินที่ต้องชำระ
        $("#pricetotal_all").val(addCommas(total_pay));

    }











    // สร้างเวลาสำหรับระบุใน array ชำระด้วยวิธีอื่น
    function time_create()
    {
        let dt = new Date($.now());
        let time = dt.getHours().toString() + dt.getMinutes().toString() + dt.getSeconds().toString();
        return time;
    }

    กดปุ่มชำระเงิน
    function pay()
    {
        // ดึงข้อมูลสินค้าที่ขายเทียบจำนวนกับที่มี  PPosController@check_product()
        let path = $('#btn-save').attr('txt');
        $.get(path, $('#frm-basket').serialize(), function(data){
            
            var count = Object.keys(data).length;
            
            if(count){
                $.each( data, function( key, value){
                    jQuery('#modalPay').modal('hide');
                    Dashmix.helpers('notify', {type: 'warning', icon: 'fa fa-exclamation mr-1', message: key + ' มีจำนวนคงเหลือ ' + value});
                });
            }else{
                // ไปทำต่อที่ TbSaleBillController@pay
                $("#frm-basket").submit();
            }
        });

    }

    function cal_credit_pay()
    {
        let pay = $('#t_credit_pay').val();
        let free = $('#t_credit_free').val();

        let freepay = (parseFloat(pay) * parseFloat(free)) / 100;
        $('#t_credit_freepay').val(freepay);

        let total = parseFloat(pay) + parseFloat(freepay);
        $('#t_credit_total').val(total);
    }

    function torn()
    {
        let a = $("#pricetotal").val().replace(",", "");  // รวมเงิน
        //let b = $("#discount").val();  // ส่วนลด
        let c = $("#getmoney").val().replace(",", "");  // รับเงิน
        //let e = $("#t_other_pay").val();  // รวมเงินที่ชำระด้วยวิธีอื่น
        //let d = $("#pricetotal_all").val().replace(",", ""); // รวมเงินที่ต้องชำระ หลังหักส่วนลด
        let f = $("#pay-total-footer").val().replace(",", ""); // รวม (เงินสด + อื่นๆ)

        //let total = parseFloat(a);// - parseFloat(b) ;
        let change = parseFloat(f) - parseFloat(a);

        // รวมเงินที่ต้องชำระ
        //$("#total-payall").html(total);
        //$("#pricetotal_all").val(addCommas(total));

        $("#total").val(addCommas(change));
        //$("#pay_discount").val(addCommas(b));
        $("#pay_getmoney").val(addCommas(c));

        $('.pay-total-footer').val(addCommas(c));

        // เงินทอน
        if(change <= 0)
        {
            change = 0;
        }
        
        $("#pay-change-footer").val(addCommas(change));
        $("#pay_change").val(addCommas(change));

        // ปุ่มบันทึก / พิมพ์
        // รวมเงินที่ต้องชำระ >= รวม
        if(parseFloat(a) > parseFloat(f)){
            $("#btn-save").prop('disabled', true);
        }else{
            $("#btn-save").prop('disabled', false);
        }

        // รายละเอียดการชำระเงินสด
        let t_cash = $("#text-cash").html();
        //console.log(t_cash);

        if(c>0){
            if(t_cash){
                $("#text-cash").html(c);
            }else{
                // เพิ่มรายละเอียดการชำระ
                let pay_etc = $(".pay-etc").html();
                let pay_add = '<tr><td class="text-left">เงินสด</td><td class="text-center" id="text-cash">' + c + '</td><td class="text-center"><a class="btn-del-cash"><i class="fa fa-trash text-danger"></i></a></td></tr>';

                $('.pay-etc').empty().html(pay_etc + pay_add);
            }
        }

        
    }

    function get_cash(num)
    {
        let money = $('#getmoney').val().replace(",", "");
        let tt_money = parseFloat(num) + parseFloat(money);
        $('#getmoney').val(addCommas(tt_money)); // ช่องรับเงิน
        
        // รวมจำนวนเงินในรายละเอียดชำระ
        let pay_total = parseFloat($('.pay-total-footer').val().replace(",", "")) + parseFloat(num);
        $('.pay-total-footer').val(addCommas(pay_total));
        $('#pay_total').val(addCommas(pay_total));

        // รวมจำนวนเงิน ใน ชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(addCommas(pay_total));

        torn();
    }

    function get_balance()
    {
        get_clear();
        // รวมเงินที่ต้องชำระ
        let money = $('#pricetotal').val().replace(",", "");
        $('#getmoney').val(addCommas(money)); // ช่องรับเงิน
        
        // รวมจำนวนเงินในรายละเอียดชำระ
        //let pay_total = parseFloat($('.pay-total-footer').val().replace(",", ""));
        $('.pay-total-footer').val(addCommas(money));
        $('#pay_total').val(addCommas(money));

        // รวมจำนวนเงิน ใน ชำระเงินด้วยวิธีอื่น
        // $('#t_other_pay').val(pay_total);

        torn();
    }

    function get_clear()
    {
        $('#getmoney').val(0);
        $('#total').val(0);
        $('.pay-etc').empty();
        
        // รวมจำนวนเงินในรายละเอียดชำระ
        $('.pay-total-footer').val(0);
        $('#pay_total').val(0);

        // รวมจำนวนเงินในชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(0);

        // เงินทอน
        $("#pay-change-footer").val(0);
        $('#pay_change').val(0);

        // ปุ่มบันทึก
        $("#btn-save").prop('disabled', true);
    }




    function click_cat(id)
    {
        let catid = $('#btncat'+id).attr("get_cat");
        $('.btn-cat').attr('class','p-3 btn btn-square btn-outline-info btn-cat');
        $('#btncat'+id).attr('class','p-3 btn btn-square btn-hero-info btn-cat');
        $.get(catid, function(data){
            $('#block-product').empty().html(data);
        });
    }

    function click_product_sn(id)
    {
        let pid = $('#pid'+id).attr("get_product");
        let list = $('#list_body').html();
        let search_id = $(list).find('#num'+id).html();

        let list_prod = $('#list_product').html();

        if(search_id){
            Dashmix.helpers('notify', {type: 'warning', icon: 'fa fa-exclamation mr-1', message: 'เป็นสินค้าที่ไม่สามารถเพิ่มรายการซ้ำได้'});
            clear_all();
        }else{
        
            $.get(pid, function(txt){
                list += txt;
                $('#list_body').html(list);

                Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'เพิ่มสินค้าแล้ว'});
                
                sum_total(id);
                clear_all();
            })            
        }

    }


    // ปุ่มลบ ของการชำระเงินด้วยเงินสด
    $(document).on('click','.btn-del-cash',function(){

        let amount = $("#text-cash").html();

        // ช่องรับเงิน
        $('#getmoney').val(0);

        // รวมจำนวนเงินในรายละเอียดชำระ
        let pay_total = parseFloat($('.pay-total-footer').val()) - parseFloat(amount);
        if(pay_total < 0)
        pay_total = 0;
        
        $('.pay-total-footer').val(pay_total);
        $('#pay_total').val(pay_total);

        // รวมจำนวนเงินในชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(pay_total);

        let tr = $(this).closest('tr');
        tr.remove();

        torn();

        Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'ลบแล้ว'});
    })