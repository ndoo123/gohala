<!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
               
                <ul class="metismenu list-unstyled mm-show" id="side-menu">
             
                    
                    <?php if(isset($shop)):?>
                    <li class="p-0">
                        <a style="color:white;text-decoration:underline" href="<?php echo url('');?>/shops">เปลี่ยนร้าน</a>
                       
                    </li>
                    <?php endif;?>
                    <li class="menu-title">
                        <button type="button" class="btn btn-sm btn-primary btn-block text-left"><?php echo $shop->name;?></button>
                        
                    </li>
                    <li class="menu-title">จัดการ</li>
                    
                 
                    <!-- <li class="menu-title">จัดการ</li> -->
                    <li>
                        <a href="<?php echo url($shop->url);?>" class="waves-effect">
                            <i class="ti-home"></i> <span> <?php echo __('menu.dashboard');?>  </span>
                        </a>
                    </li>
                    <li class="mm-active">
                        <a href="javascript: void(0);" class="has-arrow waves-effect mm-active">
                            <i class="ti-pie-chart"></i>
                            <span>ข้อมูลสินค้า</span>
                        </a>
                        <ul class="sub-menu mm-collapse mm-show" aria-expanded="false">
                            <li><a href="<?php echo url($shop->url.'/products');?>"><?php echo __('menu.product');?></a></li>
                            <li><a href="<?php echo url($shop->url.'/categories');?>">หมวดหมู่สินค้า</a></li>
                        </ul>
                    </li>
                    <li>
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