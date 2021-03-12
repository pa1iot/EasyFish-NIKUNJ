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
                        <h1><?php echo e(Helper::translation(2154,$translate)); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="<?php echo e(url('/admin/orders')); ?>" class="btn btn-success btn-sm"><i class="fa fa-chevron-left"></i> <?php echo e(Helper::translation(2088,$translate)); ?></a>
                        </ol>
                    </div>
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
                                <strong class="card-title"><?php echo e(Helper::translation(2154,$translate)); ?></strong>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(Helper::translation(1964,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2077,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2076,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(1928,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2112,$translate)); ?></th>
                                            <?php if($allsettings->type_of_marketplace == 'multi-vendor'): ?>
                                            <th><?php echo e(Helper::translation(3585,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3588,$translate)); ?></th>
                                            <?php endif; ?>
                                            <th><?php echo e(Helper::translation(2109,$translate)); ?><br/><small class="red-color">(<?php echo e(Helper::translation(3591,$translate)); ?>)</small></th>
                                            <th><?php echo e(Helper::translation(2098,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(2082,$translate)); ?></th>
                                            <th><?php echo e(Helper::translation(3594,$translate)); ?></th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($no); ?></td>
                                            <td><?php echo e($order->purchase_token); ?> </td>
                                            <td><?php echo e($order->ord_id); ?> </td>
                                            <td><?php echo e($order->product_name); ?> </td>
                                            <td><a href="<?php echo e(URL::to('/user')); ?>/<?php echo e($order->username); ?>" target="_blank" class="blue-color"><?php echo e($order->username); ?></a></td>
                                            <?php if($allsettings->type_of_marketplace == 'multi-vendor'): ?>
                                            <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order->vendor_amount); ?> </td>
                                            <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order->admin_amount); ?> </td>
                                            <?php endif; ?>
                                            <td><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($order->subtotal); ?> </td>
                                            <td>
                                            <?php if($order->product_type == 'physical'): ?>
                                            <form action="<?php echo e(route('admin.order-track')); ?>" class="setting_form" method="post" enctype="multipart/form-data">
                                            <?php echo e(csrf_field()); ?>

                                            <select class="form-control" id="order_track" name="order_track[]" required>
                                            <option value="<?php echo e($track_placed); ?>" <?php if($order->order_tracking == $track_placed): ?> selected <?php endif; ?>><?php echo e($track_placed); ?></option>
                                            <option value="<?php echo e($track_packed); ?>" <?php if($order->order_tracking == $track_packed): ?> selected <?php endif; ?>><?php echo e($track_packed); ?></option>
                                            <option value="<?php echo e($track_shipped); ?>" <?php if($order->order_tracking == $track_shipped): ?> selected <?php endif; ?>><?php echo e($track_shipped); ?></option>
                                            <option value="<?php echo e($track_delivered); ?>" <?php if($order->order_tracking == $track_delivered): ?> selected <?php endif; ?>><?php echo e($track_delivered); ?></option>
                                            </select>
                                            <input type="hidden" name="order_id[]" value="<?php echo e($order->ord_id); ?>">
                                            <input type="submit" class="btn btn-success btn-sm" value="Update">
                                            </form>
                                            <?php endif; ?>
                                            </td>
                                            <td><?php if($order->order_status == 'completed'): ?> <span class="badge badge-success">Completed</span> <?php else: ?> <span class="badge badge-danger">Pending</span> <?php endif; ?></td>
                                            <td>
                                            <?php if($order->payment_status == '' && $order->order_status == 'completed'): ?>
                                            <a href="<?php echo e(URL::to('/admin/order-details')); ?>/<?php echo e($order->ord_id); ?>/vendor" class="btn btn-success btn-sm" title="payment released to vendor" onClick="return confirm('Are you sure you will payment released to vendor?');"><i class="fa fa-money"></i>&nbsp; <?php echo e(Helper::translation(3600,$translate)); ?></a>
                                            <a href="<?php echo e(URL::to('/admin/order-details')); ?>/<?php echo e($order->ord_id); ?>/buyer" class="btn btn-danger btn-sm" title="payment released to buyer" onClick="return confirm('Are you sure you will payment released to buyer?');"><i class="fa fa-close"></i>&nbsp; <?php echo e(Helper::translation(3606,$translate)); ?></a>
                                            <?php else: ?>
                                            <?php echo e($order->payment_status); ?>

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
                    <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" v-if="headerText"><?php echo e(Helper::translation(2083,$translate)); ?></strong>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-align-middle mb-0">

                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2077,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->purchase_token); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(3609,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->payment_token); ?>

                                        </td>
                                    </tr>
                                   <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2080,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e(str_replace("-"," ",$single_data->payment_type)); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2091,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->payment_date); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2090,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($single_data->shipping_price); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(3612,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($single_data->processing_fee); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(3615,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($single_data->subtotal); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2093,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($single_data->total); ?>

                                        </td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" v-if="headerText"><?php echo e(Helper::translation(1997,$translate)); ?></strong>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-align-middle mb-0">

                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(1998,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->bill_firstname); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(1999,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->bill_lastname); ?>

                                        </td>
                                    </tr>
                                   <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2000,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->bill_companyname); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2014,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->bill_email); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2002,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->bill_phone); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2007,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($billcountry_name); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2003,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->bill_address); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2096,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->bill_city); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2005,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->bill_state); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2006,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->bill_postcode); ?>

                                        </td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" v-if="headerText"><?php echo e(Helper::translation(2095,$translate)); ?></strong>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-align-middle mb-0">

                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(1998,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->ship_firstname); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(1999,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->ship_lastname); ?>

                                        </td>
                                    </tr>
                                   <tr>
                                        <td>
                                            <?php echo e(Helper::translation(1999,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->ship_companyname); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2014,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->ship_email); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2002,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->ship_phone); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2007,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($shipcountry_name); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2003,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->ship_address); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2096,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->ship_city); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2005,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->ship_state); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo e(Helper::translation(2006,$translate)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($single_data->ship_postcode); ?>

                                        </td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" v-if="headerText"><?php echo e(Helper::translation(2009,$translate)); ?></strong>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-align-middle mb-0">

                                <tbody>
                                    <tr>
                                        <td>
                                           	<?php echo nl2br($single_data->other_notes); ?>
                                        </td>
                                    </tr>

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
</html>
<?php /**PATH C:\xampp\htdocs\ecomm_multi\resources\views/admin/order-details.blade.php ENDPATH**/ ?>