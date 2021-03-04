<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ Helper::translation(2202,$translate) }}</title>
</head>
<body class="preload dashboard-upload">
        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>{{ Helper::translation(2203,$translate) }} {{ $from_name }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p><strong> {{ Helper::translation(2202,$translate) }}</strong></p>
                        <p>{{ Helper::translation(2018,$translate) }} : {{ $from_name }}</p>   
                        <p>{{ Helper::translation(2014,$translate) }} : {{ $from_email }}</p>
                        <p>{{ Helper::translation(2002,$translate) }} : {{ $phone }}</p>
                        <p>{{ Helper::translation(2126,$translate) }} : {{ $message_text }}</p>    
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>