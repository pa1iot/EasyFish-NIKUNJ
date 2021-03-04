<?php use ZigKart\Models\Attribute; ?>
<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php if(Auth::user()->user_type == 'vendor'): ?><?php echo e(Helper::translation(2020,$translate)); ?><?php else: ?><?php echo e(Helper::translation(1912,$translate)); ?><?php endif; ?>  - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(Auth::user()->user_type == 'vendor'): ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2020,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2020,$translate)); ?></span></p>
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
             <form action="<?php echo e(route('edit-attribute-value')); ?>" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
             <?php echo e(csrf_field()); ?>

             <div class="card mt-3 tab-card">
        <div class="card-header tab-card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <?php $j = 1; ?>
            <?php $__currentLoopData = $language_page['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a class="nav-link <?php if($j == 1): ?> active show <?php endif; ?>"  data-toggle="tab" href="#<?php echo e($language->language_name); ?>" role="tab"  aria-selected="true"><?php echo e($language->language_name); ?></a>
            </li>
            <?php $j++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>

        <div class="tab-content" id="myTabContent">
          <?php $i = 1; ?>
          <?php $__currentLoopData = $languages_page['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
          if($language->language_code == 'en')
		  {
		     $view = Attribute::attrisinglar($attribute_value_id);
		  }
		  else
		  {
		    $code = $language->language_code;
		    $view = Attribute::attriothers($attribute_value_id,$code);
		  }
          ?>
          <div class="tab-pane fade <?php if($i == 1): ?> show active <?php endif; ?> mt-4" id="<?php echo e($language->language_name); ?>" role="tabpanel">
              <div class="form-group row">
                <div class="col-sm-12">
                        <label for="username"><?php echo e(Helper::translation(1921,$translate)); ?> <span class="required">*</span></label>
                        <input id="attribute_value" name="attribute_value[]" type="text" class="form-control" data-bvalidator="required" value="<?php if(!empty($view->attribute_value)): ?><?php echo e($view->attribute_value); ?><?php endif; ?>">
                    </div>
             </div>             
          </div>
          <input type="hidden" name="language_code[]" value="<?php echo e($language->language_code); ?>">
          <?php $i++; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
      </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="username">Slug<span class="required">*</span></label>
                        <input id="attribute_value_slug" name="attribute_value_slug" type="text" class="form-control" value="<?php echo e($edit['value']->attribute_value_slug); ?>" data-bvalidator="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="username"><?php echo e(Helper::translation(1934,$translate)); ?> (<?php echo e($allsettings->site_currency_symbol); ?>)</label>
                        <input id="attribute_value_price" name="attribute_value_price" type="text" class="form-control" value="<?php echo e($edit['value']->attribute_value_price); ?>" data-bvalidator="min[0]">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="name"><?php echo e(Helper::translation(1914,$translate)); ?><span class="required">*</span></label>
                        <select name="attribute_type" class="form-control" data-bvalidator="required">
                            <option value=""></option>
                            <?php $__currentLoopData = $typeData['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->attribute_id); ?>" <?php if($edit['value']->attribute_id == $type->attribute_id): ?> selected <?php endif; ?>><?php echo e($type->attribute_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="inputContactNumber"><?php echo e(Helper::translation(1915,$translate)); ?><span class="required">*</span></label>
                        <select name="attribute_status" class="form-control" data-bvalidator="required">
                          <option value=""></option>
                          <option value="1" <?php if($edit['value']->attribute_value_status == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1916,$translate)); ?></option>
                          <option value="0" <?php if($edit['value']->attribute_value_status == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1917,$translate)); ?></option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                <input type="hidden" name="attribute_value_id" value="<?php echo e($attribute_value_id); ?>">
                <input type="hidden" name="token" value="<?php echo e(uniqid()); ?>">
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/edit-attribute-value.blade.php ENDPATH**/ ?>