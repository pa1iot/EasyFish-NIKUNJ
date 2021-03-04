<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{ __('Newsletter Updates') }}</title>
</head>
<body class="preload dashboard-upload">
   <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>{{ __('Newsletter Updates') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p>Newsletter updates received. Please visit our website</p>   
                        
                        <p><strong> {{ Helper::translation(3774,$translate) }} : </strong>{{ $news_heading }}</p> 
                        <p><strong> {{ Helper::translation(3777,$translate) }} : </strong>{!! $news_content !!}</p>  
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>