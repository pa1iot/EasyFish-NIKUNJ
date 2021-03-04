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
    @if(in_array('products',$avilable))
    <div id="right-panel" class="right-panel">
       @include('admin.header')
       <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(3618,$translate) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
                </div>
            </div>
        </div>
        @if (session('success'))
        <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        @endif
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ Helper::translation(3618,$translate) }}</strong>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(1964,$translate) }}</th>
                                            <th>{{ Helper::translation(2077,$translate) }}</th>
                                            <th>{{ Helper::translation(3621,$translate) }}</th>
                                            <th>{{ Helper::translation(2109,$translate) }}</th>
                                            <th>{{ Helper::translation(2091,$translate) }}</th>
                                            <th>{{ Helper::translation(2080,$translate) }}</th>
                                            <th>{{ Helper::translation(3609,$translate) }}</th>
                                            <th>{{ Helper::translation(3624,$translate) }}</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($itemData['item'] as $order)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $order->purchase_token }} </td>
                                            <td><a href="{{ URL::to('/user') }}/{{ $order->username }}" target="_blank" class="blue-color">{{ $order->username }}</a></td>
                                            <td>{{ $allsettings->site_currency_symbol }}{{ $order->total }}  </td>
                                            <td>{{ $order->payment_date }}</td>
                                            <td>{{ str_replace("-"," ",$order->payment_type) }}</td>
                                            <td>@if($order->payment_token != ""){{ $order->payment_token }}@else <span>---</span> @endif</td>
                                            <td>@if(($order->payment_type == 'localbank' or  $order->payment_type == 'cash-on-delivery') && $order->payment_status == 'pending') <a href="orders/{{ base64_encode($order->purchase_token) }}/{{ base64_encode($order->payment_type) }}" class="blue-color"onClick="return confirm('Are you sure click to complete payment?');">{{ Helper::translation(3627,$translate) }}</a> @else <span>---</span> @endif</td>
                                            
                                            <td><a href="order-details/{{ $order->purchase_token }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>&nbsp; {{ Helper::translation(3477,$translate) }}</a></td>
                                        </tr>
                                        @php $no++; @endphp
                                   @endforeach     
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    @include('admin.denied')
    @endif 
   @include('admin.javascript')
</body>
</html>