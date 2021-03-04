<?php use ZigKart\Models\Slideshow; ?>
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
    <?php if(in_array('slideshow',$avilable)): ?>
    <div id="right-panel" class="right-panel">
       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Image</h1>
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
                       <?php if($demo_mode == 'on'): ?>
                           <?php echo $__env->make('admin.demo-mode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           <?php else: ?>
                       <form action="<?php echo e(route('admin.edit-slideshow')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <?php endif; ?>
                        <div class="card">
                         <div class="col-md-8">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    <div class="card mt-3 tab-card">
                                    <div class="card-header tab-card-header">
                                      <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                        <?php $j = 1; ?>
                                        <?php $__currentLoopData = $language['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?php if($j == 1): ?> active show <?php endif; ?>"  data-toggle="tab" href="#<?php echo e($language->language_name); ?>" role="tab"  aria-selected="true"><?php echo e($language->language_name); ?></a>
                                        </li>
                                        <?php $j++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </ul>
                                    </div>
                            
                                    <div class="tab-content" id="myTabContent">
                                      <?php $i = 1; ?>
                                      <?php $__currentLoopData = $languages['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php
                                      if($language->language_code == 'en')
                                      {
                                         $view = Slideshow::singlar($slide_id);
                                      }
                                      else
                                      {
                                        $code = $language->language_code;
                                        $view = Slideshow::others($slide_id,$code);
                                      }
                                      ?>
                                      <div class="tab-pane fade <?php if($i == 1): ?> show active <?php endif; ?> mt-4" id="<?php echo e($language->language_name); ?>" role="tabpanel">
                                          <div class="form-group">
                                               <label for="name" class="control-label mb-1">Heading</label>
                                               <input type="text" name="slide_title[]" id="slide_title" value="<?php if(!empty($view->slide_title)): ?><?php echo e($view->slide_title); ?><?php endif; ?>"   class="form-control">
                                          </div>
                                          <div class="form-group">
                                              <label for="site_desc" class="control-label mb-1">Sub Heading</label>
                                              <input id="slide_desc" name="slide_desc[]" type="text" class="form-control" value="<?php if(!empty($view->slide_desc)): ?><?php echo e($view->slide_desc); ?><?php endif; ?>">
                                          </div> 
                                          <div class="form-group">
                                              <label for="site_desc" class="control-label mb-1">Button Text</label>
                                              <input id="slide_btn_text" name="slide_btn_text[]" type="text" class="form-control" value="<?php if(!empty($view->slide_btn_text)): ?><?php echo e($view->slide_btn_text); ?><?php endif; ?>">
                                          </div>            
                                      </div>
                                      <input type="hidden" name="language_code[]" value="<?php echo e($language->language_code); ?>">
                                      <?php $i++; ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                                    </div>
                                  </div>
                                  <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> Text Position</label>
                                                <select name="slide_text_position" class="form-control">
                                                <option value="left" <?php if($edit['slide']->slide_text_position == 'left'): ?> selected <?php endif; ?>>Left</option>
                                                <option value="right" <?php if($edit['slide']->slide_text_position == 'right'): ?> selected <?php endif; ?>>Right</option>
                                                <option value="center" <?php if($edit['slide']->slide_text_position == 'center'): ?> selected <?php endif; ?>>Center</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_logo" class="control-label mb-1">Slideshow Image (size 1920 x 400) <span class="require">*</span></label>
                                            <input type="file" id="slide_image" name="slide_image" class="form-control-file"  <?php if($edit['slide']->slide_image == ''): ?> data-bvalidator="required,extension[jpg:png:jpeg]" data-bvalidator-msg="Please select file of type .jpg, .png or .jpeg" <?php else: ?> data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="Please select file of type .jpg, .png or .jpeg" <?php endif; ?>><?php if($edit['slide']->slide_image != ''): ?> <img  src="<?php echo e(url('/')); ?>/public/storage/slideshow/<?php echo e($edit['slide']->slide_image); ?>" alt="<?php echo e($edit['slide']->slide_image); ?>" class="image-size" /><?php else: ?> <img src="<?php echo e(url('/')); ?>/public/img/no-image.jpg" alt="<?php echo e($edit['slide']->slide_image); ?>"  class="image-size"/>  <?php endif; ?>
                                            </div>                                  
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Button Link</label>
                                                <input id="slide_btn_link" name="slide_btn_link" type="text" class="form-control" data-bvalidator="url" value="<?php echo e($edit['slide']->slide_btn_link); ?>">
                                            </div>                                     
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Display Order</label>
                                                <input id="slide_order" name="slide_order" type="text" class="form-control" data-bvalidator="digit,min[0]" value="<?php echo e($edit['slide']->slide_order); ?>">
                                            </div> 
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> Status <span class="require">*</span></label>
                                                <select name="slide_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($edit['slide']->slide_status == 1): ?> selected <?php endif; ?>>Active</option>
                                                <option value="0" <?php if($edit['slide']->slide_status == 0): ?> selected <?php endif; ?>>InActive</option>
                                                </select>
                                             </div>   
                                            <input type="hidden" name="save_slide_image" value="<?php echo e($edit['slide']->slide_image); ?>">                                             
                                            <input type="hidden" name="image_size" value="<?php echo e($allsettings->site_max_image_size); ?>">    
                                            <input type="hidden" name="slide_id" value="<?php echo e($edit['slide']->slide_id); ?>">   
                                           <input type="hidden" name="token" value="<?php echo e(uniqid()); ?>">  
                                    </div>
                                </div>
                               </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="card-footer">
                                  <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                      <i class="fa fa-dot-circle-o"></i> Submit
                                  </button>
                                  <button type="reset" class="btn btn-danger btn-sm">
                                       <i class="fa fa-ban"></i> Reset
                                  </button>
                            </div>
                          </div> 
                       </form> 
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
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/admin/edit-slideshow.blade.php ENDPATH**/ ?>