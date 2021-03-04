<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php if(Auth::user()->user_type == 'vendor'): ?><?php echo e(Helper::translation(2021,$translate)); ?><?php else: ?><?php echo e(Helper::translation(1912,$translate)); ?><?php endif; ?>  - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(Auth::user()->user_type == 'vendor'): ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2021,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a><span class="split">&gt;</span> <span><?php echo e(Helper::translation(2021,$translate)); ?></span></p>
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
             <form action="<?php echo e(route('edit-coupon')); ?>" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
             <?php echo e(csrf_field()); ?>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="name"><?php echo e(Helper::translation(1923,$translate)); ?> <span class="required">*</span></label>
                        <input id="coupon_code" name="coupon_code" type="text" class="form-control" value="<?php echo e($edit['value']->coupon_code); ?>" data-bvalidator="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="name"><?php echo e(Helper::translation(1924,$translate)); ?> <span class="required">*</span></label>
                        <input id="coupon_value" name="coupon_value" type="text" class="form-control" value="<?php echo e($edit['value']->coupon_value); ?>" data-bvalidator="required,min[1]">
                    </div>
                    <?php /*?><div class="col-sm-6">
                        <label for="username">Discount Type <span class="required">*</span></label>
                        <select name="discount_type" class="form-control" data-bvalidator="required">
                         <option value=""></option>
                         <option value="percentage" @if($edit['value']->discount_type == 'percentage') selected @endif>Percentage</option>
                         <option value="fixed" @if($edit['value']->discount_type == 'fixed') selected @endif>Fixed</option>
                         </select>
                    </div><?php */?>
                    <input type="hidden" name="discount_type" value="<?php echo e($edit['value']->discount_type); ?>">
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_keywords"><?php echo e(Helper::translation(1925,$translate)); ?> <span class="required">*</span></label>
                        <input id="flash_deal_start_date" name="coupon_start_date" type="text" class="form-control" autocomplete="off" value="<?php echo e($edit['value']->coupon_start_date); ?>" data-bvalidator="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="site_desc"><?php echo e(Helper::translation(1926,$translate)); ?> <span class="required">*</span></label>
                        <input id="flash_deal_end_date" name="coupon_end_date" type="text" class="form-control" autocomplete="off" value="<?php echo e($edit['value']->coupon_end_date); ?>" data-bvalidator="required">
                    </div>
                    
                </div>
                <div class="form-group row">
                   <div class="col-sm-6">
                        <label for="username"><?php echo e(Helper::translation(1915,$translate)); ?> <span class="required">*</span></label>
                        <select name="coupon_status" class="form-control" data-bvalidator="required">
                         <option value=""></option>
                         <option value="1" <?php if($edit['value']->coupon_status == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1916,$translate)); ?></option>
                         <option value="0" <?php if($edit['value']->coupon_status == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1917,$translate)); ?></option>
                         </select>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
                <input type="hidden" name="coupon_id" value="<?php echo e(base64_encode($edit['value']->coupon_id)); ?>">
                <button type="submit" class="btn button-color float-left"><?php echo e(Helper::translation(1919,$translate)); ?></button>
            </form>
        </div>
    </div>
</div>
</main>
<?php else: ?>
<?php echo $__env->make('not-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/edit-coupon.blade.php ENDPATH**/ ?>