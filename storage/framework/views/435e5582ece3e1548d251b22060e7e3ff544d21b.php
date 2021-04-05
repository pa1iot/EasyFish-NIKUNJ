<?php if($allsettings->maintenance_mode == 0): ?>
    <!doctype html>
<html class="no-js" lang="en">
<head>
    <title><?php echo e(Helper::translation(2212,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
    <?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo NoCaptcha::renderJs(); ?>

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

                <?php if($data = Session::get('data')): ?>
                    <?php print_r($data);?>
                <?php endif; ?>
                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <span class="alert_icon lnr lnr-checkmark-circle"></span>
                        <?php echo e($message); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                <?php endif; ?>
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
                        <?php $btn_val= 'Verify OTP' ;?>

                    <div class="panel">
                        <h2>OTP Verification</h2>

                    </div>
                        <form method="POST" action="<?php echo e(route('SubmitVerifyOTP')); ?>" id="login_form">

                            <div class="form-group">
                                <label for="otp">OTP<span
                                        class="required">*</span></label>
                                <input id="otp" type="text" name="otp" class="form-control"
                                       placeholder="OTP"
                                       data-bvalidator="required">
                                <input type="hidden" name="user_phone" value="<?php echo e(!empty(Session::get('user_phone')) ? base64_encode(Session::get('user_phone')) : ''); ?>">
                            </div>

                    <?php echo csrf_field(); ?>
                    <?php else: ?>
                                <?php $btn_val= Helper::translation(2212,$translate) ;?>
                            <div class="panel">
                                <h2><?php echo e(Helper::translation(2213,$translate)); ?></h2>
                                <p><?php echo e(Helper::translation(2214,$translate)); ?> <br/> <?php echo e(Helper::translation(2215,$translate)); ?></p>
                            </div>
                        <form method="POST" action="<?php echo e(route('register')); ?>" id="login_form">

                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="urname"><?php echo e(Helper::translation(2216,$translate)); ?><span
                                        class="required">*</span></label>
                                <input id="name" type="text" class="form-control" name="name"
                                       placeholder="<?php echo e(Helper::translation(2217,$translate)); ?>"
                                       value="<?php echo e(old('name')); ?>"
                                       data-bvalidator="required" autocomplete="name" autofocus> <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                         <strong><?php echo e($message); ?></strong>
                         </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label for="user_name"><?php echo e(Helper::translation(2101,$translate)); ?><span
                                        class="required">*</span></label>
                                <input id="username" type="text" name="username" class="form-control"
                                       placeholder="<?php echo e(Helper::translation(2218,$translate)); ?>"
                                       data-bvalidator="required">
                            </div>

                            <div class="form-group">
                                <label for="user_phone"><?php echo e(Helper::translation(3851,$translate)); ?><span
                                        class="required">*</span></label>
                                <input id="user_phone" type="text" name="user_phone" class="form-control"
                                       placeholder="<?php echo e(Helper::translation(3851,$translate)); ?>"
                                       data-bvalidator="required">
                            </div>


                            <div class="form-group">
                                <label for="email_ad"><?php echo e(Helper::translation(2001,$translate)); ?> <span
                                        class="required"></span></label>
                                <input id="email" type="text" class="form-control" name="email"
                                       value="<?php echo e(old('email')); ?>"
                                       placeholder="<?php echo e(Helper::translation(2034,$translate)); ?>" autocomplete="email"
                                       data-bvalidator="email"> <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                     <strong><?php echo e($message); ?></strong>
                     </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <input type="hidden" name="user_type" value="customer">


                            <?php endif; ?>

                            <button type="submit"
                                    class="btn button-color btn-block rounded button-off"><?php echo e($btn_val); ?></button>
                            <div class="d-flex justify-content-between forgot">
                                <div>
                                </div>
                                <div>
                                    <a href="<?php echo e(URL::to('/login')); ?>"
                                       class="link-color"><?php echo e(Helper::translation(2223,$translate)); ?></a>
                                </div>
                            </div>
                            
                        </form>
        </div>
    </div>
</div>

<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
    <?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\ecomm_multi\resources\views/auth/register.blade.php ENDPATH**/ ?>