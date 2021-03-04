<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
          <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <?php if($allsettings->site_logo != ''): ?>
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>"  alt="<?php echo e($allsettings->site_title); ?>" width="180"/></a>
                <?php else: ?>
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><?php echo e(substr($allsettings->site_title,0,10)); ?></a>
                <?php endif; ?>
                <?php if($allsettings->site_favicon != ''): ?>
                <a class="navbar-brand hidden" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_favicon); ?>"  alt="<?php echo e($allsettings->site_title); ?>" width="24"/></a>
                <?php else: ?>
                <a class="navbar-brand hidden" href="<?php echo e(url('/')); ?>"><?php echo e(substr($allsettings->site_title,0,1)); ?></a>
                <?php endif; ?>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                   <?php if(in_array('dashboard',$avilable)): ?>
                   <li>
                        <a href="<?php echo e(url('/admin')); ?>"> <i class="menu-icon fa fa-dashboard"></i><?php echo e(Helper::translation(3549,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('settings',$avilable)): ?>                 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gears"></i><?php echo e(Helper::translation(3408,$translate)); ?></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/general-settings')); ?>"><?php echo e(Helper::translation(3306,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/color-settings')); ?>"><?php echo e(Helper::translation(3171,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/email-settings')); ?>"><?php echo e(Helper::translation(3264,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/media-settings')); ?>"><?php echo e(Helper::translation(3522,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/currency-settings')); ?>"><?php echo e(Helper::translation(3201,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/payment-settings')); ?>"><?php echo e(Helper::translation(3552,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/social-settings')); ?>"><?php echo e(Helper::translation(3555,$translate)); ?></a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo e(url('/admin/preferred-settings')); ?>"><?php echo e(Helper::translation(3558,$translate)); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('block-section',$avilable)): ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file-text-o"></i><?php echo e(Helper::translation(3561,$translate)); ?></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-text-o"></i><a href="<?php echo e(url('/admin/home-section')); ?>"><?php echo e(Helper::translation(3411,$translate)); ?></a></li>
                            <li><i class="fa fa-file-text-o"></i><a href="<?php echo e(url('/admin/footer-section')); ?>"><?php echo e(Helper::translation(3294,$translate)); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(Auth::user()->id == 1): ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-group"></i><?php echo e(Helper::translation(3564,$translate)); ?></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-user"></i><a href="<?php echo e(url('/admin/administrator')); ?>"><?php echo e(Helper::translation(3105,$translate)); ?></a></li>
                            <li><i class="fa fa-user"></i><a href="<?php echo e(url('/admin/customer')); ?>"><?php echo e(Helper::translation(3210,$translate)); ?></a></li>
                            <?php if($allsettings->type_of_marketplace == 'multi-vendor'): ?>
                            <li><i class="fa fa-user"></i><a href="<?php echo e(url('/admin/vendor')); ?>"><?php echo e(Helper::translation(3567,$translate)); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('country',$avilable)): ?>                    
                    <li>
                        <a href="<?php echo e(url('/admin/country-settings')); ?>"> <i class="menu-icon fa fa-flag"></i><?php echo e(Helper::translation(2007,$translate)); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('manage-categories',$avilable)): ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-location-arrow"></i><?php echo e(Helper::translation(3570,$translate)); ?></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/category')); ?>"><?php echo e(Helper::translation(3045,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/sub-category')); ?>"><?php echo e(Helper::translation(3099,$translate)); ?></a></li>
                         </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('products',$avilable)): ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart"></i><?php echo e(Helper::translation(1975,$translate)); ?></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="<?php echo e(url('/admin/products')); ?>"><?php echo e(Helper::translation(3573,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="<?php echo e(url('/admin/attribute-type')); ?>"><?php echo e(Helper::translation(1914,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="<?php echo e(url('/admin/attribute-value')); ?>"><?php echo e(Helper::translation(1921,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="<?php echo e(url('/admin/brands')); ?>"><?php echo e(Helper::translation(3144,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="<?php echo e(url('/admin/coupons')); ?>">Coupons</a></li>
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="<?php echo e(url('/admin/orders')); ?>"><?php echo e(Helper::translation(2154,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/refund')); ?>"><?php echo e(Helper::translation(2115,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/rating')); ?>"><?php echo e(Helper::translation(2114,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="<?php echo e(url('/admin/withdrawal')); ?>"><?php echo e(Helper::translation(3576,$translate)); ?></a></li>
                         </ul>
                    </li>
                    <?php endif; ?>
                    <?php if($allsettings->site_blog_display == 1): ?>
                    <?php if(in_array('blog',$avilable)): ?> 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-comments-o"></i><?php echo e(Helper::translation(1978,$translate)); ?></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-comments-o"></i><a href="<?php echo e(url('/admin/blog-category')); ?>"><?php echo e(Helper::translation(3045,$translate)); ?></a></li>
                            <li><i class="menu-icon fa fa-comments-o"></i><a href="<?php echo e(url('/admin/post')); ?>"><?php echo e(Helper::translation(3750,$translate)); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(in_array('ads',$avilable)): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/ads')); ?>"> <i class="menu-icon fa fa-file-image-o"></i><?php echo e(Helper::translation(3111,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('pages',$avilable)): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/pages')); ?>"> <i class="menu-icon fa fa-file-text-o"></i><?php echo e(Helper::translation(2028,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('slideshow',$avilable)): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/slideshow')); ?>"> <i class="menu-icon fa fa-image"></i><?php echo e(Helper::translation(3579,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if(in_array('contact',$avilable)): ?>                                      
                    <li>
                        <a href="<?php echo e(url('/admin/contact')); ?>"> <i class="menu-icon fa fa-address-book-o"></i><?php echo e(Helper::translation(2012,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php if($allsettings->site_newsletter_display == 1): ?>
                    <?php if(in_array('newsletter',$avilable)): ?>
                    <li>
                        <a href="<?php echo e(url('/admin/newsletter')); ?>"> <i class="menu-icon fa fa-newspaper-o"></i><?php echo e(Helper::translation(2029,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(in_array('languages',$avilable)): ?> 
                    <li>
                        <a href="<?php echo e(url('/admin/languages')); ?>"> <i class="menu-icon fa fa-language"></i><?php echo e(Helper::translation(3510,$translate)); ?> </a>
                    </li>
                    <?php endif; ?>
                    </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/admin/navigation.blade.php ENDPATH**/ ?>