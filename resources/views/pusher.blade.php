
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // console.log(location);
    // หาชื่อร้านค้า เพื่อ pusher ได้ถูกร้าน
    var path_name = location.pathname;
    var path_array = path_name.split("/");
    var shop_url = '';
    if(path_array[1] != '')
        shop_url = path_array[1];
    var host_url = location.host;
    sub_domain = host_url.replace('.gohala.local','');
    sub_domain = sub_domain.replace('.gohala.com','');
    // console.log(sub_domain); // หา manage หรือ account เพื่อแจ้งเตือนให้ user, admin

    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        // console.log(data);
        if(data.type == sub_domain)
        {
            notify();
            if(shop_url != '' && data.shop_url != '' && (shop_url == data.shop_url || shop_url == 'notify'))
            {
                toastr.info(data.msg);
            }
        }
        if($('#table_notify').length >0)
        {
            console.log('reload table notify');
            var datatable = $('#table_notify').DataTable();
            console.log(datatable.ajax.reload(null,false));
            // .ajax().reload(null,false)
        }
    });

</script>