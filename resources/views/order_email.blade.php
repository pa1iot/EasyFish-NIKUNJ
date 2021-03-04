<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ Helper::translation(2141,$translate) }}</title>
</head>
<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>{{ Helper::translation(2141,$translate) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                    <p> {{ Helper::translation(2076,$translate) }} - {{ $order_id }}</p> 	
                    <p> {{ Helper::translation(2018,$translate) }} - {{ $name }}</p> 	
                    <p> {{ Helper::translation(2014,$translate) }} - {{ $email }}</p> 	
                    <p> {{ Helper::translation(2002,$translate) }} - {{ $phone }}</p> 
                    <p> {{ Helper::translation(2137,$translate) }} - {{ $site_currency }}{{ $amount }}</p> 
                </div>
               </div>
            </div>
        </div>
    </section>
</body>
</html>