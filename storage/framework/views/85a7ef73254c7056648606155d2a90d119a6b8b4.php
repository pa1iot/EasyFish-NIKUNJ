<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Conversation - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0">Conversation with <?php echo e($user_details->username); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span>Conversation</span></p>
      </div>
    </section>
   <main role="main">
      <div class="container page-white-box mt-3">
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
         <div class="row">
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1">
         	    <div class="container emp-profile">
                  <div class="row">
                    <div class="col-md-3 white-bg">
                        <div class="profile-img">
                        <a href="<?php echo e(url('/')); ?>/user/<?php echo e($user_details->username); ?>" title="<?php echo e($user_details->name); ?>">
                        <?php if($user_details->user_photo != ""): ?>
                        <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($user_details->user_photo); ?>" alt="" class="rounded">
                        <?php else: ?>
                        <img src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="" class="rounded">
                        <?php endif; ?>
                        </a>   
                        </div>
                        <div align="center">
                            <div class="info mt-2">
                        <div class="title">
                            <a href="<?php echo e(url('/')); ?>/user/<?php echo e($user_details->username); ?>" title="<?php echo e($user_details->name); ?>" class="theme-color"><?php echo e($user_details->username); ?></a>
                        </div>
                        <div class="desc">
                        <?php if($user_details->verified == 1): ?>
                        <i class="fa fa-check-circle green" aria-hidden="true"></i> Verified
                        <?php else: ?>
                        <i class="fa fa-times-circle-o red" aria-hidden="true"></i> Unverified
                        <?php endif; ?>
                        </div>
                        <div align="center" class="mt-3">
                        <a href="<?php echo e(url('/my-purchase-details')); ?>/<?php echo e($order_details->purchase_token); ?>" class="btn btn-danger btn-sm">&lt; <?php echo e(Helper::translation(2088,$translate)); ?></a>
                        <a href="<?php echo e(url('/')); ?>/user/<?php echo e($user_details->username); ?>" title="<?php echo e($user_details->name); ?>" class="btn button-color btn-sm">View Profile</a>
                        </div>
                        </div>
                        </div>
                        
                        <div class="mt-5 mb-3">
                         <h4 class="mb-3">Order Details</h4>
                         <label><strong><?php echo e(Helper::translation(2076,$translate)); ?> : </strong> <?php echo e($ord_id); ?></label><br>
                         <label><strong><?php echo e(Helper::translation(1984,$translate)); ?> : </strong> <a href="<?php echo e(url('/product')); ?>/<?php echo e($order_details->product_slug); ?>"><?php echo e($order_details->product_name); ?></a></label><br>
                         <label><strong><?php echo e(Helper::translation(2078,$translate)); ?> : </strong> <?php echo e($order_details->quantity); ?> X <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order_details->price); ?></label><br>
                         <?php if($order_details->product_attribute_values != ""): ?>
                         <label><strong><?php echo e(Helper::translation(2079,$translate)); ?> : </strong> <?php echo e($order_details->product_attribute_values); ?></label><br>
                         <?php endif; ?>
                        </div>
                        </div> 
                        
                        <div class="col-md-9 ash-bg">
                        <div class="comments">
		<div class="comment-wrap">
				<div class="photo">
						<div class="avatar" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/users/<?php echo e(Auth::user()->user_photo); ?>')"></div>
				</div>
				<div class="comment-block">
						<form method="POST" action="<?php echo e(route('conversation')); ?>" id="conversation_form"  enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
								<textarea name="conver_text" id="" cols="30" rows="3" placeholder="Type your message..." data-bvalidator="required"></textarea>
                                
                                <input type="hidden" name="conver_user_id" value="<?php echo e(Auth::user()->id); ?>">
                                <input type="hidden" name="conver_seller_id" value="<?php echo e($user_details->id); ?>">
                                <input type="hidden" name="conver_order_id" value="<?php echo e($order_id); ?>">
                                <input type="hidden" name="conver_url" value="<?php echo e(url('/conversation')); ?>">
                                <input type="submit" value="Send" class="btn button-color btn-sm px-4 py-2"> 
						</form>
				</div>
		</div>
        <div id="listShow">
        <?php $__currentLoopData = $chat['message']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="comment-wrap li-item">
				<div class="photo">
                        
						<div class="avatar" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($chat->user_photo); ?>')"></div>
				</div>
				<div class="comment-block">
						<p class="comment-text"><?php echo e($chat->conver_text); ?></p>
						<div class="bottom-comment">
								<div class="comment-date"><?php echo e($chat->conver_date); ?></div>
								<?php if($chat->conver_user_id == Auth::user()->id): ?>
                                <ul class="comment-actions">
										
										<li class="reply"><a href="<?php echo e(url('/conversation')); ?>/<?php echo e(base64_encode($chat->conver_id)); ?>" onClick="return confirm('Are you sure you want to delete?');"><span class="icon-delete"></span> Delete</a></li>
								</ul>
                                <?php endif; ?>
						</div>
				</div>
		</div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="row mt-9" align="center">
              <div class="turn-page" id="pager"></div>
         </div>
         </div>
         </div>
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/conversation.blade.php ENDPATH**/ ?>