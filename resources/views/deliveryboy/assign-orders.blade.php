<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
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
                            <form method="post" action="{{url('/admin/save-assign-orders')}}">
                                @csrf


                                <div class="table-responsive">
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>{{ Helper::translation(1964,$translate) }}</th>
                                            <th>{{ Helper::translation(2077,$translate) }}</th>
                                            {{--                                            <th>{{ Helper::translation(3621,$translate) }}</th>--}}
                                            <th>Address</th>

                                            <th>{{ Helper::translation(2091,$translate) }}</th>
                                            <th>{{ Helper::translation(2080,$translate) }}</th>
                                            {{--                                            <th>{{ Helper::translation(3609,$translate) }}</th>--}}
                                            {{--                                            <th>{{ Helper::translation(3624,$translate) }}</th>--}}

                                            <th>ProductName</th>
                                            <th>{{ Helper::translation(2109,$translate) }}</th>
                                            <th>
                                                Action<br>
                                                @php $checkall=0; @endphp
                                                @foreach($itemData['item'] as $order) @if($order->delivery_status == 1)  @php $checkall=1; @endphp @endif  @endforeach
                                                @if(!empty($checkall))
                                                    <a href="{{url('/deliveryboy/acceptall/').'/0'}}"
                                                       class="btn btn-primary mt-1"> Accept All</a>
                                                    <a href="{{url('/deliveryboy/declineall/').'/0'}}"
                                                       class="btn btn-danger mt-1"> Decline All</a>
                                                @endif

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $no = 1; @endphp
                                        @foreach($itemData['item'] as $order)
                                            @php
                                                $product = \ZigKart\Models\Product::getProductid($order->user_id,$order->ord_id);
                                                $orderDetils = \ZigKart\Models\Product::getorderDetils($order->user_id,$order->ord_id);
                                            @endphp
                                            <tr>

                                                <td>{{ $no }}</td>
                                                <td>{{ $order->purchase_token }} </td>
                                                {{--                                            <td><a href="{{ URL::to('/user') }}/{{ $order->username }}" target="_blank" class="blue-color">{{ $order->name }}</a></td>--}}

                                                <td>
                                                    @if($order->enable_ship == 1)
                                                        {{$order->ship_address}}
                                                        {{$order->ship_city}}
                                                        {{$order->ship_state}}
                                                        {{$order->ship_postcode}}
                                                    @else
                                                        {{$order->bill_address}}
                                                        {{$order->bill_city}}
                                                        {{$order->bill_state}}
                                                        {{$order->bill_postcode}}
                                                    @endif
                                                </td>

                                                <td>{{ $order->payment_date }}</td>
                                                <td>{{ str_replace("-"," ",$order->payment_type) }}</td>
                                                {{--                                            <td>@if($order->payment_token != ""){{ $order->payment_token }}@else <span>---</span> @endif</td>--}}
                                                {{--                                            <td>@if(($order->payment_type == 'localbank' or  $order->payment_type == 'cash-on-delivery') && $order->payment_status == 'pending') <a href="orders/{{ base64_encode($order->purchase_token) }}/{{ base64_encode($order->payment_type) }}" class="blue-color"onClick="return confirm('Are you sure click to complete payment?');">{{ Helper::translation(3627,$translate) }}</a> @else <span>---</span> @endif</td>--}}
                                                <td>{{!empty($product) ? $product->product_name : ''}}<br>

                                                </td>
                                                <td>
                                                    <b>Quantity</b>
                                                    : {{!empty($orderDetils) ? $orderDetils->quantity : ''}} <br>
                                                    <b>Price</b> : {{!empty($orderDetils) ? $orderDetils->price : ''}}
                                                    <br>
                                                </td>
                                                <td>
                                                    {{--                                                <a href="order-details/{{ $order->purchase_token }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>&nbsp; {{ Helper::translation(3477,$translate) }}</a>--}}

                                                    @csrf

                                                    @if($order->delivery_status == 0)

                                                    @elseif($order->delivery_status == 1)
                                                        <a href="{{url('/deliveryboy/2/').'/'.$order->ord_id}}"
                                                           class="btn btn-primary mt-1"> Accept</a>
                                                        <a href="{{url('/deliveryboy/3/').'/'.$order->ord_id}}"
                                                           class="btn btn-danger mt-1"> Decline</a>


                                                    @elseif($order->delivery_status == 2)
                                                        <a href="{{url('/deliveryboy/4/').'/'.$order->ord_id}}"
                                                           class="btn btn-warning mt-1"> Pickup</a>

                                                    @elseif($order->delivery_status == 4)
                                                        <a href="{{url('/deliveryboy/5/').'/'.$order->ord_id}}"
                                                           class="btn btn-success mt-1"> Delivered</a>

                                                    @elseif($order->delivery_status == 5)

                                                        <button type="button" class="btn btn-success">Completed</button>

                                                    @else
                                                        <button type="button" class="btn btn-danger">Cancel order</button>
                                                    @endif


                                                </td>
                                            </tr>
                                            @php $no++; @endphp
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--@if(in_array('products',$avilable)) @else--}}
{{--    @include('admin.denied')--}}
{{--    @endif--}}
@include('admin.javascript')

<script>
    $('#selectAll').click(function (e) {
        var table = $(e.target).closest('table');
        $('td input:checkbox', table).prop('checked', this.checked);
    });
</script>
<script>
    {{--$(document).ready(function () {--}}

    {{--    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');--}}
    {{--    $("#accept").click(function () {--}}
    {{--        alert();--}}
    {{--        $.ajax({--}}
    {{--            /* the route pointing to the post function */--}}
    {{--            url: '{{url('updateorders')}}',--}}
    {{--            type: 'GET',--}}
    {{--            /* send the csrf-token and the input to the controller */--}}
    {{--            data: {_token: CSRF_TOKEN},--}}
    {{--            dataType: 'JSON',--}}
    {{--            /* remind that 'data' is the response of the AjaxController */--}}
    {{--            success: function (data) {--}}

    {{--                //alert('verifyotp sucess');--}}
    {{--                //window.location='{{url('home')}}'--}}
    {{--                //console.log(data);--}}
    {{--            }--}}
    {{--        });--}}

    {{--    });--}}
    {{--});--}}
</script>
</body>
</html>
