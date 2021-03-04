<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e(Helper::translation(2141,$translate)); ?></title>
</head>
<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2><?php echo e(Helper::translation(2141,$translate)); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                    <p> <?php echo e(Helper::translation(2076,$translate)); ?> - <?php echo e($order_id); ?></p> 	
                    <p> <?php echo e(Helper::translation(2018,$translate)); ?> - <?php echo e($name); ?></p> 	
                    <p> <?php echo e(Helper::translation(2014,$translate)); ?> - <?php echo e($email); ?></p> 	
                    <p> <?php echo e(Helper::translation(2002,$translate)); ?> - <?php echo e($phone); ?></p> 
                    <p> <?php echo e(Helper::translation(2137,$translate)); ?> - <?php echo e($site_currency); ?><?php echo e($amount); ?></p> 
                </div>
               </div>
            </div>
        </div>
    </section>
</body>
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/order_email.blade.php ENDPATH**/ ?>