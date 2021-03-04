@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(1983,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(1983,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(1983,$translate) }}</span></p>
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
         <div class="row">
         @if(count($cart['product']) != 0)
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1 cart-page">
           <form action="{{ route('coupon') }}" class="setting_form" id="coupon_form" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
         	 <table class="table table-hover table-responsive-stack">
                <thead>
                    <tr>
                        <th>{{ Helper::translation(1984,$translate) }}</th>
                        <th>{{ Helper::translation(1985,$translate) }}</th>
                        <th class="text-center">{{ Helper::translation(1934,$translate) }}</th>
                        <th class="text-center">{{ Helper::translation(1986,$translate) }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @php 
                $subtotal = 0;
                $coupon_code = ""; 
                $new_price = 0;
                @endphp
                @foreach($cart['product'] as $cart)
                     <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                        @if($cart->product_image != "")
                            <a class="thumbnail pull-left" href="{{ url('/product') }}/{{ $cart->product_slug }}"><img class="media-object" src="{{ url('/') }}/public/storage/product/{{ $cart->product_image }}"> </a>                          @else
                            <a class="thumbnail pull-left" href="{{ url('/product') }}/{{ $cart->product_slug }}"><img class="media-object" src="{{ url('/') }}/public/img/no-image.jpg"> </a>
                            @endif
                            <div class="media-body">
                                <h4><a href="{{ url('/product') }}/{{ $cart->product_slug }}">{{ $cart->product_name }}</a></h4>
                                <span>{{ Helper::translation(1987,$translate) }}: </span><span><a href="{{ url('/user') }}/{{ $cart->username }}" class="text-success">{{ $cart->name }}</a></span>
                                <div class="mt-2">{{ $cart->product_attribute_values }}</div>
                            </div>
                        </div></td>
                        @php
                          if($cart->discount_price != 0)
                          {
                            $price = $cart->discount_price;
                            $new_price += $cart->quantity * $cart->discount_price;
                            $coupon_code = $cart->coupon_code;
                            
                          }
                          else
                          {
                            $price = $cart->price;
                            $new_price += $cart->quantity * $cart->price;
                            
                          }
                        @endphp
                        @php
                        $total = $cart->quantity * $cart->price;
                        $subtotal += $total;
                        @endphp
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        {{ $cart->quantity }}
                        </td>
                        <td class="col-sm-1 col-md-1 text-center">@if($cart->discount_price != 0)<strong>{{ $allsettings->site_currency_symbol }}{{ $price }}</strong>@endif <strong @if($cart->discount_price != 0) class="cross-line" @endif>{{ $allsettings->site_currency_symbol }}{{ $cart->price }}</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>{{ $allsettings->site_currency_symbol }}{{ $total }}</strong></td>
                        <td class="col-sm-1 col-md-1"><a href="{{ url('/product') }}/{{ $cart->product_slug }}" class="btn btn-success"><i class="fa fa-edit"></i></a> <a href="{{ url('/cart') }}/{{ base64_encode($cart->ord_id) }}" class="btn btn-danger" onClick="return confirm('{{ Helper::translation(1968,$translate) }}');"><i class="fa fa-close"></i></a></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" class="form-control coupon-text" id="coupon" name="coupon" value="" data-bvalidator="required"></td>
                        <td><button type="submit" class="btn button-color">{{ Helper::translation(1988,$translate) }}</button></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h5>{{ Helper::translation(1989,$translate) }}</h5></td>
                        <td class="text-right"><h5><strong>{{ $allsettings->site_currency_symbol }}{{ $subtotal }}</strong></h5></td>
                    </tr>
                    @if($coupon_code != "")
                    @php 
                    $coupon_discount = $subtotal - $new_price;
                    $final = $new_price+$allsettings->site_processing_fee; 
                    @endphp
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h5>{{ Helper::translation(1991,$translate) }}<br/><span class="fs14 green">{{ Helper::translation(1990,$translate) }} <strong>{{ $coupon_code }}</strong>{{ __(')') }}</span> <a href="{{ URL::to('/cart/') }}/remove/{{ $coupon_code }}" class="red fs14" onClick="return confirm('{{ Helper::translation(1992,$translate) }}');"><i class="fa fa-remove"></i>{{ Helper::translation(2848,$translate) }}</a></h5></td>
                        <td class="text-right green"><h5><strong>- {{ $allsettings->site_currency_symbol }}{{ $coupon_discount }}</strong></h5></td>
                    </tr>
                    @else
                    @php $final = $subtotal+$allsettings->site_processing_fee; @endphp
                    @endif
                    @if($allsettings->site_processing_fee != 0)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h5>{{ Helper::translation(1993,$translate) }}</h5></td>
                        <td class="text-right"><h5><strong>{{ $allsettings->site_currency_symbol }}{{ $allsettings->site_processing_fee }}</strong></h5></td>
                    </tr>
                    @endif
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h3>{{ Helper::translation(1986,$translate) }}</h3></td>
                        <td class="text-right"><h3><strong>{{ $allsettings->site_currency_symbol }}{{ $final }}</strong></h3></td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="{{ url('/shop') }}" class="btn btn-secondary"><i class="fa fa-shopping-cart"></i> {{ Helper::translation(1994,$translate) }}</a></td>
                        <td><a href="{{ url('/checkout') }}" class="btn btn-success"> {{ Helper::translation(1995,$translate) }}</a></td>
                    </tr>
                </tbody>
              </table>
              </form>
           </div>
           @else
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1 text-center">
                  <div align="center">
                  {{ Helper::translation(1996,$translate) }}
                  </div>
                </div>    
           @endif
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