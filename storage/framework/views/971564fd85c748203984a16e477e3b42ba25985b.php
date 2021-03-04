<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo e(__('Payment Refund Declined')); ?></title>
    
</head>

<body class="preload dashboard-upload">

    
    
    
        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2><?php echo e(__('Payment Refund Declined')); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p><strong>Your payment refund is declined. Please contact your vendor or administrator</strong></p>   
                        
                        <p><strong> your refund request amount is : </strong> <?php echo e($currency); ?><?php echo e($total_price); ?> </p>   
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </section>
    
    
   

    
</body>

</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/admin/buyer_declined_mail.blade.php ENDPATH**/ ?>