<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2044,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2044,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2044,$translate)); ?></span></p>
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
           <div class="col-md-12">
              <div class="table-responsive">
             <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(1964,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2077,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2089,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2080,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2109,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2091,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2082,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2083,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $purchase['details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e($product->purchase_token); ?></td>
                                            <td><?php echo e($product->payment_token); ?> </td>
                                            <td><?php echo e(str_replace("-"," ",$product->payment_type)); ?> </td>
                                            <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($product->total); ?> </td>
                                            <td><?php echo e($product->payment_date); ?> </td>
                                            <td><?php if($product->payment_status == 'completed'): ?> <span class="badge badge-success"><?php echo e(Helper::translation(2084,$translate)); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(Helper::translation(2085,$translate)); ?></span> <?php endif; ?></td>
                                            <td><a href="my-purchase-details/<?php echo e($product->purchase_token); ?>" class="btn btn-success btn-sm"><?php echo e(Helper::translation(2061,$translate)); ?></a> </td>
                                        </tr>
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
<?php endif; ?><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/my-purchase.blade.php ENDPATH**/ ?>