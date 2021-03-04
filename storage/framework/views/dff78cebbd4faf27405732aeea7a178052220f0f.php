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
    <?php if(in_array('block-section',$avilable)): ?>
    <div id="right-panel" class="right-panel">
       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(3411,$translate)); ?></h1>
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
                           <form action="<?php echo e(route('admin.home-section')); ?>" method="post" id="setting_form" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                           <div class="col-md-12 mt-3 pt-3"><h4><?php echo e(Helper::translation(2056,$translate)); ?></h4></div>
                             <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3414,$translate)); ?></label>
                                                <input id="site_home_category" name="site_home_category" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_home_category); ?>">
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
                                                <label for="site_favicon" class="control-label mb-1"><?php echo e(Helper::translation(3417,$translate)); ?> (<?php echo e(Helper::translation(3003,$translate)); ?> 128 x 128)</label>
                                            <input type="file" id="site_more_category" name="site_more_category" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="<?php echo e(Helper::translation(1937,$translate)); ?>"><?php if($setting['setting']->site_more_category != ''): ?>
                                                <img width="70" height="70" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->site_more_category); ?>" />
                                                <?php endif; ?>
                                            </div>
                                       </div>
                                </div>
                             </div>
                            </div>
                           <div class="col-md-12 mt-3 pt-3"><h4><?php echo e(Helper::translation(3420,$translate)); ?></h4></div>
                           <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3423,$translate)); ?><span class="require">*</span></label><br/>
                                                 <select name="site_home_top_banner" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_home_top_banner == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(3120,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_home_top_banner == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(3117,$translate)); ?></option>
                                         </select>
                                      </div>
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3426,$translate)); ?> (<?php echo e(Helper::translation(3003,$translate)); ?> : 630 X 250px )</label>
                                                <input type="file" id="site_banner_one" name="site_banner_one" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="<?php echo e(Helper::translation(1937,$translate)); ?>"><?php if($setting['setting']->site_banner_one != ''): ?>
                                                <img width="150" height="70" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->site_banner_one); ?>" />
                                                <?php endif; ?>
                                            </div>    
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(2943,$translate)); ?></label>
                                                <input id="site_banner_one_heading" name="site_banner_one_heading" type="text" class="form-control noscroll_textarea" value="<?php echo e(Helper::translation(2943,'en')); ?>" readonly><a href="languages" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; <?php echo e(Helper::translation(3303,$translate)); ?></a></div><div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3432,$translate)); ?></label>
                                          <input id="site_banner_one_link" name="site_banner_one_link" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_banner_one_link); ?>">
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3435,$translate)); ?> (<?php echo e(Helper::translation(3003,$translate)); ?> : 630 X 250px )</label>
                                                <input type="file" id="site_banner_two" name="site_banner_two" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="Please select file of type .jpg, .png or .jpeg"><?php if($setting['setting']->site_banner_two != ''): ?>
                                                <img width="150" height="70" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->site_banner_two); ?>" />
                                                <?php endif; ?>
                                            </div>     
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3438,$translate)); ?></label>
                                                <input id="site_banner_two_heading" name="site_banner_two_heading" type="text" class="form-control noscroll_textarea" value="<?php echo e(Helper::translation(2946,'en')); ?>" readonly><a href="languages" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; <?php echo e(Helper::translation(3303,$translate)); ?></a></div><div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3441,$translate)); ?></label>
                                              <input id="site_banner_two_link" name="site_banner_two_link" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_banner_two_link); ?>">                                         </div>
                                    </div>
                                </div>
                             </div>
                            </div>
                            <div class="col-md-12 mt-3 pt-3"><h4><?php echo e(Helper::translation(2059,$translate)); ?></h4></div>
                            <div class="col-md-6">
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3444,$translate)); ?><span class="require">*</span></label>
                                                <input id="site_home_physical" name="site_home_physical" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_home_physical); ?>" data-bvalidator="required"> </div>     
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3447,$translate)); ?><span class="require">*</span></label><br/>
                                                <select name="site_physical_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" <?php if($setting['setting']->site_physical_order == 'asc'): ?> selected <?php endif; ?>>ASC</option>
                                                <option value="desc" <?php if($setting['setting']->site_physical_order == 'desc'): ?> selected <?php endif; ?>>DESC</option>
                                                </select>
                                              </div> 
                                             <small>(ASC - <?php echo e(Helper::translation(3453,$translate)); ?> | DESC - <?php echo e(Helper::translation(3456,$translate)); ?>)</small>
                                     </div>
                                </div>
                               </div>
                            </div>
                           <div class="col-md-12 mt-3 pt-3"><h4><?php echo e(Helper::translation(2068,$translate)); ?></h4></div>
                            <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3450,$translate)); ?><span class="require">*</span></label>
                                                <input id="site_home_external" name="site_home_external" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_home_external); ?>" data-bvalidator="required"></div>     
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3447,$translate)); ?><span class="require">*</span></label><br/>
                                                 <select name="site_external_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" <?php if($setting['setting']->site_external_order == 'asc'): ?> selected <?php endif; ?>>ASC</option>
                                                <option value="desc" <?php if($setting['setting']->site_external_order == 'desc'): ?> selected <?php endif; ?>>DESC</option>
                                                </select>
                                               </div> 
                                             <small>(ASC - <?php echo e(Helper::translation(3453,$translate)); ?> | DESC - <?php echo e(Helper::translation(3456,$translate)); ?>)</small>
                                           
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 mt-3 pt-3"><h4><?php echo e(Helper::translation(2069,$translate)); ?></h4></div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3459,$translate)); ?><span class="require">*</span></label>
                                                <input id="site_home_digital" name="site_home_digital" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_home_digital); ?>" data-bvalidator="required"></div>     
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
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3447,$translate)); ?><span class="require">*</span></label><br/>
                                                 <select name="site_digital_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" <?php if($setting['setting']->site_digital_order == 'asc'): ?> selected <?php endif; ?>>ASC</option>
                                                <option value="desc" <?php if($setting['setting']->site_digital_order == 'desc'): ?> selected <?php endif; ?>>DESC</option>
                                                </select>
                                             </div> 
                                             <small>(ASC - <?php echo e(Helper::translation(3453,$translate)); ?> | DESC - <?php echo e(Helper::translation(3456,$translate)); ?>)</small>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 mt-3 pt-3"><h4>Bottom Banner</h4></div>
                            <div class="col-md-12">
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3423,$translate)); ?><span class="require">*</span></label><br/>
                                                 <select name="site_home_bottom_banner" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($setting['setting']->site_home_bottom_banner == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(3120,$translate)); ?></option>
                                                <option value="0" <?php if($setting['setting']->site_home_bottom_banner == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(3117,$translate)); ?></option>
                                         </select>
                                      </div>
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3462,$translate)); ?> (<?php echo e(Helper::translation(3003,$translate)); ?> : 1280 X 250px )</label>
                                                <input type="file" id="site_banner_three" name="site_banner_three" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="<?php echo e(Helper::translation(1937,$translate)); ?>"><?php if($setting['setting']->site_banner_three != ''): ?>
                                                <img width="150" height="70" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($setting['setting']->site_banner_three); ?>" />
                                                <?php endif; ?>
                                            </div>    
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(2949,$translate)); ?></label>
                                                <input id="site_banner_three_heading" name="site_banner_three_heading" type="text" class="form-control noscroll_textarea" value="<?php echo e(Helper::translation(2949,'en')); ?>" readonly><a href="languages" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; <?php echo e(Helper::translation(3303,$translate)); ?></a></div><div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3468,$translate)); ?></label>
                                            <input id="site_banner_three_link" name="site_banner_three_link" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_banner_three_link); ?>"></div></div></div></div></div>
                                            <div class="col-md-12 mt-3 pt-3"><h4><?php echo e(Helper::translation(3060,$translate)); ?> <?php echo e(Helper::translation(1975,$translate)); ?></h4></div>
                            <div class="col-md-6">
                              <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">How many featured product display on homepage?<span class="require">*</span></label>
                                                <input id="site_home_featured" name="site_home_featured" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_home_featured); ?>" data-bvalidator="required"></div></div></div></div>
                            </div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3447,$translate)); ?><span class="require">*</span></label><br/>
                                                <select name="site_featured_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" <?php if($setting['setting']->site_featured_order == 'asc'): ?> selected <?php endif; ?>>ASC</option>
                                                <option value="desc" <?php if($setting['setting']->site_featured_order == 'desc'): ?> selected <?php endif; ?>>DESC</option>
                                                </select>
                                              </div> 
                                             <small>(ASC - <?php echo e(Helper::translation(3453,$translate)); ?> | DESC - <?php echo e(Helper::translation(3456,$translate)); ?>)</small>
                                    </div>
                                </div>
                               </div>
                            </div>
                           <div class="col-md-12 mt-3 pt-3"><h4><?php echo e(Helper::translation(2070,$translate)); ?></h4></div>
                            <div class="col-md-6">
                              <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3471,$translate)); ?><span class="require">*</span></label>
                                                <input id="site_home_deal" name="site_home_deal" type="text" class="form-control noscroll_textarea" value="<?php echo e($setting['setting']->site_home_deal); ?>" data-bvalidator="required"></div></div></div></div>
                            </div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(Helper::translation(3447,$translate)); ?><span class="require">*</span></label><br/>
                                                <select name="site_deal_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" <?php if($setting['setting']->site_deal_order == 'asc'): ?> selected <?php endif; ?>>ASC</option>
                                                <option value="desc" <?php if($setting['setting']->site_deal_order == 'desc'): ?> selected <?php endif; ?>>DESC</option>
                                                </select>
                                              </div> 
                                             <small>(ASC - <?php echo e(Helper::translation(3453,$translate)); ?> | DESC - <?php echo e(Helper::translation(3456,$translate)); ?>)</small>
                                    </div>
                                </div>
                               </div>
                            </div> 
                            <input type="hidden" name="image_size" value="<?php echo e($setting['setting']->site_max_image_size); ?>">
                             <input type="hidden" name="save_more_category" value="<?php echo e($setting['setting']->site_more_category); ?>">
                             <input type="hidden" name="save_banner_one" value="<?php echo e($setting['setting']->site_banner_one); ?>">
                             <input type="hidden" name="save_banner_two" value="<?php echo e($setting['setting']->site_banner_two); ?>">
                             <input type="hidden" name="save_banner_three" value="<?php echo e($setting['setting']->site_banner_three); ?>">
                             <input type="hidden" name="sid" value="1">
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
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/admin/home-section.blade.php ENDPATH**/ ?>