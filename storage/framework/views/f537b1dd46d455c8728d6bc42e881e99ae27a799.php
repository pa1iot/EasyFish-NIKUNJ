<header id="header">
<div class="container-fluid">
      <div class="row">
      <div id="logo" class="col-lg-3 col-md-3 col-sm-4 mb-1">
        <?php if($allsettings->site_logo != ''): ?>
    	<a href="<?php echo e(URL::to('/')); ?>">
    	<img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>" alt="<?php echo e($allsettings->site_title); ?>">
    	</a>
    	<?php endif; ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 mt-2 pt-1">
             <form action="<?php echo e(route('shop')); ?>" class="search_form" id="search_form" method="post" enctype="multipart/form-data">
             <?php echo e(csrf_field()); ?>

              <div class="input-group flex-fill">
                 <input type="text" class="form-control" id="search_text" name="search_text" placeholder="<?php echo e(Helper::translation(2039,$translate)); ?>">
                   <div class="input-group-append">
                    <button class="btn btn-secondary button-color" type="submit">
                       <i class="fa fa-search"></i>
                 </button>
            </div>
         </div>
         </form>
      </div> 
     <div class="col-lg-5 col-md-5 col-sm-4 mt-2 pt-1 mb-1">
      <nav class="pull-right" id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a></li>
          <li> <a href="<?php echo e(URL::to('/shop')); ?>"> <?php echo e(Helper::translation(2040,$translate)); ?> </a></li>
          <?php if($allsettings->site_blog_display == 1): ?>
          <li> <a href="<?php echo e(URL::to('/blog')); ?>"> <?php echo e(Helper::translation(1978,$translate)); ?> </a></li>
          <?php endif; ?>
          <?php $__currentLoopData = $mainmenu['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		  <li> <a href="<?php echo e(URL::to('/page/')); ?>/<?php echo e($pages->page_slug); ?>"> <?php echo e($pages->page_title); ?> </a></li>
		  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <li> <a href="<?php echo e(URL::to('/contact')); ?>"> <?php echo e(Helper::translation(2012,$translate)); ?> </a></li>
          <?php if($allsettings->google_translate == 1): ?>
          <li class="menu-has-children"><a href="javascript:void(0)"><span class="fa fa-language"></span> <?php echo e($language_title); ?></a>
            <ul>
              <?php $__currentLoopData = $languages['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a href="<?php echo e(URL::to('/translate')); ?>/<?php echo e($language->language_code); ?>"><?php echo e($language->language_name); ?></a></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </li>
          <?php endif; ?>
          <?php if(Auth::guest()): ?>
          <li><a href="<?php echo e(url('/login')); ?>" class="btn login-btn"><?php echo e(Helper::translation(2041,$translate)); ?></a></li>
          <?php else: ?> 
          <li class="menu-has-children"><a href="javascript:void(0)"><?php echo e(Helper::translation(2042,$translate)); ?></a>
            <ul>
              <?php if(Auth::user()->user_type == 'customer'): ?>
              <li><a href="<?php echo e(url('/my-profile')); ?>"><?php echo e(Helper::translation(2043,$translate)); ?></a></li>
              <li><a href="<?php echo e(url('/my-purchase')); ?>"><?php echo e(Helper::translation(2044,$translate)); ?></a></li>
              <li><a href="<?php echo e(url('/my-wallet')); ?>"><?php echo e(Helper::translation(2045,$translate)); ?></a></li>
              <?php endif; ?>
              <?php if(Auth::user()->user_type == 'vendor'): ?>
              <li><a href="<?php echo e(url('/my-profile')); ?>"><?php echo e(Helper::translation(2043,$translate)); ?></a></li>
              <li><a href="<?php echo e(url('/my-product')); ?>"><?php echo e(Helper::translation(2046,$translate)); ?></a></li>
              <li><a href="<?php echo e(url('/attribute-type')); ?>"><?php echo e(Helper::translation(1914,$translate)); ?></a></li>
              <li><a href="<?php echo e(url('/attribute-value')); ?>"><?php echo e(Helper::translation(1921,$translate)); ?></a></li>
              <li><a href="<?php echo e(url('/my-coupon')); ?>"><?php echo e(Helper::translation(2047,$translate)); ?></a></li>
              <li><a href="<?php echo e(url('/my-orders')); ?>"><?php echo e(Helper::translation(2026,$translate)); ?></a></li>
              <li><a href="<?php echo e(url('/my-purchase')); ?>"><?php echo e(Helper::translation(2044,$translate)); ?></a></li>
              <li><a href="<?php echo e(url('/my-wallet')); ?>"><?php echo e(Helper::translation(2045,$translate)); ?></a></li>
              <?php endif; ?>
              <li><a href="<?php echo e(url('/logout')); ?>"><?php echo e(Helper::translation(2048,$translate)); ?></a></li>
            </ul>
          </li>
          <?php endif; ?>
        </ul>
      </nav><!-- #nav-menu-container -->
      </div>
      </div>
    </div>
    <div class="navbar navbar-expand-lg category-bar row">
                <div class="container-fluid">
                  <div class="col-lg-3 col-md-12 col-sm-12">
                    <button type="button" id="sidebarCollapse" class="btn button-color">
                        <i class="fa fa-bars"></i>
                        <span><?php echo e(Helper::translation(1932,$translate)); ?></span>
                    </button>
                    <button class="btn button-color d-inline-block d-lg-none ml-auto pull-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <button class="btn button-color d-inline-block d-lg-none ml-auto mmiddle pull-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                  </div> 
                  <div class="col-lg-4 col-md-12 col-sm-12">
                   <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                        <ul class="nav navbar-nav">
                            <?php if($allsettings->type_of_marketplace == 'multi-vendor'): ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo e(url('/best-sellers')); ?>"><?php echo e(Helper::translation(1973,$translate)); ?></a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/new-releases')); ?>"><?php echo e(Helper::translation(2049,$translate)); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/top-deals')); ?>"><?php echo e(Helper::translation(2050,$translate)); ?></a>
                            </li>
                            <?php if($allsettings->type_of_marketplace == 'multi-vendor'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/start-sellings')); ?>"><?php echo e(Helper::translation(2051,$translate)); ?></a>
                            </li>
                            <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/track-order')); ?>"><?php echo e(Helper::translation(2052,$translate)); ?></a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/wishlist')); ?>"><?php echo e(Helper::translation(2053,$translate)); ?></a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                   </div>
                  <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <?php if($allsettings->type_of_marketplace == 'multi-vendor'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/track-order')); ?>"><?php echo e(Helper::translation(2052,$translate)); ?></a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/wishlist')); ?>"><?php echo e(Helper::translation(2053,$translate)); ?></a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/checkout')); ?>"><?php echo e(Helper::translation(1995,$translate)); ?></a>
                            </li>
                            <li class="nav-item"><a href="<?php echo e(url('/cart')); ?>" class="nav-link"><i class="fa fa-shopping-cart"></i> <?php echo e(Helper::translation(1983,$translate)); ?> <span class="cart-badge"><?php echo e($cart_count); ?></span></a></li>
                        </ul>
                    </div>
                   </div> 
                 </div>
            </nav>
            <nav id="sidebar">
            <div id="dismiss">
                <i class="fa fa-arrow-left"></i>
            </div>
            <div class="sidebar-header">
                <h3><?php echo e(Helper::translation(1932,$translate)); ?></h3>
            </div>
            <ul class="list-unstyled components">
                <?php $__currentLoopData = $categories['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a <?php if(count($menu->subcategory) != 0): ?> href="#menu-<?php echo e($menu->cat_id); ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" <?php else: ?> href="<?php echo e(URL::to('/shop/category')); ?>/<?php echo e($menu->category_slug); ?>"  <?php endif; ?>>
                        <?php if($menu->category_image != ''): ?>
                        <img src="<?php echo e(url('/')); ?>/public/storage/category/<?php echo e($menu->category_image); ?>" alt="<?php echo e($menu->category_name); ?>" class="menu-icon">
                        <?php else: ?>
                        <i class="fa fa-paper-plane"></i>
                        <?php endif; ?>
                        <span onclick="window.location.href='<?php echo e(URL::to('/shop/category')); ?>/<?php echo e($menu->category_slug); ?>'"><?php echo e($menu->category_name); ?></span>
                    </a>
                    <?php if(count($menu->subcategory) != 0): ?>
                    <ul class="collapse list-unstyled" id="menu-<?php echo e($menu->cat_id); ?>">
                    <?php $__currentLoopData = $menu->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                        <li>
                            <a href="<?php echo e(URL::to('/shop/subcategory')); ?>/<?php echo e($sub_category->subcategory_slug); ?>"><?php echo e($sub_category->subcategory_name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                    </ul>
                    <?php endif; ?>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
        </div>
</header><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/header.blade.php ENDPATH**/ ?>