<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo e(Helper::translation(2142,$translate)); ?> - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="headerbg" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_header_background); ?>');">
      <div class="container text-left">
        <h2 class="mb-0"><?php echo e(Helper::translation(2142,$translate)); ?></h2>
        <p class="mb-0"><a href="<?php echo e(URL::to('/')); ?>"><?php echo e(Helper::translation(1913,$translate)); ?></a> <span class="split">&gt;</span> <span><?php echo e(Helper::translation(2142,$translate)); ?></span></p>
      </div>
    </section>
  <main role="main">
      <div class="container page-white-box mt-3">
         <div class="row">
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1" align="center">
         	   <div class="form-row mt-4 mb-4">
                <div class="col fs20">
                  <label class="mt-2 mb-2"><?php echo e(Helper::translation(2090,$translate)); ?> <span>:</span> <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($ship_rate); ?></label><br/>
                  <?php if($allsettings->site_processing_fee != 0): ?>
                  <label class="mt-2 mb-2"><?php echo e(Helper::translation(1993,$translate)); ?> <span>:</span> <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($allsettings->site_processing_fee); ?></label><br/>
                  <?php endif; ?>
                  <label class="mt-2 mb-2"><?php echo e(Helper::translation(2143,$translate)); ?> <span>:</span> <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($sub_total); ?></label><br/>
                  <label class="mt-2 mb-2"><?php echo e(Helper::translation(1986,$translate)); ?> <span>:</span> <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($total_price); ?></label>
                <?php if($payment_method=="paypal"): ?>
                <?php $encrypted = $encrypter->encrypt($purchase_token); ?>
                <br/><a href="<?php echo e(route('payment')); ?>" class="btn button-color"><?php echo e(Helper::translation(2866,$translate)); ?></a>
                <?php /*?><form action="{{ route('confirm-paypal') }}" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="paypal_url" value="{{ $paypal_url }}">
                <input type="hidden" name="paypal_email" value="{{ $paypal_email }}">
                <input type="hidden" name="product_names" value="{{ $product_names }}">
                <input type="hidden" name="purchase_token" value="{{ $purchase_token }}">
                <input type="hidden" name="total_price" value="{{ base64_encode($total_price) }}">
                <input type="hidden" name="site_currency" value="{{ $site_currency }}">
                <input type='hidden' name='cancel' value='{{ $website_url }}/cancel'>
		        <input type='hidden' name='return' value='{{ $website_url }}/success/{{ base64_encode($purchase_token) }}'>
		        <input type="submit" name="submit" value="{{ Helper::translation(2866,$translate) }}" class="btn button-color">
                </form><?php */?>
	            <?php endif; ?>
                <?php if($payment_method=="stripe"): ?>
		        <?php $totalprice = $total_price * 100; ?>
		        <form action="<?php echo e(route('stripe-success')); ?>" method="POST">
	            <?php echo e(csrf_field()); ?>

	            <input type="hidden" name="ord_token" value="<?php echo e($purchase_token); ?>">
	            <input type="hidden" name="amount" value="<?php echo e(base64_encode(round($totalprice))); ?>">
	            <input type="hidden" name="currency_code" value="<?php echo e($site_currency); ?>">
	            <input type="hidden" name="item_name" value="<?php echo e($product_names); ?>">
                <script src="https://checkout.stripe.com/checkout.js" 
                class="stripe-button" 
                <?php if($stripe_mode == 0): ?>
                data-key="<?php echo e($allsettings->test_publish_key); ?>" 
                <?php else: ?>
                data-key="<?php echo e($allsettings->live_publish_key); ?>" 
                <?php endif; ?> 
                data-image="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_logo); ?>" 
                data-name="<?php echo e($product_names); ?>" 
                data-description="<?php echo e($allsettings->site_title); ?>"
                data-amount="<?php echo e(base64_encode(round($totalprice))); ?>"
                data-currency="<?php echo e($site_currency); ?>"
                />
                </script>
	            </form>
	            <?php endif; ?>
                <?php if($payment_method=="mollie"): ?>
                <br/><a href="<?php echo e(URL::to('/mollie-payment')); ?>" class="btn button-color"><?php echo e(Helper::translation(2866,$translate)); ?></a>
                <?php endif; ?>
                <?php if($payment_method=="2checkout"): ?>
                <div class="row justify-content-center pb-5 mb-5 mt-3 pt-3">
                <div class="col-md-6 mx-auto">
                    <div class="card bg-light mb-3">
                <div class="background-color text-black text-uppercase"><i class="fa fa-money"></i> <?php echo e(Helper::translation(2860,$translate)); ?></div>
                <div class="card-body">
                <form action="<?php echo e(route('2checkout')); ?>" class="needs-validation" id="subscribe_form" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                   <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(2861,$translate)); ?> <span class="red">*</span></label>
                                        <input id="ccNo" type="text" size="20" value="" class="form-control" autocomplete="off" data-bvalidator="required" placeholder="<?php echo e(Helper::translation(2862,$translate)); ?>" />
                                    </div>
                                </div>
                                
                            </div>
                       <div class="row">
                       <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(2863,$translate)); ?> <span class="red">*</span></label>
                                        <input type="number" size="2" id="expMonth" class="form-control" data-bvalidator="required,maxlen[2]" placeholder="MM" />
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(2864,$translate)); ?> <span class="red">*</span></label>
                                        <input type="number" size="4" id="expYear" class="form-control" data-bvalidator="required,maxlen[4]" placeholder="YYYY" />
                                    </div>
                                </div>
                                </div>     
                     <div class="row">
                       <div class="col-sm-12">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(2865,$translate)); ?> <span class="red">*</span></label>
                                        <input id="cvv" size="4" type="number" class="form-control" value="" autocomplete="off" data-bvalidator="required,maxlen[4]" />
                                    </div>
                                </div>
                                </div>
                                <input type="hidden" name="two_checkout_private" value="<?php echo e($two_checkout_private); ?>">
                                <input type="hidden" name="two_checkout_account" value="<?php echo e($two_checkout_account); ?>">
                                <input type="hidden" name="two_checkout_mode" value="<?php echo e($two_checkout_mode); ?>">
                                <input type="hidden" name="purchase_token" value="<?php echo e($purchase_token); ?>">
                                <input type="hidden" name="token" value="<?php echo e($token); ?>">
                                <input type="hidden" name="site_currency" value="<?php echo e($site_currency); ?>">
                                <input type="hidden" name="amount" value="<?php echo e(base64_encode($total_price)); ?>">
                                <input type="hidden" name="product_names" value="<?php echo e($product_names); ?>">
                                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                <input type="hidden" name="user_name" value="<?php echo e(Auth::user()->name); ?>">
                                <input type="hidden" name="user_email" value="<?php echo e(Auth::user()->email); ?>">
                                <div class="mx-auto">
                        <button type="submit" class="btn button-color"><?php echo e(Helper::translation(2866,$translate)); ?></button>
                        </div>
                   </form>
                   </div>
                   </div>
                   </div>
                   </div>
                   
                <?php endif; ?>
                <?php if($payment_method=="authorize.net"): ?>
                <div class="row justify-content-center pb-5 mb-5 mt-3 pt-3">
                <div class="col-md-6 mx-auto">
                    <div class="card bg-light mb-3">
                <div class="background-color text-black text-uppercase"><i class="fa fa-money"></i> <?php echo e(Helper::translation(2860,$translate)); ?></div>
                <div class="card-body">
                <form action="<?php echo e(url('charge')); ?>" class="needs-validation" id="subscribe_form" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                   <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(2861,$translate)); ?> <span class="red">*</span></label>
                                        <input id="cc_number" name="cc_number" type="text" size="20" value="" class="form-control" autocomplete="off" data-bvalidator="required" placeholder="<?php echo e(Helper::translation(2862,$translate)); ?>" />
                                    </div>
                                </div>
                                
                            </div>
                       <div class="row">
                       <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(2863,$translate)); ?> <span class="red">*</span></label>
                                        <input type="number" size="2" id="expiry_month" name="expiry_month" class="form-control" data-bvalidator="required,maxlen[2]" placeholder="MM" />
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(2864,$translate)); ?> <span class="red">*</span></label>
                                        <input type="number" size="4" id="expiry_year" name="expiry_year" class="form-control" data-bvalidator="required,maxlen[4]" placeholder="YYYY" />
                                    </div>
                                </div>
                                </div>     
                     <div class="row">
                       <div class="col-sm-12">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo e(Helper::translation(2865,$translate)); ?> <span class="red">*</span></label>
                                        <input id="cvv" name="cvv" size="4" type="number" class="form-control" value="" autocomplete="off" data-bvalidator="required,maxlen[4]" />
                                    </div>
                                </div>
                                </div>
                                <input type="hidden" name="purchase_token" value="<?php echo e($purchase_token); ?>">
                                <input type="hidden" name="token" value="<?php echo e($token); ?>">
                                <input type="hidden" name="site_currency" value="<?php echo e($site_currency); ?>">
                                <input type="hidden" name="amount" value="<?php echo e(base64_encode($total_price)); ?>">
                                <input type="hidden" name="product_names" value="<?php echo e($product_names); ?>">
                                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                <input type="hidden" name="user_name" value="<?php echo e(Auth::user()->name); ?>">
                                <input type="hidden" name="user_email" value="<?php echo e(Auth::user()->email); ?>">
                                <div class="mx-auto">
                        <button type="submit" class="btn button-color"><?php echo e(Helper::translation(2866,$translate)); ?></button>
                        </div>
                   </form>
                   </div>
                   </div>
                   </div>
                   </div>
                 <?php endif; ?>
                 <?php if($payment_method=="razorpay"): ?>
                 <form method="POST" action="<?php echo e(route('confirm-razorpay')); ?>" accept-charset="UTF-8" class="form-horizontal" role="form">
                 <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="purchase_token" value="<?php echo e($purchase_token); ?>">
                        <input type="hidden" name="token" value="<?php echo e($token); ?>">
                        <input type="hidden" name="site_currency" value="<?php echo e($site_currency); ?>">
                        <input type="hidden" name="amount" value="<?php echo e(base64_encode($total_price)); ?>">
                        <input type="hidden" name="product_names" value="<?php echo e($product_names); ?>">
                        <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                        <input type="hidden" name="user_name" value="<?php echo e(Auth::user()->name); ?>">
                        <input type="hidden" name="user_email" value="<?php echo e(Auth::user()->email); ?>">
                        <input type="hidden" name="website_url" value="<?php echo e(url('/')); ?>">
                        <input type="hidden" name="payment_method" value="razorpay">
                        <input type="hidden" name="ship_rate" value="<?php echo e(base64_encode($ship_rate)); ?>">
                        <input type="hidden" name="sub_total" value="<?php echo e(base64_encode($sub_total)); ?>">  
                        <button class="btn button-color" type="submit"><?php echo e(Helper::translation(2866,$translate)); ?></button>
                 </form>
                <?php endif; ?>
                 <?php if($payment_method=="paystack"): ?>
                 <form method="POST" action="<?php echo e(route('confirm-paystack')); ?>" accept-charset="UTF-8" class="form-horizontal" role="form">
                 <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="email" value="<?php echo e(Auth::user()->email); ?>"> 
                        <input type="hidden" name="purchase_token" value="<?php echo e($purchase_token); ?>">
                        <input type="hidden" name="amount" value="<?php echo e(base64_encode($total_price)); ?>"> 
                        <input type="hidden" name="site_currency" value="<?php echo e($site_currency); ?>">
                        <input type="hidden" name="reference" value="<?php echo e(Paystack::genTranxRef()); ?>"> 
                        <button class="btn button-color" type="submit"><?php echo e(Helper::translation(2866,$translate)); ?></button>
                 </form>
                <?php endif; ?>
                <?php if($payment_method=="localbank"): ?>
                <form method="POST" action="<?php echo e(route('confirm-bank')); ?>" accept-charset="UTF-8" class="form-horizontal" role="form">
                 <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="purchase_token" value="<?php echo e($purchase_token); ?>">
                        <button class="btn button-color" type="submit"><?php echo e(Helper::translation(2866,$translate)); ?></button>
                 </form>
                <?php endif; ?>
                <?php if($payment_method=="cash-on-delivery"): ?>
                <form method="POST" action="<?php echo e(route('confirm-cod')); ?>" accept-charset="UTF-8" class="form-horizontal" role="form">
                 <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="purchase_token" value="<?php echo e($purchase_token); ?>">
                        <button class="btn button-color" type="submit"><?php echo e(Helper::translation(2866,$translate)); ?></button>
                 </form>
                <?php endif; ?>
                </div>
              </div>
           </div>
         </div>
      </div>
    </main>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($payment_method=="2checkout"): ?>
<!--- 2Checkout --->
<script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
<script>
            
			
			
            var successCallback = function(data) {
                var myForm = document.getElementById('subscribe_form');

                
                myForm.token.value = data.response.token.token;

                
                myForm.submit();
            };

           
            var errorCallback = function(data) {
                if (data.errorCode === 200) {
                    tokenRequest();
                } else {
                    alert(data.errorMsg);
                }
            };

            var tokenRequest = function() {
                
                var args = {
                    sellerId: "<?php echo e($two_checkout_account); ?>",
                    publishableKey: "<?php echo e($two_checkout_publishable); ?>",
                    ccNo: $("#ccNo").val(),
                    cvv: $("#cvv").val(),
                    expMonth: $("#expMonth").val(),
                    expYear: $("#expYear").val()
					
                };

               
                TCO.requestToken(successCallback, errorCallback, args);
            };
			
			

            $(function() {
			
			  
                
                TCO.loadPubKey('sandbox');

                $("#subscribe_form").submit(function(e) {
                    
                    tokenRequest();

                    
                    return false;
                });
				
				
				
				
            });
			
			
			
 </script>
<!-- 2Checkout --->
<?php endif; ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\ecomm_multi\resources\views/order-confirm.blade.php ENDPATH**/ ?>