<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e(Helper::translation(2017,$translate)); ?></title>
</head>
<body class="preload dashboard-upload">
 <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2><?php echo e(Helper::translation(2017,$translate)); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
               <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p><strong> <?php echo e(Helper::translation(2018,$translate)); ?> : </strong> <?php echo e($from_name); ?></p>   
                        <p><strong> <?php echo e(Helper::translation(2014,$translate)); ?> : </strong> <?php echo e($from_email); ?></p>
                        <p><strong> <?php echo e(Helper::translation(2002,$translate)); ?> : </strong> <?php echo e($from_phone); ?></p>
                        <p><strong> <?php echo e(Helper::translation(2016,$translate)); ?> : </strong> <?php echo e($message_text); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/contact_mail.blade.php ENDPATH**/ ?>