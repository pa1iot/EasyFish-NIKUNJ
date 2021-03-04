<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Refund Request</title>
    
</head>

<body class="preload dashboard-upload">

    
    
    
        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>New Refund Request</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <div class="row">
                    <div class="col-lg-8 col-md-7">
                    <h3> Order Details</h3>
                    
                    <p> Purchase Id - <?php echo e($purchase_token); ?></p> 	
                    <p> Product - <a href="<?php echo e($url); ?>/product/<?php echo e($product_slug); ?>"><?php echo e($product_name); ?></a></p> 	
                    <p> Amount - <?php echo e($site_currency); ?><?php echo e($payment); ?></p> 	
                    <p> Payment Type - <?php echo e($payment_type); ?></p> 
                    <p> Payment Date - <?php echo e($payment_date); ?></p> 
                     <br/>			
			         <h3> Buyer Details</h3> 
                     <p> Buyer Name - <?php echo e($to_name); ?></p> 
                     <p> Buyer Email - <?php echo e($to_email); ?></p>     
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </section>
    
    
   

    
</body>

</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/refund_email.blade.php ENDPATH**/ ?>