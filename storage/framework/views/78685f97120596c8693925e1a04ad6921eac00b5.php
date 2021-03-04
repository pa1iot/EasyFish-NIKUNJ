<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(1983,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(1983,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(1983,$translate)); ?></span></p>
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
         <?php if(count($cart['product']) != 0): ?>
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1 cart-page">
           <form action="<?php echo e(route('coupon')); ?>" class="setting_form" id="coupon_form" method="post" enctype="multipart/form-data">
           <?php echo e(csrf_field()); ?>

         	 <table class="table table-hover table-responsive-stack">
                <thead>
                    <tr>
                        <th><?php echo e(Helper::translation(1984,$translate)); ?></th>
                        <th><?php echo e(Helper::translation(1985,$translate)); ?></th>
                        <th class="text-center"><?php echo e(Helper::translation(1934,$translate)); ?></th>
                        <th class="text-center"><?php echo e(Helper::translation(1986,$translate)); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $subtotal = 0;
                $coupon_code = ""; 
                $new_price = 0;
                ?>
                <?php $__currentLoopData = $cart['product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                        <?php if($cart->product_image != ""): ?>
                            <a class="thumbnail pull-left" href="<?php echo e(url('/product')); ?>/<?php echo e($cart->product_slug); ?>"><img class="media-object" src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($cart->product_image); ?>"> </a>                          <?php else: ?>
                            <a class="thumbnail pull-left" href="<?php echo e(url('/product')); ?>/<?php echo e($cart->product_slug); ?>"><img class="media-object" src="<?php echo e(url('/')); ?>/public/img/no-image.jpg"> </a>
                            <?php endif; ?>
                            <div class="media-body">
                                <h4><a href="<?php echo e(url('/product')); ?>/<?php echo e($cart->product_slug); ?>"><?php echo e($cart->product_name); ?></a></h4>
                                <span><?php echo e(Helper::translation(1987,$translate)); ?>: </span><span><a href="<?php echo e(url('/user')); ?>/<?php echo e($cart->username); ?>" class="text-success"><?php echo e($cart->name); ?></a></span>
                                <div class="mt-2"><?php echo e($cart->product_attribute_values); ?></div>
                            </div>
                        </div></td>
                        <?php
                          if($cart->discount_price != 0)
                          {
                            $price = $cart->discount_price;
                            $new_price += $cart->quantity * $cart->discount_price;
                            $coupon_code = $cart->coupon_code;
                            
                          }
                          else
                          {
                            $price = $cart->price;
                            $new_price += $cart->quantity * $cart->price;
                            
                          }
                        ?>
                        <?php
                        $total = $cart->quantity * $cart->price;
                        $subtotal += $total;
                        ?>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <?php echo e($cart->quantity); ?>

                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><?php if($cart->discount_price != 0): ?><strong><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($price); ?></strong><?php endif; ?> <strong <?php if($cart->discount_price != 0): ?> class="cross-line" <?php endif; ?>><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($cart->price); ?></strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($total); ?></strong></td>
                        <td class="col-sm-1 col-md-1"><a href="<?php echo e(url('/product')); ?>/<?php echo e($cart->product_slug); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a> <a href="<?php echo e(url('/cart')); ?>/<?php echo e(base64_encode($cart->ord_id)); ?>" class="btn btn-danger" onClick="return confirm('<?php echo e(Helper::translation(1968,$translate)); ?>');"><i class="fa fa-close"></i></a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" class="form-control coupon-text" id="coupon" name="coupon" value="" data-bvalidator="required"></td>
                        <td><button type="submit" class="btn button-color"><?php echo e(Helper::translation(1988,$translate)); ?></button></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h5><?php echo e(Helper::translation(1989,$translate)); ?></h5></td>
                        <td class="text-right"><h5><strong><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($subtotal); ?></strong></h5></td>
                    </tr>
                    <?php if($coupon_code != ""): ?>
                    <?php 
                    $coupon_discount = $subtotal - $new_price;
                    $final = $new_price+$allsettings->site_processing_fee; 
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h5><?php echo e(Helper::translation(1991,$translate)); ?><br/><span class="fs14 green"><?php echo e(Helper::translation(1990,$translate)); ?> <strong><?php echo e($coupon_code); ?></strong><?php echo e(__(')')); ?></span> <a href="<?php echo e(URL::to('/cart/')); ?>/remove/<?php echo e($coupon_code); ?>" class="red fs14" onClick="return confirm('<?php echo e(Helper::translation(1992,$translate)); ?>');"><i class="fa fa-remove"></i><?php echo e(Helper::translation(2848,$translate)); ?></a></h5></td>
                        <td class="text-right green"><h5><strong>- <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($coupon_discount); ?></strong></h5></td>
                    </tr>
                    <?php else: ?>
                    <?php $final = $subtotal+$allsettings->site_processing_fee; ?>
                    <?php endif; ?>
                    <?php if($allsettings->site_processing_fee != 0): ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h5><?php echo e(Helper::translation(1993,$translate)); ?></h5></td>
                        <td class="text-right"><h5><strong><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($allsettings->site_processing_fee); ?></strong></h5></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h3><?php echo e(Helper::translation(1986,$translate)); ?></h3></td>
                        <td class="text-right"><h3><strong><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($final); ?></strong></h3></td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="<?php echo e(url('/shop')); ?>" class="btn btn-secondary"><i class="fa fa-shopping-cart"></i> <?php echo e(Helper::translation(1994,$translate)); ?></a></td>
                        <td><a href="<?php echo e(url('/checkout')); ?>" class="btn btn-success"> <?php echo e(Helper::translation(1995,$translate)); ?></a></td>
                    </tr>
                </tbody>
              </table>
              </form>
           </div>
           <?php else: ?>
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1 text-center">
                  <div align="center">
                  <?php echo e(Helper::translation(1996,$translate)); ?>

                  </div>
                </div>    
           <?php endif; ?>
         </div>
      </div>
    </main>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/cart.blade.php ENDPATH**/ ?>