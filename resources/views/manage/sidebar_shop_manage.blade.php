<!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
               
                <ul class="metismenu" id="side-menu">
                    
                    <li class="menu-title"><?php echo $shop->name;?></li>
                    
                    <?php if(isset($shop)):?>
                    <li class="p-2">
                        <button type="button" onclick="location.href='<?php echo url('');?>/shops'" class="btn btn-sm btn-primary btn-block">ร้านของฉัน</button>
                    </li>
                    <?php endif;?>
                    
                    <li class="menu-title">จัดการ</li>
                    
                    <li class="menu-title"><?php echo $shop->name;?></li>
                    <!-- <li class="menu-title">จัดการ</li> -->
                    <li>
                        <a href="<?php echo url($shop->url);?>" class="waves-effect">
                            <i class="ti-home"></i> <span> <?php echo __('menu.dashboard');?>  </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo url($shop->url.'/products');?>" class="waves-effect">
                            <i class="ti-home"></i> <span> <?php echo __('menu.product');?> </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo url($shop->url.'/setting_shop');?>" class="waves-effect">
                        <a href="<?php echo url($shop->url.'/settings');?>" class="waves-effect">
                            <i class="ti-home"></i> <span> <?php echo __('menu.setup');?> </span>
                        </a>
                    </li>
                    
                </ul>

            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
<!-- Left Sidebar End -->