
notify();

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
function get_url() // สำหรับแยก url ของ ร้านค้าทั้งหมด และเฉพาะร้านค้า
{
    var url = location.origin;
    if($("#shop_url").val() !== undefined)
    {
        var url = location.origin+'/'+$("#shop_url").val();
    }
    return url;
}
function notify()
{
    var url = get_url()+'/notify_bar';
    var obj = new Object();
    obj._token = $('meta[name=csrf-token]').attr('content');

    // console.log(url);
    // console.log(obj);
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function(res){
            console.log(res);
            if(res.result == 1)
            {
                $('.notify_unread_element').html(res.notify_unread_element);
                $('.notify_unread_global').html(res.notify_unread_global);
                $('.notify_all_element').html(res.notify_all_element);
                if(res.notify_unread_global > 0)
                    $(".notify_unread_global").fadeIn();
                if(res.notify_unread_global < 1)
                {
                    $(".notify_unread_global").fadeOut();
                }
                if(res.notify_unread_element > 0)
                {
                    var icon = [ '',
                    '<div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>',
                    '<div class="notify-icon bg-info"><i class="mdi mdi-cash-multiple"></i></div>',
                    '<div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>',
                    ];
                    var append = '<!-- item-->';
                    $.each(res.notify, function(key,value){
                        // console.log(key);
                        // console.log(value);
                        var unread = '';
                        var font_weight = ' style="font-weight: 400" ';
                        var event_name = res.event_name[value.event_id];
                        if(value.is_read == 0)
                        {
                            unread = '<span class="notify-unread"></span>';
                            font_weight = ' style="font-weight: 600" ';
                        }
                        if(res.from_shop == 1)
                        {
                            event_name += ' <span style="font-size:12px">ร้าน '+value.shop_name+'</span>';
                        }
                        append += 
                        '<a href="javascript:void(0);" class="dropdown-item notify-item" order_id="'+value.order_id+'" shop_url="'+value.shop_url+'" event_id="'+value.event_id+'">'
                            + icon[value.event_id]
                            + '<p class="notify-details"'+ font_weight +'>' +event_name
                                + unread
                                + '<span class="text-muted">'+ value.info +'</span>'
                                + '<span class="text-info">'+ value.created_show +'</span>'
                            + '</p>'
                        + '</a>';
                    });
                    
                    $('.notify_body').css('height','auto').html(append);
                }
                else
                {
                    $('.notify_body').css('height','auto').html('<span class="text-center d-block">ยังไม่มีการแจ้งเตือน</span>');
                }
            }
        }
    });
}
$(document).on('shown.bs.dropdown','.notify',function(e){ 
        var url = get_url()+'/notify_update_global';
        var obj = new Object();
        obj._token = $('meta[name=csrf-token]').attr('content');
        // console.log(obj);
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: obj,
            success: function(res){
                console.log(res);
                if(res.result == 1)
                {
                    notify();
                }
            }
        });
}); // เมื่อคลิกกระดิ่งให้เปลี่ยนเป็นอ่านให้หมด

$(document).on('click','.notify-item',function(){ // เปลี่ยนแต่คลิกแต่ละออเดอร์เป็นอ่านแล้ว
    var order_id = $(this).attr('order_id');
    var shop_url = $(this).attr('shop_url');
    var event_id = $(this).attr('event_id');
    var url = get_url()+'/notify_read';
    // console.log(url);
    var obj = new Object();
    obj._token = $('meta[name=csrf-token]').attr('content');
    obj.order_id = order_id;
    obj.event_id = event_id;
    // console.log(obj);
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: obj,
        success: function(res){
            // console.log(res);
            if(res.result == 1)
            {
                var sub_domain = getSubDomain();
                // console.log(res);
                // console.log(window.location);
                // console.log('notify.js');
                // console.log(sub_domain);
                if(sub_domain == "account")
                {
                    $("ul.nav.nav-tabs a.nav-link.myorder").click();
                    var notify_type = '';
                    if(res.notify.event_id == 1)
                    {
                        notify_type = 'order';
                    }
                    else if(res.notify.event_id == 2)
                    {
                        notify_type = 'payment';
                    }
                    else if(res.notify.event_id == 3)
                    {
                        notify_type = 'order';
                    }
                    $("#notify_type").val(notify_type);
                    $("#master_order_id").val(res.notify.order_id);
                    table_order_datatables();
                }
                else if(sub_domain == "manage")
                {
                    var go_location = $("#manage_url").val()+'/'+shop_url+'/order?';
                    if(res.notify.event_id == 1)
                    {
                        go_location += 'order_id='+res.notify.order_id;
                    }
                    else if(res.notify.event_id == 2)
                    {
                        go_location += 'payment_id='+res.notify.order_id;
                    }
                    else if(res.notify.event_id == 3)
                    {
                        go_location += 'order_id='+res.notify.order_id;
                    }
                    window.location.href = go_location;
                }
            }
        }
    });
});
function table_order_datatables()
{
    return $('#table_order').DataTable(
    {
        serverSide: true,
        processing: false,
        destroy: true,
        // retrieve: true,
        // order: [[ 1, "asc" ]],
        search: {
            search: $("#master_order_id").val()
        },
        ajax: {
            url: $('#table_order').attr('remote_url'),
            data: {},
        },
        columns: [
            { data: 'id', name: 'id', class: 'text-center' },
            { data: 'order_date', name: 'order_date', class: 'text-center' },
            { data: 'shop_name', name: 'shop_name', class: 'text-center',"orderable": false, "searchable": false },
            { data: 'get_sold_price', name: 'get_sold_price', class: 'text-center',"orderable": false, "searchable": false },
            { data: 'status', name: 'status', class: 'text-center',"orderable": false, "searchable": false },
            { data: 'action', name: 'action', class: 'text-center',"orderable": false, "searchable": false },
        ],
        createdRow: function( row, data, dataIndex ) {
            var td_length = $('td',row).length-1;
            $.each($('td',row),function(index){
                if(index != td_length)
                {
                    // $(this).attr('id', 'data');
                    $(this).addClass('order_detail');
                    $(this).attr('style','cursor: context-menu;');
                }
                $(this).attr('order_id',data.id);
                // console.log(td_length);
            });
            // console.log(data);
        },
        initComplete: function(settingss,json){
            // console.log( 'initComplete' );
            var order_id = $("#master_order_id").val();
            var td = $(this).find('td.order_detail.sorting_1');
            td.each(function(){
                if($(this).attr('order_id') == order_id)
                {
                    // console.log(this);
                    if($("#notify_type").val() == 'order')
                    {
                        $(this).click();
                    }
                    else if($("#notify_type").val() == 'payment')
                    {
                        $(this).closest('tr').find('.btn_order_payment_view').click();
                    }
                    $("#notify_type").val('');
                }
            });
        },
    });
}