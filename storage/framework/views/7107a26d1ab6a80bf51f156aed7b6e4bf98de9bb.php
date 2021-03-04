<?php use ZigKart\Models\Product; ?>
<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php if(Auth::user()->user_type == 'vendor'): ?><?php echo e(Helper::translation(2149,$translate)); ?><?php else: ?><?php echo e(Helper::translation(1912,$translate)); ?><?php endif; ?>  - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(Auth::user()->user_type == 'vendor'): ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2149,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2149,$translate)); ?></span></p>
      </div>
    </section>
    <main role="main">
     <div class="container page-white-box mt-3">
     <div class="row">
	     <div class="col-md-12">
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
        </div>
    <div class="row">
        <div class="col-md-12">
             <form action="<?php echo e(route('edit-product')); ?>" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
             <?php echo e(csrf_field()); ?>

             <div class="card mt-3 tab-card">
        <div class="card-header tab-card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <?php $j = 1; ?>
            <?php $__currentLoopData = $language_page['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a class="nav-link <?php if($j == 1): ?> active show <?php endif; ?>"  data-toggle="tab" href="#<?php echo e($language->language_name); ?>" role="tab"  aria-selected="true"><?php echo e($language->language_name); ?></a>
            </li>
            <?php $j++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>

        <div class="tab-content" id="myTabContent">
          <?php $i = 1; ?>
          <?php $__currentLoopData = $languages_page['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
          if($language->language_code == 'en')
		  {
		     $view = Product::singlar($edit['product']->product_id);
		  }
		  else
		  {
		    $code = $language->language_code;
		    $view = Product::others($edit['product']->product_id,$code);
		  }
          ?>
          <div class="tab-pane fade <?php if($i == 1): ?> show active <?php endif; ?> mt-4" id="<?php echo e($language->language_name); ?>" role="tabpanel">
          <div class="form-group row">
              <div class="col-sm-6">
                        <label for="name"><?php echo e(Helper::translation(1928,$translate)); ?> <span class="required">*</span></label>
                        <input id="product_name" name="product_name[]" type="text" class="form-control" data-bvalidator="required" value="<?php if(!empty($view->product_name)): ?><?php echo e($view->product_name); ?><?php endif; ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="site_keywords"><?php echo e(Helper::translation(1930,$translate)); ?> <span class="required">*</span></label>
                        <textarea name="product_short_desc[]" id="product_short_desc" rows="3" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"><?php if(!empty($view->product_short_desc)): ?><?php echo e($view->product_short_desc); ?><?php endif; ?></textarea>
                    </div>
                    <div class="col-sm-12">
                         <label for="site_desc"><?php echo e(Helper::translation(1931,$translate)); ?><span class="required">*</span></label>
                       <textarea name="product_desc[]" id="summary-ckeditor<?php echo e($language->language_id); ?>" rows="3"  class="form-control" data-bvalidator="required"><?php if(!empty($view->product_desc)): ?><?php echo e(html_entity_decode($view->product_desc)); ?><?php endif; ?></textarea>
                    </div>
                                 
          </div>
          </div>
          <input type="hidden" name="language_code[]" value="<?php echo e($language->language_code); ?>">
          <?php $i++; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         
        </div>
      </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="name">Slug<span class="required">*</span></label>
                        <input id="product_slug" name="product_slug" type="text" class="form-control" data-bvalidator="required" value="<?php echo e($edit['product']->product_slug); ?>">
                    </div>
                    <div class="col-sm-6">
                         <label for="name"><?php echo e(Helper::translation(1929,$translate)); ?> <span class="required">*</span></label>
                        <input id="product_sku" name="product_sku" type="text" class="form-control" data-bvalidator="required" value="<?php echo e($edit['product']->product_sku); ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="site_title"> <?php echo e(Helper::translation(1932,$translate)); ?> <span class="required">*</span></label>
                        <select name="product_category[]" class="form-control" data-bvalidator="required" multiple>
                                                <?php $__currentLoopData = $categories['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php 
                                                
                                                if($translate == 'en') { $menuu_id = $menu->cat_id; } else { $menuu_id = $menu->category_page_parent; } 
                                                $cats = 'cat-'.$menuu_id;
                                                ?>
                                                <option value="cat-<?php echo e($menuu_id); ?>" <?php if(in_array($cats,$product_categories)): ?> selected="selected" <?php endif; ?>><?php echo e($menu->category_name); ?></option>
                                                     <?php $__currentLoopData = $menu->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <?php 
                                                     
                                                     if($translate == 'en') { $submenuu_id = $sub_category->subcat_id; } else { $submenuu_id = $sub_category->subcategory_page_parent; } 
                                                     $subcats = 'subcat-'.$submenuu_id;
                                                     ?>
                                                     <option value="subcat-<?php echo e($submenuu_id); ?>" class="ml-2" <?php if(in_array($subcats,$product_categories)): ?> selected="selected" <?php endif; ?>>- <?php echo e($sub_category->subcategory_name); ?></option>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                </select>
                    </div>
                    <div class="col-sm-6">
                         <label for="name"><?php echo e(Helper::translation(1933,$translate)); ?></label>
                        <input id="product_video_url" name="product_video_url" type="text" class="form-control" value="<?php echo e($edit['product']->product_video_url); ?>">
                        <small>( <?php echo e(__('Example')); ?> : https://www.youtube.com/watch?v=C0DPdy98e4c )</small>
                    </div>
                </div>
               <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="name"><?php echo e(Helper::translation(1934,$translate)); ?> (<?php echo e($allsettings->site_currency_symbol); ?>)<span class="required">*</span></label>
                         <input id="product_price" name="product_price" type="text" class="form-control" data-bvalidator="required,min[1]" value="<?php echo e($edit['product']->product_price); ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="name"><?php echo e(Helper::translation(1935,$translate)); ?> (<?php echo e($allsettings->site_currency_symbol); ?>)</label>
                        <input id="product_offer_price" name="product_offer_price" type="text" class="form-control" data-bvalidator="min[1]" value="<?php if($edit['product']->product_offer_price != 0): ?><?php echo e($edit['product']->product_offer_price); ?><?php endif; ?>">
                    </div>
               </div>
               <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="customer_earnings"><?php echo e(Helper::translation(1936,$translate)); ?> <span class="required">*</span></label>
                         <input type="file" id="product_image" name="product_image" class="form-control-file" <?php if($edit['product']->product_image == ''): ?> data-bvalidator="required,extension[jpg:png:jpeg]" <?php else: ?> data-bvalidator="extension[jpg:png:jpeg]" <?php endif; ?> data-bvalidator-msg="<?php echo e(Helper::translation(1937,$translate)); ?>"> <?php if($edit['product']->product_image != ''): ?>
                                          <img src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($edit['product']->product_image); ?>"  class="image-size" alt="<?php echo e($edit['product']->product_name); ?>"/><?php else: ?> <img src="<?php echo e(url('/')); ?>/public/img/no-image.jpg"  class="image-size" alt="<?php echo e($edit['product']->product_name); ?>"/>
                                          <?php endif; ?>    
                    </div>
                    <div class="col-sm-6">
                        <label for="customer_earnings"><?php echo e(Helper::translation(1938,$translate)); ?></label>
                        <input type="file" id="product_gallery[]" name="product_gallery[]" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="<?php echo e(Helper::translation(1937,$translate)); ?>" multiple><br/><?php $__currentLoopData = $editimage['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <div class="item-img"><img src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>" alt="<?php echo e($product->product_image); ?>" class="item-thumb">
                                                    <a href="<?php echo e(url('/edit-product')); ?>/dropimg/<?php echo e(base64_encode($product->proimg_id)); ?>" onClick="return confirm('<?php echo e(Helper::translation(1968,$translate)); ?>');" class="drop-icon"><span class="fa fa-trash-o drop-icon"></span></a>
                                                    </div>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <div class="clearfix"></div>
                    </div>
                </div>
               <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_keywords"><?php echo e(Helper::translation(1939,$translate)); ?></label>
                        <textarea name="product_tags" id="product_tags" rows="4" placeholder="<?php echo e(Helper::translation(1940,$translate)); ?>" class="form-control noscroll_textarea"><?php echo e($edit['product']->product_tags); ?></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label for="site_title"><?php echo e(Helper::translation(1941,$translate)); ?><span class="required">*</span></label>
                        <select name="product_allow_seo" id="product_allow_seo" class="form-control" data-bvalidator="required">
                             <option value=""></option>
                             <option value="1" <?php if($edit['product']->product_allow_seo == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1942,$translate)); ?></option>
                             <option value="0" <?php if($edit['product']->product_allow_seo == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1943,$translate)); ?></option>
                        </select>
                    </div>
                </div>
                <div id="ifseo" <?php if($edit['product']->product_allow_seo == 1): ?> class="force-block" <?php else: ?> class="force-none" <?php endif; ?>>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_keywords"><?php echo e(Helper::translation(1944,$translate)); ?> <span class="required">*</span></label>
                        <textarea name="product_seo_keyword" id="product_seo_keyword" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"><?php echo e($edit['product']->product_seo_keyword); ?></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label for="site_desc"><?php echo e(Helper::translation(1945,$translate)); ?> <span class="required">*</span></label>
                        <textarea name="product_seo_desc" id="product_seo_desc" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"><?php echo e($edit['product']->product_seo_desc); ?></textarea>
                    </div>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                         <label for="site_title"><?php echo e(Helper::translation(1946,$translate)); ?> <span class="required">*</span></label>
                        <?php /*?><select name="product_type" id="product_type" class="form-control" data-bvalidator="required">
                           <option value=""></option>
                           @foreach($product_type as $type)
                           <option value="{{ $type }}" @if($edit['product']->product_type == $type) selected @endif>{{ $type }}</option>
                           @endforeach
                       </select><?php */?>
                       <select name="product_type" id="product_type" class="form-control" data-bvalidator="required">
                             <option value=""></option>
                             <option value="physical" <?php if($edit['product']->product_type == 'physical'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2165,$translate)); ?></option>
                             <option value="digital" <?php if($edit['product']->product_type == 'digital'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2167,$translate)); ?></option>                            <?php if($allsettings->display_external_product == 1): ?>
                             <option value="external" <?php if($edit['product']->product_type == 'external'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(2166,$translate)); ?></option><?php endif; ?>
                        </select>
                      </div>
                </div>
                <div id="ifphysical_external" <?php if($edit['product']->product_type == 'physical' or $edit['product']->product_type == 'external'): ?> class="force-block" <?php else: ?> class="force-none" <?php endif; ?>>
                <div class="form-group row">
                    <div class="col-sm-12">
                         <label for="site_keywords"><?php echo e(Helper::translation(1947,$translate)); ?></label>
                        <select name="product_brand" id="product_brand" class="form-control">
                             <option value=""></option>
                             <?php $__currentLoopData = $brand['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($brand->brand_id); ?>" <?php if($edit['product']->product_brand == $brand->brand_id): ?> selected <?php endif; ?>><?php echo e($brand->brand_name); ?></option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_keywords"><?php echo e(Helper::translation(1948,$translate)); ?></label>
                        <textarea name="product_return_policy" id="product_return_policy" rows="6" class="form-control noscroll_textarea"><?php echo e($edit['product']->product_return_policy); ?></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label for="name"><?php echo e(Helper::translation(1949,$translate)); ?> <span class="required">*</span></label>
                        <input id="product_estimate_time" name="product_estimate_time" type="text" class="form-control" data-bvalidator="required,digit,min[1]" value="<?php echo e($edit['product']->product_estimate_time); ?>">
                        <small><?php echo e(__('Days')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_title"><?php echo e(Helper::translation(1950,$translate)); ?> <span class="required">*</span></label>
                        <select name="product_condition" class="form-control" data-bvalidator="required">
                            <option value=""></option>
                            <option value="new" <?php if($edit['product']->product_condition == 'new'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1951,$translate)); ?></option>
                            <option value="used" <?php if($edit['product']->product_condition == 'used'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1952,$translate)); ?></option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="name"><?php echo e(Helper::translation(1953,$translate)); ?></label>
                        <input id="product_stock" name="product_stock" type="text" class="form-control" data-bvalidator="digit,min[0]" value="<?php echo e($edit['product']->product_stock); ?>">
                        <small><span class="red-color"><?php echo e(Helper::translation(1954,$translate)); ?></span></small>
                    </div>
                </div>
                <?php if(count($attributer['display']) != 0): ?>
                <div class="form-group row">
                    <?php $__currentLoopData = $attributer['display']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6">
                         <label for="site_title"><?php echo e($attribute->attribute_name); ?></label>
                        <select name="product_attribute[]" class="form-control" multiple>
                                                <?php $__currentLoopData = $attribute->attributeagain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($product_value->attribute_value_id); ?>-<?php echo e($attribute->attribute_id); ?>" <?php if(in_array($product_value->attribute_value_id,$product_attribute)): ?> selected="selected" <?php endif; ?>><?php echo e($product_value->attribute_value); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </div>
                <?php endif; ?>
                </div>
                <div class="form-group row">
                    <div id="ifdigital" <?php if($edit['product']->product_type == 'digital'): ?> class="col-sm-6 force-block" <?php else: ?> class="col-sm-6 force-none" <?php endif; ?>>
                         <label for="customer_earnings"><?php echo e(Helper::translation(1955,$translate)); ?><span class="required">*</span></label>
                        <input type="file" id="product_file" name="product_file" class="form-control-file" <?php if($edit['product']->product_file == ''): ?> data-bvalidator="required,extension[zip]" <?php else: ?> data-bvalidator="extension[zip]" <?php endif; ?> data-bvalidator-msg="<?php echo e(Helper::translation(1956,$translate)); ?>">
                                                <?php if($allsettings->site_s3_storage == 1): ?>
                                                <?php 
                                                if($edit['product']->product_file != '')
                                                {
                                                $fileurl = Storage::disk('s3')->url($edit['product']->product_file); 
                                                }
                                                else
                                                {
                                                $fileurl = '';  
                                                }
                                                ?>
                                                <br/><a href="<?php echo e($fileurl); ?>" class="blue-color" download><?php echo e($edit['product']->product_file); ?></a>
                                                <?php else: ?>
                                                <br/><?php if($edit['product']->product_file!=''): ?><a href="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($edit['product']->product_file); ?>" class="blue-color" download><?php echo e($edit['product']->product_file); ?></a><?php endif; ?> <?php endif; ?>
                    </div>
                    <div id="ifexternal" <?php if($edit['product']->product_type == 'external'): ?> class="col-sm-6 force-block" <?php else: ?> class="col-sm-6 force-none" <?php endif; ?>>
                        <label for="name"><?php echo e(Helper::translation(1957,$translate)); ?> <span class="required">*</span></label>
                        <input id="product_external_url" name="product_external_url" type="text" class="form-control" data-bvalidator="required,url" value="<?php echo e($edit['product']->product_external_url); ?>">
                    </div>
                </div>
                <div id="ifphysical" <?php if($edit['product']->product_type == 'physical'): ?> class="force-block" <?php else: ?> class="force-none" <?php endif; ?>>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="name"><?php echo e(Helper::translation(1958,$translate)); ?> (<?php echo e($allsettings->site_currency_symbol); ?>)</label>
                        <input id="product_local_shipping_fee" name="product_local_shipping_fee" type="text" class="form-control" data-bvalidator="min[0]" value="<?php echo e($edit['product']->product_local_shipping_fee); ?>">
                        <small><?php echo e(__('(Vendor country based shipping)')); ?> <span class="red-color"> - <?php echo e(Helper::translation(1959,$translate)); ?></span></small>
                    </div>
                    <div class="col-sm-6">
                        <label for="name"><?php echo e(Helper::translation(1960,$translate)); ?> (<?php echo e($allsettings->site_currency_symbol); ?>)</label>
                        <input id="product_global_shipping_fee" name="product_global_shipping_fee" type="text" class="form-control" data-bvalidator="min[0]" value="<?php echo e($edit['product']->product_global_shipping_fee); ?>">
                        <small><?php echo e(__('(Vendor non country based shipping)')); ?> <span class="red-color"> - <?php echo e(Helper::translation(1959,$translate)); ?></span></small>
                    </div>
                    
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                         <label for="site_title"> <?php echo e(Helper::translation(1961,$translate)); ?> <span class="required">*</span></label>
                        <select name="flash_deals" id="flash_deals" class="form-control" data-bvalidator="required">
                          <option value=""></option>
                          <option value="1" <?php if($edit['product']->flash_deals == 1): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1942,$translate)); ?></option>
                          <option value="0" <?php if($edit['product']->flash_deals == 0): ?> selected <?php endif; ?>><?php echo e(Helper::translation(1943,$translate)); ?></option>
                        </select>
                    </div>
                 </div>
                <div id="ifdeal" <?php if($edit['product']->flash_deals == 1): ?> class="force-block" <?php else: ?> class="force-none" <?php endif; ?>>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_keywords"><?php echo e(Helper::translation(1962,$translate)); ?> <span class="required">*</span></label>
                        <input id="flash_deal_start_date" name="flash_deal_start_date" type="text" class="form-control" data-bvalidator="required" value="<?php echo e($edit['product']->flash_deal_start_date); ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="site_desc"><?php echo e(Helper::translation(1963,$translate)); ?> <span class="required">*</span></label>
                        <input id="flash_deal_end_date" name="flash_deal_end_date" type="text" class="form-control" data-bvalidator="required" value="<?php echo e($edit['product']->flash_deal_end_date); ?>">
                    </div>
                </div>
                </div>
                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                <input type="hidden" name="image_size" value="<?php echo e($allsettings->site_max_image_size); ?>"> 
                <input type="hidden" name="file_size" value="<?php echo e($allsettings->site_max_zip_size); ?>">
                <input type="hidden" name="save_product_image" value="<?php echo e($edit['product']->product_image); ?>"> 
                <input type="hidden" name="save_product_file" value="<?php echo e($edit['product']->product_file); ?>">            
                <input type="hidden" name="product_token" value="<?php echo e($edit['product']->product_token); ?>">
                <input type="hidden" name="token" value="<?php echo e(uniqid()); ?>"> 
                <input type="hidden" name="product_id" value="<?php echo e($edit['product']->product_id); ?>">
                <button type="submit" class="btn button-color float-left"><?php echo e(Helper::translation(1919,$translate)); ?></button>
            </form>
        </div>
    </div>
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
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\zigkart\resources\views/edit-product.blade.php ENDPATH**/ ?>