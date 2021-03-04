<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<?php echo $__env->make('admin.stylesheet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Right Panel -->
    <?php if(in_array('products',$avilable)): ?>
    <div id="right-panel" class="right-panel">
      <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(2021,$translate)); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
                </div>
            </div>
        </div>
        <?php if(session('success')): ?>
        <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        </div>
       <?php endif; ?>
       <?php if(session('error')): ?>
            <div class="col-sm-12">
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                    <?php echo e(session('error')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="col-sm-12">
             <div class="alert  alert-danger alert-dismissible fade show" role="alert">
             <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php echo e($error); ?>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
             </div>
            </div>   
         <?php endif; ?>
         <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                   <div class="col-md-12">
                     <div class="card">
                       <?php if($demo_mode == 'on'): ?>
                           <?php echo $__env->make('admin.demo-mode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           <?php else: ?>
                        <form action="<?php echo e(route('admin.edit-coupon')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <?php endif; ?>
                         <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(1923,$translate)); ?> <span class="require">*</span></label>
                                                <input id="coupon_code" name="coupon_code" type="text" class="form-control noscroll_textarea" value="<?php echo e($edit['value']->coupon_code); ?>" data-bvalidator="required"> 
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(1925,$translate)); ?> <span class="require">*</span></label>
                                                <input id="flash_deal_start_date" name="coupon_start_date" type="text" class="form-control noscroll_textarea" value="<?php echo e($edit['value']->coupon_start_date); ?>" data-bvalidator="required"> 
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(1915,$translate)); ?> <span class="require">*</span></label>
                                                <select name="coupon_status" class="form-control" data-bvalidator="required">
                                                 <option value=""></option>
                                                 <option value="1" <?php if($edit['value']->coupon_status == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1916,$translate)); ?></option>
                                                 <option value="0" <?php if($edit['value']->coupon_status == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1917,$translate)); ?></option>
                                                 </select>
                                            </div>
                                     </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(1924,$translate)); ?>(%) <span class="require">*</span></label>
                                                <input id="coupon_value" name="coupon_value" type="text" class="form-control noscroll_textarea" value="<?php echo e($edit['value']->coupon_value); ?>" data-bvalidator="required,min[1]">
                                            </div>
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(1926,$translate)); ?> <span class="require">*</span></label>
                                                <input id="flash_deal_end_date" name="coupon_end_date" type="text" class="form-control noscroll_textarea" value="<?php echo e($edit['value']->coupon_end_date); ?>" data-bvalidator="required"> 
                                            </div>
                                            <?php if($allsettings->type_of_marketplace == 'multi-vendor'): ?>
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(2112,$translate)); ?> <span class="require">*</span></label>
                                                <select name="user_id" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $vendor['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($vendor->id); ?>" <?php if($edit['value']->user_id == $vendor->id): ?> selected <?php endif; ?>><?php echo e($vendor->username); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <?php else: ?>
                                            <input type="hidden" name="user_id" value="1">
                                            <?php endif; ?>
                                            <input type="hidden" name="discount_type" value="<?php echo e($edit['value']->discount_type); ?>">
                                            <input type="hidden" name="coupon_id" value="<?php echo e(base64_encode($edit['value']->coupon_id)); ?>">
                                     </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> <?php echo e(Helper::translation(1919,$translate)); ?></button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> <?php echo e(Helper::translation(2979,$translate)); ?> </button>
                             </div>
                             </div>
                    </form> 
                    </div>
                  </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->
   <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/admin/edit-coupon.blade.php ENDPATH**/ ?>