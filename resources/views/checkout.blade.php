@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(1995,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(1995,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(1995,$translate) }}</span></p>
      </div>
    </section>
   <main role="main">
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
      @if($subtotal != 0)
      <form action="{{ route('checkout') }}" class="setting_form" id="checkout_form" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
         <div class="row">
           <div class="col-md-6 mt-1 mb-1 pt-1 pb-1">
               <h3>{{ Helper::translation(1997,$translate) }}</h3>
         	   <div class="form-row mt-4 mb-4">
                <div class="col">
                  <label>{{ Helper::translation(1998,$translate) }}<span class="red">*</span></label>
                  <input type="text" class="form-control" id="bill_firstname" name="bill_firstname" data-bvalidator="required">
                </div>
                <div class="col">
                  <label>{{ Helper::translation(1999,$translate) }}<span class="red">*</span></label> 
                  <input type="text" class="form-control" id="bill_lastname" name="bill_lastname" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label>{{ Helper::translation(2000,$translate) }}</label>
                  <input type="text" class="form-control" id="bill_companyname" name="bill_companyname">
                </div>
                <div class="col">
                  <label>{{ Helper::translation(2001,$translate) }}<span class="red">*</span></label> 
                  <input type="text" class="form-control" id="bill_email" name="bill_email" data-bvalidator="email,required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label>{{ Helper::translation(2002,$translate) }}<span class="red">*</span></label>
                  <input type="text" class="form-control" id="bill_phone" name="bill_phone" data-bvalidator="required">
                </div>
                <div class="col">
                  <label>{{ Helper::translation(2003,$translate) }}<span class="red">*</span></label> 
                  <input type="text" class="form-control" id="bill_address" name="bill_address" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label>{{ Helper::translation(2004,$translate) }} <span class="red">*</span></label>
                  <input type="text" class="form-control" id="bill_city" name="bill_city" data-bvalidator="required">
                </div>
                <div class="col">
                  <label>{{ Helper::translation(2005,$translate) }} <span class="red">*</span></label> 
                  <input type="text" class="form-control" id="bill_state" name="bill_state" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label>{{ Helper::translation(2006,$translate) }} <span class="red">*</span></label>
                  <input type="text" class="form-control" id="bill_postcode" name="bill_postcode" data-bvalidator="required">
                </div>
                <div class="col">
                  <label>{{ Helper::translation(2007,$translate) }} <span class="red">*</span></label> 
                  <select class="form-control" name="bill_country" data-bvalidator="required">
                  <option value=""></option>
                  @foreach($allcountry as $country)
                  <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
           </div>
           <div class="col-md-6 mt-1 mb-1 pt-1 pb-1">
               <h3>{{ Helper::translation(2008,$translate) }} <span><input type="checkbox" name="enable_shipping" id="enable_shipping" value="1"></span></h3>
               <div id="show_shipping">
         	   <div class="form-row mt-4 mb-4">
                <div class="col">
                  <label>{{ Helper::translation(1998,$translate) }}<span class="red">*</span></label>
                  <input type="text" class="form-control" id="ship_firstname" name="ship_firstname" data-bvalidator="required">
                </div>
                <div class="col">
                  <label>{{ Helper::translation(1999,$translate) }} <span class="red">*</span></label> 
                  <input type="text" class="form-control" id="ship_lastname" name="ship_lastname" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label>{{ Helper::translation(2000,$translate) }}</label>
                  <input type="text" class="form-control" id="ship_companyname" name="ship_companyname">
                </div>
                <div class="col">
                  <label>{{ Helper::translation(2001,$translate) }} <span class="red">*</span></label> 
                  <input type="text" class="form-control" id="ship_email" name="ship_email" data-bvalidator="email,required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label>{{ Helper::translation(2002,$translate) }} <span class="red">*</span></label>
                  <input type="text" class="form-control" id="ship_phone" name="ship_phone" data-bvalidator="required">
                </div>
                <div class="col">
                  <label>{{ Helper::translation(2003,$translate) }} <span class="red">*</span></label> 
                  <input type="text" class="form-control" id="ship_address" name="ship_address" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label>{{ Helper::translation(2004,$translate) }} <span class="red">*</span></label>
                  <input type="text" class="form-control" id="ship_city" name="ship_city" data-bvalidator="required">
                </div>
                <div class="col">
                  <label>{{ Helper::translation(2005,$translate) }} <span class="red">*</span></label> 
                  <input type="text" class="form-control" id="ship_state" name="ship_state" data-bvalidator="required">
                </div>
              </div>
              <div class="form-row mt-3 mb-3">
                <div class="col">
                  <label>{{ Helper::translation(2006,$translate) }} <span class="red">*</span></label>
                  <input type="text" class="form-control" id="ship_postcode" name="ship_postcode" data-bvalidator="required">
                </div>
                <div class="col">
                  <label>{{ Helper::translation(2007,$translate) }} <span class="red">*</span></label> 
                  <select class="form-control" name="ship_country" data-bvalidator="required">
                  <option value=""></option>
                  @foreach($allcountry as $country)
                  <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              </div>
              <div class="form-row mt-4 mb-4">
                <div class="col">
                  <label>{{ Helper::translation(2009,$translate) }}</label>
                  <textarea class="form-control" id="other_notes" placeholder="About your order" name="other_notes"></textarea>
                </div>
               </div>
               <div class="form-row mt-4 mb-4">
               <h3>{{ Helper::translation(2010,$translate) }}</h3>
               </div>
               <div class="form-row mt-2 mb-2">
                           <div class="col-lg-12 col-md-12 col-sm-12">
                           @php $no = 1; @endphp
                                @foreach($get_payment as $payment)
                                <div class="custom-control custom-radio">
                                    <input id="opt1-{{ $payment }}" name="payment_method" type="radio" class="custom-control-input" value="{{ $payment }}" @if($no == 1) checked @endif data-bvalidator="required">
                                    <label class="custom-control-label" for="opt1-{{ $payment }}">{{ str_replace("-"," ",$payment) }} @if($payment == 'wallet') ({{ $allsettings->site_currency_symbol }}{{ Auth::user()->earnings }}) @endif</label>
                                </div>
                                @php $no++; @endphp
                                @endforeach
                                </div>
                </div>
               <div class="form-row mt-2 mb-2">
                <div class="col text-right fs25">
                  {{ Helper::translation(1989,$translate) }}
                </div>
                <div class="col text-right fs25">
                  {{ $allsettings->site_currency_symbol }}{{ $subtotal }}
                </div>
               </div>
               @if($coupon_discount != 0)
               <div class="form-row mt-4 mb-1">
                <div class="col text-right fs25">
                  <span>{{ Helper::translation(1991,$translate) }}</span><p class="fs14 green">{{ Helper::translation(1990,$translate) }}</p>
                </div>
                <div class="col text-right fs25 green">
                  - {{ $allsettings->site_currency_symbol }}{{ $coupon_discount }}
                </div>
               </div>
               @endif
               @if($allsettings->site_processing_fee != 0)
               <div class="form-row mt-2 mb-2">
                <div class="col text-right fs25">
                  {{ Helper::translation(1993,$translate) }}
                </div>
                <div class="col text-right fs25">
                  {{ $allsettings->site_currency_symbol }}{{ $allsettings->site_processing_fee }}
                </div>
               </div>
               @endif
               <div class="form-row mt-3 mb-3">
                <div class="col text-right fs25">
                  {{ Helper::translation(1986,$translate) }}
                </div>
                <div class="col text-right fs25">
                  {{ $allsettings->site_currency_symbol }}{{ $final }}
                </div>
               </div>
               <div class="form-row mt-4 mb-4">
               <div class="col text-right">
               <button type="submit" class="btn button-color">{{ Helper::translation(2011,$translate) }}</button>
               </div>
               </div>
               <input type="hidden" name="order_id" value="{{ $order_numbers }}">
               <input type="hidden" name="sub_total" value="{{ $new_price }}">
               <input type="hidden" name="shipping_fee" value="0">
               <input type="hidden" name="shipping_fee_separate" value="0">
               <input type="hidden" name="processing_fee" value="{{ $allsettings->site_processing_fee }}">
               <input type="hidden" name="total" value="{{ $final }}">
               <input type="hidden" name="product_id" value="{{ $product_numbers }}">
               <input type="hidden" name="product_names" value="{{ $product_names }}">
           </div>
         </div>
        </form>
        @else
        <div class="col-md-12 mt-1 mb-1 pt-1 pb-1 text-center">
           <div align="center">
           {{ Helper::translation(1996,$translate) }}
           </div>
        </div>    
       @endif  
      </div>
    </main>
@include('footer')
@include('javascript')
</body>
</html>
@else
@include('503')
@endif