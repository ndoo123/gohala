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
            $('#t_sn').val(''); 
            $('#t_ck').val('');
            $('#t_pid').val('');
        }
    })


    $('#frm_barcode').on('submit',function(e){
        e.preventDefault(); 
        let list = $('#list_body').html();  // รายการสินค้าที่มีอยู่
        let tsn = $('#t_sn').val(); // ps_sn
        let tck = $('#t_ck').val(); // p_sn 0/1
        let tpid = $('#t_pid').val(); // p_id
        let tname = $('#t_search').val(); // p_name
        let sn;

        if((tck == '') && (tpid == '') && (tsn == '')){
            // ไม่ได้รับค่าจาก autocomplete
            // เช็คและเพิ่มรายการสินค้าได้เลย
            add_product(tname);
        }else{
            // ได้รับค่าจาก autocomplete            
            if(tck == '1'){
                // เป็นสินค้า sn
                // แสดง model เลือกรหัสสินค้า
                let path = "{{ URL::to('sale/get_sn') }}"+'/'+tname;
                console.log(path);
                jQuery('#modalForm').modal('show',function(){
                    $.get(path, function(data){
                        $('#modal_content').html(data); 
                        console.log(data);
                    });
                });
            }else{
                // ไม่ใช่สินค้า sn
                // เช็คและเพิ่มรายการสินค้าได้เลย
                add_product(tsn);
            }
        }
        
    })

    function add_product(sn){

        $.get("{{ URL::to('sale/check-barcode') }}"+'/'+sn, function(num){
            //console.log(num);
            if(num > 0){
                click_product(sn);
                clear_all();
            }else{   
                Dashmix.helpers('notify', {type: 'warning', icon: 'fa fa-times mr-1', message: 'ไม่พบสินค้ารหัส '+sn});
                clear_all();
            }                
        })
    }

    function clear_all(){
        $('.clear_end').val('');
        $('#t_search').focus();
    }

    // autocomplete

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










    

    // เพิ่มการจ่ายด้วยเงินโอน
    function bank_add(dt,id)
    {
        //let dt = time_create();
        let t_bid = '#t_bank_id'+id+dt;
        let bid = $(t_bid).val();
        //console.log(t_bid);
        let t_bno = '#t_bank_no'+id+dt;
        let bno = $(t_bno).val();
        //console.log(t_bno);
        let txt_amount = $('#t_bank_amount'+id+bno).val();
        //console.log(txt_amount);

        let bb_id = "<input type='hidden' name='bank_id["+dt+"]' value=''>";
        let bank_id = "<input type='hidden' name='t_bank_id["+dt+"]' value='" + bid + "'>";
        let bank_amount = "<input type='hidden' name='t_bank_amount["+dt+"]' value='"+txt_amount+"'>";

        // จ่ายด้วยวิธีอื่นๆ
        // เพิ่ม hidden ของการจ่ายด้วยเงินโอน
        let oth_pay = $('.other-pay').html();
        let input_bank = "<div class='hidden-other-buy' id='bank"+dt+ "'>" + bb_id + bank_id + bank_amount + "</div>";
        $('.other-pay').empty().html(oth_pay + input_bank);

        // เพิ่มรายละเอียดการชำระ
        let pay_etc = $(".pay-etc").html();
        let pay_add = '<tr><td class="text-left">บัญชี '+ bno + '</td><td class="text-center">' + txt_amount + '</td><td class="text-center"><a  class="btn-del-other" other-amount="' + txt_amount + '" del_other="bank'+dt+ '"><i class="fa fa-trash text-danger"></i></a></td></tr>';
        $('.pay-etc').empty().html(pay_etc + pay_add);
        
        // รวมจำนวนเงินในรายละเอียดชำระ
        let pay_total = parseFloat($('.pay-total-footer').val()) + parseFloat(txt_amount);
        $('.pay-total-footer').val(pay_total);
        $('#pay_total').val(pay_total);

        // รวมจำนวนเงินในชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(pay_total);

        torn();
    }

    // เพิ่มการจ่ายด้วยเช็ค
    function check_add()
    {
        let dt = time_create();

        let ck_id = "<input type='hidden' name='check_id["+dt+"]' value=''>";
        let ck_name = "<input type='hidden' name='check_name["+dt+"]' value='"+ $('#t_check_name').val() + "'>";
        let ck_branch = "<input type='hidden' name='check_branch["+dt+"]' value='"+ $('#t_check_branch').val() + "'>";
        let ck_number = "<input type='hidden' name='check_number["+dt+"]' value='"+ $('#t_check_number').val() + "'>";
        let ck_date = "<input type='hidden' name='check_date["+dt+"]' value='"+ $('#t_check_date').val() + "'>";
        let ck_no = "<input type='hidden' name='check_no["+dt+"]' value='"+ $('#t_check_no').val() + "'>";
        let ck_amount = "<input type='hidden' name='check_amount["+dt+"]' value='"+ $('#t_check_amount').val() + "'>";
        let ck_status = "<input type='hidden' name='check_status["+dt+"]' value='"+ $('#t_check_status').val() + "'>";

        // จ่ายด้วยวิธีอื่นๆ
        // เพิ่ม hidden ของการจ่ายด้วยเช็ค
        let oth_pay = $('.other-pay').html();
        let input_check = "<div class='hidden-other-buy' id='check"+dt+"'>" + ck_id + ck_name + ck_branch + ck_number + ck_date + ck_no + ck_amount + ck_status + "</div>";
        $('.other-pay').empty().html(oth_pay + input_check);

        // เพิ่มรายละเอียดการชำระ
        let pay_etc = $(".pay-etc").html();
        let pay_add = '<tr><td class="text-left">เช็ค '+ $('#t_check_number').val() + '</td><td class="text-center">' + $('#t_check_amount').val() + '</td><td class="text-center"><a  class="btn-del-other" other-amount="' + $('#t_check_amount').val() + '" del_other="check'+dt+ '"><i class="fa fa-trash text-danger"></i></a></td></tr>';
        $('.pay-etc').empty().html(pay_etc + pay_add);
        
        // รวมจำนวนเงินในรายละเอียดชำระ
        let pay_total = parseFloat($('.pay-total-footer').val()) + parseFloat($('#t_check_amount').val());
        $('.pay-total-footer').val(pay_total);
        $('#pay_total').val(pay_total);

        // รวมจำนวนเงินในชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(pay_total);

        torn();
    }

    // สร้างเวลาสำหรับระบุใน array ชำระด้วยวิธีอื่น
    function time_create()
    {
        let dt = new Date($.now());
        let time = dt.getHours().toString() + dt.getMinutes().toString() + dt.getSeconds().toString();
        return time;
    }

    // เพิ่มการจ่ายด้วยบัตรเครดิต
    function credit_add()
    {      
        let dt = time_create();

        let c_id = "<input type='hidden' name='credit_id["+dt+"]' value='"+ $('#t_credit_id').val() + "'>";
        let c_name = "<input type='hidden' name='credit_name["+dt+"]' value='"+ $('#t_credit_name').val() + "'>";
        let c_no = "<input type='hidden' name='credit_no["+dt+"]' value='"+ $('#t_credit_no').val() + "'>";
        let c_expired = "<input type='hidden' name='credit_expired["+dt+"]' value='"+ $('#t_credit_expired').val() + "'>";
        let c_installment = "<input type='hidden' name='credit_installment["+dt+"]' value='"+ $('#t_credit_installment').val() + "'>";
        let c_isim = "<input type='hidden' name='credit_isim["+dt+"]' value='"+ $('#t_credit_isim').val() + "'>";
        let c_pay = "<input type='hidden' name='credit_pay["+dt+"]' value='"+ $('#t_credit_pay').val() + "'>";
        let c_free = "<input type='hidden' name='credit_free["+dt+"]' value='"+ $('#t_credit_free').val() + "'>";
        let c_freepay = "<input type='hidden' name='credit_freepay["+dt+"]' value='"+ $('#t_credit_freepay').val() + "'>";
        let c_total = "<input type='hidden' name='credit_total["+dt+"]' value='"+ $('#t_credit_total').val() + "'>";

        // จ่ายด้วยวิธีอื่นๆ
        // เพิ่ม hidden ของการจ่ายด้วยบัตรเครดิต
        let oth_pay = $('.other-pay').html();
        let input_credit = "<div class='hidden-other-buy' id='credit"+dt+"'>" + c_id + c_name + c_no + c_expired + c_installment + c_isim + c_pay + c_free + c_freepay + c_total + "</div>";
        $('.other-pay').empty().html(oth_pay + input_credit);

        // เพิ่มรายละเอียดการชำระ
        let pay_etc = $(".pay-etc").html();
        let pay_add = '<tr><td class="text-left">บัตร ' + $('#t_credit_name').val() + '</td><td class="text-center">' + $('#t_credit_pay').val() + '</td><td class="text-center"><a  class="btn-del-other" other-amount="' + $('#t_credit_pay').val() + '" del_other="credit'+dt+'"><i class="fa fa-trash text-danger"></i></a></td></tr>';
        $('.pay-etc').empty().html(pay_etc + pay_add);
        
        // รวมจำนวนเงินในรายละเอียดชำระ
        let pay_total = parseFloat($('.pay-total-footer').val()) + parseFloat($('#t_credit_pay').val());
        $('.pay-total-footer').val(pay_total);
        $('#pay_total').val(pay_total);

        // รวมจำนวนเงินในชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(pay_total);

        torn();
    }

    function click_pay()
    {
        //let path = "{{ URL('salebill_product') }}";
        let path = $('#btn-pay').attr('txt');
        $.get(path, $('#frm-basket').serialize(), function(data){
            
            var count = Object.keys(data).length;
            //console.log(count);
            if(count){
                $.each( data, function( key, value){
                    Dashmix.helpers('notify', {type: 'warning', icon: 'fa fa-exclamation mr-1', message: key + ' มีจำนวนคงเหลือ ' + value});
                });
            }else{
                $('#modalPay').modal({
                    show: true
                })
                let total_pay = $('#sum_cash').html();

                // รวมเงิน
                $('#pricetotal').val(total_pay);

                // รวมเงินที่ต้องชำระ
                $("#pricetotal_all").val(total_pay);
            }
        });

    }

    // กดปุ่มชำระเงิน
    function pay()
    {
        // ดึงข้อมูลสินค้าที่ขายเทียบจำนวนกับที่มี  TbSaleController@check_product()
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
        let a = $("#pricetotal").val();  // รวมเงิน
        let b = $("#discount").val();  // ส่วนลด
        let c = $("#getmoney").val();  // รับเงิน
        let e = $("#t_other_pay").val();  // รวมเงินที่ชำระด้วยวิธีอื่น
        let d = $("#pricetotal_all").val(); // รวมเงินที่ต้องชำระ หลังหักส่วนลด
        let f = $("#pay-total-footer").val(); // รวม (เงินสด + อื่นๆ)

        let total = parseFloat(a) - parseFloat(b) ;
        let change = parseFloat(f) - parseFloat(d);

        // รวมเงินที่ต้องชำระ
        //$("#total-payall").html(total);
        $("#pricetotal_all").val(total);

        $("#total").val(change);
        $("#pay_discount").val(b);
        $("#pay_getmoney").val(c);

        // เงินทอน
        if(change <= 0)
        {
            change = 0;
        }
        
        $("#pay-change-footer").val(change);
        $("#pay_change").val(change);

        // ปุ่มบันทึก / พิมพ์
        // รวมเงินที่ต้องชำระ >= รวม
        if(parseFloat(d) > parseFloat(f)){
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
        let money = $('#getmoney').val();
        let tt_money = parseFloat(num) + parseFloat(money);
        $('#getmoney').val(tt_money); // ช่องรับเงิน
        
        // รวมจำนวนเงินในรายละเอียดชำระ
        let pay_total = parseFloat($('.pay-total-footer').val()) + parseFloat(num);
        $('.pay-total-footer').val(pay_total);
        $('#pay_total').val(pay_total);

        // รวมจำนวนเงิน ใน ชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(pay_total);

        torn();
    }

    function get_balance()
    {
        // รวมเงินที่ต้องชำระ
        let num = $('#pricetotal_all').val();
        let money = $('#getmoney').val();
        let tt_money = parseFloat(num) + parseFloat(money);
        $('#getmoney').val(tt_money); // ช่องรับเงิน
        
        // รวมจำนวนเงินในรายละเอียดชำระ
        let pay_total = parseFloat($('.pay-total-footer').val()) + parseFloat(num);
        $('.pay-total-footer').val(pay_total);
        $('#pay_total').val(pay_total);

        // รวมจำนวนเงิน ใน ชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(pay_total);

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

    // ปุ่มลบ ของการชำระเงินด้วยวิธีอื่นๆ
    $(document).on('click','.btn-del-other',function(){
        let amount = $(this).attr('other-amount');
        let no = $(this).attr('del_other'); 

        // รวมจำนวนเงินในรายละเอียดชำระ
        let pay_total = parseFloat($('.pay-total-footer').val()) - parseFloat(amount);
        $('.pay-total-footer').val(pay_total);
        $('#pay_total').val(pay_total);

        // รวมจำนวนเงินในชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(pay_total);

        let tr = $(this).closest('tr');
        tr.remove();

        let div = $('#'+no).closest('div');
        div.remove();

        torn();

        Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'ลบแล้ว'});
    })

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