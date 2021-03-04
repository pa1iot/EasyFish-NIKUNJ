<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2881,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2881,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2881,$translate)); ?></span></p>
      </div>
    </section>
<main role="main">
      <div class="container page-white-box mt-3">
         <div class="row justify-content-center pb-5 mb-5 mt-3 pt-3">
          <div class="col-md-12">
                    <div class="product_archive added_to__cart pb-3 mb-3">
                        
                        <div class="panel-body mb-5 pb-5">
                        <h3><?php echo e(Helper::translation(2882,$translate)); ?></h3>
                        <h5 class="mt-3"><?php echo e(Helper::translation(2883,$translate)); ?> : <?php echo e($purchase_token); ?></h5>
							
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/cash-on-delivery.blade.php ENDPATH**/ ?>