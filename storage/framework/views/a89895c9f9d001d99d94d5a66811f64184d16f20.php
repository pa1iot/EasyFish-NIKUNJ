<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<?php echo $__env->make('admin.stylesheet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Right Panel -->
    <?php if(in_array('products',$avilable)): ?>
    <div id="right-panel" class="right-panel">
       <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(3618,$translate)); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
                </div>
            </div>
        </div>
        <?php if(session('success')): ?>
        <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        <?php endif; ?>
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><?php echo e(Helper::translation(3618,$translate)); ?></strong>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(1964,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2077,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3621,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2109,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2091,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2080,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3609,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3624,$translate)); ?></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e($order->purchase_token); ?> </td>
                                            <td><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($order->username); ?>" target="_blank" class="blue-color"><?php echo e($order->username); ?></a></td>
                                            <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order->total); ?>  </td>
                                            <td><?php echo e($order->payment_date); ?></td>
                                            <td><?php echo e(str_replace("-"," ",$order->payment_type)); ?></td>
                                            <td><?php if($order->payment_token != ""): ?><?php echo e($order->payment_token); ?><?php else: ?> <span>---</span> <?php endif; ?></td>
                                            <td><?php if(($order->payment_type == 'localbank' or  $order->payment_type == 'cash-on-delivery') && $order->payment_status == 'pending'): ?> <a href="orders/<?php echo e(base64_encode($order->purchase_token)); ?>/<?php echo e(base64_encode($order->payment_type)); ?>" class="blue-color"onClick="return confirm('Are you sure click to complete payment?');"><?php echo e(Helper::translation(3627,$translate)); ?></a> <?php else: ?> <span>---</span> <?php endif; ?></td>
                                            
                                            <td><a href="order-details/<?php echo e($order->purchase_token); ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>&nbsp; <?php echo e(Helper::translation(3477,$translate)); ?></a></td>
                                        </tr>
                                        <?php $no++; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?> 
   <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/admin/orders.blade.php ENDPATH**/ ?>