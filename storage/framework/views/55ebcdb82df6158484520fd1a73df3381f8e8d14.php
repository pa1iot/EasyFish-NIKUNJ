<!DOCTYPE html>
<html lang="en">

<head>
    <title>New message received</title>
    
</head>

<body class="preload dashboard-upload">

    
    
    
        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2><?php echo e(__('Message sent from')); ?> <?php echo e($from_name); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p><strong> New message received</strong></p>
                        
                        <p>Name : <?php echo e($from_name); ?></p>   
                        <p>Email : <?php echo e($from_email); ?></p>
                        <p>Phone : <?php echo e($phone); ?></p>
                        <p>Message : <?php echo e($message_text); ?></p>    
                            
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </section>
    
    
   

    
</body>

</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/user_mail.blade.php ENDPATH**/ ?>