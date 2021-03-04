<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e($shop->product_name); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($shop->product_allow_seo == 1): ?>
<meta name="description" content="<?php echo e($shop->product_seo_desc); ?>">
<meta name="keywords" content="<?php echo e($shop->product_seo_keyword); ?>">
<?php else: ?>
<meta name="description" content="<?php echo e($allsettings->site_desc); ?>">
<meta name="keywords" content="<?php echo e($allsettings->site_keywords); ?>">
<?php endif; ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e($shop->product_name); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <a href="<?php echo e(URL::to('/shop')); ?>"><?php echo e(Helper::translation(2040,$translate)); ?></a> <span class="split">&gt;</span><span> <?php echo e($shop->product_name); ?></span></p>
      </div>
    </section>
<main role="main">
      <div class="container">
      <?php if($allsettings->shop_ads == 1): ?>
      <?php if($allsettings->shop_top_ads !=''): ?>
         <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-2" align="center">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <?php echo html_entity_decode($allsettings->shop_top_ads); ?>
                    <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
       </script>
      </div>
      </div>
      <?php endif; ?> 
      <?php endif; ?>
	  <div class="row bg-white border-0 mt-3 mb-3">
      <div class="col-md-12 mt-3">
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
          <div class="col-md-6 mt-3 mb-3" id="slider">
           <div class="item">            
              <div class="clearfix">
                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                    <?php if($shop->product_image != ""): ?>
                    <li data-thumb="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($shop->product_image); ?>"> 
                        <a href="">
                        <img src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($shop->product_image); ?>" />
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php $imagecount = count($shop->productimages); ?>
                    <?php if($imagecount != 0): ?>
                    <?php $__currentLoopData = $shop->productimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li data-thumb="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($images->product_image); ?>">
                        <a href=""> 
                        <img src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($images->product_image); ?>" />
                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </div>
           </div>
         </div>
		<div class="col-md-6 mt-3 mb-3">
        <form action="<?php echo e(route('cart')); ?>" class="cart_form" id="cart_form" method="post" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

          <h3><?php echo e($shop->product_name); ?></h3>
            <span class="stars-active" style="width:88%">
                <?php if($getreview == 0): ?>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php else: ?>
                <?php if($count_rating == 0): ?>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php endif; ?>
                <?php if($count_rating == 1): ?>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php endif; ?>
                <?php if($count_rating == 2): ?>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php endif; ?>
                <?php if($count_rating == 3): ?>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php endif; ?>
                <?php if($count_rating == 4): ?>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php endif; ?>
                <?php if($count_rating == 5): ?>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <?php endif; ?>
                <?php endif; ?>
                <span>( <?php echo e($getreview); ?> <?php echo e(Helper::translation(2144,$translate).' )'); ?></span>
            </span>
            <?php if($shop->product_sku != ""): ?><div class="mt-2"><?php echo e(Helper::translation(1929,$translate)); ?> : <span><?php echo e($shop->product_sku); ?></span></div><?php endif; ?>
            <?php if($shop->product_type != 'digital'): ?>
            <div class="mt-2"><?php echo e(Helper::translation(2062,$translate)); ?> : <?php if($shop->product_stock != 0): ?><span class="theme-color"><?php echo e(Helper::translation(2063,$translate)); ?> (<?php echo e($shop->product_stock); ?>)</span><?php else: ?><span class="red-color"><?php echo e(Helper::translation(2064,$translate)); ?> (<?php echo e($shop->product_stock); ?>)</span><?php endif; ?></div>
            <?php endif; ?>
            <?php if($shop->product_condition == 'new'){ $badg = "badge badge-warning"; } else { $badg = "badge badge-secondary"; } ?>
            <?php if($shop->product_condition != ""): ?><div class="mt-2"><?php echo e(Helper::translation(1950,$translate)); ?> : <span class="<?php echo e($badg); ?>"><?php echo e($shop->product_condition); ?></span></div><?php endif; ?>
            <?php if($shop->product_brand != ""): ?><div class="mt-2"><?php echo e(Helper::translation(1947,$translate)); ?> : <span class="badge badge-info"><?php echo e($shop->brand_name); ?></span></div><?php endif; ?>
            
            <?php if($shop->product_type != 'digital'): ?>
            <?php $attri_value = 0; ?>
            <?php if(!empty($shop->product_attribute)): ?>
            <?php $product_attr = explode(',',$shop->product_attribute); ?>
            <?php if(count($attributer['display']) != 0): ?>
            <?php $__currentLoopData = $attributer['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $i = 1; ?>
            <?php $__currentLoopData = $attribute->attributeagain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(in_array($product_value->attribute_value_id,$product_attr)): ?>
            <?php if($i == 1): ?>
            <?php $attri_value += $product_value->attribute_value_price; ?>
            <?php endif; ?>
            <?php $i++; ?>        
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <?php $attri_value = 0; ?>
            <?php endif; ?>
            <?php else: ?>
            <?php $attri_value = 0; ?>
            <?php endif; ?>
            <?php else: ?>
            <?php $attri_value = 0; ?>
            <?php endif; ?>
            <?php /*?><div class="mt-5" id="start">
            @if($shop->product_price != 0)<span @if($shop->product_offer_price != 0) class="fs16 offer-price red-color" @else class="fs32 display_result" @endif>{{ $allsettings->site_currency_symbol }}{{ $shop->product_price+$attri_value }}</span>@endif @if($shop->product_offer_price != 0)<span class="fs32 display_result">{{ $allsettings->site_currency_symbol }}{{ $shop->product_offer_price+$attri_value }}</span>@endif</div><?php */?> 
            <div class="mt-5" id="start">
            <?php if($shop->product_offer_price != 0): ?><span class="fs32 display_result"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($shop->product_offer_price); ?></span><?php else: ?><span class="fs32 display_result"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($shop->product_price); ?></span><?php endif; ?></div>     
            <?php if(!empty($shop->product_offer_price)): ?>
            <input type="hidden" name="foo" id="foo" data-price-effect="<?php echo e($shop->product_offer_price); ?>" />
            <?php else: ?>
            <input type="hidden" name="foo" id="foo" data-price-effect="<?php echo e($shop->product_price); ?>" />
            <?php endif; ?>
            <?php if($shop->flash_deals == 1): ?>
             <div class="single-details">
             <ul class="countdown-<?php echo e($shop->product_token); ?>" id="countdown-timer">
                                                <li>
                                                    <span class="days">00</span>
                                                    <p class="days_ref"><?php echo e(Helper::translation(2071,$translate)); ?></p>
                                                </li>
                                                <li>
                                                    <span class="hours">00</span>
                                                    <p class="hours_ref"><?php echo e(Helper::translation(2072,$translate)); ?></p>
                                                </li>
                                                <li>
                                                    <span class="minutes">00</span>
                                                    <p class="minutes_ref"><?php echo e(Helper::translation(2073,$translate)); ?></p>
                                                </li>
                                                <li>
                                                    <span class="seconds last">00</span>
                                                    <p class="seconds_ref"><?php echo e(Helper::translation(2074,$translate)); ?></p>
                                                </li>
                                            </ul>
                                            </div>
                                            <?php endif; ?>
                                         <div class="qty mt-5 mb-5">
                                         <?php if($shop->product_type != 'digital'): ?>
                                           <span>
                                              <label><?php echo e(Helper::translation(2145,$translate)); ?></label>
                                              <input type="number" name="qty" class="form-control qty_box" id="qty" min="1" data-bvalidator="required,min[1],max[<?php echo e($shop->product_stock); ?>]" value="1">
                                           </span>
                                          <?php else: ?>
                                          <input type="hidden" name="qty" value="1">
                                          <?php endif; ?> 
                                           <?php if($shop->product_type != 'digital'): ?>
                                           <?php $product_attr = explode(',',$shop->product_attribute); ?>
                                           <?php if(count($attributer['display']) != 0): ?>
                                           <?php $__currentLoopData = $attributer['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <span>
                                              <label><?php echo e($attribute->attribute_name); ?></label>
                                              <select name="product_attribute[]" class="form-control qty_box attri_box" required>
                                                 <option value="" data-price-effect="0"></option>
                                                 <?php $__currentLoopData = $attribute->attributeagain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <?php if(in_array($product_value->attribute_value_id,$product_attr)): ?>
                                                 <option value="<?php echo e($product_value->attribute_value_id); ?>_<?php echo e($attribute->attribute_name); ?> - <?php echo e($product_value->attribute_value); ?>" data-price-effect="<?php echo e($product_value->attribute_value_price); ?>"><?php echo e($product_value->attribute_value); ?></option><?php endif; ?>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             </select>
                                           </span>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                           <?php endif; ?>
                                           <?php endif; ?>
                                          </div>
              <div class="mt-2"><?php echo e(Helper::translation(1987,$translate)); ?> : <span><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($seller->username); ?>" class="theme-color"><?php echo e($seller->name); ?></a></span></div> 
              <?php if($shop->product_type != 'digital'): ?><div class="mt-2"><?php echo e(Helper::translation(2094,$translate)); ?> : <span><?php echo e($shop->product_estimate_time); ?> <?php echo e(Helper::translation(2071,$translate)); ?></span></div><?php endif; ?>
              <?php if(Auth::guest()): ?>
              <div class="mt-3">
              <?php if($shop->product_video_url != ''): ?>
              <a class="bla-2 btn btn-danger float-left mr-1" href="<?php echo e($shop->product_video_url); ?>"><i class="fa fa-file-video-o"></i> <?php echo e(Helper::translation(2147,$translate)); ?></a>
              <?php endif; ?>
              <a href="<?php echo e(URL::to('/login')); ?>" class="btn button-color float-left"><?php echo e(Helper::translation(2067,$translate)); ?></a> 
              </div>
              <?php else: ?>
              <?php if($shop->product_stock != 0): ?>
              <?php if($shop->user_id != Auth::user()->id): ?>
              <?php if($shop->product_type != 'external'): ?>
              <div class="mt-3">
              <?php if($shop->product_video_url != ''): ?>
              <a class="bla-2 btn btn-danger float-left mr-1" href="<?php echo e($shop->product_video_url); ?>"><i class="fa fa-file-video-o"></i> <?php echo e(Helper::translation(2147,$translate)); ?></a>
              <?php endif; ?>
              <button type="submit" class="btn button-color float-left"><?php echo e(Helper::translation(2067,$translate)); ?></button>
              </div>
              <?php else: ?>
              <div class="mt-3">
              <?php if($shop->product_video_url != ''): ?>
              <a class="bla-2 btn btn-danger float-left mr-1" href="<?php echo e($shop->product_video_url); ?>"><i class="fa fa-file-video-o"></i> <?php echo e(Helper::translation(2147,$translate)); ?></a>
              <?php endif; ?>
              <a href="<?php echo e($shop->product_external_url); ?>" class="btn button-color float-left" target="_blank"><?php echo e(Helper::translation(2148,$translate)); ?></a>
              </div>
              <?php endif; ?>
              <?php else: ?>
              <div class="mt-3">
              <?php if($shop->product_video_url != ''): ?>
              <a class="bla-2 btn btn-danger float-left mr-1" href="<?php echo e($shop->product_video_url); ?>"><i class="fa fa-file-video-o"></i> <?php echo e(Helper::translation(2147,$translate)); ?></a>
              <?php endif; ?>
              <a href="<?php echo e(URL::to('/edit-product')); ?>/<?php echo e($shop->product_token); ?>" class="btn button-color float-left"><?php echo e(Helper::translation(2149,$translate)); ?></a> 
              </div>
              <?php endif; ?>
              <?php endif; ?>
              <?php endif; ?>
              <input type="hidden" name="product_token" value="<?php echo e($shop->product_token); ?>">
              <input type="hidden" name="product_id" value="<?php echo e($shop->product_id); ?>">
              <?php if(!empty($shop->product_offer_price)): ?>
              <input type="hidden" name="price" id="price" value="<?php echo e(base64_encode($shop->product_offer_price+$attri_value)); ?>">
              <?php else: ?>
              <input type="hidden" name="price" id="price" value="<?php echo e(base64_encode($shop->product_price+$attri_value)); ?>">
              <?php endif; ?>
              <input type="hidden" name="product_user_id" value="<?php echo e($shop->user_id); ?>">
              <input type="hidden" name="product_stock" value="<?php echo e($shop->product_stock); ?>">
             </form>
             <div class="footer-box-info mt-3 mb-3 pt-3 pb-3 clearfix">
                <p class="font-weight-bold"><?php echo e(Helper::translation(2150,$translate)); ?> : </p>
                <ul class="social-icons">
                    <li>
                    <a class="share-button" data-share-url="<?php echo e(URL::to('/product')); ?>/<?php echo e($shop->product_slug); ?>" data-share-network="facebook" data-share-text="<?php echo e($shop->product_short_desc); ?>" data-share-title="<?php echo e($shop->product_name); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($shop->product_image); ?>" href="javascript:void(0)">
                    <i class="fa fa-facebook"></i>
                    </a>
                    </li>
                    <li>
                    <a class="share-button" data-share-url="<?php echo e(URL::to('/product')); ?>/<?php echo e($shop->product_slug); ?>" data-share-network="twitter" data-share-text="<?php echo e($shop->product_short_desc); ?>" data-share-title="<?php echo e($shop->product_name); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($shop->product_image); ?>" href="javascript:void(0)">
                     <i class="fa fa-twitter"></i>
                    </a>
                    </li>
                    <li>
                    <a class="share-button" data-share-url="<?php echo e(URL::to('/product')); ?>/<?php echo e($shop->product_slug); ?>" data-share-network="googleplus" data-share-text="<?php echo e($shop->product_short_desc); ?>" data-share-title="<?php echo e($shop->product_name); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($shop->product_image); ?>" href="javascript:void(0)">
                    <i class="fa fa-google-plus"></i>
                    </a>
                    </li>
                    <li>
                    <a class="share-button" data-share-url="<?php echo e(URL::to('/product')); ?>/<?php echo e($shop->product_slug); ?>" data-share-network="linkedin" data-share-text="<?php echo e($shop->product_short_desc); ?>" data-share-title="<?php echo e($shop->product_name); ?>" data-share-via="<?php echo e($allsettings->site_title); ?>" data-share-tags="" data-share-media="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($shop->product_image); ?>" href="javascript:void(0)">
                    <i class="fa fa-linkedin"></i>
                    </a>
                    </li>
                 </ul>
              </div>
		</div>
        <div class="col-md-12 mb-5">
        <div class="card mt-3 tab-card">
        <div class="card-header tab-card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true"><?php echo e(Helper::translation(1931,$translate)); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false"><?php echo e(Helper::translation(2151,$translate)); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false"><?php echo e(Helper::translation(1939,$translate)); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab" aria-controls="Four" aria-selected="false"><?php echo e(Helper::translation(1948,$translate)); ?></a>
            </li>
          </ul>
        </div>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
            <?php echo html_entity_decode($shop->product_desc); ?>
          </div>
          <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
          <?php $__currentLoopData = $getreviewdata['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="container mt-2 mb-2">
		    <div class="row">
				<div class="col-md-1">
                        <div class="avatar">
                        <a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($rating->username); ?>">
                        <?php if($rating->user_photo!=''): ?>
                        <img  src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e($rating->user_photo); ?>" alt="<?php echo e($rating->username); ?>" class="media-object">
                        <?php else: ?>
                        <img src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e($rating->username); ?>" class="media-object">
                        <?php endif; ?>
                        </a>
                        </div>
                </div>
				<div class="col-md-11">
                        <a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($rating->username); ?>" class="review-user">
                        <?php echo e($rating->username); ?>

                        </a>
						<p class="comment-text"><?php echo e($rating->review); ?></p>
						<p>
						   <?php if($rating->rating == 0): ?>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php if($rating->rating == 1): ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php if($rating->rating == 2): ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php if($rating->rating == 3): ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php if($rating->rating == 4): ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php if($rating->rating == 5): ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <?php endif; ?>
                        </p>
				</div>
		</div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                 
          </div>
          <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
          <?php $__currentLoopData = $product_tag; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tags): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($tags)): ?>
            <a href="<?php echo e(url('/shop')); ?>/<?php echo e(strtolower(str_replace(' ','-',$tags))); ?>" class="fs13 tag-btn"><?php echo e($tags); ?></a>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </div>
           <div class="tab-pane fade p-3" id="four" role="tabpanel" aria-labelledby="four-tab">
            <p><?php echo nl2br($shop->product_return_policy); ?></p>
           </div>
        </div>
      </div>
    </div>
    <?php if(count($another['product']) != 0): ?> 
    <div class="col-md-12 mb-5">
        <h4 class="black mb-2 pb-2 text-center"><?php echo e(Helper::translation(2152,$translate)); ?></h4>
                            <div class="row mt-3 pt-3" align="center">
                            <?php $z = 1; ?>
                              <?php $__currentLoopData = $another['product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-2 pb-2">
                                   <div class="product-grid2">
                                    <div class="product-image2">
                                    <div class="product-hider">
                               <a href="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>" data-fancybox="quick-view-<?php echo e($product->product_token.$z); ?>" data-type="image" class="quickview">
                               <i class="fa fa-eye"></i>
                               <p><?php echo e(Helper::translation(2060,$translate)); ?><br/><?php echo e(Helper::translation(2061,$translate)); ?></p>
                               </a>
                               <div class="product-images">
                                    <?php $imagecount = count($product->productimages); ?>
                                    <?php if($imagecount != 0): ?>
                                    <?php $__currentLoopData = $product->productimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($images->product_image); ?>" data-fancybox="quick-view-<?php echo e($product->product_token.$z); ?>" data-type="image"></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    </div>
                                    <div class="product-former">
                                    <h3><?php echo e($product->product_name); ?></h3>
                                    <div class="mt-3"><?php echo e(Helper::translation(2062,$translate)); ?> : <?php if($product->product_stock != 0): ?><span class="theme-color"><?php echo e(Helper::translation(2063,$translate)); ?> (<?php echo e($product->product_stock); ?>)</span><?php else: ?><span class="red-color"><?php echo e(Helper::translation(2064,$translate)); ?> (<?php echo e($product->product_stock); ?>)</span><?php endif; ?></div>
            <?php if($product->product_condition == 'new'){ $badg = "badge badge-warning"; } else { $badg = "badge badge-secondary"; } ?>
            <?php if($product->product_condition != ""): ?><div class="mt-2"><?php echo e(Helper::translation(1950,$translate)); ?> : <span class="<?php echo e($badg); ?>"><?php echo e($product->product_condition); ?></span></div><?php endif; ?>
                                    <div class="mt-3"><?php if($product->product_price != 0): ?><span <?php if($product->product_offer_price != 0): ?> class="fs16 offer-price red-color" <?php else: ?> class="fs32" <?php endif; ?>><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_price); ?></span><?php endif; ?> <?php if($product->product_offer_price != 0): ?><span class="fs32"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_offer_price); ?></span><?php endif; ?></div>                                <p class="mt-3">
                                    <?php echo e($product->product_short_desc); ?> 
                                    </p>
                                    <p><a href="<?php echo e(URL::to('/product')); ?>/<?php echo e($product->product_slug); ?>" class="btn button-color"><?php echo e(Helper::translation(2065,$translate)); ?></a></p>
                                    </div>
                                    </div>
                                    <a href="<?php echo e(URL::to('/product')); ?>/<?php echo e($product->product_slug); ?>">
                                            <?php if($product->product_image != ""): ?>
                                            <img class="pic-1" src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>">
                                            <?php else: ?>
                                            <img class="pic-1" src="<?php echo e(url('/')); ?>/public/img/no-image.jpg">
                                            <?php endif; ?>
                                            <?php $imagecount = count($product->productimages); ?>
                                            <?php if($imagecount != 0): ?>
                                            <?php $no = 1; ?>
                                            <?php $__currentLoopData = $product->productimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($no == 1): ?>
                                            <img class="pic-2" src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($images->product_image); ?>">
                                            <?php endif; ?>
                                            <?php $no++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                            <img class="pic-2" src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>">
                                            <?php endif; ?>
                                            </a>
                                            <?php if($product->flash_deals == 1): ?>
                                            <ul class="countdown-<?php echo e($product->product_token); ?>" id="countdown-timer">
                                                <li>
                                                    <span class="days">00</span>
                                                    <p class="days_ref"><?php echo e(Helper::translation(2071,$translate)); ?></p>
                                                </li>
                                                <li>
                                                    <span class="hours">00</span>
                                                    <p class="hours_ref"><?php echo e(Helper::translation(2072,$translate)); ?></p>
                                                </li>
                                                <li>
                                                    <span class="minutes">00</span>
                                                    <p class="minutes_ref"><?php echo e(Helper::translation(2073,$translate)); ?></p>
                                                </li>
                                                <li>
                                                    <span class="seconds last">00</span>
                                                    <p class="seconds_ref"><?php echo e(Helper::translation(2074,$translate)); ?></p>
                                                </li>
                                            </ul>
                                            <?php endif; ?>
                                            <ul class="social">
                                                <?php if(Auth::guest()): ?>
                                                <li><a href="<?php echo e(url('/login')); ?>" data-tip="<?php echo e(Helper::translation(2066,$translate)); ?>"><i class="fa fa-shopping-bag"></i></a></li>
                                                <?php else: ?>
                                                <?php if(Auth::user()->id != $product->user_id): ?>
                                                <li><a href="<?php echo e(url('/wishlist')); ?>/<?php echo e(Auth::user()->id); ?>/<?php echo e($product->product_token); ?>" data-tip="<?php echo e(Helper::translation(2066,$translate)); ?>"><i class="fa fa-shopping-bag"></i></a></li>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                <li><a href="<?php echo e(URL::to('/product')); ?>/<?php echo e($product->product_slug); ?>" data-tip="<?php echo e(Helper::translation(2067,$translate)); ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                            <a class="add-to-cart" href="<?php echo e(URL::to('/product')); ?>/<?php echo e($product->product_slug); ?>"><?php echo e(Helper::translation(2067,$translate)); ?></a>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a href="<?php echo e(URL::to('/product')); ?>/<?php echo e($product->product_slug); ?>"><?php echo e($product->product_name); ?></a></h3>
                                            <span class="price like"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_price); ?></span>
                                        </div>
                                        </div>
                                    </div>
                                   <?php $z++; ?>      
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                   </div>
             </div>
        <?php endif; ?>
	</div>
    <?php if($allsettings->shop_ads == 1): ?>
      <?php if($allsettings->shop_bottom_ads !=''): ?>
         <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-2" align="center">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <?php echo html_entity_decode($allsettings->shop_bottom_ads); ?>
                    <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
       </script>
      </div>
      </div>
      <?php endif; ?> 
     <?php endif; ?>
