<script type="text/javascript" src="<?php echo e(URL::to('resources/views/template/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/template/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/template/js/bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('resources/views/template/validate/jquery.bvalidator.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/views/template/validate/themes/presenters/default.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/views/template/validate/themes/red/red.js')); ?>"></script>
<link href="<?php echo e(asset('resources/views/template/validate/themes/red/red.css')); ?>" rel="stylesheet" />
<script type="text/javascript">
    $(document).ready(function () {
        "use strict";
		var options = {
		
		offset:              {x:5, y:-2},
		position:            {x:'left', y:'center'},
        themes: {
            'red': {
                 showClose: true
            },
	
        }
    };
    $('#login_form').bValidator(options);
	$('#contact_form').bValidator(options);
	$('#message_form').bValidator(options);
	$('#comment_form').bValidator(options);
	$('#search_form').bValidator(options);
	$('#footer_form').bValidator(options);
	$('#cart_form').bValidator(options);
	$('#coupon_form').bValidator(options);
	$('#checkout_form').bValidator(options);
	$('#refund_form').bValidator(options);
	$('#newsample_form').bValidator(options);
	$('#seller_form').bValidator(options);
	$('#track_form').bValidator(options);
	$('#reset_form').bValidator(options);
	$('#subscribe_form').bValidator(options);
	$('#conversation_form').bValidator(options);
    });
	$(function () {
	    $("#show_shipping").hide();
        $("#enable_shipping").click(function () {
            if ($(this).is(":checked")) {
                $("#show_shipping").show();
                } else {
                $("#show_shipping").hide();
                
            }
        });
    });
</script>
<!-------- Cart ---------->
<script type="text/javascript">
  $(document).ready(function() {
  $('.table-responsive-stack').each(function (i) {
  var id = $(this).attr('id');
  //alert(id);
  $(this).find("th").each(function(i) {
     $('#'+id + ' td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">'+ $(this).text() + ':</span> ');
     $('.table-responsive-stack-thead').hide();
  });
  });
  $( '.table-responsive-stack' ).each(function() {
  var thCount = $(this).find("th").length;
  var rowGrow = 100 / thCount + '%';
  //console.log(rowGrow);
  $(this).find("th, td").css('flex-basis', rowGrow);
  });
  function flexTable(){
  if ($(window).width() < 768) {
  $(".table-responsive-stack").each(function (i) {
  $(this).find(".table-responsive-stack-thead").show();
  $(this).find('thead').hide();
  });
  // window is less than 768px
  } else {
  $(".table-responsive-stack").each(function (i) {
  $(this).find(".table-responsive-stack-thead").hide();
  $(this).find('thead').show();
  });
  }
  // flextable
  }
  flexTable();
  window.onresize = function(event) {
  flexTable();
  };
  // document ready
  });
