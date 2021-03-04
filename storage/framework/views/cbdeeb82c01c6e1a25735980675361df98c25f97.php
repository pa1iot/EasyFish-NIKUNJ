<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php if($allsettings->site_blog_display == 1): ?> <?php echo e($slug); ?> <?php else: ?> <?php echo e(Helper::translation(1912,$translate)); ?> <?php endif; ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if($allsettings->site_blog_display == 1): ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(1978,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(1978,$translate)); ?></span><?php if($slug != 'Blog'): ?> <span class="split">&gt;</span> <span><?php echo e($slug); ?></span><?php endif; ?></p>
      </div>
    </section>
<main role="main">
      <div class="container mt-3">
      <?php if($allsettings->blog_ads == 1): ?>
      <?php if($allsettings->blog_top_ads !=''): ?>
         <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-2" align="center">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <?php echo html_entity_decode($allsettings->blog_top_ads); ?>
                    <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
       </script>
      </div>
      </div>
      <?php endif; ?> 
      <?php endif; ?>
         <div class="row mb-5 pb-5">
          <div class="col-md-9">
          <!-- Blog Post -->
          <?php $__currentLoopData = $blogData['post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="card mb-5 shadow-sm white-box border-0 rounded-0 blog-post-loop li-item">
            <?php if($post->post_media_type =='image'): ?>
            <a href="<?php echo e(URL::to('/single')); ?>/<?php echo e($post->post_slug); ?>" title="<?php echo e($post->post_title); ?>">
            <?php if($post->post_image!=''): ?>
            <img src="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($post->post_image); ?>" alt="<?php echo e($post->post_title); ?>" class="card-img-top blog-img-lg rounded-0">
            <?php else: ?>
            <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($post->post_title); ?>" class="card-img-top rounded-0 blog-img-lg">
            <?php endif; ?>
            </a>
            <?php endif; ?>
            <?php if($post->post_media_type =='video'): ?>
            <?php 
            $link = $post->post_video;
            $video_id = explode("?v=", $link);
            $video_id = $video_id[1];
            ?>
            <iframe type="text/html" width="100%" height="500px" src="https://www.youtube.com/embed/<?php echo e($video_id); ?>?showinfo=0&rel=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe> 
            <?php endif; ?>
            <?php
            $date = date('d', strtotime($post->post_date));
            $month = date('M', strtotime($post->post_date));
            $year = date('Y', strtotime($post->post_date));
            if($translate == 'en')
            {
            $comment_post_id = $post->post_id;
            }
            else
            {
            $comment_post_id = $post->post_page_parent;
            }
            ?>
            <div class="post-date"> <span class="post-date-day"><i class="fa fa-calendar"></i> <?php echo e($date); ?> <?php echo e($month); ?> <?php echo e($year); ?></span></div>
            <div class="card-body">
              <h3 class="card-title"><a href="<?php echo e(URL::to('/single')); ?>/<?php echo e($post->post_slug); ?>" class="link-color"><?php echo e($post->post_title); ?></a></h3>
              <div class="blog-meta">
                  <div class="blog-icon-view">
                        <p><a href="<?php echo e(URL::to('/blog')); ?>/category/<?php echo e($post->blog_cat_id); ?>/<?php echo e($post->blog_category_slug); ?>">
                        <i class="fa fa-list-alt"></i> <?php echo e($post->blog_category_name); ?>

                        </a></p>
                        <p class="comment"><i class="fa fa-comments"></i> <?php echo e($comments->has($comment_post_id) ? count($comments[$comment_post_id]) : 0); ?></p>
                        <p class="view"><i class="fa fa-eye"></i> <?php echo e($post->post_view); ?></p>
                  </div>
              </div>
              <p class="card-text"><?php echo e(substr($post->post_short_desc,0,300).'...'); ?></p>
              <a href="<?php echo e(URL::to('/single')); ?>/<?php echo e($post->post_slug); ?>" class="btn button-color"><?php echo e(Helper::translation(1979,$translate)); ?></a>
            </div>
          </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <div class="text-right">
            <div class="turn-page" id="post-pager"></div>
         </div>
       </div>
        <!-- Sidebar Widgets Column -->
      <div class="col-md-3">
        <!-- Search Widget -->
         <!-- Categories Widget -->
          <div class="card shadow-sm bg-white border-0 mb-5 rounded-0 categorylist">
            <h5 class="card-header bg-white link-color"><?php echo e(Helper::translation(1932,$translate)); ?></h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                    <?php $__currentLoopData = $catData['post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($translate == 'en'){ $cat_id = $post->blog_cat_id; } else { $cat_id = $post->blog_page_parent; } ?>
                      <li>
                      <a href="<?php echo e(URL::to('/blog')); ?>/category/<?php echo e($cat_id); ?>/<?php echo e($post->blog_category_slug); ?>" class="ash-color">
                       <span class="fa fa-angle-right"></span> <?php echo e($post->blog_category_name); ?>

                       <span class="post-count">[<?php echo e($category_count->has($cat_id) ? count($category_count[$cat_id]) : 0); ?>]</span>
                      </a>
                     </li>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                  </ul>
                </div>
                
              </div>
            </div>
          </div>
         <!-- Side Widget -->
         <div class="card shadow-sm bg-white border-0 mb-5 rounded-0">
          <h5 class="card-header bg-white link-color"><?php echo e(Helper::translation(1980,$translate)); ?></h5>
              <div class="items-bordered-wrap">
                  <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                    <?php $__currentLoopData = $blogPost['latest']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <ul class="media-list">
                      <li class="media mb-4 mt-2 no-gutters">
                            <div class="col-md-5 full-width-image mr-2">
                            <a href="<?php echo e(URL::to('/single')); ?>/<?php echo e($post->post_slug); ?>" title="<?php echo e($post->post_title); ?>">
                            <?php if($post->post_media_type =='image'): ?>
                            <?php if($post->post_image!=''): ?>
                            <img src="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($post->post_image); ?>" alt="<?php echo e($post->post_title); ?>" class="mx-auto d-block img-sm">
                            <?php else: ?>
                            <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($post->post_title); ?>" class="img-sm">
                            <?php endif; ?>
                            <?php else: ?>
                            <?php 
                            $link = $post->post_video;
                            $video_id = explode("?v=", $link);
                            $video_id = $video_id[1];
                            ?>
                            <img src="https://img.youtube.com/vi/<?php echo e($video_id); ?>/mqdefault.jpg" alt="<?php echo e($post->post_title); ?>" class="mx-auto d-block img-sm">
                            <?php endif; ?>
                            </a>
                            </div>
                            <div class="col-md-7">
                                <a href="<?php echo e(URL::to('/single')); ?>/<?php echo e($post->post_slug); ?>" class="link-color fs15"><?php echo e($post->post_title); ?></a>
                                <div class="ash-color">
                                <small>
                                    <i class="fa fa-clock"></i> <?php echo e(date('d M Y', strtotime($post->post_date))); ?>

                                </small>
                                </div> 
                            </div>
                        </li>
                   </ul>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                   </div>
                   </div>
                   </div>
                </div>
            </div>
            <?php if($allsettings->blog_ads == 1): ?>
                 <?php if($allsettings->blog_sidebar_ads !=''): ?>
                 <div class="row">
                        <div class="col-lg-12" align="center">
                          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <?php echo html_entity_decode($allsettings->blog_sidebar_ads); ?>
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                 </div> 
                 <?php endif; ?>      
                 <?php endif; ?>
         </div>
      </div>
      <?php if($allsettings->blog_ads == 1): ?>
      <?php if($allsettings->blog_bottom_ads !=''): ?>
         <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-2" align="center">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <?php echo html_entity_decode($allsettings->blog_bottom_ads); ?>
                    <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
       </script>
      </div>
      </div>
      <?php endif; ?> 
      <?php endif; ?>
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/blog.blade.php ENDPATH**/ ?>