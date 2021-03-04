<?php use ZigKart\Models\Blog; ?>
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
    <?php if($allsettings->site_blog_display == 1): ?>
    <?php if(in_array('blog',$avilable)): ?>
    <div id="right-panel" class="right-panel">
         <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Post</h1>
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
                       <form action="<?php echo e(route('admin.edit-post')); ?>" method="post" enctype="multipart/form-data" id="category_form">
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
		     $view = Blog::postsinglar($post_id);
		  }
		  else
		  {
		    $code = $language->language_code;
		    $view = Blog::postothers($post_id,$code);
		  }
          ?>
          <div class="tab-pane fade <?php if($i == 1): ?> show active <?php endif; ?> mt-4" id="<?php echo e($language->language_name); ?>" role="tabpanel">
              <div class="form-group">
                   <label for="name" class="control-label mb-1">Title <span class="require">*</span></label>
                   <input type="text" name="post_title[]" id="post_title" value="<?php if(!empty($view->post_title)): ?><?php echo e($view->post_title); ?><?php endif; ?>"   class="form-control" data-bvalidator="required">
              </div>
              <div class="form-group">
                     <label for="site_desc" class="control-label mb-1">Short Description<span class="require">*</span></label>
                     <textarea name="post_short_desc[]" rows="3"  class="form-control" data-bvalidator="required"><?php if(!empty($view->post_short_desc)): ?><?php echo e($view->post_short_desc); ?><?php endif; ?></textarea>
              </div>
              <div class="form-group">
                  <label for="site_desc" class="control-label mb-1">Description<span class="require">*</span></label>
                  <textarea name="post_desc[]" id="summary-ckeditor<?php echo e($language->language_id); ?>" rows="6" class="form-control" data-bvalidator="required"><?php if(!empty($view->post_desc)): ?><?php echo e(html_entity_decode($view->post_desc)); ?><?php endif; ?></textarea>
              </div>            
          </div>
          <input type="hidden" name="language_code[]" value="<?php echo e($language->language_code); ?>">
          <?php $i++; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
      </div>
      <div class="form-group">
                                                <label for="name" class="control-label mb-1">Slug <span class="require">*</span></label>
                                                <input id="post_slug" name="post_slug" type="text" class="form-control" value="<?php echo e($edit['post']->post_slug); ?>" data-bvalidator="required">
                                            </div>
                       <div class="form-group">
                                                <label for="cat_id" class="control-label mb-1">Category <span class="require">*</span></label>
                                                <select name="blog_cat_id" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $catData['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->blog_cat_id); ?>" <?php if($edit['post']->blog_cat_id == $category->blog_cat_id): ?> selected="selected" <?php endif; ?>><?php echo e($category->blog_category_name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cat_id" class="control-label mb-1">Media Type <span class="require">*</span></label>
                                                <select name="post_media_type" id="post_media_type" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="image" <?php if($edit['post']->post_media_type == 'image'): ?> selected <?php endif; ?>>Image</option>
                                                <option value="video" <?php if($edit['post']->post_media_type == 'video'): ?> selected <?php endif; ?>>Video</option>
                                                </select>
                                            </div>
                                            <div id="ifVideo" <?php if($edit['post']->post_media_type == 'video'): ?> class="form-group force-block" <?php else: ?> class="form-group force-none" <?php endif; ?>>
                                                <label for="name" class="control-label mb-1">Youtube Video Url <span class="require">*</span></label>
                                                <input id="post_video" name="post_video" type="text" class="form-control" data-bvalidator="required,url" value="<?php echo e($edit['post']->post_video); ?>">
                                                (example video url : https://www.youtube.com/watch?v=cXxAVn3rASk )
                                            </div>
                                            <div id="ifImage" <?php if($edit['post']->post_media_type == 'image'): ?> class="form-group force-block" <?php else: ?> class="form-group force-none" <?php endif; ?>>
                                                <label for="site_favicon" class="control-label mb-1">Image<span class="require">*</span></label>
                                            <input type="file" id="post_image" name="post_image" class="form-control-file" <?php if($edit['post']->post_image == ''): ?> data-bvalidator="required,extension[jpg:png:jpeg]" data-bvalidator-msg="Please select file of type .jpg, .png or .jpeg" <?php else: ?> data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="Please select file of type .jpg, .png or .jpeg" <?php endif; ?>>
                                            <?php if($edit['post']->post_image != ''): ?>
                                                <img height="50" width="50" src="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">Tags</label>
                                            <textarea name="post_tags" rows="6"  class="form-control"><?php echo e($edit['post']->post_tags); ?></textarea>
                                            <small>(Tags separated by comma <strong>example:</strong> post,blog,category)</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> Status <span class="require">*</span></label>
                                                <select name="post_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($edit['post']->post_status == 1): ?> selected="selected" <?php endif; ?>>Active</option>
                                                <option value="0" <?php if($edit['post']->post_status == 0): ?> selected="selected" <?php endif; ?>>InActive</option>
                                                </select>
                                            </div>   
                                            <input type="hidden" name="save_post_image" value="<?php echo e($edit['post']->post_image); ?>">     
                                            <input type="hidden" name="post_id" value="<?php echo e($edit['post']->post_id); ?>"> 
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
    <?php endif; ?>
    <!-- Right Panel -->
    <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/admin/edit-post.blade.php ENDPATH**/ ?>