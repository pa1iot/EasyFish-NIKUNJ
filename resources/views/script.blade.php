<script type="text/javascript" src="{{ URL::to('resources/views/template/js/jquery.min.js') }}"></script>
<script src="{{ URL::to('resources/views/template/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::to('resources/views/template/js/bootstrap.js') }}"></script>
<script src="{{ asset('resources/views/template/validate/jquery.bvalidator.min.js') }}"></script>
<script src="{{ asset('resources/views/template/validate/themes/presenters/default.min.js') }}"></script>
<script src="{{ asset('resources/views/template/validate/themes/red/red.js') }}"></script>
<link href="{{ asset('resources/views/template/validate/themes/red/red.css') }}" rel="stylesheet" />
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
<!-- page loader -->
@if($allsettings->site_loader_display == 1)
<script type="text/javascript" src="{{ URL::to('resources/views/template/loader/loader.js') }}"></script>
<script>
$(function(){
    var lb = new $.LoadingBox({loadingImageSrc: "{{ url('/') }}/public/storage/settings/{{ $allsettings->site_loader_image }}",});

        setTimeout(function(){
            lb.close();
        }, 1000);
});
</script>
@endif
<!-- page loader -->
<!-- google analytics -->
@if($allsettings->google_analytics!= "")
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
 
  ga('create', '{{ $allsettings->google_analytics }}', 'auto');
  ga('send', 'pageview');
</script>
@endif
<!-- google analytics -->
<!-- cookie -->
<script type="text/javascript" src="{{ asset('resources/views/template/cookie/cookiealert.js') }}"></script>
<!-- cookie -->