</script>
<!-------- Cart ---------->
<script src="<?php echo e(URL::to('resources/views/template/js/navigation.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/template/menu/menu.js')); ?>"></script>
<script type="text/javascript">
        $(document).ready(function () {
		   $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
</script>
<?php if($view_name == 'my-profile' or $view_name == 'add-product' or $view_name == 'edit-product'): ?>
<script src="<?php echo e(url('vendor/tinymce/jquery.tinymce.min.js')); ?>"></script>
<script src="<?php echo e(url('vendor/tinymce/tinymce.min.js')); ?>"></script>
<script>
  tinymce.init({
    
	selector: '#summary-ckeditor', 
    
		plugins : 'advlist anchor autolinkcharmap code colorpicker contextmenu fullscreen hr image insertdatetime link lists media pagebreak preview print searchreplace tabfocus table textcolor',
	toolbar: [
		'newdocument | print preview | searchreplace | undo redo | link unlink anchor image media | alignleft aligncenter alignright alignjustify | code',
		'formatselect fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor',
		'removeformat | hr pagebreak | charmap subscript superscript insertdatetime | bullist numlist | outdent indent blockquote | table'
	],
	menubar : false,
	browser_spellcheck : true,
	branding: false,
	width: '100%',
	height : "480"
    
 
  
  });

</script>
<?php $__currentLoopData = $alllang['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<script type="text/javascript">
tinymce.init({
    
	selector: '#summary-ckeditor<?php echo e($language->language_id); ?>', 
    
		plugins : 'advlist anchor autolinkcharmap code colorpicker contextmenu fullscreen hr image insertdatetime link lists media pagebreak preview print searchreplace tabfocus table textcolor',
	toolbar: [
		'newdocument | print preview | searchreplace | undo redo | link unlink anchor image media | alignleft aligncenter alignright alignjustify | code',
		'formatselect fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor',
		'removeformat | hr pagebreak | charmap subscript superscript insertdatetime | bullist numlist | outdent indent blockquote | table'
	],
	menubar : false,
	browser_spellcheck : true,
	branding: false,
	width: '100%',
	height : "480"
    
 
  
  });
</script>  
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if($view_name == 'index'): ?>
<!--- scroller -->
<script src="<?php echo e(URL::to('resources/views/template/scroller/swiper.js')); ?>"></script>
<!--- scroller -->
<?php endif; ?>
<!--- quick-view -->
<script src="<?php echo e(URL::to('resources/views/template/quick-view/quick.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/template/quick-view/script.js')); ?>"></script>
<!--- quick-view -->
<!--- auto search -->
<script src="<?php echo e(URL::to('resources/views/template/autosearch/jquery-ui.js')); ?>"></script>
<script type="text/javascript">
   $(document).ready(function() {
    src = "<?php echo e(route('searchajax')); ?>";
     $("#search_text").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                   
                }
            });
        },
        minLength: 1,
       
    });
});
$(function () {
	     
        $("#product_allow_seo").change(function () {
            if ($(this).val() == "1") {
                $("#ifseo").show();
            } else {
                $("#ifseo").hide();
            }
        });
		
		$("#flash_deals").change(function () {
            if ($(this).val() == "1") {
                $("#ifdeal").show();
            } else {
                $("#ifdeal").hide();
            }
        });
		
    });
	$(function () {
	    
        $("#product_type").change(function () {
            if ($(this).val() == "physical") 
			{
                $("#ifphysical_external").show();
				$("#ifphysical").show();
				$("#ifdigital").hide();
				$("#ifexternal").hide();
            } 
			else if($(this).val() == "external") 
			{
                 $("#ifphysical_external").show();
				 $("#ifphysical").hide();
				 $("#ifdigital").hide();
				 $("#ifexternal").show();
            }
			else if($(this).val() == "digital")
			{
			   $("#ifphysical_external").hide();
			   $("#ifphysical").hide();
			   $("#ifdigital").show();
			   $("#ifexternal").hide();
			}
			else
			{
			   $("#ifphysical_external").hide();
			   $("#ifphysical").hide();
			   $("#ifdigital").hide();
			   $("#ifexternal").hide();
			}
        });
    });
</script>
<!--- auto search -->
<!--- count down timer -->
<script type="text/javascript" src="<?php echo e(URL::to('resources/views/template/countdown/jquery.downCount.js')); ?>"></script>
<?php if(count($deal['product']) != 0): ?>
<?php $__currentLoopData = $deal['product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<script type="text/javascript">
$(document).ready(function() { 
    
	$('.countdown-<?php echo e($product->product_token); ?>').downCount({
		date: '<?php echo e(date("m/d/Y H:i:s", strtotime($product->flash_deal_end_date))); ?>',
  offset: +1
	});
});
</script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<!--- count down timer --> 
<!--- brands -->
<script type="text/javascript" src="<?php echo e(URL::to('resources/views/template/brands/script.js')); ?>"></script>
<script id="rendered-js">
$(document).ready(function () {
  $('#client-logos').owlCarousel({
    loop: true,
	rtl:true,
    margin: 15,
    nav: true,
    responsive: {
      0: {
        items: 2 },

      600: {
        items: 4 },

      1000: {
        items: 8 } },
     navText: ["<img src='<?php echo e(url('/')); ?>/resources/views/template/brands/left.png'/>", "<img src='<?php echo e(url('/')); ?>/resources/views/template/brands/right.png'/>"] });


});
</script>
<!--- brands -->
<!-- page loader -->
<?php if($allsettings->site_loader_display == 1): ?>
<script type="text/javascript" src="<?php echo e(URL::to('resources/views/template/loader/loader.js')); ?>"></script>
<script>
$(function(){
      var lb = new $.LoadingBox({loadingImageSrc: "<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_loader_image); ?>",});

        setTimeout(function(){
            lb.close();
        }, 1000);
});
</script>
<?php endif; ?>
<!-- page loader -->
<!-- share -->
<script src="<?php echo e(URL::to('resources/views/template/share/share.js')); ?>"></script> 
<script type="text/javascript">
	$(document).ready(function(){
        
		$('.share-button').simpleSocialShare();

	});
</script> 
<!-- share -->
<!-- pagination -->
<script src="<?php echo e(URL::to('resources/views/template/pagination/pagination.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
	 $(this).cPager({
            pageSize: <?php echo e($allsettings->post_per_page); ?>, 
            pageid: "post-pager", 
            itemClass: "li-item",
			pageIndex: 1
 
        });
	$(this).cPager({
            pageSize: <?php echo e($allsettings->product_per_page); ?>, 
            pageid: "itempager", 
            itemClass: "prod-item",
			pageIndex: 1
 
        });	
   });
