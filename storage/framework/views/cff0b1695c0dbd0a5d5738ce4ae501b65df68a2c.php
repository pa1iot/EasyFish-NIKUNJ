<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2045,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2045,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2045,$translate)); ?></span></p>
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
           <div class="col-md-6">
         	<h4><?php echo e(Helper::translation(2127,$translate)); ?> <span class="theme-color"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($allsettings->site_minimum_withdrawal); ?> </span></h4>
           </div>
           <div class="col-md-6">
         	<h4><?php echo e(Helper::translation(2857,$translate)); ?> <span class="theme-color"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e(Auth::user()->referral_amount); ?> </span></h4>
           </div>
         </div>
         <div class="row mt-3 mb-3">
                    <div class="col-md-12">
                    <form action="<?php echo e(route('my-wallet')); ?>" class="setting_form" method="post" id="newsample_form" enctype="multipart/form-data">
                     <?php echo e(csrf_field()); ?>

                        <div class="withdraw_module cardify">
                            <div class="row form-group">
                                <div class="col-lg-6 white-bg">
                                    <div class="modules__title">
                                        <h4><?php echo e(Helper::translation(2128,$translate)); ?></h4>
                                    </div>
                                    <div class="modules__content">
                                       <div class="options">
                                            <?php $no = 1; ?>
                                            <?php $__currentLoopData = $withdraw_option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                            <div class="custom-radio">
                                                <input type="radio" id="withdrawal-<?php echo e($withdraw); ?>" name="withdrawal" value="<?php echo e($withdraw); ?>" <?php if($no == 1): ?> checked <?php endif; ?>>
                                                <label for="withdrawal-<?php echo e($withdraw); ?>">
                                                    <span class="circle"></span><?php echo e($withdraw); ?></label>
                                            </div>
                                            <?php $no++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="row form-group" id="ifpaypal">
                                                <div class="col-md-12 mb-3 mb-md-0">
                                                  <label class="font-weight-bold" for="phone"><?php echo e(Helper::translation(2129,$translate)); ?></label>
                                                     <input type="text" id="paypal_email" name="paypal_email" class="form-control" data-bvalidator="email,required">
                                                </div>
                                            </div> 
                                            <div class="row form-group" id="ifstripe">
                                                      <div class="col-md-12 mb-3 mb-md-0">
                                                        <label class="font-weight-bold" for="phone"><?php echo e(Helper::translation(2130,$translate)); ?></label>
                                                    <input type="text" id="stripe_email" name="stripe_email" class="form-control" data-bvalidator="email,required">
                                                </div>
                                            </div>
                                            <div class="row form-group" id="ifpaystack">
                                                      <div class="col-md-12 mb-3 mb-md-0">
                                                        <label class="font-weight-bold" for="phone"><?php echo e(Helper::translation(2902,$translate)); ?></label>
                                                    <input type="text" id="paystack_email" name="paystack_email" class="form-control" data-bvalidator="email,required">
                                                </div>
                                            </div>
                                            <div class="row form-group" id="iflocalbank">
                                                      <div class="col-md-12 mb-3 mb-md-0">
                                                        <label class="font-weight-bold" for="phone"><?php echo e(Helper::translation(2885,$translate)); ?></label>
                                                    <textarea id="bank_details" name="bank_details" class="form-control" data-bvalidator="required"></textarea>
                                                <small><strong>Example:</strong><br/>
                                                Bank Name : Test Bank<br/>
                                                Branch Name : Test Branch<br/>
                                                Branch Code : 00000<br/>
                                                IFSC Code : 63632EF</small>
                                                </div>
                                            </div> 
                                        </div>
                                        <!-- end /.options -->
                                    </div>
                                    <!-- end /.modules__content -->
                                </div>
                                <!-- end /.col-md-6 -->
                                <div class="col-lg-6 white-bg">
                                    <div class="modules__title">
                                        <h4><?php echo e(Helper::translation(2206,$translate)); ?></h4>
                                    </div>
                                    <div class="modules__content">
                                        <p class="subtitle"><?php echo e(Helper::translation(2132,$translate)); ?></p>
                                        <div class="options">
                                            <div>
                                                
                                                <label>
                                                    <span class="circle"></span><?php echo e(Helper::translation(2133,$translate)); ?>:
                                                    <span class="bold"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e(Auth::user()->earnings); ?></span>
                                                </label>
                                            </div>
                                            <input type="hidden" name="available_balance" value="<?php echo e(base64_encode(Auth::user()->earnings)); ?>">
                                            <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                            <input type="hidden" name="user_token" value="<?php echo e(Auth::user()->user_token); ?>">
                                            <div class="row form-group" id="ifstripe">
                                                 <div class="col-md-12 mb-3 mb-md-0">
                                                    <label class="font-weight-bold" for="phone"><?php echo e($allsettings->site_currency_code); ?></label>
                                                    <input type="text" id="rlicense" name="get_amount" class="form-control" data-bvalidator="min[<?php echo e($allsettings->site_minimum_withdrawal); ?>],max[<?php echo e(Auth::user()->earnings); ?>],required"></div>
                                                    </div>
                                                 </div>
                                           <div class="button_wrapper">
                                            <button type="submit" class="btn button-color pill px-4 py-2"><?php echo e(Helper::translation(2134,$translate)); ?></button>
                                         </div>
                                    </div>
                                </div>
                                <!-- end /.col-md-6 -->
                            </div>
                            <!-- end /.row -->
                        </div>
                        </form>
                        <!-- end /.withdraw_module -->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
              <div class="row mt-3 mb-3">
              <div class="col-md-12">
              <div class="table-responsive">
              <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                            <th><?php echo e(Helper::translation(1964,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2135,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2136,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2129,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2130,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2902,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2885,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2137,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(1915,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $withdrawData['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e(date('d F Y', strtotime($withdrawal->withdraw_date))); ?></td>
                                            <td><?php echo e($withdrawal->withdraw_payment_type); ?></td>
                                            <td><?php if($withdrawal->paypal_id != ""): ?> <?php echo e($withdrawal->paypal_id); ?> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td><?php if($withdrawal->stripe_id != ""): ?> <?php echo e($withdrawal->stripe_id); ?> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td><?php if($withdrawal->paystack_email != ""): ?> <?php echo e($withdrawal->paystack_email); ?> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td><?php if($withdrawal->bank_details != ""): ?> <?php echo nl2br($withdrawal->bank_details); ?> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($withdrawal->withdraw_amount); ?></td>
                                            <td><?php if($withdrawal->withdraw_status == 'pending'): ?> <span class="badge badge-danger"><?php echo e($withdrawal->withdraw_status); ?></span> <?php else: ?> <span class="badge badge-success"><?php echo e($withdrawal->withdraw_status); ?></span> <?php endif; ?> </td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                    </tbody>
                             </table>
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/my-wallet.blade.php ENDPATH**/ ?>