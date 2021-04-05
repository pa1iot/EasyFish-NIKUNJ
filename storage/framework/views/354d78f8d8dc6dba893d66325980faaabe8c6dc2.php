<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
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
                            <form method="post" action="<?php echo e(url('/admin/save-assign-orders')); ?>">
                                <?php echo csrf_field(); ?>


                                <div class="table-responsive">
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(1964,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2077,$translate)); ?></th>
                                            
                                            <th>Address</th>

                                            <th><?php echo e(Helper::translation(2091,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2080,$translate)); ?></th>
                                            
                                            

                                            <th>ProductName</th>
                                            <th><?php echo e(Helper::translation(2109,$translate)); ?></th>
                                            <th>
                                                Action<br>
                                                <?php $checkall=0; ?>
                                                <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($order->delivery_status == 1): ?>  <?php $checkall=1; ?> <?php endif; ?>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($checkall)): ?>
                                                    <a href="<?php echo e(url('/deliveryboy/acceptall/').'/0'); ?>"
                                                       class="btn btn-primary mt-1"> Accept All</a>
                                                    <a href="<?php echo e(url('/deliveryboy/declineall/').'/0'); ?>"
                                                       class="btn btn-danger mt-1"> Decline All</a>
                                                <?php endif; ?>

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                        <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $product = \ZigKart\Models\Product::getProductid($order->user_id,$order->ord_id);
                                                $orderDetils = \ZigKart\Models\Product::getorderDetils($order->user_id,$order->ord_id);
                                            ?>
                                            <tr>

                                                <td><?php echo e($no); ?></td>
                                                <td><?php echo e($order->purchase_token); ?> </td>
                                                

                                                <td>
                                                    <?php if($order->enable_ship == 1): ?>
                                                        <?php echo e($order->ship_address); ?>

                                                        <?php echo e($order->ship_city); ?>

                                                        <?php echo e($order->ship_state); ?>

                                                        <?php echo e($order->ship_postcode); ?>

                                                    <?php else: ?>
                                                        <?php echo e($order->bill_address); ?>

                                                        <?php echo e($order->bill_city); ?>

                                                        <?php echo e($order->bill_state); ?>

                                                        <?php echo e($order->bill_postcode); ?>

                                                    <?php endif; ?>
                                                </td>

                                                <td><?php echo e($order->payment_date); ?></td>
                                                <td><?php echo e(str_replace("-"," ",$order->payment_type)); ?></td>
                                                
                                                
                                                <td><?php echo e(!empty($product) ? $product->product_name : ''); ?><br>

                                                </td>
                                                <td>
                                                    <b>Quantity</b>
                                                    : <?php echo e(!empty($orderDetils) ? $orderDetils->quantity : ''); ?> <br>
                                                    <b>Price</b> : <?php echo e(!empty($orderDetils) ? $orderDetils->price : ''); ?>

                                                    <br>
                                                </td>
                                                <td>
                                                    

                                                    <?php echo csrf_field(); ?>

                                                    <?php if($order->delivery_status == 0): ?>

                                                    <?php elseif($order->delivery_status == 1): ?>
                                                        <a href="<?php echo e(url('/deliveryboy/2/').'/'.$order->ord_id); ?>"
                                                           class="btn btn-primary mt-1"> Accept</a>
                                                        <a href="<?php echo e(url('/deliveryboy/3/').'/'.$order->ord_id); ?>"
                                                           class="btn btn-danger mt-1"> Decline</a>


                                                    <?php elseif($order->delivery_status == 2): ?>
                                                        <a href="<?php echo e(url('/deliveryboy/4/').'/'.$order->ord_id); ?>"
                                                           class="btn btn-warning mt-1"> Pickup</a>

                                                    <?php elseif($order->delivery_status == 4): ?>
                                                        <a href="<?php echo e(url('/deliveryboy/5/').'/'.$order->ord_id); ?>"
                                                           class="btn btn-success mt-1"> Delivered</a>

                                                    <?php elseif($order->delivery_status == 5): ?>

                                                        <button type="button" class="btn btn-success">Completed</button>

                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger">Cancel order</button>
                                                    <?php endif; ?>


                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>

                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    $('#selectAll').click(function (e) {
        var table = $(e.target).closest('table');
        $('td input:checkbox', table).prop('checked', this.checked);
    });
</script>
<script>
    

    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    

    
    
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\ecomm_multi\resources\views/deliveryboy/assign-orders.blade.php ENDPATH**/ ?>