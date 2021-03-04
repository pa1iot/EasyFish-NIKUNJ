<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2087,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2087,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2087,$translate)); ?></span></p>
      </div>
    </section>
    <main role="main">
    <div class="container mt-3">
    <div class="row">
       <div class="col-md-12" align="right">
          <a href="<?php echo e(URL::to('/my-orders')); ?>" class="btn button-color">&lt; <?php echo e(Helper::translation(2088,$translate)); ?></a>
       </div>
    </div>
    </div>
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
           <div class="col-md-12">
         	   <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2077,$translate)); ?> : </label>
                        <?php echo e($purchase->purchase_token); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2076,$translate)); ?> : </label>
                        <?php echo e($ord_id); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2089,$translate)); ?> : </label>
                        <?php echo e($purchase->payment_token); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2090,$translate)); ?> : </label>
                        <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->shipping_price); ?>

                    </div>
                 </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2080,$translate)); ?> : </label>
                        <?php echo e(str_replace("-"," ",$purchase->payment_type)); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2091,$translate)); ?> : </label>
                        <?php echo e($purchase->payment_date); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2092,$translate)); ?> : </label>
                        <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->subtotal); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2093,$translate)); ?> : </label>
                        <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->total); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2082,$translate)); ?> : </label>
                        <?php if($purchase->payment_status == 'completed'): ?> <span class="badge badge-success"><?php echo e(Helper::translation(2084,$translate)); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(Helper::translation(2085,$translate)); ?></span> <?php endif; ?>
                    </div>
                    <?php if($product->coupon_code != ''): ?>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1923,$translate)); ?> : </label>
                        <?php echo e($product->coupon_code); ?>

                    </div>
                    <?php endif; ?>
                    <?php if($product->product_type == 'physical'): ?>
                    <?php
                    $delivery_time ='+'.$product->product_estimate_time.' days';
                    $delivery_date = date('d F Y', strtotime($delivery_time, strtotime($purchase->payment_date)));
                    ?>
                    <div class="col-sm-6">
                        <label for="name"><?php echo e(Helper::translation(2146,$translate)); ?> : </label>
                        <?php echo e($delivery_date); ?>

                    </div>
                    <?php endif; ?>
                </div> 
                <div class="form-group row mt-3 pt-3">
                    <div class="col-sm-6">
                        <h4><?php echo e(Helper::translation(1997,$translate)); ?> </h4>
                    </div>
                    <div class="col-sm-6">
                        <h4><?php echo e(Helper::translation(2095,$translate)); ?> </h4>
                    </div>
                </div>    
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1998,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_firstname); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1999,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_lastname); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1998,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_firstname); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1999,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_lastname); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2000,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_companyname); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2014,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_email); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2000,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_companyname); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2014,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_email); ?>

                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2002,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_phone); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2007,$translate)); ?> : </label>
                        <?php echo e($billcountry); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2002,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_phone); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2007,$translate)); ?> : </label>
                        <?php echo e($shipcountry); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2003,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_address); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2096,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_city); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2003,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_address); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2096,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_city); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2005,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_state); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2006,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_postcode); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2005,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_state); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2006,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_postcode); ?>

                    </div>
                </div>
                <div class="form-group row mt-3 pt-3">
                    <div class="col-sm-12">
                        <h4><?php echo e(Helper::translation(2097,$translate)); ?> </h4>
                        <?php echo e($purchase->other_notes); ?>

                    </div>
              </div> 
              <?php if($product->product_type == 'physical'): ?>
              <form action="<?php echo e(route('order-track')); ?>" class="setting_form" method="post" enctype="multipart/form-data">
              <?php echo e(csrf_field()); ?>

               <div class="form-group row mt-3 pt-3">
                    <div class="col-sm-12">
                        <h4><?php echo e(Helper::translation(2098,$translate)); ?> </h4>
                    </div>
              </div>
              <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1915,$translate)); ?> : </label>
                        Order has been <?php echo e($product->order_tracking); ?>

                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="order_track" name="order_track" required>
                        <option value="<?php echo e($track_placed); ?>" <?php if($product->order_tracking == $track_placed): ?> selected <?php endif; ?>><?php echo e($track_placed); ?></option>
                        <option value="<?php echo e($track_packed); ?>" <?php if($product->order_tracking == $track_packed): ?> selected <?php endif; ?>><?php echo e($track_packed); ?></option>
                        <option value="<?php echo e($track_shipped); ?>" <?php if($product->order_tracking == $track_shipped): ?> selected <?php endif; ?>><?php echo e($track_shipped); ?></option>
                        <option value="<?php echo e($track_delivered); ?>" <?php if($product->order_tracking == $track_delivered): ?> selected <?php endif; ?>><?php echo e($track_delivered); ?></option>
                        </select>
                        <input type="hidden" name="order_id" value="<?php echo e($ord_id); ?>">
                        <button type="submit" class="btn button-color mt-1"><?php echo e(Helper::translation(1919,$translate)); ?></button>
                    </div>
                    </div>
               </form>     
              <?php endif; ?>
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/my-orders-details.blade.php ENDPATH**/ ?>