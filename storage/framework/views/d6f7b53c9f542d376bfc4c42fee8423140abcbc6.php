<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(1973,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
   <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(1973,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(1973,$translate)); ?></span></p>
      </div>
    </section>
  <main role="main">
      <div class="container page-white-box mt-3">
         <div class="row">
           <?php $__currentLoopData = $best['seller']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <div class="col-lg-3 col-md-4 col-sm-6 mt-1 mb-1 pt-1 pb-1 prod-item">
    		    <div class="card profile-card-2">
                    <div class="card-img-block">
                      <a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($seller->username); ?>" title="<?php echo e($seller->name); ?>">
                        <?php if($seller->user_banner != ""): ?>
                        <img class="img-fluid b-sellers" src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($seller->user_banner); ?>" alt="">
                        <?php else: ?>
                        <img class="img-fluid b-sellers" src="<?php echo e(url('/')); ?>/public/img/no-image.jpg" alt="">
                        <?php endif; ?>
                        </a>
                    </div>
                    <div class="card-body pt-5">
                    <a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($seller->username); ?>" title="<?php echo e($seller->name); ?>">
                        <?php if($seller->user_photo != ""): ?>
                        <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($seller->user_photo); ?>" alt="" class="profile">
                        <?php else: ?>
                        <img src="<?php echo e(url('/')); ?>/public/img/no-image.jpg" alt="" class="profile">
                        <?php endif; ?>
                        </a>
                        <h5><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($seller->username); ?>" class="theme-color"><?php echo e($seller->name); ?></a></h5>
                        <p class="card-text"><?php echo e($product_count->has($seller->id) ? count($product_count[$seller->id]) : 0); ?> <?php echo e(Helper::translation(1975,$translate)); ?></p>
                        <p class="card-text"><?php echo e($sale_count->has($seller->id) ? count($sale_count[$seller->id]) : 0); ?> <?php echo e(Helper::translation(1976,$translate)); ?></p>
                        <div><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($seller->username); ?>" class="btn button-color"><?php echo e(Helper::translation(1977,$translate)); ?></a></div>
                    </div>
                </div>
             </div>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
         <div class="row">
          <div class="col-md-12" align="center">
              <div class="turn-page" id="itempager"></div>
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
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\zigkart\resources\views/best-sellers.blade.php ENDPATH**/ ?>