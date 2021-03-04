<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2197,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2197,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2197,$translate)); ?></span></p>
      </div>
    </section>
   <main role="main">
      <div class="container page-white-box mt-3">
      <div>
        <?php if($message = Session::get('success')): ?>
         <div class="alert alert-success" role="alert">
           <span class="alert_icon lnr lnr-checkmark-circle"></span>
             <?php echo e($message); ?>

             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span class="fa fa-close" aria-hidden="true"></span>
             </button>
         </div>
        <?php endif; ?>
        <?php if($message = Session::get('error')): ?>
        <div class="alert alert-danger" role="alert">
           <span class="alert_icon lnr lnr-warning"></span>
             <?php echo e($message); ?>

             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span class="fa fa-close" aria-hidden="true"></span>
             </button>
        </div>
        <?php endif; ?>
        <?php if(!$errors->isEmpty()): ?>
        <div class="alert alert-danger" role="alert">
        <span class="alert_icon lnr lnr-warning"></span>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($error); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-close" aria-hidden="true"></span>
        </button>
        </div>
        <?php endif; ?>
        </div>
         <div class="row">
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1">
         	    <div class="container emp-profile">
                  <div class="row">
                    <div class="col-md-3 white-bg">
                        <div class="profile-img">
                        <a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($user_details->username); ?>" title="<?php echo e($user_details->name); ?>">
                        <?php if($user_details->user_photo != ""): ?>
                        <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($user_details->user_photo); ?>" alt="" class="rounded">
                        <?php else: ?>
                        <img src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="" class="rounded">
                        <?php endif; ?>
                        </a>   
                        </div>
                        <div align="center">
                            <div class="info mt-2">
                        <div class="title">
                            <a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($user_details->username); ?>" title="<?php echo e($user_details->username); ?>" class="theme-color"><?php echo e($user_details->name); ?></a>
                        </div>
                        <div class="desc"><?php echo e($total_product); ?> <?php echo e(__('Products')); ?></div>
                        </div>
                        <div class="stars-active">
                         <?php if($count_rating == 0): ?>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <?php endif; ?>
                        <?php if($count_rating == 1): ?>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <?php endif; ?>
                        <?php if($count_rating == 2): ?>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <?php endif; ?>
                        <?php if($count_rating == 3): ?>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <?php endif; ?>
                        <?php if($count_rating == 4): ?>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <?php endif; ?>
                        <?php if($count_rating == 5): ?>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <?php endif; ?>
                        <span>( <?php echo e($getreview); ?> <?php echo e(Helper::translation(2144,$translate)); ?> )</span>
                        </div>
                        </div>
                        </div> 
                       <div class="col-md-9 ash-bg">
                        <div class="profile-banner">
                         <?php if($user_details->user_banner != ""): ?>
                           <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($user_details->user_banner); ?>" alt="" class="rounded">
                         <?php else: ?>
                         <img src="<?php echo e(url('/')); ?>/public/img/no-image.jpg" alt="" class="rounded">
                         <?php endif; ?>  
                        </div>
                        <div class="profile-head">
                                    <?php if($user_details->user_address != ""): ?>
                                    <h4 class="text-white">
                                        <?php echo e($user_details->user_address); ?>

                                    </h4>
                                    <?php endif; ?>
                                    <p class="theme-color">
                                        <?php if($user_details->country_name != ""): ?><?php echo e($user_details->country_name); ?>,<?php endif; ?> Member since <?php echo e(date('F Y', strtotime($user_details->created_at))); ?>

                                    </p>
                       </div>
                       <div class="tabnav mt-3">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo e(Helper::translation(2108,$translate)); ?></a>
                                </li>
                                <?php if($user_details->user_type == 'vendor'): ?>
                                <li class="nav-item">
                                    <a class="nav-link show" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="true"><?php echo e(Helper::translation(1975,$translate)); ?></a>
                                </li>
                                <?php endif; ?>
                               <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><?php echo e(Helper::translation(2198,$translate)); ?></a>
                                </li>
                                </ul>
                        </div>    
                        <div class="tab-content profile-tab" id="myTabContent_new">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                      <div class="row">
                                            <div class="col-md-3">
                                                <label><?php echo e(Helper::translation(2018,$translate)); ?></label>
                                            </div>
                                            <div class="col-md-9">
                                                <p><?php echo e($user_details->name); ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label><?php echo e(Helper::translation(2014,$translate)); ?></label>
                                            </div>
                                            <div class="col-md-9">
                                                <p><?php echo e($user_details->email); ?></p>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-3">
                                                <label><?php echo e(Helper::translation(2103,$translate)); ?></label>
                                            </div>
                                            <div class="col-md-9">
                                                <p><?php echo e($user_details->user_gender); ?></p>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-3">
                                                <label><?php echo e(Helper::translation(2199,$translate)); ?></label>
                                            </div>
                                            <div class="col-md-9">
                                               <?php echo nl2br($user_details->user_about); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label><?php echo e(Helper::translation(2200,$translate)); ?></label>
                                            </div>
                                            <div class="col-md-9">
                                                <p><?php echo e($user_details->user_phone); ?></p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
                              <div class="mt-1 mb-1 pt-1 pb-1">
                           <div class="row" align="center">
                           <?php $z = 1; ?>
                              <?php $__currentLoopData = $shop['product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                   <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-2 pb-2">
                                   <div class="product-grid2">
                                    <div class="product-image2">
                                    <div class="product-hider">
                               <a href="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>" data-fancybox="quick-view-<?php echo e($product->product_token.$z); ?>" data-type="image" class="quickview">
                               <i class="fa fa-eye"></i>
                               <p><?php echo e(Helper::translation(2060,$translate)); ?><br/><?php echo e(Helper::translation(2061,$translate)); ?></p>
                               </a>
                               <div class="product-images">
                                    <?php $imagecount = count($product->productimages); ?>
                                    <?php if($imagecount != 0): ?>
                                    <?php $__currentLoopData = $product->productimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($images->product_image); ?>" data-fancybox="quick-view-<?php echo e($product->product_token.$z); ?>" data-type="image"></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </div>
                                    <div class="product-former">
                                    <h3><?php echo e($product->product_name); ?></h3>
                                    <div class="mt-3"><?php echo e(Helper::translation(2062,$translate)); ?> : <?php if($product->product_stock != 0): ?><span class="theme-color"><?php echo e(Helper::translation(2063,$translate)); ?> (<?php echo e($product->product_stock); ?>)</span><?php else: ?><span class="red-color"><?php echo e(Helper::translation(2064,$translate)); ?> (<?php echo e($product->product_stock); ?>)</span><?php endif; ?></div>
            <?php if($product->product_condition == 'new'){ $badg = "badge badge-warning"; } else { $badg = "badge badge-secondary"; } ?>
            <?php if($product->product_condition != ""): ?><div class="mt-2"><?php echo e(Helper::translation(1950,$translate)); ?> : <span class="<?php echo e($badg); ?>"><?php echo e($product->product_condition); ?></span></div><?php endif; ?>
                                    <div class="mt-3"><?php if($product->product_price != 0): ?><span <?php if($product->product_offer_price != 0): ?> class="fs16 offer-price red-color" <?php else: ?> class="fs32" <?php endif; ?>><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_price); ?></span><?php endif; ?> <?php if($product->product_offer_price != 0): ?><span class="fs32"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_offer_price); ?></span><?php endif; ?></div>                                <p class="mt-3">
                                    <?php echo e($product->product_short_desc); ?> 
                                    </p>
                                    <p><a href="<?php echo e(URL::to('/product')); ?>/<?php echo e($product->product_slug); ?>" class="btn button-color"><?php echo e(Helper::translation(2065,$translate)); ?></a></p>
                                    </div>
                                    </div>
                                    <a href="<?php echo e(URL::to('/product')); ?>/<?php echo e($product->product_slug); ?>">
                                            <?php if($product->product_image != ""): ?>
                                            <img class="pic-1" src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>">
                                            <?php else: ?>
                                            <img class="pic-1" src="<?php echo e(url('/')); ?>/public/img/no-image.jpg">
                                            <?php endif; ?>
                                            <?php $imagecount = count($product->productimages); ?>
                                            <?php if($imagecount != 0): ?>
                                            <?php $no = 1; ?>
                                            <?php $__currentLoopData = $product->productimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($no == 1): ?>
                                            <img class="pic-2" src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($images->product_image); ?>">
                                            <?php endif; ?>
                                            <?php $no++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                            <img class="pic-2" src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>">
                                            <?php endif; ?>
                                            </a>
                                            <?php if($product->flash_deals == 1): ?>
                                            <ul class="countdown-<?php echo e($product->product_token); ?>" id="countdown-timer">
                                                <li>
                                                    <span class="days">00</span>
                                                    <p class="days_ref"><?php echo e(Helper::translation(2071,$translate)); ?></p>
                                                </li>
                                                <li>
                                                    <span class="hours">00</span>
                                                    <p class="hours_ref"><?php echo e(Helper::translation(2072,$translate)); ?></p>
                                                </li>
                                                <li>
                                                    <span class="minutes">00</span>
                                                    <p class="minutes_ref"><?php echo e(Helper::translation(2073,$translate)); ?></p>
                                                </li>
                                                <li>
                                                    <span class="seconds last">00</span>
                                                    <p class="seconds_ref"><?php echo e(Helper::translation(2074,$translate)); ?></p>
                                                </li>
                                            </ul>
                                            <?php endif; ?>
                                            <ul class="social">
                                                <?php if(Auth::guest()): ?>
                                                <li><a href="<?php echo e(url('/login')); ?>" data-tip="<?php echo e(Helper::translation(2066,$translate)); ?>"><i class="fa fa-shopping-bag"></i></a></li>
                                                <?php else: ?>
                                                <?php if(Auth::user()->id != $product->user_id): ?>
                                                <li><a href="<?php echo e(url('/wishlist')); ?>/<?php echo e(Auth::user()->id); ?>/<?php echo e($product->product_token); ?>" data-tip="<?php echo e(Helper::translation(2066,$translate)); ?>"><i class="fa fa-shopping-bag"></i></a></li><?php endif; ?>
                                                <?php endif; ?>
                                                <li><a href="<?php echo e(URL::to('/product')); ?>/<?php echo e($product->product_slug); ?>" data-tip="<?php echo e(Helper::translation(2067,$translate)); ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                            <a class="add-to-cart" href="<?php echo e(URL::to('/product')); ?>/<?php echo e($product->product_slug); ?>"><?php echo e(Helper::translation(2067,$translate)); ?></a>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a href="<?php echo e(URL::to('/product')); ?>/<?php echo e($product->product_slug); ?>"><?php echo e($product->product_name); ?></a></h3>
                                            <span class="price like"><?php if($product->product_offer_price != 0): ?><span class="linethrow"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_price); ?></span><?php endif; ?> <?php if($product->product_offer_price != 0): ?><span class="like"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_offer_price); ?></span><?php else: ?><span class="like"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_price); ?></span><?php endif; ?></span>
                                        </div>
                                        </div>
                                    </div>
                                   <?php $z++; ?>      
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                           </div>
                            </div>
                           <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                           <form action="<?php echo e(route('user')); ?>" class="seller_form" id="seller_form" method="post" enctype="multipart/form-data">
                              <?php echo e(csrf_field()); ?>

                              <div class="row form-group">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                      <label class="font-weight-bold" for="fullname"><?php echo e(Helper::translation(2015,$translate)); ?></label>
                                      <input type="text" id="from_name" class="form-control" name="from_name" placeholder="<?php echo e(Helper::translation(2015,$translate)); ?>" data-bvalidator="required">
                                    </div>
                                    
                                    <div class="col-md-6">
                                      <label class="font-weight-bold" for="email"><?php echo e(Helper::translation(2014,$translate)); ?></label>
                                      <input type="text" id="email" class="form-control" name="from_email" placeholder="<?php echo e(Helper::translation(2001,$translate)); ?>" data-bvalidator="required,email">
                                    </div>
                                  </div>
                                 <div class="row form-group">
                                    <div class="col-md-12 mb-3 mb-md-0">
                                      <label class="font-weight-bold" for="phone"><?php echo e(Helper::translation(2002,$translate)); ?></label>
                                      <input type="text" id="phone" class="form-control" name="phone" placeholder="<?php echo e(Helper::translation(2200,$translate)); ?>" data-bvalidator="required">
                                    </div>
                                 </div>
                                 <div class="row form-group">
                                  <div class="col-md-12">
                                      <label class="font-weight-bold" for="message"><?php echo e(Helper::translation(2126,$translate)); ?></label> 
                                      <textarea name="message_text" id="message" cols="30" rows="5" class="form-control" data-bvalidator="required"></textarea>
                                    </div>
                                  </div>  
                                  <input type="hidden" name="to_email" value="<?php echo e($user_details->email); ?>">
                                  <input type="hidden" name="to_name" value="<?php echo e($user_details->name); ?>">
                                  <div class="row form-group">
                                    <div class="col-md-12">
                                      <input type="submit" value="<?php echo e(Helper::translation(2201,$translate)); ?>" class="btn button-color">
                                    </div>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           </div>
         </div>
      </div>
    </main>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/user.blade.php ENDPATH**/ ?>