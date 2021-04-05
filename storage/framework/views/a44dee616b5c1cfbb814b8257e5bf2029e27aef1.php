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
                                <form method="post" action="<?php echo e(url('/admin/save-assign-orders')); ?>">
                                <?php echo csrf_field(); ?>


                                <div class="row">

                                    <div class="col-sm-3">
                                        <label>Assign Delivery Boy</label>
                                    <select class="form-control" name="deliveryboy_user_id" required>
                                        <option value="">Select Delivery Boy</option>
                                        <?php $__currentLoopData = $itemData['deliveryboy']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option  value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary">Assign Order</button>
                                    </div>
                                </div>
                                <br>

                              <div class="table-responsive">

                                  <div class="row">
                                      <div class="col-sm-9 mb-2"></div>
                                  <div class="col-sm-3 mb-2">
                                      <label>Filter <a  href="<?php echo e(url('admin/assign-orders')); ?>"><i class="fa fa-recycle"></i></a></label>

                                      <select class="form-control" name="filter"  onchange="filterposcode(this.value);">
                                          <option value="">Filter Postcode </option>
                                          <?php $__currentLoopData = $itemData['postcodes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option <?php if(!empty(Request::segment(3))): ?> <?php echo e(Request::segment(3) == $value->bill_postcode ? 'selected' : ''); ?>    <?php endif; ?> value="<?php echo e($value->bill_postcode); ?>"><?php echo e($value->bill_postcode); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                  </div>
                                  </div>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll">All</th>
                                            <th><?php echo e(Helper::translation(1964,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2077,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3621,$translate)); ?></th>
                                            <th>Address </th>

                                            <th><?php echo e(Helper::translation(2091,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2080,$translate)); ?></th>



                                            <th>ProductName</th>
                                            <th><?php echo e(Helper::translation(2109,$translate)); ?></th>

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
                                            <td><?php if($orderDetils->delivery_status == 0 ): ?> <input type="checkbox" name="assign_arr[]" value="<?php echo e($order->ord_id); ?>"> <?php else: ?> assigned <?php endif; ?></td>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e($order->purchase_token); ?> </td>
                                            <td><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($order->username); ?>" target="_blank" class="blue-color"><?php echo e($order->name); ?></a></td>

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
                                                <b>Quantity</b> : <?php echo e(!empty($orderDetils) ? $orderDetils->quantity : ''); ?> <br>
                                                <b>Price</b> : <?php echo e(!empty($orderDetils) ? $orderDetils->price : ''); ?> <br>
                                                <b>Discount</b> : <?php echo e(!empty($orderDetils) ? $orderDetils->price - $orderDetils->discount_price : ''); ?> <br>
                                                <b>ShippingPrice</b> : <?php echo e(!empty($orderDetils) ? $orderDetils->shipping_price : ''); ?> <br>
                                                <hr>
                                                <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order->total); ?>

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
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
   <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    $('#selectAll').click(function(e){
        var table= $(e.target).closest('table');
        $('td input:checkbox',table).prop('checked',this.checked);
    });
</script>
<script>
    function filterposcode(val) {
        window.location='<?php echo e(url('admin/assign-orders')); ?>/'+val;
    }
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\ecomm_multi\resources\views/admin/assign-orders.blade.php ENDPATH**/ ?>