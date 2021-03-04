<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ Helper::translation(2153,$translate) }}</title>
</head>
<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>{{ Helper::translation(2153,$translate) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                    <h3>{{ Helper::translation(2154,$translate) }}</h3>
                    <p> {{ Helper::translation(2077,$translate) }} - {{ $purchase_token }}</p> 	
                    <p> {{ Helper::translation(1984,$translate) }} - <a href="{{ $url }}/product/{{ $product_slug }}">{{ $product_name }}</a></p> 	
                    <p> {{ Helper::translation(2137,$translate) }} - {{ $site_currency }}{{ $payment }}</p> 	
                    <p> {{ Helper::translation(2080,$translate) }} - {{ $payment_type }}</p> 
                    <p> {{ __('Payment Date') }} - {{ $payment_date }}</p> 
                     <br/>			
			         <h3>{{ Helper::translation(2155,$translate) }}</h3> 
                     <p> {{ Helper::translation(2156,$translate) }} - {{ $to_name }}</p> 
                     <p> {{ Helper::translation(2157,$translate) }} - {{ $to_email }}</p>     
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>