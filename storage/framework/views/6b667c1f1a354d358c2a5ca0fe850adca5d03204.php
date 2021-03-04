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
    <?php if(in_array('ads',$avilable)): ?> 
    <div id="right-panel" class="right-panel">
       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Ads</h1>
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
                           <form action="<?php echo e(route('admin.ads')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                           <div class="col-md-12 mt-3"><h5>Shop Ads</h5></div>
                           <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Shop Ads</label>
                                                <select name="shop_ads" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="0" <?php if($setting['setting']->shop_ads == 0): ?> selected <?php endif; ?>>OFF</option>
                                                <option value="1" <?php if($setting['setting']->shop_ads == 1): ?> selected <?php endif; ?>>ON</option>
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
                                                <strong>example code : <br> <img src="<?php echo e(url('/')); ?>/public/img/ins.png"></strong>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                           <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Top Google Ads Code</label>
                                            <textarea name="shop_top_ads" id="shop_top_ads" rows="6" class="form-control noscroll_textarea" ><?php echo e($setting['setting']->shop_top_ads); ?></textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Bottom Google Ads Code</label>
                                            <textarea name="shop_bottom_ads" id="shop_bottom_ads" rows="6" class="form-control noscroll_textarea" ><?php echo e($setting['setting']->shop_bottom_ads); ?></textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Sidebar Google Ads Code</label>
                                            <textarea name="shop_sidebar_ads" id="shop_sidebar_ads" rows="6" class="form-control noscroll_textarea" ><?php echo e($setting['setting']->shop_sidebar_ads); ?></textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 mt-3"><h5>Blog Ads</h5></div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Blog Ads</label>
                                                <select name="blog_ads" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="0" <?php if($setting['setting']->blog_ads == 0): ?> selected <?php endif; ?>>OFF</option>
                                                <option value="1" <?php if($setting['setting']->blog_ads == 1): ?> selected <?php endif; ?>>ON</option>
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
                                                <strong>example code : <br> <img src="<?php echo e(url('/')); ?>/public/img/ins.png"></strong>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Top Google Ads Code</label>
                                            <textarea name="blog_top_ads" id="blog_top_ads" rows="6" class="form-control noscroll_textarea" ><?php echo e($setting['setting']->blog_top_ads); ?></textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Bottom Google Ads Code</label>
                                            <textarea name="blog_bottom_ads" id="blog_bottom_ads" rows="6" class="form-control noscroll_textarea" ><?php echo e($setting['setting']->blog_bottom_ads); ?></textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Sidebar Google Ads Code</label>
                                            <textarea name="blog_sidebar_ads" id="blog_sidebar_ads" rows="6" class="form-control noscroll_textarea" ><?php echo e($setting['setting']->blog_sidebar_ads); ?></textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 mt-3"><h5>Pages Ads</h5></div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">Pages Ads</label>
                                                <select name="page_ads" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="0" <?php if($setting['setting']->page_ads == 0): ?> selected <?php endif; ?>>OFF</option>
                                                <option value="1" <?php if($setting['setting']->page_ads == 1): ?> selected <?php endif; ?>>ON</option>
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
                                                <strong>example code : <br> <img src="<?php echo e(url('/')); ?>/public/img/ins.png"></strong>
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
                                                <label for="site_favicon" class="control-label mb-1">Top Google Ads Code</label>
                                            <textarea name="page_top_ads" id="page_top_ads" rows="6" class="form-control noscroll_textarea" ><?php echo e($setting['setting']->page_top_ads); ?></textarea>
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
                                                <label for="site_favicon" class="control-label mb-1">Bottom Google Ads Code</label>
                                            <textarea name="page_bottom_ads" id="page_bottom_ads" rows="6" class="form-control noscroll_textarea" ><?php echo e($setting['setting']->page_bottom_ads); ?></textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                             <input type="hidden" name="sid" value="1">
                            <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> Submit</button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Reset </button>
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
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/admin/ads.blade.php ENDPATH**/ ?>