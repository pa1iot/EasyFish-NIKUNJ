@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2050,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2050,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2050,$translate) }}</span></p>
      </div>
    </section>
  <main role="main">
      <div class="container page-white-box mt-3">
         <div class="row" align="center">
                           @php $z = 1; @endphp
                              @foreach($deal['product'] as $product) 
                                   <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-2 pb-2 prod-item">
                                   <div class="product-grid2">
                                    <div class="product-image2">
                                    <div class="product-hider">
                               <a href="{{ url('/') }}/public/storage/product/{{ $product->product_image }}" data-fancybox="quick-view-{{ $product->product_token.$z }}" data-type="image" class="quickview">
                               <i class="fa fa-eye"></i>
                               <p>{{ Helper::translation(2060,$translate) }}<br/>{{ Helper::translation(2061,$translate) }}</p>
                               </a>
                               <div class="product-images">
                                    @php $imagecount = count($product->productimages); @endphp
                                    @if($imagecount != 0)
                                    @foreach($product->productimages as $images)
                                    <a href="{{ url('/') }}/public/storage/product/{{ $images->product_image }}" data-fancybox="quick-view-{{ $product->product_token.$z }}" data-type="image"></a>
                                    @endforeach
                                    @endif
                                    </div>
                                    <div class="product-former">
                                    <h3>{{ $product->product_name }}</h3>
                                    <div class="mt-3">{{ Helper::translation(2062,$translate) }} : @if($product->product_stock != 0)<span class="theme-color">{{ Helper::translation(2063,$translate) }} ({{ $product->product_stock }})</span>@else<span class="red-color">{{ Helper::translation(2064,$translate) }} ({{ $product->product_stock }})</span>@endif</div>
            @php if($product->product_condition == 'new'){ $badg = "badge badge-warning"; } else { $badg = "badge badge-secondary"; } @endphp
            @if($product->product_condition != "")<div class="mt-2">{{ Helper::translation(1950,$translate) }} : <span class="{{ $badg }}">{{ $product->product_condition }}</span></div>@endif
                                    <div class="mt-3">@if($product->product_price != 0)<span @if($product->product_offer_price != 0) class="fs16 offer-price red-color" @else class="fs32" @endif>{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="fs32">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@endif</div>                                <p class="mt-3">
                                    {{ $product->product_short_desc }} 
                                    </p>
                                    <p><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}" class="btn button-color">{{ Helper::translation(2065,$translate) }}</a></p>
                                    </div>
                                    </div>
                                    <a href="{{ URL::to('/product') }}/{{ $product->product_slug }}">
                                            @if($product->product_image != "")
                                            <img class="pic-1" src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}">
                                            @else
                                            <img class="pic-1" src="{{ url('/') }}/public/img/no-image.jpg">
                                            @endif
                                            @php $imagecount = count($product->productimages); @endphp
                                            @if($imagecount != 0)
                                            @php $no = 1; @endphp
                                            @foreach($product->productimages as $images)
                                            @if($no == 1)
                                            <img class="pic-2" src="{{ url('/') }}/public/storage/product/{{ $images->product_image }}">
                                            @endif
                                            @php $no++; @endphp
                                            @endforeach
                                            @else
                                            <img class="pic-2" src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}">
                                            @endif
                                            </a>
                                            @if($product->flash_deals == 1)
                                            <ul class="countdown-{{ $product->product_token }}" id="countdown-timer">
                                                <li>
                                                    <span class="days">00</span>
                                                    <p class="days_ref">{{ Helper::translation(2071,$translate) }}</p>
                                                </li>
                                                <li>
                                                    <span class="hours">00</span>
                                                    <p class="hours_ref">{{ Helper::translation(2072,$translate) }}</p>
                                                </li>
                                                <li>
                                                    <span class="minutes">00</span>
                                                    <p class="minutes_ref">{{ Helper::translation(2073,$translate) }}</p>
                                                </li>
                                                <li>
                                                    <span class="seconds last">00</span>
                                                    <p class="seconds_ref">{{ Helper::translation(2074,$translate) }}</p>
                                                </li>
                                            </ul>
                                            @endif
                                            <ul class="social">
                                                @if(Auth::guest())
                                                <li><a href="{{ url('/login') }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @else
                                                @if(Auth::user()->id != $product->user_id)
                                                <li><a href="{{ url('/wishlist') }}/{{ Auth::user()->id }}/{{ $product->product_token }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>@endif @endif
                                                <li><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}" data-tip="{{ Helper::translation(2067,$translate) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                            <a class="add-to-cart" href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ Helper::translation(2067,$translate) }}</a>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ $product->product_name }}</a></h3>
                                            <span class="price like">@if($product->product_offer_price != 0)<span class="linethrow">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@else<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif</span>
                                        </div>
                                        </div>
                                    </div>
                                   @php $z++; @endphp      
                            @endforeach
                            </div>
                            <div class="row">
                               <div class="col-md-12" align="center">
                    <div class="turn-page" id="itempager"></div>
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