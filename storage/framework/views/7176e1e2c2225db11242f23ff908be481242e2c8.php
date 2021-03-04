<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2052,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2052,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2052,$translate)); ?></span></p>
      </div>
    </section>
  <main role="main">
      <div class="container page-white-box mt-3">
         <div class="row">
           <div class="col-md-6 mt-1 mb-1 pt-1 pb-1 mx-auto">
         	    <form action="<?php echo e(route('track-order')); ?>" class="setting_form" id="track_form" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-row">
                             <div class="form-group col-md-12">
                              <label><?php echo e(Helper::translation(2195,$translate)); ?></label>
                              <input id="order_number" name="order_number" placeholder="<?php echo e(__('Order No')); ?>" class="form-control" type="text" data-bvalidator="required">
                            </div>
                            
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-12"> 
                            <button type="submit" class="btn button-color"><?php echo e(Helper::translation(1919,$translate)); ?></button>
                            </div>
                        </div>
                  </form>        
           </div>
         </div>
         <?php if($check_track_order != 0): ?>
         <?php
         $delivery_time ='+'.$track_order->product_estimate_time.' days';
         $delivery_date = date('d F Y', strtotime($delivery_time, strtotime($track_order->payment_date)));
         ?>
         <div class="row">
           <div class="col-md-12">
              <div class="card-body">
                      <h6><?php echo e(Helper::translation(2076,$translate)); ?>: <?php echo e($order_id); ?></h6>
                       <article class="card">
                              <div class="card-body row">
                               <div class="col"> <strong><?php echo e(Helper::translation(2094,$translate)); ?>:</strong> <br><?php echo e($delivery_date); ?></div>
                               <div class="col"> <strong><?php echo e(Helper::translation(1915,$translate)); ?>:</strong> <br> Order has been <?php echo e($track_order->order_tracking); ?></div>
                               <div class="col"> <strong><?php echo e(Helper::translation(2117,$translate)); ?>:</strong> <br> <?php echo e($order_id); ?> </div>
                               </div>
                       </article>
                    <div class="track">
                         <?php if($track_order->order_tracking == $track_placed): ?>
                         <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?php echo e(Helper::translation(2118,$translate)); ?></span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> <?php echo e(Helper::translation(2119,$translate)); ?></span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> <?php echo e(Helper::translation(2120,$translate)); ?> </span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text"><?php echo e(Helper::translation(2121,$translate)); ?></span> </div>
                         <?php endif; ?>
                         <?php if($track_order->order_tracking == $track_packed): ?>
                         <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?php echo e(Helper::translation(2118,$translate)); ?></span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> <?php echo e(Helper::translation(2119,$translate)); ?></span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> <?php echo e(Helper::translation(2120,$translate)); ?> </span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text"><?php echo e(Helper::translation(2121,$translate)); ?></span> </div>
                         <?php endif; ?>
                         <?php if($track_order->order_tracking == $track_shipped): ?>
                         <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?php echo e(Helper::translation(2118,$translate)); ?></span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> <?php echo e(Helper::translation(2119,$translate)); ?></span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> <?php echo e(Helper::translation(2120,$translate)); ?> </span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text"><?php echo e(Helper::translation(2121,$translate)); ?></span> </div>
                         <?php endif; ?>
                         <?php if($track_order->order_tracking == $track_delivered): ?>
                         <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?php echo e(Helper::translation(2118,$translate)); ?></span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> <?php echo e(Helper::translation(2119,$translate)); ?></span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> <?php echo e(Helper::translation(2120,$translate)); ?> </span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text"><?php echo e(Helper::translation(2121,$translate)); ?></span> </div>
                         <?php endif; ?>
                         <?php if($track_order->order_tracking == ''): ?>
                         <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?php echo e(Helper::translation(2118,$translate)); ?></span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> <?php echo e(Helper::translation(2119,$translate)); ?></span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> <?php echo e(Helper::translation(2120,$translate)); ?> </span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text"><?php echo e(Helper::translation(2121,$translate)); ?></span> </div>
                         <?php endif; ?>
                         </div>
                  </div>
           </div>
         </div>
         <?php else: ?>
         <?php if($without == 1): ?>
         <div class="row">
           <div class="col-md-12 mt-3 mb-3 pt-3 pb-3" align="center">
             <p><?php echo e(Helper::translation(2196,$translate)); ?></p>
           </div>
         </div> 
         <?php endif; ?> 
         <?php endif; ?>
      </div>
    </main>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/track-order.blade.php ENDPATH**/ ?>