<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php if($allsettings->site_blog_display == 1): ?> <?php echo e($edit['post']->post_title); ?> <?php else: ?> <?php echo e(Helper::translation(1912,$translate)); ?> <?php endif; ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if($allsettings->site_blog_display == 1): ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(1978,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(1978,$translate)); ?></span> <span class="split">&gt;</span> <span><?php echo e($edit['post']->post_title); ?></span></p>
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
        <!-- Blog Entries Column -->
        <div class="col-md-9">
          <!-- Blog Post -->
         <div class="card mb-5 shadow-sm bg-white border-0 rounded-0 blog-post-loop li-item">
           <?php if($edit['post']->post_media_type =='image'): ?>
           <?php if($edit['post']->post_image!=''): ?>
            <img src="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" alt="<?php echo e($edit['post']->post_title); ?>" class="card-img-top blog-img-lg rounded-0">
            <?php else: ?>
            <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($edit['post']->post_title); ?>" class="card-img-top rounded-0 blog-img-lg">
            <?php endif; ?>
            <?php endif; ?>
            <?php if($edit['post']->post_media_type =='video'): ?>
            <?php 
            $link = $edit['post']->post_video;
            $video_id = explode("?v=", $link);
            $video_id = $video_id[1];
            ?>
            <iframe type="text/html" width="100%" height="500px" src="https://www.youtube.com/embed/<?php echo e($video_id); ?>?showinfo=0&rel=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe> 
            <?php endif; ?>
            <?php
            $date = date('d', strtotime($edit['post']->post_date));
            $month = date('M', strtotime($edit['post']->post_date));
            $year = date('Y', strtotime($edit['post']->post_date));
            ?>
            <div class="post-date"> <span class="post-date-day"><i class="fa fa-calendar"></i> <?php echo e($date); ?> <?php echo e($month); ?> <?php echo e($year); ?></span></div>
            <div class="card-body">
              <h3 class="card-title"><a href="<?php echo e(URL::to('/single')); ?>/<?php echo e($edit['post']->post_slug); ?>" class="link-color"><?php echo e($edit['post']->post_title); ?></a></h3>
              <div class="blog-meta">
                        <div class="blog-icon-view">
                        <p><a href="<?php echo e(URL::to('/blog')); ?>/category/<?php echo e($edit['post']->blog_cat_id); ?>/<?php echo e($edit['post']->blog_category_slug); ?>">
                        <i class="fa fa-list-alt"></i> <?php echo e($edit['post']->blog_category_name); ?>

                        </a></p>
                        <p class="comment"><i class="fa fa-comments"></i> <?php echo e($count); ?></p>
                        <p class="view"><i class="fa fa-eye"></i> <?php echo e($edit['post']->post_view); ?></p>
                        </div>
              </div>
              <div class="single-blog-content">
                                <div>
                                <?php echo html_entity_decode($edit['post']->post_desc); ?>
                                </div>
                                <div class="share mt-3 pt-3">
                                <p class="font-weight-bold"><?php echo e(Helper::translation(2168,$translate)); ?> :
                                <?php $__currentLoopData = $post_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tags): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(url('/blog')); ?>/blog/<?php echo e(strtolower(str_replace(' ','-',$tags))); ?>" class="fs13 tag-btn"><?php echo e($tags); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                                </div>
                                <div class="share mt-3 pt-3">
                                    <p class="font-weight-bold"><?php echo e(Helper::translation(2169,$translate)); ?></p>
                                        <div class="footer-box-info">
                                            <ul class="social-icons">
                                                <li>
                                                    <a class="share-button" data-share-url="<?php echo e(URL::to('/single')); ?>/<?php echo e($edit['post']->post_slug); ?>" data-share-network="facebook" data-share-text="<?php echo e($edit['post']->post_short_desc); ?>" data-share-title="<?php echo e($edit['post']->post_title); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" href="javascript:void(0)"><i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="share-button" data-share-url="<?php echo e(URL::to('/single')); ?>/<?php echo e($edit['post']->post_slug); ?>" data-share-network="twitter" data-share-text="<?php echo e($edit['post']->post_short_desc); ?>" data-share-title="<?php echo e($edit['post']->post_title); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" href="javascript:void(0)"><i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="share-button" data-share-url="<?php echo e(URL::to('/single')); ?>/<?php echo e($edit['post']->post_slug); ?>" data-share-network="googleplus" data-share-text="<?php echo e($edit['post']->post_short_desc); ?>" data-share-title="<?php echo e($edit['post']->post_title); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" href="javascript:void(0)"><i class="fa fa-google-plus"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="share-button" data-share-url="<?php echo e(URL::to('/single')); ?>/<?php echo e($edit['post']->post_slug); ?>" data-share-network="linkedin" data-share-text="<?php echo e($edit['post']->post_short_desc); ?>" data-share-title="<?php echo e($edit['post']->post_title); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/post/<?php echo e($edit['post']->post_image); ?>" href="javascript:void(0)"><i class="fa fa-linkedin"></i>
                                                    </a>
                                                </li>
                                                                                                
                                            </ul>
                                        </div>
                                        <!-- end social_share -->
                                 </div>
                            </div>
            </div>
          </div>
         <div>
         <?php if($message = Session::get('success')): ?>
         <div class="alert alert-success" role="alert">
            <span class="alert_icon lnr lnr-checkmark-circle"></span>
              <?php echo e($message); ?>

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="fa fa-window-close"></i>
              </button>
         </div>
        <?php endif; ?>
        <?php if($message = Session::get('error')): ?>
        <div class="alert alert-danger" role="alert">
           <span class="alert_icon lnr lnr-warning"></span>
             <?php echo e($message); ?>

             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <i class="fa fa-window-close"></i>
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
        <i class="fas fa-window-close"></i>
        </button>
        </div>
        <?php endif; ?>
        </div>
        <?php if(Auth::guest()): ?>
          <div class="mb-5"> 
             <h5><?php echo e(Helper::translation(2170,$translate)); ?> <a href="<?php echo e(URL::to('/login')); ?>" class="theme-color"><?php echo e(Helper::translation(2173,$translate)); ?></a> <?php echo e(Helper::translation(2171,$translate)); ?></h5>
          </div>      
          <?php endif; ?>
          <div class="card mb-5 shadow-sm bg-white border-0 rounded-0"> 
          <div class="comments">
          <?php if(Auth::check()): ?>
          <div class="container mt-3 mb-3">
          <div class="row">
		  <div class="col-md-1">
				<?php if(Auth::user()->user_photo != ''): ?>
				<div class="avatar"><img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e(Auth::user()->user_photo); ?>" /></div>
                <?php else: ?>
                <div class="avatar"><img src="<?php echo e(url('/')); ?>/public/img/no-user.png" /></div>
                <?php endif; ?>
		  </div>
		  <div class="col-md-11">
			<form class="cmnt_reply_form" action="<?php echo e(route('single')); ?>" id="comment_form" method="post">
                <?php echo e(csrf_field()); ?>

				<textarea name="comment_content" id="" rows="3" placeholder="<?php echo e(Helper::translation(2172,$translate)); ?>" class="d-block form-control" data-bvalidator="required"></textarea>
                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                <input type="hidden" name="post_id" value="<?php echo e($edit['post']->post_id); ?>">
                <input type="submit" name="submit" class="btn button-color mt-1" value="Submit">
			</form>
		  </div>
		</div>
        </div>
        <?php endif; ?>
        <?php if($count != 0): ?>
        <?php $no = 1; ?>
        <?php $__currentLoopData = $comment['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="container mt-5 mb-5">
		<div class="row">
				<div class="col-md-1">
                        <?php if($comment->user_photo != ''): ?>
						<div class="avatar"><img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($comment->user_photo); ?>" /></div>
                        <?php else: ?>
                        <div class="avatar"><img src="<?php echo e(url('/')); ?>/public/img/no-user.png" /></div>
                        <?php endif; ?>
				</div>
				<div class="col-md-11">
                        <h5><?php echo e($comment->name); ?></h5>
						<p class="comment-text"><?php echo e($comment->comment_content); ?></p>
						<div class="bottom-comment">
								<div class="ash-color fs12"><i class="fa fa-calendar"></i> <?php echo e(date('d M Y', strtotime($comment->comment_date))); ?></div>
						</div>
				</div>
		</div>
        </div>
        <?php $no++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
</div>
</div>
</div>
<!-- Sidebar Widgets Column -->
        <div class="col-md-3">
          <div class="card shadow-sm bg-white border-0 mb-5 rounded-0 categorylist">
            <h5 class="card-header bg-white"><?php echo e(Helper::translation(1932,$translate)); ?></h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                    <?php $__currentLoopData = $catData['post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($translate == 'en'){ $cat_id = $post->blog_cat_id; } else { $cat_id = $post->blog_page_parent; } ?>
                      <li><a href="<?php echo e(URL::to('/blog')); ?>/category/<?php echo e($cat_id); ?>/<?php echo e($post->blog_category_slug); ?>" class="ash-color">
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
          <h5 class="card-header bg-white"><?php echo e(Helper::translation(1980,$translate)); ?></h5>
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/single.blade.php ENDPATH**/ ?>