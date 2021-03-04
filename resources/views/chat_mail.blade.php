<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ Helper::translation(2934,$translate) }}</title>
</head>
<body class="preload dashboard-upload">
 <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>{{ Helper::translation(2934,$translate) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
               <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p><strong> {{ Helper::translation(2018,$translate) }} : </strong> {{ $from_name }}</p>   
                        <p><strong> {{ Helper::translation(2014,$translate) }} : </strong> {{ $from_email }}</p>
                        <p><strong> {{ Helper::translation(2126,$translate) }} : </strong> {{ $conver_text }}</p>
                        <p><strong> {{ Helper::translation(2076,$translate) }} : {{ $conver_order_id }}</p> 
                        <p><strong> {{ Helper::translation(2937,$translate) }} : </strong> <a href="{{ $conversation_url }}">{{ $conversation_url }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>