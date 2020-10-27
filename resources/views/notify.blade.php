
<style>
    .notify-unread{
        border-bottom-left-radius: 50%;
        border-top-left-radius: 50%;
        display: inline-flex !important;
        background-color: cornflowerblue;
        width: 12px;
        border-top-right-radius: 50%;
        height: 12px;
        border-bottom-right-radius: 50%;
        border-left: 0;
        border-top: 0;
        border-right: 0;
        border-bottom: 0;
        /* float: right; */
        /* margin-top: 26px; */
        /* margin-bottom: auto; */

        float: left;
        top: 12px;
        margin-top: 5px;
        margin-right: 2px;
    }
    .notification-list .notify-item .notify-details , .notification-list .notify-item .notify-details span{
        font-family: 'Kanit' !important;
    }
</style>
<!-- notification -->
<li class="dropdown notification-list list-inline-item notify">
    <a class="nav-link dropdown-toggle arrow-none waves-effect notify_icon" id="notify_icon" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
        <i class="mdi mdi-bell-outline noti-icon"></i>
        <span class="badge badge-pill badge-danger noti-icon-badge notify_unread_global">
            3
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
        <!-- item-->
        <h6 class="dropdown-item-text">
            Notifications (<span class="notify_unread_element">258</span>)
        </h6>
        <div class="slimscroll notification-item-list notify_body">
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                <p class="notify-details">มีออเดอร์ใหม่
                    <span class="notify-unread"></span>
                    <span class="text-muted">ออเดอร์จากคุณ เมฆา เลื่อนลอย</span>
                    <span class="text-info">เมื่อ 20/10/2563 10:10:10</span>
                </p>
            </a>
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon bg-warning"><i class="mdi mdi-message-text-outline"></i></div>
                <p class="notify-details">
                    New Message received
                    <span class="notify-unread"></span>
                    <span class="text-muted">You have 87 unread messages</span>
                </p>
            </a>
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                <p class="notify-details">Your item is shipped<span class="text-muted">It is a long established fact that a reader will</span></p>
            </a>
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
            </a>
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
            </a>
        </div>
        <!-- All-->
        <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
            View all <i class="fi-arrow-right"></i>
        </a>
    </div>
</li>
<!-- end notification -->