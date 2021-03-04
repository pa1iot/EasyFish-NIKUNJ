<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ Helper::translation(2205,$translate) }}</title>
</head>
<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>{{ Helper::translation(2205,$translate) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p>{{ Helper::translation(2018,$translate) }} : {{ $from_name }}</p>   
                        <p>{{ Helper::translation(2014,$translate) }} : {{ $from_email }}</p>
                        <p>{{ Helper::translation(2136,$translate) }} : {{ $withdrawal }}</p>  
                        @if($withdrawal == 'paypal')<p>{{ Helper::translation(2129,$translate) }} : {{ $paypal_id }}</p>@endif
                        @if($withdrawal == 'stripe')<p>{{ Helper::translation(2130,$translate) }} : {{ $stripe_id }}</p>@endif 
                        @if($withdrawal == 'paystack')<p>{{ Helper::translation(2902,$translate) }} : {{ $paystack_email }}</p>@endif
                        @if($withdrawal == 'localbank')<p>{{ Helper::translation(2885,$translate) }} : {{ $bank_details }}</p>@endif           
                        <p>{{ Helper::translation(2131,$translate) }} : {{ $currency }}{{ $get_amount }}</p>    
                    </div>
                </div>
            </div>
        </div>
</section>
</body>
</html>