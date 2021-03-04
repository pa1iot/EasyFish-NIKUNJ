<footer class="section-footer pt-3 pb-2 mt-3" id="footer">
	<div class="container pt-3 pb-3">
		<section class="footer-top padding-top">
			<div class="row">
				<aside class="col-sm-3 col-md-3 white">
					<h5 class="title"><?php echo e(Helper::translation(2022,$translate)); ?></h5>
					<div class="footer-box-info">
						    <ul>
                               <?php if($allsettings->facebook_url != ''): ?>
                                <li>
                                    <a href="<?php echo e($allsettings->facebook_url); ?>" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if($allsettings->twitter_url != ''): ?>
                                <li>
                                    <a href="<?php echo e($allsettings->twitter_url); ?>" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if($allsettings->gplus_url != ''): ?>
                                <li>
                                    <a href="<?php echo e($allsettings->gplus_url); ?>" target="_blank">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if($allsettings->pinterest_url != ''): ?>
                                <li>
                                    <a href="<?php echo e($allsettings->pinterest_url); ?>" target="_blank">
                                        <i class="fa fa-pinterest"></i>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if($allsettings->instagram_url != ''): ?>
                                <li>
                                    <a href="<?php echo e($allsettings->instagram_url); ?>" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
						</div>
                </aside>
				<aside class="col-sm-3  col-md-3 white">
					<h5 class="title"><?php echo e(Helper::translation(2023,$translate)); ?></h5>
					<ul class="list-unstyled">
                        <?php if($allsettings->site_blog_display == 1): ?>
						<li> <a href="<?php echo e(URL::to('/blog')); ?>"> <?php echo e(Helper::translation(1978,$translate)); ?> </a></li>
                        <?php endif; ?>
						<li> <a href="<?php echo e(URL::to('/register')); ?>"> <?php echo e(Helper::translation(2024,$translate)); ?> </a></li>
                        <?php if(Auth::guest()): ?>
                        <li> <a href="<?php echo e(URL::to('/my-profile')); ?>"> <?php echo e(Helper::translation(2025,$translate)); ?> </a></li>
                        <?php else: ?>
                        <?php if(Auth::user()->user_type == 'admin'): ?>
                        <li> <a href="<?php echo e(URL::to('/admin/edit-profile')); ?>"> <?php echo e(Helper::translation(2025,$translate)); ?> </a></li>
                        <?php else: ?>
						<li> <a href="<?php echo e(URL::to('/my-profile')); ?>"> <?php echo e(Helper::translation(2025,$translate)); ?> </a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <li><a href="<?php echo e(URL::to('/featured-products')); ?>"><?php echo e(Helper::translation(3060,$translate)); ?> <?php echo e(Helper::translation(1975,$translate)); ?></a></li>
                        <li> <a href="<?php echo e(URL::to('/my-orders')); ?>"> <?php echo e(Helper::translation(2026,$translate)); ?> </a></li>
						<li> <a href="<?php echo e(URL::to('/wishlist')); ?>"> <?php echo e(Helper::translation(2027,$translate)); ?> </a></li>
					</ul>
				</aside>
				<aside class="col-sm-3  col-md-3 white">
					<h5 class="title"><?php echo e(Helper::translation(2028,$translate)); ?></h5>
					<ul class="list-unstyled">
                        <?php $__currentLoopData = $footerpages['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li> <a href="<?php echo e(URL::to('/page/')); ?>/<?php echo e($pages->page_slug); ?>"> <?php echo e($pages->page_title); ?> </a></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li> <a href="<?php echo e(URL::to('/contact')); ?>"> <?php echo e(Helper::translation(2012,$translate)); ?> </a></li>
					</ul>
				</aside>
                <?php if($allsettings->site_newsletter_display == 1): ?>
				<aside class="col-sm-3">
					<article class="white">
						<h5 class="title"><?php echo e(Helper::translation(2029,$translate)); ?></h5>
						<p class="pb-2"><?php echo e(Helper::translation(2940,$translate)); ?></p>
                        <div>
                        <?php if($message = Session::get('news-success')): ?>
                        <div class="alert alert-success" role="alert">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="fa fa-close close" aria-hidden="true"></span></a>
                           <?php echo e($message); ?>

                        </div>
                        <?php endif; ?>
                        <?php if($message = Session::get('news-error')): ?>
                        <div class="alert alert-danger" role="alert">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="fa fa-close close" aria-hidden="true"></span></a>
                              <?php echo e($message); ?>

                        </div>
                       <?php endif; ?> 
                     </div>
                     <form action="<?php echo e(route('newsletter')); ?>" id="footer_form" method="post" class="row-sm form-noborder" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="col-md-8 padding-off float-left">
                        <input class="form-control rounded-0" placeholder="<?php echo e(Helper::translation(2030,$translate)); ?>" type="text" name="news_email" data-bvalidator="required,email">
                        </div>
                        <div class="col-md-4 padding-off float-left">
                        <button type="submit" class="btn btn-block button-color rounded-0"><?php echo e(Helper::translation(2031,$translate)); ?> </button>
                        </div>
                     </form>
					</article>
				</aside>
                <?php endif; ?>
			</div> <!-- row.// -->
			<br> 
		</section>
	</div><!-- //container -->
</footer>
<div class="copyright">
   <div class="container pt-4">
      <div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12"> 
				<p class="text-white"><?php echo e(Helper::translation(2958,$translate)); ?> <?php echo e($allsettings->site_title); ?></p>
			</div>
            <?php if($allsettings->site_footer_payment != ''): ?>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<p class="text-md-right text-white-50">
	               <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_footer_payment); ?>" alt="<?php echo e($allsettings->site_title); ?>" class="payment-icon">
				</p>
			</div>
           <?php endif; ?>
       </div>
    </div>      
</div>
<?php if($allsettings->cookie_popup == 1): ?>
<div class="alert text-center cookiealert" role="alert">
    <?php echo e(Helper::translation(2952,$translate)); ?>

    <button type="button" class="btn button-color btn-sm acceptcookies" aria-label="Close">
        <?php echo e(Helper::translation(2955,$translate)); ?>

    </button>
</div>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/footer.blade.php ENDPATH**/ ?>