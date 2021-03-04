<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2012,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo NoCaptcha::renderJs(); ?>

</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2012,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2012,$translate)); ?></span></p>
      </div>
    </section>
    <main role="main">
      <div class="container page-white-box mt-3">
         <div class="row">
	    <div class="col-md-12">
	        <h4><?php echo e(Helper::translation(2013,$translate)); ?></h4>
		    <hr>
	    </div>
		<div class="col-md-6">
		    <div class="address">
		    <h5><?php echo e(Helper::translation(2003,$translate)); ?>:</h5>
		    <ul class="list-unstyled">
		        <li> <?php echo e($allsettings->office_address); ?></li>
		       
		    </ul>
		    </div>
		    <div class="email">
		    <h5><?php echo e(Helper::translation(2014,$translate)); ?>:</h5>
		    <ul class="list-unstyled">
		        <li> <?php echo e($allsettings->office_email); ?></li>
		        
		    </ul>
		    </div>
		    <div class="phone">
		        <h5><?php echo e(Helper::translation(2002,$translate)); ?>:</h5>
		        <ul class="list-unstyled">
		        <li> <?php echo e($allsettings->office_phone); ?></li>
		       
		    </ul>
		    </div>
		</div>
		<div class="col-md-6">
            <div>
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
		    <div class="card">
		        <div class="card-body">
		             <form action="<?php echo e(route('contact')); ?>" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <input id="from_name" name="from_name" placeholder="<?php echo e(Helper::translation(2015,$translate)); ?>" class="form-control" type="text" data-bvalidator="required">
                            </div>
                            <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="inputEmail4" placeholder="<?php echo e(Helper::translation(2014,$translate)); ?>" name="from_email" data-bvalidator="email,required">
                            </div>
                          </div>
                          <div class="form-row">
                          <div class="form-group col-md-12">
                                     <input id="from_phone" name="from_phone" placeholder="<?php echo e(Helper::translation(2002,$translate)); ?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                                      <textarea class="form-control" cols="20" rows="5" placeholder="<?php echo e(Helper::translation(2016,$translate)); ?>" name="message_text" data-bvalidator="required"></textarea>
                            </div>
                        </div>
                        <div class="form-row form-group<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">
                         <div class="col-md-12">
                          <?php echo app('captcha')->display(); ?>

                                        <?php if($errors->has('g-recaptcha-response')): ?>
                                            <span class="help-block">
                                                <strong class="red"><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                        </div>
                      </div>
                        <div class="form-row">
                            <button type="submit" class="btn button-color"><?php echo e(Helper::translation(1919,$translate)); ?></button>
                        </div>
                    </form>
		        </div>
		    </div>
		</div>
	</div>
   </div>
 </main>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/contact.blade.php ENDPATH**/ ?>