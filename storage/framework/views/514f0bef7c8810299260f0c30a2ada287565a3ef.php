<!doctype html>
<html class="no-js" lang="en">
<head>
    <title><?php echo e(Helper::translation(2041,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
    <?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body id="LoginForm">
<div class="container mt-5">
    <div align="center" class="mt-5 mb-5">
        <?php if($allsettings->site_logo != ''): ?>
            <a href="<?php echo e(URL::to('/')); ?>" class="navbar-brand">
                <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>"
                     alt="<?php echo e($allsettings->site_title); ?>" class="logo">
            </a>
        <?php endif; ?>
    </div>
    <div class="login-form mt-5">
        <div class="main-div loginform col-md-5 mx-auto">
            <div>
                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <span class="alert_icon lnr lnr-checkmark-circle"></span>
                        <?php echo e($message); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                <?php endif; ?>

                    <div class="msg_class" style="display: none">
                    <div class="alert alert-danger" role="alert">
                        <span class="alert_icon lnr lnr-checkmark-circle"></span>
                       <div class="msg"></div>

                    </div>
                    </div>


                <?php if($message = Session::get('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <span class="alert_icon lnr lnr-warning"></span>
                        <?php echo e($message); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close"></i>
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
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                <?php endif; ?>
            </div>


            <?php if(Session::get('insertGetId')): ?>

                <div class="panel">
                    <h2>OTP Verification</h2>

                </div>
                <form method="POST" action="<?php echo e(route('SubmitVerifyOTPLogin')); ?>" id="login_form">

                    <div class="form-group">
                        <label for="otp">OTP<span
                                class="required">*</span></label>
                        <input id="otp" type="text" name="otp" class="form-control"
                               placeholder="OTP"
                               data-bvalidator="required">


                            <div class="d-flex justify-content-between forgot">

                                <a class="link-color" style="cursor: pointer" onclick="resendotp('<?php echo e(!empty(Session::get('user_phone')) ? base64_encode(Session::get('user_phone')) : ''); ?>');">Resend OTP</a>

                            </div>

                            <div>
                                <input type="hidden" name="user_phone"
                                       value="<?php echo e(!empty(Session::get('user_phone')) ? base64_encode(Session::get('user_phone')) : ''); ?>">
                            </div>

                            <?php echo csrf_field(); ?>
                            <?php else: ?>
                                <div class="panel">
                                    <h2><?php echo e(Helper::translation(2041,$translate)); ?></h2>
                                    <p><?php echo e(Helper::translation(2207,$translate)); ?></p>
                                </div>
                                <form action="<?php echo e(route('SubmitLogin')); ?>" method="POST" id="login_form">
                                    <?php echo csrf_field(); ?>

                                    <div class="form-group">

                                        <label for="urname">  <?php echo e(Helper::translation(3851,$translate)); ?></label>
                                        <input type="text" class="form-control rounded-0" name="user_phone"
                                               placeholder="<?php echo e(Helper::translation(3851,$translate)); ?>"
                                               data-bvalidator="required">
                                    </div>

                                    <div class="d-flex justify-content-between forgot">
                                        
                                        
                                        
                                        <div>
                                            <a href="<?php echo e(URL::to('/register')); ?>"
                                               class="link-color"><?php echo e(Helper::translation(2210,$translate)); ?></a>
                                        </div>
                                    </div>


                                    <?php endif; ?>
                                    <button type="submit"
                                            class="btn button-color btn-block rounded button-off"><?php echo e(Helper::translation(2041,$translate)); ?></button>
                                </form>
                        </div>
                    </div>
        </div>
    </div>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>

        function resendotp(phone) {
            alert(phone);
            $.ajax({
                type: 'post',
                url: '<?php echo e(url('resendotp')); ?>',
                data: {'_token':'<?php echo csrf_token() ?>','phone': phone},
                success: function (data) {
                     $(".alert-success").hide();
                     $(".msg_class").show();
                     $(".msg").html(data.success);
                    console.log(data);
                    console.log(data.success);
                }
            });
        }

    </script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\ecomm_multi\resources\views/auth/login.blade.php ENDPATH**/ ?>