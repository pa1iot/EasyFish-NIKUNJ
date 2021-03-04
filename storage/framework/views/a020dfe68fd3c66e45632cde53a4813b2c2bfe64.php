<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title><?php echo e($purchase_token); ?> - <?php echo e($allsettings->site_title); ?></title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('resources/views/template/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('resources/views/template/css/stylesheet.css')); ?>">
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container" style="background:#FFFFFF;">
  <!-- Header -->
  <header>
  <div class="row align-items-center mb-5">
    <div class="col-sm-7 text-center text-sm-left mb-sm-0">
      <?php if($allsettings->site_logo != ''): ?>
      <a href="<?php echo e(URL::to('/')); ?>" target="_blank">
      <img width="200" src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>" alt="<?php echo e($allsettings->site_title); ?>"/>
      </a>
      <?php endif; ?>
    </div>
    <div class="col-sm-5 text-right" style="float:right;">
      <h4 class="text-7 mb-0">Invoice</h4>
    </div>
  </div>
  <hr>
  <div class="row align-items-center">
    <div class="col-sm-6 text-center text-sm-left"><strong><?php echo e(Helper::translation(2091,$translate)); ?>:</strong> <?php echo e(date("d M Y", strtotime($payment_date))); ?></div>
    <div class="col-sm-6 text-right" style="float:right;"> <strong>Invoice No / <?php echo e(Helper::translation(2077,$translate)); ?>:</strong> #<?php echo e($purchase_token); ?></div>
  </div>
  <hr>
  <div class="row align-items-center mt-3">
  <div class="col-sm-6 text-center text-sm-left"> <strong>Pay To:</strong>
      <address>
      <?php echo e($buyer_name); ?><br />
      <?php echo e($buyer_address); ?><br />
      <?php echo e($buyer_city); ?>, <?php echo e($buyer_zip); ?><br />
      <?php echo e($buyer_country); ?><br/>
	  <?php echo e($buyer_email); ?>

      </address>
    </div>
    <div class="col-sm-6 text-right" style="float:right;"> <strong>Invoiced To:</strong>
      <address>
      <?php echo e($allsettings->office_address); ?><br />
      <?php echo e($allsettings->office_email); ?><br />
      <?php echo e($allsettings->office_phone); ?>

      </address>
    </div>
   </div> 
   <div class="row align-items-center mt-3">
   <table class="table">
  <thead class="grey bg-light-2 text-center">
    <tr>
      <th scope="col"><?php echo e(Helper::translation(1964,$translate)); ?></th>
      <th scope="col"><?php echo e(Helper::translation(2076,$translate)); ?></th>
      <th scope="col"><?php echo e(Helper::translation(1984,$translate)); ?></th>
      <th scope="col"><?php echo e(Helper::translation(2079,$translate)); ?></th>
      <th scope="col"><?php echo e(Helper::translation(2112,$translate)); ?></th>
      <th scope="col"><?php echo e(Helper::translation(2078,$translate)); ?></th>
     </tr>
  </thead>
  <tbody class="text-center">
    <?php $no = 1; ?>
    <?php $__currentLoopData = $product['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="mb-5 mt-2">
      <th scope="row"><?php echo e($no); ?></th>
      <td><?php echo e($product->ord_id); ?>

      </td>
      <td>
      <a href="<?php echo e(url('/product')); ?>/<?php echo e($product->product_slug); ?>">
      <br/>
      <?php if($product->product_image != ''): ?>
      <img src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>"  class="img-thumb" alt="<?php echo e($product->product_name); ?>"/><?php else: ?> <img src="<?php echo e(url('/')); ?>/public/img/no-image.jpg"  class="img-thumb" alt="<?php echo e($product->product_name); ?>"/>  
      <?php endif; ?>
      </a></td>
      <td><?php echo e($product->product_attribute_values); ?></td>
      <td><a href="<?php echo e(url('/user')); ?>/<?php echo e($product->username); ?>"><?php echo e($product->name); ?></a></td>
      <td><?php echo e($product->quantity); ?> X <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->price); ?></td>
    </tr>
    <?php $no++; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    <tr>
      <td colspan="5" class="bg-light-2 text-right"><strong><?php echo e(Helper::translation(2090,$translate)); ?></strong></td>
      <td class="bg-light-2"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($purchase->shipping_price); ?></td>
      </tr>
    <tr>
      <td colspan="5" class="bg-light-2 text-right"><strong><?php echo e(Helper::translation(1993,$translate)); ?></strong></td>
      <td class="bg-light-2"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($purchase->processing_fee); ?></td>
      </tr>
      <tr>
      <td colspan="5" class="bg-light-2 text-right"><strong><?php echo e(Helper::translation(2092,$translate)); ?></strong></td>
      <td class="bg-light-2"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($purchase->subtotal); ?></td>
      </tr>
       <tr>
      <td colspan="5" class="bg-light-2 text-right"><strong><?php echo e(Helper::translation(2093,$translate)); ?></strong></td>
      <td class="bg-light-2"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($purchase->total); ?></td>
      </tr>
  </tbody>
</table>
</div>
  <div class="row align-items-center">
  <div class="row align-items-center">
    <div class="col-sm-6 text-center text-sm-left"><strong><?php echo e(Helper::translation(2080,$translate)); ?></strong> <?php echo e($payment_type); ?></div>
    <div class="col-sm-6 text-right" style="float:right;"> <strong><?php echo e(Helper::translation(2089,$translate)); ?></strong> <?php echo e($payment_token); ?></div>
  </div>
  </div>
  </header>
</div>
</body>
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/pdf_view.blade.php ENDPATH**/ ?>