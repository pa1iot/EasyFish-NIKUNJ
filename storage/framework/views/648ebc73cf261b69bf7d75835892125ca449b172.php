<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(1995,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(1995,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(1995,$translate)); ?></span></p>
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
      <?php if($subtotal != 0): ?>
      <form action="<?php echo e(route('checkout')); ?>" class="setting_form" id="checkout_form" method="post" enctype="multipart/form-data">
      <?php echo e(csrf_field()); ?>

         <div class="row">
           <div class="col-md-6 mt-1 mb-1 pt-1 pb-1">
               <h3><?php echo e(Helper::translation(1997,$translate)); ?></h3>
         	   <div class="form-row mt-4 mb-4">
                <div class="col">
                  <label><?php echo e(Helper::translation(1998,$translate)); ?><span class="red">*</span></label>
                  <input type="text" class="form-control" id="bill_firstname" name="bill_firstname" data-bvalidator="required">
                </div>
                <div class="col">
                  <label><?php echo e(Helper::translation(1999,$translate)); ?><span class="red">*</span></label> 
                  <input type="text" class="form-control" id="bill_lastname" name="bill_lastname" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label><?php echo e(Helper::translation(2000,$translate)); ?></label>
                  <input type="text" class="form-control" id="bill_companyname" name="bill_companyname">
                </div>
                <div class="col">
                  <label><?php echo e(Helper::translation(2001,$translate)); ?><span class="red">*</span></label> 
                  <input type="text" class="form-control" id="bill_email" name="bill_email" data-bvalidator="email,required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label><?php echo e(Helper::translation(2002,$translate)); ?><span class="red">*</span></label>
                  <input type="text" class="form-control" id="bill_phone" name="bill_phone" data-bvalidator="required">
                </div>
                <div class="col">
                  <label><?php echo e(Helper::translation(2003,$translate)); ?><span class="red">*</span></label> 
                  <input type="text" class="form-control" id="bill_address" name="bill_address" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label><?php echo e(Helper::translation(2004,$translate)); ?> <span class="red">*</span></label>
                  <input type="text" class="form-control" id="bill_city" name="bill_city" data-bvalidator="required">
                </div>
                <div class="col">
                  <label><?php echo e(Helper::translation(2005,$translate)); ?> <span class="red">*</span></label> 
                  <input type="text" class="form-control" id="bill_state" name="bill_state" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label><?php echo e(Helper::translation(2006,$translate)); ?> <span class="red">*</span></label>
                  <input type="text" class="form-control" id="bill_postcode" name="bill_postcode" data-bvalidator="required">
                </div>
                <div class="col">
                  <label><?php echo e(Helper::translation(2007,$translate)); ?> <span class="red">*</span></label> 
                  <select class="form-control" name="bill_country" data-bvalidator="required">
                  <option value=""></option>
                  <?php $__currentLoopData = $allcountry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($country->country_id); ?>"><?php echo e($country->country_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
           </div>
           <div class="col-md-6 mt-1 mb-1 pt-1 pb-1">
               <h3><?php echo e(Helper::translation(2008,$translate)); ?> <span><input type="checkbox" name="enable_shipping" id="enable_shipping" value="1"></span></h3>
               <div id="show_shipping">
         	   <div class="form-row mt-4 mb-4">
                <div class="col">
                  <label><?php echo e(Helper::translation(1998,$translate)); ?><span class="red">*</span></label>
                  <input type="text" class="form-control" id="ship_firstname" name="ship_firstname" data-bvalidator="required">
                </div>
                <div class="col">
                  <label><?php echo e(Helper::translation(1999,$translate)); ?> <span class="red">*</span></label> 
                  <input type="text" class="form-control" id="ship_lastname" name="ship_lastname" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label><?php echo e(Helper::translation(2000,$translate)); ?></label>
                  <input type="text" class="form-control" id="ship_companyname" name="ship_companyname">
                </div>
                <div class="col">
                  <label><?php echo e(Helper::translation(2001,$translate)); ?> <span class="red">*</span></label> 
                  <input type="text" class="form-control" id="ship_email" name="ship_email" data-bvalidator="email,required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label><?php echo e(Helper::translation(2002,$translate)); ?> <span class="red">*</span></label>
                  <input type="text" class="form-control" id="ship_phone" name="ship_phone" data-bvalidator="required">
                </div>
                <div class="col">
                  <label><?php echo e(Helper::translation(2003,$translate)); ?> <span class="red">*</span></label> 
                  <input type="text" class="form-control" id="ship_address" name="ship_address" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label><?php echo e(Helper::translation(2004,$translate)); ?> <span class="red">*</span></label>
                  <input type="text" class="form-control" id="ship_city" name="ship_city" data-bvalidator="required">
                </div>
                <div class="col">
                  <label><?php echo e(Helper::translation(2005,$translate)); ?> <span class="red">*</span></label> 
                  <input type="text" class="form-control" id="ship_state" name="ship_state" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label><?php echo e(Helper::translation(2006,$translate)); ?> <span class="red">*</span></label>
                  <input type="text" class="form-control" id="ship_postcode" name="ship_postcode" data-bvalidator="required">
                </div>
                <div class="col">
                  <label><?php echo e(Helper::translation(2007,$translate)); ?> <span class="red">*</span></label> 
                  <select class="form-control" name="ship_country" data-bvalidator="required">
                  <option value=""></option>
                  <?php $__currentLoopData = $allcountry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($country->country_id); ?>"><?php echo e($country->country_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              </div>
              <div class="form-row mt-4 mb-4">
                <div class="col">
                  <label><?php echo e(Helper::translation(2009,$translate)); ?></label>
                  <textarea class="form-control" id="other_notes" placeholder="About your order" name="other_notes"></textarea>
                </div>
               </div>
               <div class="form-row mt-4 mb-4">
               <h3><?php echo e(Helper::translation(2010,$translate)); ?></h3>
               </div>
               <div class="form-row mt-2 mb-2">
                           <div class="col-lg-12 col-md-12 col-sm-12">
                           <?php $no = 1; ?>
                                <?php $__currentLoopData = $get_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-radio">
                                    <input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom-control-input" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required">
                                    <label class="custom-control-label" for="opt1-<?php echo e($payment); ?>"><?php echo e(str_replace("-"," ",$payment)); ?> <?php if($payment == 'wallet'): ?> (<?php echo e($allsettings->site_currency_symbol); ?><?php echo e(Auth::user()->earnings); ?>) <?php endif; ?></label>
                                </div>
                                <?php $no++; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                </div>
               <div class="form-row mt-2 mb-2">
                <div class="col text-right fs25">
                  <?php echo e(Helper::translation(1989,$translate)); ?>

                </div>
                <div class="col text-right fs25">
                  <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($subtotal); ?>

                </div>
               </div>
               <?php if($coupon_discount != 0): ?>
               <div class="form-row mt-4 mb-1">
                <div class="col text-right fs25">
                  <span><?php echo e(Helper::translation(1991,$translate)); ?></span><p class="fs14 green"><?php echo e(Helper::translation(1990,$translate)); ?></p>
                </div>
                <div class="col text-right fs25 green">
                  - <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($coupon_discount); ?>

                </div>
               </div>
               <?php endif; ?>
               <?php if($allsettings->site_processing_fee != 0): ?>
               <div class="form-row mt-2 mb-2">
                <div class="col text-right fs25">
                  <?php echo e(Helper::translation(1993,$translate)); ?>

                </div>
                <div class="col text-right fs25">
                  <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($allsettings->site_processing_fee); ?>

                </div>
               </div>
               <?php endif; ?>
               <div class="form-row mt-3 mb-3">
                <div class="col text-right fs25">
                  <?php echo e(Helper::translation(1986,$translate)); ?>

                </div>
                <div class="col text-right fs25">
                  <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($final); ?>

                </div>
               </div>
               <div class="form-row mt-4 mb-4">
               <div class="col text-right">
               <button type="submit" class="btn button-color"><?php echo e(Helper::translation(2011,$translate)); ?></button>
               </div>
               </div>
               <input type="hidden" name="order_id" value="<?php echo e($order_numbers); ?>">
               <input type="hidden" name="sub_total" value="<?php echo e($new_price); ?>">
               <input type="hidden" name="shipping_fee" value="0">
               <input type="hidden" name="shipping_fee_separate" value="0">
               <input type="hidden" name="processing_fee" value="<?php echo e($allsettings->site_processing_fee); ?>">
               <input type="hidden" name="total" value="<?php echo e($final); ?>">
               <input type="hidden" name="product_id" value="<?php echo e($product_numbers); ?>">
               <input type="hidden" name="product_names" value="<?php echo e($product_names); ?>">
           </div>
         </div>
        </form>
        <?php else: ?>
        <div class="col-md-12 mt-1 mb-1 pt-1 pb-1 text-center">
           <div align="center">
           <?php echo e(Helper::translation(1996,$translate)); ?>

           </div>
        </div>    
       <?php endif; ?>  
      </div>
    </main>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/checkout.blade.php ENDPATH**/ ?>