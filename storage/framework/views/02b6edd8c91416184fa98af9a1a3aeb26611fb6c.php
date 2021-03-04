<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2040,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2040,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2040,$translate)); ?></span></p>
      </div>
    </section>
   <main role="main">
      <div class="container mt-3" id="demo">
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
      <div class="row">
           <div class="col-md-3">
             <form action="<?php echo e(route('shop')); ?>" method="post" id="shop_form"  enctype="multipart/form-data">
           <?php echo e(csrf_field()); ?>

             <div class="mt-1 mb-1 pt-1 pb-1">
                 <div class="card shadow-sm bg-white border-0 mb-3 rounded-0">
                    <h5 class="card-header bg-white link-color"><?php echo e(Helper::translation(1932,$translate)); ?></h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12 categorybox">
                        <div>
                            <?php $__currentLoopData = $categories['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                            if($translate == 'en'){ $menu_cat = $menu->cat_id;  } else { $menu_cat = $menu->category_page_parent;  } 
                            ?>
                            <input type="checkbox" name="category[]" value="cat-<?php echo e($menu_cat); ?>"> <?php echo e($menu->category_name); ?><br/>
                               <?php if(count($menu->subcategory) != 0): ?>
                                  <?php $__currentLoopData = $menu->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if($translate == 'en'){ $menu_subcat = $sub_category->subcat_id; } else { $menu_subcat = $sub_category->subcategory_page_parent; } ?>
                                   <span class="move_subcategory"><input type="checkbox" name="category[]" value="subcat-<?php echo e($menu_subcat); ?>"> <?php echo e($sub_category->subcategory_name); ?><br/></span>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                           </div>
                       </div>
                    </div>
                  </div>
                  <div class="card shadow-sm bg-white border-0 mb-3 rounded-0">
                    <h5 class="card-header bg-white link-color"><?php echo e(Helper::translation(1934,$translate)); ?></h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12">
                            <select class="form-control" name="orderby">
                              <option value="asc"><?php echo e(Helper::translation(2163,$translate)); ?></option>
                              <option value="desc"><?php echo e(Helper::translation(2164,$translate)); ?></option>
                           </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card shadow-sm bg-white border-0 mb-3 rounded-0">
                    <h5 class="card-header bg-white link-color"><?php echo e(Helper::translation(1950,$translate)); ?></h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <div>
                            <input type="checkbox" name="condition" value="new"> <?php echo e(Helper::translation(1951,$translate)); ?><br/>
                            <input type="checkbox" name="condition" value="used"> <?php echo e(Helper::translation(1952,$translate)); ?>

                           </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card shadow-sm bg-white border-0 mb-3 rounded-0">
                    <h5 class="card-header bg-white link-color"><?php echo e(Helper::translation(1946,$translate)); ?></h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <div>
                            <input type="checkbox" name="product_type" value="physical"> <?php echo e(Helper::translation(2165,$translate)); ?><br/>
                            <input type="checkbox" name="product_type" value="external"> <?php echo e(Helper::translation(2166,$translate)); ?><br/>
                            <input type="checkbox" name="product_type" value="digital"> <?php echo e(Helper::translation(2167,$translate)); ?><br/>
                           </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <?php if(count($attributer['display']) != 0): ?>
                  <?php $__currentLoopData = $attributer['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="card shadow-sm bg-white border-0 mb-3 rounded-0">
                    <h5 class="card-header bg-white link-color"><?php echo e($attribute->attribute_name); ?></h5>
                    <div class="card-body">
                      <div class="row">
                      <div class="col-lg-12">
                        <div>
                        <?php $__currentLoopData = $attribute->newattributevalue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($translate == 'en') { $value_id = $product_value->attribute_value_id; } else { $value_id = $product_value->attrivalue_page_parent; } ?>
                            <input type="checkbox" name="attribute[]" value="<?php echo e($value_id); ?>"> <?php echo e($product_value->attribute_value); ?><br/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </div>   
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php endif; ?>
                 </div>
                 <div class="input-group-append">
                  <button class="btn button-color btn-block" type="submit"><?php echo e(__('Search')); ?></button>
                 </div>
                 <?php if($allsettings->shop_ads == 1): ?>
                 <?php if($allsettings->shop_sidebar_ads !=''): ?>
                 <div class="row">
                        <div class="col-lg-12" align="center">
                          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <?php echo html_entity_decode($allsettings->shop_sidebar_ads); ?>
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                 </div> 
                 <?php endif; ?>      
                 <?php endif; ?>
                 </form>
         	</div>
            
            <div class="col-md-9">
              <div class="mt-1 mb-1 pt-1 pb-1">
                  <div class="row" align="center">
                           <?php $z = 1; ?>
                              <?php $__currentLoopData = $shop['product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                   <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-2 pb-2 prod-item">
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
                                            <span class="price like"><?php if($product->product_offer_price != 0): ?><span class="linethrow"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_price); ?></span><?php endif; ?> <?php if($product->product_offer_price != 0): ?><span class="like"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_offer_price); ?></span><?php else: ?><span class="like"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->product_price); ?></span><?php endif; ?></span>
                                        </div>
                                        <p class="d-none">
                                        <?php 
                                        $var=explode(',',$product->product_category);
                                        ?>
                                        <?php $__currentLoopData = $var; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="<?php echo e($row); ?>"><?php echo e($row); ?></span>,
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                        $var_two = explode(',',$product->product_attribute);
                                        ?>
                                        <?php $__currentLoopData = $var_two; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_two): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="<?php echo e($row_two); ?>"><?php echo e($row_two); ?></span>,
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <span class="<?php echo e($product->product_condition); ?>"><?php echo e($product->product_condition); ?></span>,
                                        <span class="<?php echo e($product->product_type); ?>"><?php echo e($product->product_type); ?></span>,
                                        </p>
                                        </div>
                                    </div>
                                   <?php $z++; ?>      
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                          <div class="text-right">
                           <div class="turn-page" id="itempager"></div>
                        </div>
              </div>
         	</div>
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
    </body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/shop.blade.php ENDPATH**/ ?>