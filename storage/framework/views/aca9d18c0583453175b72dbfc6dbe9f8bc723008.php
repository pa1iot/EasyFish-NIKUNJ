<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e(Helper::translation(2205,$translate)); ?></title>
</head>
<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2><?php echo e(Helper::translation(2205,$translate)); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p><?php echo e(Helper::translation(2018,$translate)); ?> : <?php echo e($from_name); ?></p>   
                        <p><?php echo e(Helper::translation(2014,$translate)); ?> : <?php echo e($from_email); ?></p>
                        <p><?php echo e(Helper::translation(2136,$translate)); ?> : <?php echo e($withdrawal); ?></p>  
                        <?php if($withdrawal == 'paypal'): ?><p><?php echo e(Helper::translation(2129,$translate)); ?> : <?php echo e($paypal_id); ?></p><?php endif; ?>
                        <?php if($withdrawal == 'stripe'): ?><p><?php echo e(Helper::translation(2130,$translate)); ?> : <?php echo e($stripe_id); ?></p><?php endif; ?> 
                        <?php if($withdrawal == 'paystack'): ?><p><?php echo e(Helper::translation(2902,$translate)); ?> : <?php echo e($paystack_email); ?></p><?php endif; ?>
                        <?php if($withdrawal == 'localbank'): ?><p><?php echo e(Helper::translation(2885,$translate)); ?> : <?php echo e($bank_details); ?></p><?php endif; ?>           
                        <p><?php echo e(Helper::translation(2131,$translate)); ?> : <?php echo e($currency); ?><?php echo e($get_amount); ?></p>    
                    </div>
                </div>
            </div>
        </div>
</section>
</body>
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/withdrawal_mail.blade.php ENDPATH**/ ?>