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
<div id="right-panel" class="right-panel">
@include('admin.header')
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(3576,$translate) }}</h1>
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
                                <strong class="card-title">{{ Helper::translation(3576,$translate) }}</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(1964,$translate) }}</th>
                                            <th>{{ Helper::translation(2135,$translate) }}</th>
                                            <th>{{ Helper::translation(2101,$translate) }}</th>
                                            <th>{{ Helper::translation(2136,$translate) }}</th>
                                            <th>{{ Helper::translation(3831,$translate) }}</th>
                                            <th>{{ Helper::translation(3834,$translate) }}</th>
                                            <th>{{ Helper::translation(3837,$translate) }}</th>
                                            <th width="200">{{ Helper::translation(2885,$translate) }}</th>
                                            <th>{{ Helper::translation(2137,$translate) }}</th>
                                            <th>{{ Helper::translation(1915,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($itemData['item'] as $withdraw)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $withdraw->withdraw_date }} </td>
                                            <td><a href="{{ URL::to('/user') }}/{{ $withdraw->username }}" target="_blank" class="blue-color">{{ $withdraw->username }}</a></td>
                                            <td>{{ $withdraw->withdraw_payment_type }} </td>
                                            <td>@if($withdraw->paypal_id != "") {{ $withdraw->paypal_id }} @else <span>---</span> @endif</td>
                                            <td>@if($withdraw->stripe_id != "") {{ $withdraw->stripe_id }} @else <span>---</span> @endif</td>
                                            <td>@if($withdraw->paystack_email != "") {{ $withdraw->paystack_email }} @else <span>---</span> @endif</td>
                                            <td width="200">@if($withdraw->bank_details != "") @php echo nl2br($withdraw->bank_details); @endphp @else <span>---</span> @endif</td>
                                            <td>{{ $allsettings->site_currency_symbol }}{{ $withdraw->withdraw_amount }}</td>
                                            <td>
                                            @if($withdraw->withdraw_status == 'pending')
                                            <a href="{{ URL::to('/admin/withdrawal') }}/{{ $withdraw->wid }}/{{ $withdraw->user_id }}" class="btn btn-success btn-sm" onClick="return confirm('{{ Helper::translation(3840,$translate) }}');"><i class="fa fa-money"></i>&nbsp; {{ Helper::translation(3843,$translate) }}</a>
                                            @else
                                            <span class="badge badge-success">{{ $withdraw->withdraw_status }}</span>
                                            @endif
                                            </td>
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
 @include('admin.javascript')
</body>
</html>