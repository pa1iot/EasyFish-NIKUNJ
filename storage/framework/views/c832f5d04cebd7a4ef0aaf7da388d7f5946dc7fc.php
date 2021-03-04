<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2051,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->selling_background); ?>');">
      <div class="container text-center">
        <div class="row"> 
        <div class="col-md-8 mx-auto">
        <h2 class="mb-0"><?php echo e(Helper::translation(2175,$translate)); ?></h2>
        <p class="mb-5 mt-5 text-white fs21"><?php echo e(Helper::translation(2176,$translate)); ?> <?php echo e($allsettings->site_title); ?>.</p>
        <a href="<?php echo e(URL::to('/register')); ?>" class="btn button-color black-color"><?php echo e(Helper::translation(2177,$translate)); ?></a>
        </div>
        </div>
      </div>
    </section>
<main role="main">
      <div class="container page-white-box mt-3">
         <div class="row">
           <div class="col-md-4 mt-1 mb-1 pt-1 pb-1">
         	  <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->selling_image_one); ?>" border="0" class="img-fluid">
           </div>
           <div class="col-md-8 mt-1 mb-1 pt-1 pb-1">
             <h3 class="text-dark font-bold m-b-lg mt-3 mb-3"><?php echo e(Helper::translation(2178,$translate)); ?></h3>
             <p class="line-height-35">
             <strong>1.</strong> <?php echo e(Helper::translation(2179,$translate)); ?>.<br>
             <strong>2.</strong> <?php echo e(Helper::translation(2180,$translate)); ?>.<br>
             <strong>3.</strong> <?php echo e(Helper::translation(2181,$translate)); ?>.<br>
             <strong>4.</strong> <?php echo e(Helper::translation(2182,$translate)); ?> <?php echo e($allsettings->site_title); ?>.<br>
             <strong>5.</strong> <?php echo e(Helper::translation(2183,$translate)); ?>.<br>
             </p>
           </div>
         </div>
         <?php
         $hundred = 100;
         $seller_commission = $hundred - $allsettings->site_admin_commission;
         ?>
         <div class="row">
            <div class="col-md-8 mt-3 mb-3 pt-3 pb-3">
             <h3 class="text-dark font-bold m-b-lg mt-4 pt-5 mb-3"><?php echo e(Helper::translation(2184,$translate)); ?> <?php echo e($seller_commission); ?>% <?php echo e(Helper::translation(2185,$translate)); ?></h3>
            	<p class="line-height-35">
                <strong>1.</strong> <?php echo e(Helper::translation(2186,$translate)); ?> <strong><?php echo e($seller_commission); ?>%</strong>.<br>
                <strong>2.</strong> <?php echo e(Helper::translation(2187,$translate)); ?><br>
                <strong>3.</strong> <?php echo e(Helper::translation(2188,$translate)); ?><br>
                <strong>4.</strong> <?php echo e(Helper::translation(2189,$translate)); ?><br>
                </p>
           </div>
            <div class="col-md-4 mt-3 mb-3 pt-3 pb-3">
         	  <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->selling_image_two); ?>" border="0" class="img-fluid">
           </div>
         </div>
         <div class="row">
           <div class="col-md-12 mt-3 mb-3 pt-3 pb-3" align="center">
	        <h3 class="text-center"><?php echo e(Helper::translation(2190,$translate)); ?></h3>
            </div>
         </div>   
         <div class="row text-center">
	        <div class="col-md-4 tex-center mt-2 mb-2 pt-2 pb-2">
				<span><img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->selling_icon_one); ?>" border="0" class="img-fluid ss-icon"></span><br>
				<span class="text-lg "><?php echo e(Helper::translation(2059,$translate)); ?></span>
			</div>
			<div class="col-md-4 tex-center mt-2 mb-2 pt-2 pb-2">
				<span><img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->selling_icon_two); ?>" border="0" class="img-fluid ss-icon"></span><br>
				<span class="text-lg "><?php echo e(Helper::translation(2068,$translate)); ?></span>
			</div>
			<div class="col-md-4 tex-center mt-2 mb-2 pt-2 pb-2">
				<span><img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->selling_icon_three); ?>" border="0" class="img-fluid ss-icon"></span><br>
				<span class="text-lg "><?php echo e(Helper::translation(2069,$translate)); ?></span>
			</div>
		</div>
         <div class="row">
           <div class="col-md-4 mt-5 mb-3 pt-5 pb-3 mx-auto" align="center">
	        <h3 class="text-center"><?php echo e(Helper::translation(2191,$translate)); ?></h3>
            <a href="<?php echo e(URL::to('/register')); ?>" class="btn button-color black-color mt-3 btn-block"><?php echo e(Helper::translation(2177,$translate)); ?></a>
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/start-sellings.blade.php ENDPATH**/ ?>