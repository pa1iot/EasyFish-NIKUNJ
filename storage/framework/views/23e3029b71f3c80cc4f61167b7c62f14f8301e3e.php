<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(3822,$translate)); ?></title>
</head>
<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2><?php echo e(Helper::translation(3822,$translate)); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p><strong><?php echo e(Helper::translation(3825,$translate)); ?></strong></p>   
                        <p><strong> <?php echo e(Helper::translation(3828,$translate)); ?> : </strong> <?php echo e($currency); ?><?php echo e($vendor_amount); ?> </p>   
                    </div>
                 </div>
             </div>
         </div>
     </section>
</body>
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/admin/vendor_payment_mail.blade.php ENDPATH**/ ?>