<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2110,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2110,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2110,$translate)); ?></span></p>
      </div>
    </section>
<main role="main">
    <div class="container mt-3">
    <div class="row">
       <div class="col-md-12" align="right">
          <a href="<?php echo e(URL::to('/my-purchase')); ?>" class="btn button-color">&lt; <?php echo e(Helper::translation(2088,$translate)); ?></a><a href="<?php echo e(url('/invoice')); ?>/<?php echo e($purchase->purchase_token); ?>" class="btn btn-danger ml-1"><i class="fa fa-download" aria-hidden="true"></i> Invoice</a>
       </div>
    </div>
    </div>
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
           <div class="col-md-12">
         	   <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2077,$translate)); ?> : </label>
                        <?php echo e($purchase->purchase_token); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2089,$translate)); ?> : </label>
                        <?php echo e($purchase->payment_token); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2090,$translate)); ?> : </label>
                        <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($purchase->shipping_price); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1993,$translate)); ?> : </label>
                        <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($purchase->processing_fee); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2080,$translate)); ?> : </label>
                        <?php echo e(str_replace("-"," ",$purchase->payment_type)); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2091,$translate)); ?> : </label>
                        <?php echo e($purchase->payment_date); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2092,$translate)); ?> : </label>
                        <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($purchase->subtotal); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2093,$translate)); ?> : </label>
                        <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($purchase->total); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2082,$translate)); ?> : </label>
                        <?php if($purchase->payment_status == 'completed'): ?> <span class="badge badge-success"><?php echo e(Helper::translation(2084,$translate)); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(Helper::translation(2085,$translate)); ?></span> <?php endif; ?>
                    </div>
                </div> 
                <div class="form-group row mt-3 pt-3">
                    <div class="col-sm-6">
                        <h4><?php echo e(Helper::translation(1997,$translate)); ?> </h4>
                        
                    </div>
                    <div class="col-sm-6">
                        <h4><?php echo e(Helper::translation(2095,$translate)); ?> </h4>
                        
                    </div>
                </div>    
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1998,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_firstname); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1999,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_lastname); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1998,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_firstname); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(1999,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_lastname); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2000,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_companyname); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2014,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_email); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2000,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_companyname); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2014,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_email); ?>

                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2002,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_phone); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2007,$translate)); ?> : </label>
                        <?php echo e($billcountry); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2002,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_phone); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2007,$translate)); ?> : </label>
                        <?php echo e($shipcountry); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2003,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_address); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2096,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_city); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2003,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_address); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2096,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_city); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2005,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_state); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2006,$translate)); ?> : </label>
                        <?php echo e($purchase->bill_postcode); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2005,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_state); ?>

                    </div>
                    <div class="col-sm-3">
                        <label for="name"><?php echo e(Helper::translation(2006,$translate)); ?> : </label>
                        <?php echo e($purchase->ship_postcode); ?>

                    </div>
                </div>
                <div class="form-group row mt-3 pt-3">
                    <div class="col-sm-12">
                        <h4><?php echo e(Helper::translation(2097,$translate)); ?> </h4>
                        <?php echo e($purchase->other_notes); ?>

                    </div>
              </div> 
           </div>
         </div>
        <div class="row">
           <div class="col-md-12"> 
        <div class="form-group row mt-3 pt-3">
                    <div class="col-sm-12">
                        <h4><?php echo e(Helper::translation(2111,$translate)); ?></h4>
                        
                    </div>
             </div> 
             <div class="table-responsive">
             <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(1964,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2076,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(1984,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2078,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2079,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2112,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2113,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2114,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2098,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2912,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $product['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e($product->ord_id); ?></td>
                                            <td>
                                            <a href="<?php echo e(url('/product')); ?>/<?php echo e($product->product_slug); ?>">
                                            <?php if($product->product_image != ''): ?>
                                                <img src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>"  class="img-thumb" alt="<?php echo e($product->product_name); ?>"/><?php else: ?> <img src="<?php echo e(url('/')); ?>/public/img/no-image.jpg"  class="img-thumb" alt="<?php echo e($product->product_name); ?>"/>  <?php endif; ?>
                                                </a>
                                           </td>
                                            <td><?php echo e($product->quantity); ?> X <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->price); ?></td>
                                            <td><?php echo e($product->product_attribute_values); ?> </td>
                                            <td><a href="<?php echo e(url('/user')); ?>/<?php echo e($product->username); ?>"><?php echo e($product->name); ?></a> </td>
                                            <td>
                                            <?php if($today_date <= $refund_date): ?>
                                            <?php if($product->order_status == 'completed' && $product->payment_status != $payment_status_buyer): ?>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#sem-login-<?php echo e($product->ord_id); ?>" class="btn btn-success btn-sm"><?php echo e(Helper::translation(2115,$translate)); ?></a>
                                            <?php else: ?>
                                            <span class="badge badge-warning"><?php echo e($product->payment_status); ?></span>
                                            <?php endif; ?>
                                            <?php else: ?>
                                            <span class="badge badge-warning"><?php echo e($product->payment_status); ?></span>
                                            <?php endif; ?>
                                            </td>
                                            <td  align="center">
                                            <?php if($allsettings->site_s3_storage == 1): ?>
                                            <?php 
                                            if($product->product_file != '')
                                            {
                                            $fileurl = Storage::disk('s3')->url($product->product_file); 
                                            }
                                            else
                                            {
                                            $fileurl = '';  
                                            }
                                            ?>
                                            <?php endif; ?>
                                            <?php if($product->order_status == 'completed'): ?>
                                            <?php if($product->payment_status != $payment_status_buyer or $product->payment_status == $payment_status_vendor): ?> 
                                            <a href="javascript:void(0);" class="badge badge-success" data-toggle="modal" data-target="#sem-rate-<?php echo e($product->ord_id); ?>"><i class="fa fa-star"></i> <?php echo e(Helper::translation(2114,$translate)); ?></a>                            <?php else: ?>
                                            <span>---</span>
                                            <?php endif; ?>
                                            <?php if($product->product_type == 'digital'): ?>
                                            <?php if($product->payment_status != $payment_status_buyer or $product->payment_status == $payment_status_vendor): ?>
                                            <?php if($allsettings->site_s3_storage == 1): ?>
                                            <br/><a href="<?php echo e($fileurl); ?>" class="badge badge-primary" download><i class="fa fa-download"></i> <?php echo e(Helper::translation(2116,$translate)); ?></a>
                                            <?php else: ?>
                                            <br/><a href="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_file); ?>" class="badge badge-primary" download><i class="fa fa-download"></i> <?php echo e(Helper::translation(2116,$translate)); ?></a>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            </td>
                                            <td align="center">
                                            <?php if($product->product_type == 'physical'): ?>
                                            <?php if($product->payment_status != $payment_status_buyer): ?>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#sem-track-<?php echo e($product->ord_id); ?>"><?php echo e(Helper::translation(2098,$translate)); ?></a>
                                            <?php else: ?>
                                            <span>---</span>
                                            <?php endif; ?>
                                            <?php else: ?>
                                            <span>---</span>
                                            <?php endif; ?>
                                            </td>
                                            <td>
                                            <?php if($product->payment_status != $payment_status_buyer or $product->payment_status == $payment_status_vendor): ?>
                                            <a href="<?php echo e(url('/conversation-to-vendor')); ?>/<?php echo e($product->username); ?>/<?php echo e($encrypter->encrypt($product->ord_id)); ?>" class="btn btn-primary btn-sm"><?php echo e(Helper::translation(2915,$translate)); ?></a>
                                            <?php else: ?>
                                            <span>---</span>
                                            <?php endif; ?>
                                            </td>
                                        </tr>
                                        <div class="modal fade seminor-login-modal" data-backdrop="static" id="sem-track-<?php echo e($product->ord_id); ?>">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                              <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h4 class="modal-title"><?php echo e(Helper::translation(2098,$translate)); ?></h4>
                                                       <button type="button" class="close" data-dismiss="modal">
                                                      <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                       </button>
                                                    </div>
                                                    <?php
                                                    $delivery_time ='+'.$product->product_estimate_time.' days';
                                                    $delivery_date = date('d F Y', strtotime($delivery_time, strtotime($purchase->payment_date)));
                                                    ?>
                                                    <div class="modal-body">
                                                          <div class="card-body">
                                                                <h6><?php echo e(Helper::translation(2076,$translate)); ?>: <?php echo e($product->ord_id); ?></h6>
                                                                <article class="card">
                                                                    <div class="card-body row">
                                                                        <div class="col"> <strong><?php echo e(Helper::translation(2094,$translate)); ?>:</strong> <br><?php echo e($delivery_date); ?></div>
                                                                        <div class="col"> <strong><?php echo e(Helper::translation(1915,$translate)); ?>:</strong> <br> Order has been <?php echo e($product->order_tracking); ?></div>
                                                                        <div class="col"> <strong><?php echo e(Helper::translation(2117,$translate)); ?>:</strong> <br> <?php echo e($product->ord_id); ?> </div>
                                                                    </div>
                                                                </article>
                                                                <div class="track">
                                                                    <?php if($product->order_tracking == $track_placed): ?>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?php echo e(Helper::translation(2118,$translate)); ?></span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"><?php echo e(Helper::translation(2119,$translate)); ?></span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"><?php echo e(Helper::translation(2120,$translate)); ?></span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text"><?php echo e(Helper::translation(2121,$translate)); ?></span> </div>
                                                                    <?php endif; ?>
                                                                    <?php if($product->order_tracking == $track_packed): ?>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?php echo e(Helper::translation(2118,$translate)); ?></span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"><?php echo e(Helper::translation(2119,$translate)); ?></span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"><?php echo e(Helper::translation(2120,$translate)); ?></span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text"><?php echo e(Helper::translation(2121,$translate)); ?></span> </div>
                                                                    <?php endif; ?>
                                                                    <?php if($product->order_tracking == $track_shipped): ?>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?php echo e(Helper::translation(2118,$translate)); ?></span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"><?php echo e(Helper::translation(2119,$translate)); ?></span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"><?php echo e(Helper::translation(2120,$translate)); ?></span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text"><?php echo e(Helper::translation(2121,$translate)); ?></span> </div>
                                                                    <?php endif; ?>
                                                                    <?php if($product->order_tracking == $track_delivered): ?>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?php echo e(Helper::translation(2118,$translate)); ?></span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"><?php echo e(Helper::translation(2119,$translate)); ?></span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"><?php echo e(Helper::translation(2120,$translate)); ?> </span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text"><?php echo e(Helper::translation(2121,$translate)); ?></span> </div>
                                                                    <?php endif; ?>
                                                                    <?php if($product->order_tracking == ''): ?>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><?php echo e(Helper::translation(2118,$translate)); ?></span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> <?php echo e(Helper::translation(2119,$translate)); ?></span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> <?php echo e(Helper::translation(2120,$translate)); ?> </span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text"><?php echo e(Helper::translation(2121,$translate)); ?></span> </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                           </div>
                                                    </div>
                                              </div>
                                            </div>
                                          </div>
                                        <div class="modal fade seminor-login-modal" data-backdrop="static" id="sem-rate-<?php echo e($product->ord_id); ?>">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                              <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h4 class="modal-title"><?php echo e(Helper::translation(2114,$translate)); ?></h4>
                                                       <button type="button" class="close" data-dismiss="modal">
                                                      <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                       </button>
                                                    </div>
                                                    <div class="modal-body">
                                                          <div class="row">
                                                             <div class="col-md-6">
                                                              <?php if($product->product_image != ''): ?>
                                                <img src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>"  class="refund-img" alt="<?php echo e($product->product_name); ?>"/><?php else: ?> <img src="<?php echo e(url('/')); ?>/public/img/no-image.jpg"  class="refund-img" alt="<?php echo e($product->product_name); ?>"/>  <?php endif; ?>
                                                <h5 align="center"><?php echo e($product->product_name); ?></h5>
                                                              </div>
                                                              <div class="col-md-6">
                                                                 <form action="<?php echo e(route('rating')); ?>" class="setting_form" method="post" enctype="multipart/form-data">
                                                                 <?php echo e(csrf_field()); ?>

                                                                            <div class="form-group">
                                                                            <label for="email"><?php echo e(Helper::translation(2122,$translate)); ?></label><br/>
                                                                            <div>
                                                                            <input type="radio" name="rating" value="5" required="required">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i> 
                                                                            </div>
                                                                            <div>
                                                                            <input type="radio" name="rating" value="4" required="required">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                            </div>
                                                                            <div>
                                                                            <input type="radio" name="rating" value="3" required="required">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                            </div>
                                                                            <div>
                                                                            <input type="radio" name="rating" value="2" required="required">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                            </div>
                                                                            <div>
                                                                            <input type="radio" name="rating" value="1" required="required">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                            </div>
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <label for="pwd"><?php echo e(Helper::translation(2123,$translate)); ?></label>
                                                                            <textarea class="form-control" name="review" rows="5" required="required"></textarea>
                                                                          </div>
                                                                          <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                                                          <input type="hidden" name="product_id" value="<?php echo e($product->product_id); ?>">
                                                                          <input type="hidden" name="order_id" value="<?php echo e($product->ord_id); ?>">
                                                                          <button type="submit" class="btn button-color"><?php echo e(Helper::translation(1919,$translate)); ?></button>
                                                                 </form>
                                                              </div>
                                                           </div>
                                                    </div>
                                              </div>
                                            </div>
                                          </div>
                                        <div class="modal fade seminor-login-modal" data-backdrop="static" id="sem-login-<?php echo e($product->ord_id); ?>">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                              <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h4 class="modal-title"><?php echo e(Helper::translation(2124,$translate)); ?></h4>
                                                       <button type="button" class="close" data-dismiss="modal">
                                                      <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                       </button>
                                                    </div>
                                                    <div class="modal-body">
                                                          <div class="row">
                                                             <div class="col-md-6">
                                                              <?php if($product->product_image != ''): ?>
                                                <img src="<?php echo e(url('/')); ?>/public/storage/product/<?php echo e($product->product_image); ?>"  class="refund-img" alt="<?php echo e($product->product_name); ?>"/><?php else: ?> <img src="<?php echo e(url('/')); ?>/public/img/no-image.jpg"  class="refund-img" alt="<?php echo e($product->product_name); ?>"/>  <?php endif; ?>
                                                <h5 align="center"><?php echo e($product->product_name); ?></h5>
                                                              </div>
                                                              <div class="col-md-6">
                                                                 <form action="<?php echo e(route('refund-request')); ?>" class="setting_form" method="post" enctype="multipart/form-data">
                                                                 <?php echo e(csrf_field()); ?>

                                                                 <input type="hidden" name="product_id" value="<?php echo e($product->product_id); ?>">
                                                                 <input type="hidden" name="product_name" value="<?php echo e($product->product_name); ?>">
                                                                 <input type="hidden" name="product_slug" value="<?php echo e($product->product_slug); ?>">
                                                                 <input type="hidden" name="purchase_token" value="<?php echo e($product->purchase_token); ?>">
                                                                 <input type="hidden" name="order_id" value="<?php echo e($product->ord_id); ?>">
                                                                 <input type="hidden" name="payment_date" value="<?php echo e($purchase->payment_date); ?>">
                                                                 <input type="hidden" name="buyer_id" value="<?php echo e(Auth::user()->id); ?>">
                                                                 <input type="hidden" name="vendor_id" value="<?php echo e($product->product_user_id); ?>">
                                                                 <input type="hidden" name="payment" value="<?php echo e($product->subtotal); ?>">
                                                                 <input type="hidden" name="payment_type" value="<?php echo e($product->payment_type); ?>">
                                                                          <div class="form-group">
                                                                            <label for="email"><?php echo e(Helper::translation(2125,$translate)); ?></label>
                                                                            <input type="text" class="form-control" name="reason" required="required">
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <label for="pwd"><?php echo e(Helper::translation(2126,$translate)); ?></label>
                                                                            <textarea class="form-control" name="message" rows="5" required="required"></textarea>
                                                                          </div>
                                                                          <button type="submit" class="btn button-color"><?php echo e(Helper::translation(1919,$translate)); ?></button>
                                                                 </form>
                                                              </div>
                                                           </div>
                                                    </div>
                                              </div>
                                            </div>
                                          </div>
                                        <?php $no++; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                   </tbody>
                         </table>
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/my-purchase-details.blade.php ENDPATH**/ ?>