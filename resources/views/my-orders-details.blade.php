@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2087,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2087,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2087,$translate) }}</span></p>
      </div>
    </section>
    <main role="main">
    <div class="container mt-3">
    <div class="row">
       <div class="col-md-12" align="right">
          <a href="{{ URL::to('/my-orders') }}" class="btn button-color">&lt; {{ Helper::translation(2088,$translate) }}</a>
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
                        <label for="name">{{ Helper::translation(2076,$translate) }} : </label>
                        {{ $ord_id }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2089,$translate) }} : </label>
                        {{ $purchase->payment_token }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2090,$translate) }} : </label>
                        {{ $allsettings->site_currency_symbol }}{{ $product->shipping_price }}
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
                        {{ $allsettings->site_currency_symbol }}{{ $product->subtotal }}
                    </div>
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2093,$translate) }} : </label>
                        {{ $allsettings->site_currency_symbol }}{{ $product->total }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(2082,$translate) }} : </label>
                        @if($purchase->payment_status == 'completed') <span class="badge badge-success">{{ Helper::translation(2084,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(2085,$translate) }}</span> @endif
                    </div>
                    @if($product->coupon_code != '')
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(1923,$translate) }} : </label>
                        {{ $product->coupon_code }}
                    </div>
                    @endif
                    @if($product->product_type == 'physical')
                    @php
                    $delivery_time ='+'.$product->product_estimate_time.' days';
                    $delivery_date = date('d F Y', strtotime($delivery_time, strtotime($purchase->payment_date)));
                    @endphp
                    <div class="col-sm-6">
                        <label for="name">{{ Helper::translation(2146,$translate) }} : </label>
                        {{ $delivery_date }}
                    </div>
                    @endif
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
              @if($product->product_type == 'physical')
              <form action="{{ route('order-track') }}" class="setting_form" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
               <div class="form-group row mt-3 pt-3">
                    <div class="col-sm-12">
                        <h4>{{ Helper::translation(2098,$translate) }} </h4>
                    </div>
              </div>
              <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ Helper::translation(1915,$translate) }} : </label>
                        Order has been {{ $product->order_tracking }}
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="order_track" name="order_track" required>
                        <option value="{{ $track_placed }}" @if($product->order_tracking == $track_placed) selected @endif>{{ $track_placed }}</option>
                        <option value="{{ $track_packed }}" @if($product->order_tracking == $track_packed) selected @endif>{{ $track_packed }}</option>
                        <option value="{{ $track_shipped }}" @if($product->order_tracking == $track_shipped) selected @endif>{{ $track_shipped }}</option>
                        <option value="{{ $track_delivered }}" @if($product->order_tracking == $track_delivered) selected @endif>{{ $track_delivered }}</option>
                        </select>
                        <input type="hidden" name="order_id" value="{{ $ord_id }}">
                        <button type="submit" class="btn button-color mt-1">{{ Helper::translation(1919,$translate) }}</button>
                    </div>
                    </div>
               </form>     
              @endif
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