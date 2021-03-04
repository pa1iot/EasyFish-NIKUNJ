@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2110,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2110,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2110,$translate) }}</span></p>
      </div>
    </section>
<main role="main">
    <div class="container mt-3">
    <div class="row">
       <div class="col-md-12" align="right">
          <a href="{{ URL::to('/my-purchase') }}" class="btn button-color">&lt; {{ Helper::translation(2088,$translate) }}</a><a href="{{ url('/invoice') }}/{{ $purchase->purchase_token }}" class="btn btn-danger ml-1"><i class="fa fa-download" aria-hidden="true"></i> Invoice</a>
       </div>
    </div>
    </div>
      <div class="container page-white-box mt-3">
      <div>
           @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                 <span class="alert_icon lnr lnr-checkmark-circle"></span>
                     {{ $message }}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span class="fa fa-close" aria-hidden="true"></span>
                     </button>
             </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
               <span class="alert_icon lnr lnr-warning"></span>
                    {{ $message }}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span class="fa fa-close" aria-hidden="true"></span>
                     </button>
            </div>
            @endif
            @if (!$errors->isEmpty())
            <div class="alert alert-danger" role="alert">
            <span class="alert_icon lnr lnr-warning"></span>
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span class="fa fa-close" aria-hidden="true"></span>
            </button>
            </div>
            @endif
            </div>
           <div class="row">
           <div class="col-md-12">
         	   <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2077,$translate) }} : </label>
                        {{ $purchase->purchase_token }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2089,$translate) }} : </label>
                        {{ $purchase->payment_token }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2090,$translate) }} : </label>
                        {{ $allsettings->site_currency_symbol }}{{ $purchase->shipping_price }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(1993,$translate) }} : </label>
                        {{ $allsettings->site_currency_symbol }}{{ $purchase->processing_fee }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2080,$translate) }} : </label>
                        {{ str_replace("-"," ",$purchase->payment_type) }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2091,$translate) }} : </label>
                        {{ $purchase->payment_date }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2092,$translate) }} : </label>
                        {{ $allsettings->site_currency_symbol }}{{ $purchase->subtotal }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2093,$translate) }} : </label>
                        {{ $allsettings->site_currency_symbol }}{{ $purchase->total }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2082,$translate) }} : </label>
                        @if($purchase->payment_status == 'completed') <span class="badge badge-success">{{ Helper::translation(2084,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(2085,$translate) }}</span> @endif
                    </div>
                </div> 
                <div class="form-group row mt-3 pt-3">
                    <div class="col-sm-6">
                        <h4>{{ Helper::translation(1997,$translate) }} </h4>
                        
                    </div>
                    <div class="col-sm-6">
                        <h4>{{ Helper::translation(2095,$translate) }} </h4>
                        
                    </div>
                </div>    
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(1998,$translate) }} : </label>
                        {{ $purchase->bill_firstname }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(1999,$translate) }} : </label>
                        {{ $purchase->bill_lastname }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(1998,$translate) }} : </label>
                        {{ $purchase->ship_firstname }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(1999,$translate) }} : </label>
                        {{ $purchase->ship_lastname }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2000,$translate) }} : </label>
                        {{ $purchase->bill_companyname }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2014,$translate) }} : </label>
                        {{ $purchase->bill_email }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2000,$translate) }} : </label>
                        {{ $purchase->ship_companyname }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2014,$translate) }} : </label>
                        {{ $purchase->ship_email }}
                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2002,$translate) }} : </label>
                        {{ $purchase->bill_phone }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2007,$translate) }} : </label>
                        {{ $billcountry }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2002,$translate) }} : </label>
                        {{ $purchase->ship_phone }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2007,$translate) }} : </label>
                        {{ $shipcountry }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2003,$translate) }} : </label>
                        {{ $purchase->bill_address }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2096,$translate) }} : </label>
                        {{ $purchase->bill_city }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2003,$translate) }} : </label>
                        {{ $purchase->ship_address }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2096,$translate) }} : </label>
                        {{ $purchase->ship_city }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2005,$translate) }} : </label>
                        {{ $purchase->bill_state }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2006,$translate) }} : </label>
                        {{ $purchase->bill_postcode }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2005,$translate) }} : </label>
                        {{ $purchase->ship_state }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2006,$translate) }} : </label>
                        {{ $purchase->ship_postcode }}
                    </div>
                </div>
                <div class="form-group row mt-3 pt-3">
                    <div class="col-sm-12">
                        <h4>{{ Helper::translation(2097,$translate) }} </h4>
                        {{ $purchase->other_notes }}
                    </div>
              </div> 
           </div>
         </div>
        <div class="row">
           <div class="col-md-12"> 
        <div class="form-group row mt-3 pt-3">
                    <div class="col-sm-12">
                        <h4>{{ Helper::translation(2111,$translate) }}</h4>
                        
                    </div>
             </div> 
             <div class="table-responsive">
             <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(1964,$translate) }}</th>
                                            <th>{{ Helper::translation(2076,$translate) }}</th>
                                            <th>{{ Helper::translation(1984,$translate) }}</th>
                                            <th>{{ Helper::translation(2078,$translate) }}</th>
                                            <th>{{ Helper::translation(2079,$translate) }}</th>
                                            <th>{{ Helper::translation(2112,$translate) }}</th>
                                            <th>{{ Helper::translation(2113,$translate) }}</th>
                                            <th>{{ Helper::translation(2114,$translate) }}</th>
                                            <th>{{ Helper::translation(2098,$translate) }}</th>
                                            <th>{{ Helper::translation(2912,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($product['view'] as $product)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $product->ord_id }}</td>
                                            <td>
                                            <a href="{{ url('/product') }}/{{ $product->product_slug }}">
                                            @if($product->product_image != '')
                                                <img src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}"  class="img-thumb" alt="{{ $product->product_name }}"/>@else <img src="{{ url('/') }}/public/img/no-image.jpg"  class="img-thumb" alt="{{ $product->product_name }}"/>  @endif
                                                </a>
                                           </td>
                                            <td>{{ $product->quantity }} X {{ $allsettings->site_currency_symbol }}{{ $product->price }}</td>
                                            <td>{{ $product->product_attribute_values }} </td>
                                            <td><a href="{{ url('/user') }}/{{ $product->username }}">{{ $product->name }}</a> </td>
                                            <td>
                                            @if($today_date <= $refund_date)
                                            @if($product->order_status == 'completed' && $product->payment_status != $payment_status_buyer)
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#sem-login-{{ $product->ord_id }}" class="btn btn-success btn-sm">{{ Helper::translation(2115,$translate) }}</a>
                                            @else
                                            <span class="badge badge-warning">{{ $product->payment_status }}</span>
                                            @endif
                                            @else
                                            <span class="badge badge-warning">{{ $product->payment_status }}</span>
                                            @endif
                                            </td>
                                            <td  align="center">
                                            @if($allsettings->site_s3_storage == 1)
                                            @php 
                                            if($product->product_file != '')
                                            {
                                            $fileurl = Storage::disk('s3')->url($product->product_file); 
                                            }
                                            else
                                            {
                                            $fileurl = '';  
                                            }
                                            @endphp
                                            @endif
                                            @if($product->order_status == 'completed')
                                            @if($product->payment_status != $payment_status_buyer or $product->payment_status == $payment_status_vendor) 
                                            <a href="javascript:void(0);" class="badge badge-success" data-toggle="modal" data-target="#sem-rate-{{ $product->ord_id }}"><i class="fa fa-star"></i> {{ Helper::translation(2114,$translate) }}</a>                            @else
                                            <span>---</span>
                                            @endif
                                            @if($product->product_type == 'digital')
                                            @if($product->payment_status != $payment_status_buyer or $product->payment_status == $payment_status_vendor)
                                            @if($allsettings->site_s3_storage == 1)
                                            <br/><a href="{{ $fileurl }}" class="badge badge-primary" download><i class="fa fa-download"></i> {{ Helper::translation(2116,$translate) }}</a>
                                            @else
                                            <br/><a href="{{ url('/') }}/public/storage/product/{{ $product->product_file }}" class="badge badge-primary" download><i class="fa fa-download"></i> {{ Helper::translation(2116,$translate) }}</a>
                                            @endif
                                            @endif
                                            @endif
                                            @endif
                                            </td>
                                            <td align="center">
                                            @if($product->product_type == 'physical')
                                            @if($product->payment_status != $payment_status_buyer)
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#sem-track-{{ $product->ord_id }}">{{ Helper::translation(2098,$translate) }}</a>
                                            @else
                                            <span>---</span>
                                            @endif
                                            @else
                                            <span>---</span>
                                            @endif
                                            </td>
                                            <td>
                                            @if($product->payment_status != $payment_status_buyer or $product->payment_status == $payment_status_vendor)
                                            <a href="{{ url('/conversation-to-vendor') }}/{{ $product->username }}/{{ $encrypter->encrypt($product->ord_id) }}" class="btn btn-primary btn-sm">{{ Helper::translation(2915,$translate) }}</a>
                                            @else
                                            <span>---</span>
                                            @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade seminor-login-modal" data-backdrop="static" id="sem-track-{{ $product->ord_id }}">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                              <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h4 class="modal-title">{{ Helper::translation(2098,$translate) }}</h4>
                                                       <button type="button" class="close" data-dismiss="modal">
                                                      <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                       </button>
                                                    </div>
                                                    @php
                                                    $delivery_time ='+'.$product->product_estimate_time.' days';
                                                    $delivery_date = date('d F Y', strtotime($delivery_time, strtotime($purchase->payment_date)));
                                                    @endphp
                                                    <div class="modal-body">
                                                          <div class="card-body">
                                                                <h6>{{ Helper::translation(2076,$translate) }}: {{ $product->ord_id }}</h6>
                                                                <article class="card">
                                                                    <div class="card-body row">
                                                                        <div class="col"> <strong>{{ Helper::translation(2094,$translate) }}:</strong> <br>{{ $delivery_date }}</div>
                                                                        <div class="col"> <strong>{{ Helper::translation(1915,$translate) }}:</strong> <br> Order has been {{ $product->order_tracking }}</div>
                                                                        <div class="col"> <strong>{{ Helper::translation(2117,$translate) }}:</strong> <br> {{ $product->ord_id }} </div>
                                                                    </div>
                                                                </article>
                                                                <div class="track">
                                                                    @if($product->order_tracking == $track_placed)
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">{{ Helper::translation(2118,$translate) }}</span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text">{{ Helper::translation(2119,$translate) }}</span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">{{ Helper::translation(2120,$translate) }}</span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text">{{ Helper::translation(2121,$translate) }}</span> </div>
                                                                    @endif
                                                                    @if($product->order_tracking == $track_packed)
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">{{ Helper::translation(2118,$translate) }}</span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text">{{ Helper::translation(2119,$translate) }}</span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">{{ Helper::translation(2120,$translate) }}</span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text">{{ Helper::translation(2121,$translate) }}</span> </div>
                                                                    @endif
                                                                    @if($product->order_tracking == $track_shipped)
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">{{ Helper::translation(2118,$translate) }}</span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text">{{ Helper::translation(2119,$translate) }}</span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">{{ Helper::translation(2120,$translate) }}</span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text">{{ Helper::translation(2121,$translate) }}</span> </div>
                                                                    @endif
                                                                    @if($product->order_tracking == $track_delivered)
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">{{ Helper::translation(2118,$translate) }}</span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text">{{ Helper::translation(2119,$translate) }}</span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">{{ Helper::translation(2120,$translate) }} </span> </div>
                                                                    <div class="step active"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text">{{ Helper::translation(2121,$translate) }}</span> </div>
                                                                    @endif
                                                                    @if($product->order_tracking == '')
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">{{ Helper::translation(2118,$translate) }}</span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> {{ Helper::translation(2119,$translate) }}</span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> {{ Helper::translation(2120,$translate) }} </span> </div>
                                                                    <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text">{{ Helper::translation(2121,$translate) }}</span> </div>
                                                                    @endif
                                                                </div>
                                                           </div>
                                                    </div>
                                              </div>
                                            </div>
                                          </div>
                                        <div class="modal fade seminor-login-modal" data-backdrop="static" id="sem-rate-{{ $product->ord_id }}">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                              <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h4 class="modal-title">{{ Helper::translation(2114,$translate) }}</h4>
                                                       <button type="button" class="close" data-dismiss="modal">
                                                      <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                       </button>
                                                    </div>
                                                    <div class="modal-body">
                                                          <div class="row">
                                                             <div class="col-md-6">
                                                              @if($product->product_image != '')
                                                <img src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}"  class="refund-img" alt="{{ $product->product_name }}"/>@else <img src="{{ url('/') }}/public/img/no-image.jpg"  class="refund-img" alt="{{ $product->product_name }}"/>  @endif
                                                <h5 align="center">{{ $product->product_name }}</h5>
                                                              </div>
                                                              <div class="col-md-6">
                                                                 <form action="{{ route('rating') }}" class="setting_form" method="post" enctype="multipart/form-data">
                                                                 {{ csrf_field() }}
                                                                            <div class="form-group">
                                                                            <label for="email">{{ Helper::translation(2122,$translate) }}</label><br/>
                                                                            <div>
                                                                            <input type="radio" name="rating" value="5" required="required">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i> 
                                                                            </div>
                                                                            <div>
                                                                            <input type="radio" name="rating" value="4" required="required">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                            </div>
                                                                            <div>
                                                                            <input type="radio" name="rating" value="3" required="required">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                            </div>
                                                                            <div>
                                                                            <input type="radio" name="rating" value="2" required="required">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                            </div>
                                                                            <div>
                                                                            <input type="radio" name="rating" value="1" required="required">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                            </div>
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <label for="pwd">{{ Helper::translation(2123,$translate) }}</label>
                                                                            <textarea class="form-control" name="review" rows="5" required="required"></textarea>
                                                                          </div>
                                                                          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                                          <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                                                          <input type="hidden" name="order_id" value="{{ $product->ord_id }}">
                                                                          <button type="submit" class="btn button-color">{{ Helper::translation(1919,$translate) }}</button>
                                                                 </form>
                                                              </div>
                                                           </div>
                                                    </div>
                                              </div>
                                            </div>
                                          </div>
                                        <div class="modal fade seminor-login-modal" data-backdrop="static" id="sem-login-{{ $product->ord_id }}">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                              <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h4 class="modal-title">{{ Helper::translation(2124,$translate) }}</h4>
                                                       <button type="button" class="close" data-dismiss="modal">
                                                      <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                       </button>
                                                    </div>
                                                    <div class="modal-body">
                                                          <div class="row">
                                                             <div class="col-md-6">
                                                              @if($product->product_image != '')
                                                <img src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}"  class="refund-img" alt="{{ $product->product_name }}"/>@else <img src="{{ url('/') }}/public/img/no-image.jpg"  class="refund-img" alt="{{ $product->product_name }}"/>  @endif
                                                <h5 align="center">{{ $product->product_name }}</h5>
                                                              </div>
                                                              <div class="col-md-6">
                                                                 <form action="{{ route('refund-request') }}" class="setting_form" method="post" enctype="multipart/form-data">
                                                                 {{ csrf_field() }}
                                                                 <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                                                 <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                                                                 <input type="hidden" name="product_slug" value="{{ $product->product_slug }}">
                                                                 <input type="hidden" name="purchase_token" value="{{ $product->purchase_token }}">
                                                                 <input type="hidden" name="order_id" value="{{ $product->ord_id }}">
                                                                 <input type="hidden" name="payment_date" value="{{ $purchase->payment_date }}">
                                                                 <input type="hidden" name="buyer_id" value="{{ Auth::user()->id }}">
                                                                 <input type="hidden" name="vendor_id" value="{{ $product->product_user_id }}">
                                                                 <input type="hidden" name="payment" value="{{ $product->subtotal }}">
                                                                 <input type="hidden" name="payment_type" value="{{ $product->payment_type }}">
                                                                          <div class="form-group">
                                                                            <label for="email">{{ Helper::translation(2125,$translate) }}</label>
                                                                            <input type="text" class="form-control" name="reason" required="required">
                                                                          </div>
                                                                          <div class="form-group">
                                                                            <label for="pwd">{{ Helper::translation(2126,$translate) }}</label>
                                                                            <textarea class="form-control" name="message" rows="5" required="required"></textarea>
                                                                          </div>
                                                                          <button type="submit" class="btn button-color">{{ Helper::translation(1919,$translate) }}</button>
                                                                 </form>
                                                              </div>
                                                           </div>
                                                    </div>
                                              </div>
                                            </div>
                                          </div>
                                        @php $no++; @endphp
                                   @endforeach     
                                   </tbody>
                         </table>
                 </div>
         </div>
</div>
</div>
</main>
@include('footer')
@include('javascript')
</body>
</html>
@else
@include('503')
@endif