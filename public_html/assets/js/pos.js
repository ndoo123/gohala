    // เปิดหน้ามาโหลดเสร็จแล้วให้แสดงสินค้าทุกหมวดหมู่
    $(document).ready(function(){
        let path = app.url+'/pos/readData/0/'+$('#shopid').attr("value");
        console.log(path);
        //let path = $(this).attr('data-href');
        $('#btncat0').attr('class','btn btn-primary waves-effect waves-light btn-cat');
        $.get(path, function(data){
            $('#block-product').empty().html(data)                
        })

    })


    // เพิ่มรายการสินค้าลงตารางขาย โดยคลิกจากภาพสินค้า
    function click_product(id)
    {
        //alert(id);
        let list = $('#list_body').html();
        let search_id = $(list).find('#num'+id).html();
        let tsearch = $('#t_search').val();
        
        //console.log(tfind);

        //let list_prod = $('#list_product').html();

        // ถ้ามีสินค้าอยู่ในรายการแล้ว
        if(search_id){
            let real_price = $('#price'+id).attr("real_price").replace(",", ""); // ราคาสินค้า
            let o_num = parseInt(search_id); //  จำนวนที่มีอยู่
            let num = 0;
            
            // ถ้ามีข้อมูลในช่องบาร์โค้ด
            if(tsearch.includes("*")){
                let tsearch_num = tsearch.replace("*","");
                //console.log(tsearch_num);
                num = parseInt(search_id) + parseInt(tsearch_num);
            }else{
                num = parseInt(search_id) + 1;
            }
            
            let o_price = parseFloat(o_num) * parseFloat(real_price);
            let n_price = parseFloat(num) * parseFloat(real_price);

            $('#num'+id).html(num);
            $('#h_num'+id).val(num);

            $('#price'+id).html(addCommas(n_price.toFixed(2)));
            $('#h_price'+id).val(n_price);

            //alert('เพิ่มสินค้าแล้ว');
            //Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'เพิ่มสินค้าแล้ว'});
                
            sum_total_new(id, o_price, n_price);
            clear_all();

        }else{
            let num = 0;
            
            // ถ้ามีข้อมูลในช่องบาร์โค้ด
            if(tsearch.includes("*")){
                let tsearch_num = tsearch.replace("*","");
                //console.log(tsearch_num);
                num = parseInt(tsearch_num);
            }else{
                num = 1;
            }
            // let path = app.url+'/pos/readData/'+id+'/'+$('#shopid').attr("value");

            let pid = $('#pid'+id).attr("get_product");  // จาก pos_product
            let path = app.url+'/pos/read-barcode/'+pid+'*'+num+'/'+$('#shopid').attr("value");
            console.log(path);
        
            $.get(path, function(txt){
                list += txt;
                $('#list_body').html(list);

                //alert('เพิ่มสินค้าแล้ว');
                //Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'เพิ่มสินค้าแล้ว'});
                
                sum_total(id);
                clear_all();
            })            
        }

    }



    // รวมเงิน
    function sum_total(id)
    {
        let sumcash = $('#sum_cash').html().replace(",", "");
        let price = $('#price'+id).html().replace(",", "");
        let total = parseFloat(sumcash) + parseFloat(price);
        $('.sum_cash').html(addCommas(total.toFixed(2)));
    }

    // รวมเงินเพิ่มใหม่
    function sum_total_new(id, oprice, nprice)
    {
        let sumcash = $('#sum_cash').html().replace(",", "");
        //let price = $('#price'+id).html().replace(",", "");
        let total = parseFloat((sumcash - oprice) + nprice);
        $('.sum_cash').html(addCommas(total.toFixed(2)));
    }

    // เพิ่มคอมม่าในจำนวนเงิน
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

    // ลบรายการซื้อทั้งหมด
    function list_del()
    {
        if(confirm('ยืนยันการลบทั้งหมด')){
            $('#list_body').empty();
            $('.sum_cash').html(0);
            $('.other-pay').empty();
            $('.pay-etc').empty();
        }
        
        //Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'ลบรายการทั้งหมดแล้ว'});
    }

    // ลบบางรายการซื้อ
    function del_one(pssn)
    {
        if(confirm('ยืนยันการลบ')){
            let pnum = $('#num'+pssn).html();  //  จำนวนของรายการที่จะลบ
            let pprice = $('#price'+pssn).html().replace(",","");  //  ราคาของรายการที่จะลบ
            let sumcash = $('#sum_cash').html().replace(",","");  //  จำนวนเงินรวม
            let total = parseFloat(sumcash) - parseFloat(pprice);
            $('.sum_cash').html(addCommas(total.toFixed(2)));
            //console.log(pnum);

            let tr = $('#num'+pssn).closest('tr');
            tr.remove();
        }
            //Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'ลบแล้ว'});
            //console.log(tr);

    }


    $('#t_search').on('keyup',function(){
        if($(this).val() == ""){
            clear_all();
        }
    })


    // รับข้อมูลจากช่อง barcode

    $('#frm_barcode').on('submit',function(e){
        e.preventDefault(); 
        
        let key = $('#t_search').val(); // p_name
        let shopid = $('#shopid').val(); // shop_id

        //$.get("{{ URL::to('sale/check-barcode') }}"+'/'+sn, function(num){
        $.get(app.url+"/check-barcode-box"+'/'+shopid+'/'+key, function(prod){
            console.log(prod[0]);
            console.log(prod[1]);
            console.log(prod[2]);
            if((prod[0] > 0) || (prod[0] != null) || (prod[0] >= prod[2])){
                click_product_barcode(prod[1],prod[2]);
                clear_all();
            }else{
                alert('ไม่พบสินค้า');
                //Dashmix.helpers('notify', {type: 'warning', icon: 'fa fa-times mr-1', message: 'ไม่พบสินค้ารหัส '+sn});
                clear_all();
            }                
        })

    })


    // เพิ่มรายการสินค้าลงตารางขาย คีย์ข้อมูลจากช่อง barcode
    function click_product_barcode(id, barcode_num)
    {
        //alert(id);
        let pid = $('#pid'+id).attr("get_product");
        let list = $('#list_body').html();
        let search_id = $(list).find('#num'+id).html();

        console.log(search_id);
        console.log(id);
        console.log(barcode_num);

        //let list_prod = $('#list_product').html();

        if(search_id){
            let real_price = $('#price'+id).attr("real_price").replace(",", ""); // ราคาสินค้า
            let o_num = parseInt(search_id);
            let num = parseInt(search_id) + parseInt(barcode_num);
            let o_price = parseFloat(o_num) * parseFloat(real_price);
            let n_price = parseFloat(num) * parseFloat(real_price);

            $('#num'+id).html(num);
            $('#h_num'+id).val(num);

            $('#price'+id).html(addCommas(n_price.toFixed(2)));
            $('#h_price'+id).val(n_price);

            //alert('เพิ่มสินค้าแล้ว');
            //Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'เพิ่มสินค้าแล้ว'});
                
            sum_total_new(id, o_price, n_price);
            clear_all();

        }else{
            let key = $('#t_search').val(); // p_barcode
            let shopid = $('#shopid').attr('value'); // shop id
            let path = app.url+'/pos/read-barcode/'+key+'/'+shopid;
            console.log(path);
            $.get(path, function(txt){
                list += txt;
                $('#list_body').html(list);

                //alert('เพิ่มสินค้าแล้ว');
                //Dashmix.helpers('notify', {type: 'success', icon: 'fa fa-check mr-1', message: 'เพิ่มสินค้าแล้ว'});
                
                sum_total(id);
                clear_all();
            })            
        }

    }

    
    function clear_all(){
        $('.clear_end').val('');
        $('#t_search').focus();
    }

    // autocomplete

    //let path = app.url+"/shop/"+shopid+'/autocomplete';
    // let path = app.url+'/autocomplete';
    // $('#t_search').autocomplete({
    //     source : path,
    //     minlenght:1,
    //     autoFocus:true,
    //     select:function(e,ui){
    //         $('#t_search').val(ui.item.value);  // name
    //         $('#t_id').val(ui.item.id);  // id
    //         $('#t_sku').val(ui.item.id);   // sku       
    //     }
    // });

    function click_pay()
    {
        let total_pay = $('#sum_cash').html();

        // รวมเงิน
        $('#pricetotal').val(total_pay);
        $('#sumprice').val(total_pay);

        // รวมเงินที่ต้องชำระ
        $("#pricetotal_all").val(addCommas(total_pay));

        // hidden ในฟอร์ม frm_save
        $("#h_total").val(total_pay.replace(",", ""));

    }

    //กดปุ่มชำระเงิน
    function pay()
    {
        $("#frm_save").submit();
        console.log('test');
    }











    // สร้างเวลาสำหรับระบุใน array ชำระด้วยวิธีอื่น
    function time_create()
    {
        let dt = new Date($.now());
        let time = dt.getHours().toString() + dt.getMinutes().toString() + dt.getSeconds().toString();
        return time;
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

    function discount()
    {
        let disc = $("#discount").val(); // ใส่จำนวนส่วนลด

        $("#discounttotal").val(addCommas(disc));
        $("#h_discount").val(disc);
        real_total();
    }

    function real_total()
    {
        let disc = $("#discounttotal").val().replace(",", ""); // ส่วนลด
        let price = $("#sumprice").val().replace(",", "");  // ยอดเงินรวม
        let sumprice = parseFloat(price) - parseFloat(disc);

        $("#pricetotal").val(addCommas(sumprice));
    }

    // เลือกส่วนลดเป็น percent
    function real_percent_total()
    {
        let disc = $("#discount").val().replace(",", ""); // ส่วนลด
        let price = $("#sumprice").val().replace(",", "");  // ยอดเงินรวม
        let percent = (parseFloat(price) * parseFloat(disc)) / 100;
        let sumprice = parseFloat(price) - parseFloat(percent);

        $("#discounttotal").val(addCommas(percent));
        $("#pricetotal").val(addCommas(sumprice));
        $("#h_discount").val(percent);
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
                let pay_add = '<tr><td class="text-left">เงินสด</td><td class="text-center" id="text-cash">' + c + '</td><td class="text-center"><a class="btn-del-cash" onclick="get_clear()"><i class="fa fa-trash text-danger"></i></a></td></tr>';

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
        $('#h_amount').val(pay_total);

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
        $('#h_amount').val(money);

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
        $('#h_amount').val(0);

        // รวมจำนวนเงินในชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(0);

        // เงินทอน
        $("#pay-change-footer").val(0);
        $('#pay_change').val(0);

        // ปุ่มบันทึก
        $("#btn-save").prop('disabled', true);
    }



    // click หมวดหมู่สินค้า
    function click_cat(id)
    {
        //let catid = $('#btncat'+id).attr("get_cat");
        // let shopid = $('#shopid').attr('value'); // shop id
        // let path = app.url+'/pos/readData/'+id+'/'+shopid;
        // let catid = app.url+$('#btncat'+id).attr("get_cat");

        // console.log(catid);

        // $('.btn-cat').attr('class','btn btn-outline-primary waves-effect waves-light btn-cat');
        // $('#btncat'+id).attr('class','btn btn-primary waves-effect waves-light btn-cat');

        // $.get(catid, function(data){
        //     $('#block-product').empty().html(data);
        // });

        let path = app.url+'/pos/readData/'+id+'/'+$('#shopid').attr("value");
        console.log(path);
        
        $('.btn-cat').attr('class','btn btn-outline-primary waves-effect waves-light btn-cat');
        $('#btncat'+id).attr('class','btn btn-primary waves-effect waves-light btn-cat');

        $.get(path, function(data){
            $('#block-product').empty().html(data)                
        })
        
    }



    // click ชื่อสินค้า
    function show_title(id)
    {
        $('#tt' + id).attr("class","text-left");
        let txt = $('#tt' + id).attr("title3");
        console.log(txt);
        $('#tt' + id).tooltip({ title: txt });
        $('#tt' + id).tooltip("show");
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
        $('#h_amount').val(pay_total);

        // รวมจำนวนเงินในชำระเงินด้วยวิธีอื่น
        $('#t_other_pay').val(pay_total);

        let tr = $(this).closest('tr');
        tr.remove();

        torn();

        Dashmix.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: 'ลบแล้ว'});
    })

    // เปลี่ยนประเภทส่วนลด
    $('input[type=radio][name=typeDiscount]').change(function() {
        if (this.value == 'bath') {
            //console.log('value', 'bath');
            discount();
            get_clear();
        }
        else if (this.value == 'percent') {
            //console.log('value', 'percent');
            real_percent_total();
            get_clear();
        }
    });


    
