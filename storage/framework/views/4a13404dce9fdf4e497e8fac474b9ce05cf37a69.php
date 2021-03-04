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
<div id="right-panel" class="right-panel">
<?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(2115,$translate)); ?></h1>
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
                                <strong class="card-title"><?php echo e(Helper::translation(2115,$translate)); ?></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(1964,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2077,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2076,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(1928,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3621,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3753,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3756,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(1965,$translate)); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e($refund->purchase_token); ?> </td>
                                            <td><?php echo e($refund->order_id); ?> </td>
                                            <td><?php echo e($refund->product_name); ?> </td>
                                            <td><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($refund->username); ?>" target="_blank" class="blue-color"><?php echo e($refund->username); ?></a></td>
                                            <td><?php echo e($refund->reason); ?> </td>
                                            <td><?php echo e($refund->message); ?></td>
                                            <td>
                                            <?php if($refund->dispute_status == ""): ?> 
                                            <a href="<?php echo e(URL::to('/admin/refund')); ?>/<?php echo e($refund->order_id); ?>/<?php echo e($refund->dispute_id); ?>/buyer" class="btn btn-success btn-sm" title="payment released to buyer"><i class="fa fa-money"></i>&nbsp; Refund Accept</a><a href="<?php echo e(URL::to('/admin/refund')); ?>/<?php echo e($refund->order_id); ?>/<?php echo e($refund->dispute_id); ?>/vendor" class="btn btn-danger btn-sm" title="payment released to vendor"><i class="fa fa-close"></i>&nbsp; <?php echo e(Helper::translation(3759,$translate)); ?></a>
                                            <?php else: ?>
                                            <?php if($refund->dispute_status == 'accepted'): ?> <span class="badge badge-success"><?php echo e(Helper::translation(3762,$translate)); ?></span> <?php else: ?> <span class="badge badge-danger"><?php echo e(Helper::translation(3765,$translate)); ?></span> <?php endif; ?>
                                            <?php endif; ?>
                                            </td>
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
<?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/admin/refund.blade.php ENDPATH**/ ?>