</div>
</main>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
var EffectElements = $('form input[data-price-effect], form select');
EffectElements.on('change', function() {
    var PriceEffect = 0;
	var GetErr = 0;
    EffectElements.each(function() { // Loop through elements
        if ($(this).is('.attri_box')) { //if this element is a select
            $(this).children().each(function() { //Loop through the child elements (options)
                if ($(this).is(':selected')) { //if this option is selected
                    PriceEffect += parseFloat($(this).attr('data-price-effect')) * $("#qty").val();
					GetErr += parseFloat($(this).attr('data-price-effect'));
                }
            });
        } else {
            PriceEffect += parseFloat($(this).attr('data-price-effect')) * $("#qty").val();
			GetErr += parseFloat($(this).attr('data-price-effect'));
        }
    });
    $('.display_result').text("<?php echo e($allsettings->site_currency_symbol); ?>" + PriceEffect);
	//$('#price').val($('#name').val());
	//$('#checkprice').val(btoa(PriceEffect));
	$('#price').val(btoa(GetErr));
});
$(document).ready(function() { 
   var EffectElementer = $('form input[data-price-effect], form select');       
    /*$("#qty").click(function(event) {*/
	$("#qty").bind('keyup mouseup', function (event) {
	    var PriceEffect = 0;
		var GetErr = 0;
		var FinalEffect = 0;
		EffectElementer.each(function() {
	    if ($(this).is('.attri_box')) { 
		    $(this).children().each(function() { //Loop through the child elements (options)
                    if ($(this).is(':selected')) { 
                    PriceEffect += parseFloat($(this).attr('data-price-effect')) * $("#qty").val();
					GetErr += parseFloat($(this).attr('data-price-effect'));
					
                    }
					
            });
			
        } else {
            PriceEffect += parseFloat($(this).attr('data-price-effect')) * $("#qty").val();
			GetErr += parseFloat($(this).attr('data-price-effect'));
			
        } 
		});
		$('.display_result').text("<?php echo e($allsettings->site_currency_symbol); ?>" + PriceEffect);
		$('#price').val(btoa(GetErr));
		
	});
});  
</script>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/product.blade.php ENDPATH**/ ?>