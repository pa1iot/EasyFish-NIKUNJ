<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e(__('Conversation Message')); ?></title>
</head>
<body class="preload dashboard-upload">
 <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2><?php echo e(__('Conversation Message')); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
               <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p><strong> Name : </strong> <?php echo e($from_name); ?></p>   
                        <p><strong> Email : </strong> <?php echo e($from_email); ?></p>
                        <p><strong> Message : </strong> <?php echo e($conver_text); ?></p>
                        <p><strong> Order Id : <?php echo e($conver_order_id); ?></p> 
                        <p><strong> Conversation Url : </strong> <a href="<?php echo e($conversation_url); ?>"><?php echo e($conversation_url); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/chat_mail.blade.php ENDPATH**/ ?>