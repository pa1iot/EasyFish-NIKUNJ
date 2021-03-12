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
                        <h1>{{ Helper::translation(2154,$translate) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="{{ url('/admin/orders') }}" class="btn btn-success btn-sm"><i class="fa fa-chevron-left"></i> {{ Helper::translation(2088,$translate) }}</a>
                        </ol>
                    </div>
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
                                <strong class="card-title">{{ Helper::translation(2154,$translate) }}</strong>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(1964,$translate) }}</th>
                                            <th>{{ Helper::translation(2077,$translate) }}</th>
                                            <th>{{ Helper::translation(2076,$translate) }}</th>
                                            <th>{{ Helper::translation(1928,$translate) }}</th>
                                            <th>{{ Helper::translation(2112,$translate) }}</th>
                                            @if($allsettings->type_of_marketplace == 'multi-vendor')
                                            <th>{{ Helper::translation(3585,$translate) }}</th>
                                            <th>{{ Helper::translation(3588,$translate) }}</th>
                                            @endif
                                            <th>{{ Helper::translation(2109,$translate) }}<br/><small class="red-color">({{ Helper::translation(3591,$translate) }})</small></th>
                                            <th>{{ Helper::translation(2098,$translate) }}</th>
                                            <th>{{ Helper::translation(2082,$translate) }}</th>
                                            <th>{{ Helper::translation(3594,$translate) }}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($itemData['item'] as $order)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $order->purchase_token }} </td>
                                            <td>{{ $order->ord_id }} </td>
                                            <td>{{ $order->product_name }} </td>
                                            <td><a href="{{ URL::to('/user') }}/{{ $order->username }}" target="_blank" class="blue-color">{{ $order->username }}</a></td>
                                            @if($allsettings->type_of_marketplace == 'multi-vendor')
                                            <td>{{ $allsettings->site_currency_symbol }}{{ $order->vendor_amount }} </td>
                                            <td>{{ $allsettings->site_currency_symbol }}{{ $order->admin_amount }} </td>
                                            @endif
                                            <td>{{ $allsettings->site_currency_symbol }}{{ $order->subtotal }} </td>
                                            <td>
                                            @if($order->product_type == 'physical')
                                            <form action="{{ route('admin.order-track') }}" class="setting_form" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <select class="form-control" id="order_track" name="order_track[]" required>
                                            <option value="{{ $track_placed }}" @if($order->order_tracking == $track_placed) selected @endif>{{ $track_placed }}</option>
                                            <option value="{{ $track_packed }}" @if($order->order_tracking == $track_packed) selected @endif>{{ $track_packed }}</option>
                                            <option value="{{ $track_shipped }}" @if($order->order_tracking == $track_shipped) selected @endif>{{ $track_shipped }}</option>
                                            <option value="{{ $track_delivered }}" @if($order->order_tracking == $track_delivered) selected @endif>{{ $track_delivered }}</option>
                                            </select>
                                            <input type="hidden" name="order_id[]" value="{{ $order->ord_id }}">
                                            <input type="submit" class="btn btn-success btn-sm" value="Update">
                                            </form>
                                            @endif
                                            </td>
                                            <td>@if($order->order_status == 'completed') <span class="badge badge-success">Completed</span> @else <span class="badge badge-danger">Pending</span> @endif</td>
                                            <td>
                                            @if($order->payment_status == '' && $order->order_status == 'completed')
                                            <a href="{{ URL::to('/admin/order-details') }}/{{ $order->ord_id }}/vendor" class="btn btn-success btn-sm" title="payment released to vendor" onClick="return confirm('Are you sure you will payment released to vendor?');"><i class="fa fa-money"></i>&nbsp; {{ Helper::translation(3600,$translate) }}</a>
                                            <a href="{{ URL::to('/admin/order-details') }}/{{ $order->ord_id }}/buyer" class="btn btn-danger btn-sm" title="payment released to buyer" onClick="return confirm('Are you sure you will payment released to buyer?');"><i class="fa fa-close"></i>&nbsp; {{ Helper::translation(3606,$translate) }}</a>
                                            @else
                                            {{ $order->payment_status }}
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
                    <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" v-if="headerText">{{ Helper::translation(2083,$translate) }}</strong>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-align-middle mb-0">

                                <tbody>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2077,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->purchase_token }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(3609,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->payment_token }}
                                        </td>
                                    </tr>
                                   <tr>
                                        <td>
                                            {{ Helper::translation(2080,$translate) }}
                                        </td>

                                        <td>
                                            {{ str_replace("-"," ",$single_data->payment_type) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2091,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->payment_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2090,$translate) }}
                                        </td>

                                        <td>
                                            {{ $allsettings->site_currency_symbol }}{{ $single_data->shipping_price }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(3612,$translate) }}
                                        </td>

                                        <td>
                                            {{ $allsettings->site_currency_symbol }}{{ $single_data->processing_fee }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(3615,$translate) }}
                                        </td>

                                        <td>
                                            {{ $allsettings->site_currency_symbol }}{{ $single_data->subtotal }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2093,$translate) }}
                                        </td>

                                        <td>
                                            {{ $allsettings->site_currency_symbol }}{{ $single_data->total }}
                                        </td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" v-if="headerText">{{ Helper::translation(1997,$translate) }}</strong>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-align-middle mb-0">

                                <tbody>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(1998,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->bill_firstname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(1999,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->bill_lastname }}
                                        </td>
                                    </tr>
                                   <tr>
                                        <td>
                                            {{ Helper::translation(2000,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->bill_companyname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2014,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->bill_email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2002,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->bill_phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2007,$translate) }}
                                        </td>

                                        <td>
                                            {{ $billcountry_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2003,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->bill_address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2096,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->bill_city }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2005,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->bill_state }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2006,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->bill_postcode }}
                                        </td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" v-if="headerText">{{ Helper::translation(2095,$translate) }}</strong>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-align-middle mb-0">

                                <tbody>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(1998,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->ship_firstname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(1999,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->ship_lastname }}
                                        </td>
                                    </tr>
                                   <tr>
                                        <td>
                                            {{ Helper::translation(1999,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->ship_companyname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2014,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->ship_email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2002,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->ship_phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2007,$translate) }}
                                        </td>

                                        <td>
                                            {{ $shipcountry_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2003,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->ship_address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2096,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->ship_city }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2005,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->ship_state }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Helper::translation(2006,$translate) }}
                                        </td>

                                        <td>
                                            {{ $single_data->ship_postcode }}
                                        </td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title" v-if="headerText">{{ Helper::translation(2009,$translate) }}</strong>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-align-middle mb-0">

                                <tbody>
                                    <tr>
                                        <td>
                                           	@php echo nl2br($single_data->other_notes); @endphp
                                        </td>
                                    </tr>

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
