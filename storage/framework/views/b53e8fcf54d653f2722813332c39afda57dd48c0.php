<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(__('My Profile')); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(__('My Profile')); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>">Home</a> <span class="split">&gt;</span> <span><?php echo e(__('My Profile')); ?></span></p>
      </div>
    </section>
    <main role="main">
     <div class="container page-white-box mt-3">
     <div class="row">
	     <div class="col-md-12">
             <?php if($message = Session::get('success')): ?>
                   <div class="alert alert-success" role="alert">
                                    <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                    <?php echo e($message); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="fa fa-close" aria-hidden="true"></span>
                                    </button>
                                </div>
            <?php endif; ?>
            <?php if($message = Session::get('error')): ?>
            <div class="alert alert-danger" role="alert">
                                    <span class="alert_icon lnr lnr-warning"></span>
                                    <?php echo e($message); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="fa fa-close" aria-hidden="true"></span>
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
            <span class="fa fa-close" aria-hidden="true"></span>
            </button>
            </div>
            <?php endif; ?>
            </div>
        </div>
    <div class="row">
        <div class="col-md-12">
             <form action="<?php echo e(route('profile')); ?>" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
             <?php echo e(csrf_field()); ?>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="name">Name <span class="required">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($edit['profile']->name); ?>" data-bvalidator="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="username">Username <span class="required">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo e($edit['profile']->username); ?>" data-bvalidator="required">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputAddressLine1">Email <span class="required">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo e($edit['profile']->email); ?>" data-bvalidator="required,email">
                    </div>
                    <div class="col-sm-6">
                        <label for="inputAddressLine2">Password</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="country">Country <span class="required">*</span></label>
                        <select class="form-control" name="user_country" data-bvalidator="required">
                        <?php $__currentLoopData = $allcountry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country->country_id); ?>" <?php if($edit['profile']->user_country == $country->country_id): ?> selected <?php endif; ?>><?php echo e($country->country_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="inputState">Gender</label>
                        <select class="form-control" id="user_gender" name="user_gender">
                        <option value="male" <?php if($edit['profile']->user_gender == "male"): ?> selected <?php endif; ?>>Male</option>
                        <option value="female" <?php if($edit['profile']->user_gender == "female"): ?> selected <?php endif; ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputContactNumber">Upload Banner</label>
                        <input type="file" class="form-control" id="user_banner" name="user_banner">
                        <?php if($edit['profile']->user_banner != ""): ?>
                        <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($edit['profile']->user_banner); ?>" alt="<?php echo e($edit['profile']->name); ?>" class="img-thumb">
                        <?php else: ?>
                        <img src="<?php echo e(url('/')); ?>/public/img/no-image.jpg" alt="<?php echo e($edit['profile']->name); ?>" class="img-thumb">
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6">
                        <label for="inputState">Upload Photo</label>
                        <input type="file" class="form-control" id="user_photo" name="user_photo">
                        <?php if($edit['profile']->user_photo != ""): ?>
                        <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($edit['profile']->user_photo); ?>" alt="<?php echo e($edit['profile']->name); ?>" class="img-thumb">
                        <?php else: ?>
                        <img src="<?php echo e(url('/')); ?>/public/img/no-image.jpg" alt="<?php echo e($edit['profile']->name); ?>" class="img-thumb">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputContactNumber">Address</label>
                        <input type="text" class="form-control" id="user_address" name="user_address" value="<?php echo e($edit['profile']->user_address); ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="inputState">Phone</label>
                        <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php echo e($edit['profile']->user_phone); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="inputContactNumber">About</label>
                        <textarea name="user_about" id="summary-ckeditor" rows="6" class="form-control"><?php echo e(html_entity_decode($edit['profile']->user_about)); ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="save_password" value="<?php echo e($edit['profile']->password); ?>">
                <input type="hidden" name="edit_id" value="<?php echo e($edit['profile']->user_token); ?>">
                <input type="hidden" name="image_size" value="<?php echo e($allsettings->site_max_image_size); ?>">
                <input type="hidden" name="save_photo" value="<?php echo e($edit['profile']->user_photo); ?>">
                <input type="hidden" name="save_banner" value="<?php echo e($edit['profile']->user_banner); ?>">
                <button type="submit" class="btn button-color float-right"><?php echo e(__('Submit')); ?></button>
            </form>
        </div>
    </div>
</div>
</main>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH D:\xampp\htdocs\zigkart\resources\views/profile.blade.php ENDPATH**/ ?>