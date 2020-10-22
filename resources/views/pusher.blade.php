
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // console.log(location.pathname);
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
        // alert(JSON.stringify(data));
        if(data.type == sub_domain && shop_url != '' && data.shop_url != '' && shop_url == data.shop_url)
        {
            toastr.info(data.msg);
            notify();
        }
    });

    $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
        window.location.reload();
    };
</script>