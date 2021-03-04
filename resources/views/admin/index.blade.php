<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
@include('admin.stylesheet')
</head>
<body>
@include('admin.navigation')
<!-- Right Panel -->
    @if(in_array('dashboard',$avilable))
    <div id="right-panel" class="right-panel">
       @include('admin.header')
       <div class="col-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-user bg-flat-color-5 p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">{{ Helper::translation(3474,$translate) }}</div>
                    <div class="h5 text-secondary mb-0 mt-1">{{ $total_customers }}</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="{{ url('/admin/customer') }}">{{ Helper::translation(3477,$translate) }} <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
   <div class="col-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-user bg-info p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">{{ Helper::translation(3480,$translate) }}</div>
                    <div class="h5 text-secondary mb-0 mt-1">{{ $total_vendors }}</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="{{ url('/admin/vendor') }}">{{ Helper::translation(3477,$translate) }} <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-user bg-warning p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">{{ Helper::translation(3483,$translate) }}</div>
                    <div class="h5 text-secondary mb-0 mt-1">{{ $sub_admin }}</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="{{ url('/admin/administrator') }}">{{ Helper::translation(3477,$translate) }} <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->
    <div class="col-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-location-arrow bg-danger p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">{{ Helper::translation(3486,$translate) }}</div>
                    <div class="h5 text-secondary mb-0 mt-1">{{ $total_products }}</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="{{ url('/admin/products') }}">{{ Helper::translation(3477,$translate) }} <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-location-arrow bg-flat-color-4 p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">{{ Helper::translation(3489,$translate) }}</div>
                    <div class="h5 text-secondary mb-0 mt-1">{{ $total_category }}</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="{{ url('/admin/category') }}">{{ Helper::translation(3477,$translate) }} <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->
    <div class="col-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-shopping-cart bg-flat-color-3 p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">{{ Helper::translation(3492,$translate) }}</div>
                    <div class="h5 text-secondary mb-0 mt-1">{{ $total_orders }}</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="{{ url('/admin/orders') }}">{{ Helper::translation(3477,$translate) }} <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
   <div class="col-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-location-arrow bg-flat-color-2 p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">{{ Helper::translation(3495,$translate) }}</div>
                    <div class="h5 text-secondary mb-0 mt-1">{{ $refund_request }}</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="{{ url('/admin/refund') }}">{{ Helper::translation(3477,$translate) }} <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-money bg-flat-color-1 p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">{{ Helper::translation(3498,$translate) }}</div>
                    <div class="h5 text-secondary mb-0 mt-1">{{ $withdrawal_request }}</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="{{ url('/admin/withdrawal') }}">{{ Helper::translation(3477,$translate) }} <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
            <div class="col-sm-8 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">{{ Helper::translation(3501,$translate) }} </h4>
                                <canvas id="team-chart"></canvas>
                            </div>
                        </div>
                    </div>   
          <div class="col-sm-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">{{ Helper::translation(1975,$translate) }} </h4>
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div><!-- /# card -->
                    </div>
        </div>
       <!-- .content -->
    </div><!-- /#right-panel -->
    @else
    @include('admin.denied')
    @endif
    <!-- Right Panel -->
    @include('admin.javascript')
    <script type="text/javascript">
	$(document).ready(function () {
    "use strict";
     var ctx = document.getElementById( "team-chart" );
    ctx.height = 150;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: [ "{{ $sixth_day }}", "{{ $fifth_day }}", "{{ $fourth_day }}", "{{ $third_day }}", "{{ $second_day }}", "{{ $first_day }}", "{{ $today }}" ],
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [ {
                data: [ {{ $view7 }} , {{ $view6 }}, {{ $view5 }}, {{ $view4 }} , {{ $view3 }} , {{ $view2 }} , {{ $view1 }} ],
                label: "sale",
                backgroundColor: 'rgba(0,103,255,.15)',
                borderColor: 'rgba(0,103,255,0.5)',
                borderWidth: 3.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(0,103,255,0.5)',
                    }, ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Montserrat',
                },


            },
            scales: {
                xAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                        } ],
                yAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Sales'
                    }
                        } ]
            },
            title: {
                display: false,
            }
        }
    } );
    var ctx = document.getElementById( "pieChart" );
    ctx.height = 300;
    var myChart = new Chart( ctx, {
        type: 'pie',
        data: {
            datasets: [ {
                data: [ {{ $approved }}, {{ $unapproved }} ],
                backgroundColor: [
                                    "rgba(6, 163, 61, 1)",
                                    "rgba(226, 27, 26, 1)"
                                    
                                    
                                ],
                hoverBackgroundColor: [
                                    "rgba(6, 163, 61, 0.7)",
                                    "rgba(226, 27, 26, 0.7)"
                                    
                                    
                                ]

                            } ],
            labels: [
                            "{{ Helper::translation(3504,$translate) }}",
                            "{{ Helper::translation(3507,$translate) }}"
                            
                        ]
        },
        options: {
            responsive: true
        }
    } );
    

});
</script>
</body>
</html>