</script>
<!--- pagination -->
<!-- datatable -->
<script src="<?php echo e(URL::to('resources/views/admin/template/vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/admin/template/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/admin/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/admin/template/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/admin/template/vendors/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/admin/template/vendors/datatables.net-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/admin/template/vendors/datatables.net-buttons/js/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/admin/template/assets/js/init-scripts/data-table/datatables-init.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::to('resources/views/admin/template/picker/jquery-ui-timepicker-addon.js')); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#flash_deal_start_date").datetimepicker({
    timeFormat: "hh:mm tt", minDate: 0, dateFormat: 'yy-mm-dd',
    onSelect: function (selected) {
      var dt = new Date(selected);
      dt.setDate(dt.getDate() + 1);
 $("#flash_deal_end_date").datetimepicker("option", "minDate", dt);
}                                 
});
  $("#flash_deal_end_date").datetimepicker({
    timeFormat: "hh:mm tt", minDate: 0, dateFormat: 'yy-mm-dd',
    onSelect: function (selected) {
      var dt1 = new Date(selected);
      dt1.setDate(dt1.getDate() - 1);
      $("#flash_deal_start_date").datetimepicker("option", "maxDate", dt1);
    }
  });
});
</script>
<!-- datatable -->
<!--- filter -->
<script src="<?php echo e(URL::to('resources/views/template/filter/jplist.core.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/template/filter/jplist.sort-bundle.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/template/filter/jplist.textbox-filter.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/template/filter/jplist.filter-toggle-bundle.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('resources/views/template/filter/jplist.pagination-bundle.min.js')); ?>"></script>
<script type="text/javascript">
        $('document').ready(function(){
             
            $('#demo').jplist({
                itemsBox: '.list'
                ,itemPath: '.list-item'
                ,panelPath: '.jplist-panel'

            });
        });
</script>
<!--- filter -->
<!--- product-carousel -->
<script src="<?php echo e(URL::to('resources/views/template/product-carousel/js/lightslider.js')); ?>"></script>
<script>
    $(document).ready(function() {
	         
			 $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:9,
                slideMargin: 0,
                speed:500,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
		});
</script>
<!--- swiper -->
<!--- video popup -->
<script src="<?php echo e(URL::to('resources/views/template/video/YouTubePopUp.jquery.js')); ?>"></script>
<script type="text/javascript">
		jQuery(function(){
			jQuery("a.bla-2").YouTubePopUp( { autoplay: 0 } ); // Disable autoplay
		});
</script>
<!--- video popup -->
<!-- withdrawal code -->
<script>
$(function () {
$("#ifstripe").hide();
$("#ifpaystack").hide();
$("#iflocalbank").hide();
        $("input[name='withdrawal']").click(function () {
		
            if ($("#withdrawal-paypal").is(":checked")) 
			{
			   $("#ifpaypal").show();
			   $("#ifstripe").hide();
			   $("#ifpaystack").hide();
			   $("#iflocalbank").hide();
			}
			else if ($("#withdrawal-stripe").is(":checked"))
			{
			  $("#ifpaypal").hide();
			  $("#ifstripe").show();
			  $("#ifpaystack").hide();
			  $("#iflocalbank").hide();
			}
			else if ($("#withdrawal-paystack").is(":checked"))
			{
			  $("#ifpaypal").hide();
			  $("#ifstripe").hide();
			  $("#ifpaystack").show();
			  $("#iflocalbank").hide();
			}
			else if ($("#withdrawal-localbank").is(":checked"))
			{
			  $("#ifpaypal").hide();
			  $("#ifstripe").hide();
			  $("#ifpaystack").hide();
			  $("#iflocalbank").show();
			}
			else
			{
			$("#ifpaypal").hide();
			$("#ifstripe").hide();
			$("#ifpaystack").hide();
			$("#iflocalbank").hide();
			}
		});
    });
</script>
<!-- withdrawal code -->
<!-- google analytics -->
<?php if($allsettings->google_analytics!= ""): ?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
 
  ga('create', '<?php echo e($allsettings->google_analytics); ?>', 'auto');
  ga('send', 'pageview');
</script>
<?php endif; ?>
<!-- google analytics -->
<!-- cookie -->
<script type="text/javascript" src="<?php echo e(asset('resources/views/template/cookie/cookiealert.js')); ?>"></script>
<!-- cookie --><?php /**PATH D:\xampp\htdocs\zigkart\resources\views/javascript.blade.php ENDPATH**/ ?>