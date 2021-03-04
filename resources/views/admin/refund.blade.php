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
                        <h1>{{ Helper::translation(2115,$translate) }}</h1>
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
                                <strong class="card-title">{{ Helper::translation(2115,$translate) }}</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(1964,$translate) }}</th>
                                            <th>{{ Helper::translation(2077,$translate) }}</th>
                                            <th>{{ Helper::translation(2076,$translate) }}</th>
                                            <th>{{ Helper::translation(1928,$translate) }}</th>
                                            <th>{{ Helper::translation(3621,$translate) }}</th>
                                            <th>{{ Helper::translation(3753,$translate) }}</th>
                                            <th>{{ Helper::translation(3756,$translate) }}</th>
                                            <th>{{ Helper::translation(1965,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($itemData['item'] as $refund)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $refund->purchase_token }} </td>
                                            <td>{{ $refund->order_id }} </td>
                                            <td>{{ $refund->product_name }} </td>
                                            <td><a href="{{ URL::to('/user') }}/{{ $refund->username }}" target="_blank" class="blue-color">{{ $refund->username }}</a></td>
                                            <td>{{ $refund->reason }} </td>
                                            <td>{{ $refund->message }}</td>
                                            <td>
                                            @if($refund->dispute_status == "") 
                                            <a href="{{ URL::to('/admin/refund') }}/{{ $refund->order_id }}/{{ $refund->dispute_id }}/buyer" class="btn btn-success btn-sm" title="payment released to buyer"><i class="fa fa-money"></i>&nbsp; Refund Accept</a><a href="{{ URL::to('/admin/refund') }}/{{ $refund->order_id }}/{{ $refund->dispute_id }}/vendor" class="btn btn-danger btn-sm" title="payment released to vendor"><i class="fa fa-close"></i>&nbsp; {{ Helper::translation(3759,$translate) }}</a>
                                            @else
                                            @if($refund->dispute_status == 'accepted') <span class="badge badge-success">{{ Helper::translation(3762,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(3765,$translate) }}</span> @endif
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