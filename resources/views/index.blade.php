@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(1913,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <main role="main" class="main-content">
      @if(count($slideshow['view']) != 0)
      <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
        @php $k = 1; @endphp
        @foreach($slideshow['view'] as $slide)
          <li data-target="#myCarousel" data-slide-to="{{ $k }}" @if($k == 1) class="active" @endif></li>
          @php $k++; @endphp
          @endforeach
        </ol>
        <div class="carousel-inner">
          @php $k = 1; @endphp
          @foreach($slideshow['view'] as $slide)
          <div class="carousel-item @if($k == 1) active @endif">
            <img class="first-slide img-fluid" src="{{ url('/') }}/public/storage/slideshow/{{ $slide->slide_image }}" alt="{{ $slide->slide_image }}">
            <div class="container">
              <div class="carousel-caption @if($slide->slide_text_position != '') text-{{ $slide->slide_text_position }} @else text-left @endif">
                <h1>{{ $slide->slide_title }}</h1>
                <p>{{ $slide->slide_desc }}</p>
                <p>@if($slide->slide_btn_link != '')<a class="btn button-color" href="{{ $slide->slide_btn_link }}" role="button" target="_blank">@endif @if($slide->slide_btn_text != '') {{ $slide->slide_btn_text }} @endif @if($slide->slide_btn_link != '')</a>@endif</p>
              </div>
            </div>
          </div>
          @php $k++; @endphp
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">{{ Helper::translation(2054,$translate) }}</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">{{ Helper::translation(2055,$translate) }}</span>
        </a>
      </div>
      @endif

     @if(count($categorybox['view']) != 0)
      <div class="container white-box">
        <h4 class="black mb-2 pb-2">{{ Helper::translation(2056,$translate) }}</h4>
        <div class="row">
         @foreach($categorybox['view'] as $category)
          <div class="icon-category pt-2 pb-2 ash-border col-lg-2 col-md-2 col-sm-4  ml-3 mr-3" align="center">
            <a href="{{ URL::to('/shop/category') }}/{{ $category->category_slug }}" title="{{ $category->category_name }}">
            @if($category->category_image != '')
            <img src="{{ url('/') }}/public/storage/category/{{ $category->category_image }}" alt="{{ $category->category_name }}">
            @else
            <img src="{{ url('/') }}/public/img/no-image.jpg" alt="{{ $category->category_name }}">
            @endif
            </a>
            <p><a href="{{ URL::to('/shop/category') }}/{{ $category->category_slug }}" class="link-color fs14">{{ $category->category_name }}</a></p>
          </div>
          @endforeach
          @if(count($categorybox['view']) != 0)
          <div class="icon-category pt-2 pb-2 ash-border col-lg-2 col-md-2 col-sm-4  ml-3 mr-3" align="center">
            <a href="{{ URL::to('/shop') }}" title="More">
            @if($allsettings->site_more_category != '')
            <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_more_category }}" alt="More">
            @else
            <img src="{{ url('/') }}/public/img/no-image.jpg" alt="More">
            @endif
            </a>
            <p><a href="{{ URL::to('/shop') }}" class="link-color fs14">{{ Helper::translation(2057,$translate) }}</a></p>
          </div>
          @endif
        </div><!-- /.row -->
      </div>
      @endif
     @if($allsettings->site_home_top_banner == 1)
     <div class="container pt-3 mt-3 pb-3 mb-3 p-0">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
        <div class="basic-padding">
            <div class="image-hover">
              @if($allsettings->site_banner_one != '')
              <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner_one }}" alt="{{ $allsettings->site_banner_one_heading }}">
              @else
              <img src="{{ url('/') }}/public/img/no-image.jpg" alt="More">
              @endif
              <div class="overlay-pro">
                <h2>{{ Helper::translation(2943,$translate) }}</h2>
                @if($allsettings->site_banner_one_link != '')<a href="{{ $allsettings->site_banner_one_link }}" class="btn-hover">{{ Helper::translation(2058,$translate) }}</a>@endif
              </div>
            </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
        <div class="basic-padding">
            <div class="image-hover">
              @if($allsettings->site_banner_two != '')
              <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner_two }}" alt="{{ $allsettings->site_banner_two_heading }}">
              @else
              <img src="{{ url('/') }}/public/img/no-image.jpg" alt="More">
              @endif
              <div class="overlay-pro">
                <h2>{{ Helper::translation(2946,$translate) }}</h2>
                @if($allsettings->site_banner_two_link != '')<a href="{{ $allsettings->site_banner_two_link }}" class="btn-hover">{{ Helper::translation(2058,$translate) }}</a>@endif
              </div>
            </div>
        </div>
      </div>
      </div>
      </div>
      @endif
      @if(count($physical['product']) != 0)
       <div class="container pt-3 mt-3 pb-3 mb-3">
         <div class="row">
         <h4 class="black mb-2 pb-2">{{ Helper::translation(2059,$translate) }}</h4>
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                            @php $z = 1; @endphp
                              @foreach($physical['product'] as $product)
                                    <div class="swiper-slide">
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
                                    <div class="mt-3">@if($product->product_price != 0)<span @if($product->product_offer_price != 0) class="fs16 offer-price red-color" @else class="fs32" @endif>{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="fs32">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@endif</div>
                                    <p class="mt-3">
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
                                            <ul class="social">
                                                @if(Auth::guest())
                                                <li><a href="{{ url('/login') }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @else
                                                @if(Auth::user()->id != $product->user_id)
                                                <li><a href="{{ url('/wishlist') }}/{{ Auth::user()->id }}/{{ $product->product_token }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @endif
                                                @endif
                                                <li><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}" data-tip="{{ Helper::translation(2067,$translate) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                            <a class="add-to-cart" href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ Helper::translation(2067,$translate) }}</a>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ $product->product_name }}</a></h3>
                                            <span class="price">@if($product->product_offer_price != 0)<span class="linethrow">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@else<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif</span>
                                        </div>
                                    </div>
                                    </div>
                                   @php $z++; @endphp
                            @endforeach
                            </div>
                            <div class="swiper-button-next swiper-button-white"></div>
                    <div class="swiper-button-prev swiper-button-white"></div>
                </div>
               </div>
        </div>
        @endif
        @if(count($external['product']) != 0)
        <div class="container mt-4 mb-4 pt-4 pb-4">
         <div class="row">
         <h4 class="black mb-2 pb-2">{{ Helper::translation(2068,$translate) }}</h4>
         <div class="swiper-container">
                            <div class="swiper-wrapper">
                            @php $y = 1; @endphp
                              @foreach($external['product'] as $product)
                                    <div class="swiper-slide">
                                    <div class="product-grid2">
                                    <div class="product-image2">
                                    <div class="product-hider">
                               <a href="{{ url('/') }}/public/storage/product/{{ $product->product_image }}" data-fancybox="quick-view-{{ $product->product_token.$y }}" data-type="image" class="quickview">
                               <i class="fa fa-eye"></i>
                               <p>{{ Helper::translation(2060,$translate) }}<br/>{{ Helper::translation(2061,$translate) }}</p>
                               </a>
                               <div class="product-images">
                                    @php $imagecount = count($product->productimages); @endphp
                                    @if($imagecount != 0)
                                    @foreach($product->productimages as $images)
                                    <a href="{{ url('/') }}/public/storage/product/{{ $images->product_image }}" data-fancybox="quick-view-{{ $product->product_token.$y }}" data-type="image"></a>
                                    @endforeach
                                    @endif
                                    </div>
                                    <div class="product-former">
                                    <h3>{{ $product->product_name }}</h3>
                                    <div class="mt-3">{{ Helper::translation(2062,$translate) }} : @if($product->product_stock != 0)<span class="theme-color">{{ Helper::translation(2063,$translate) }} ({{ $product->product_stock }})</span>@else<span class="red-color">{{ Helper::translation(2064,$translate) }} ({{ $product->product_stock }})</span>@endif</div>
            @php if($product->product_condition == 'new'){ $badg = "badge badge-warning"; } else { $badg = "badge badge-secondary"; } @endphp
            @if($product->product_condition != "")<div class="mt-2">{{ Helper::translation(1950,$translate) }} : <span class="{{ $badg }}">{{ $product->product_condition }}</span></div>@endif
                                    <div class="mt-3">@if($product->product_price != 0)<span @if($product->product_offer_price != 0) class="fs16 offer-price red-color" @else class="fs32" @endif>{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="fs32">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@endif</div>
                                    <p class="mt-3">
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
                                            <ul class="social">
                                                @if(Auth::guest())
                                                <li><a href="{{ url('/login') }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @else
                                                @if(Auth::user()->id != $product->user_id)
                                                <li><a href="{{ url('/wishlist') }}/{{ Auth::user()->id }}/{{ $product->product_token }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @endif
                                                @endif
                                                <li><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}" data-tip="{{ Helper::translation(2067,$translate) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                            <a class="add-to-cart" href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ Helper::translation(2067,$translate) }}</a>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ $product->product_name }}</a></h3>
                                            <span class="price">@if($product->product_offer_price != 0)<span class="linethrow">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@else<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif</span>
                                        </div>
                                    </div>
                                    </div>
                                   @php $y++; @endphp
                            @endforeach
                            </div>
                            <div class="swiper-button-next swiper-button-white"></div>
                    <div class="swiper-button-prev swiper-button-white"></div>
                </div>
               </div>
        </div>
        @endif
        @if(count($digital['product']) != 0)
        <div class="container mt-4 mb-4 pt-4 pb-4">
         <div class="row">
         <h4 class="black mb-2 pb-2">{{ Helper::translation(2069,$translate) }}</h4>
         <div class="swiper-container">
                            <div class="swiper-wrapper">
                            @php $x = 1; @endphp
                              @foreach($digital['product'] as $product)
                                    <div class="swiper-slide">
                                    <div class="product-grid2">
                                    <div class="product-image2">
                                    <div class="product-hider">
                               <a href="{{ url('/') }}/public/storage/product/{{ $product->product_image }}" data-fancybox="quick-view-{{ $product->product_token.$x }}" data-type="image" class="quickview">
                               <i class="fa fa-eye"></i>
                               <p>{{ Helper::translation(2060,$translate) }}<br/>{{ Helper::translation(2061,$translate) }}</p>
                               </a>
                               <div class="product-images">
                                    @php $imagecount = count($product->productimages); @endphp
                                    @if($imagecount != 0)
                                    @foreach($product->productimages as $images)
                                    <a href="{{ url('/') }}/public/storage/product/{{ $images->product_image }}" data-fancybox="quick-view-{{ $product->product_token.$x }}" data-type="image"></a>
                                    @endforeach
                                    @endif
                                    </div>
                                    <div class="product-former">
                                    <h3>{{ $product->product_name }}</h3>
                                    <div class="mt-3">{{ Helper::translation(2062,$translate) }} : @if($product->product_stock != 0)<span class="theme-color">{{ Helper::translation(2063,$translate) }} ({{ $product->product_stock }})</span>@else<span class="red-color">{{ Helper::translation(2064,$translate) }} ({{ $product->product_stock }})</span>@endif</div>
            @php if($product->product_condition == 'new'){ $badg = "badge badge-warning"; } else { $badg = "badge badge-secondary"; } @endphp
            @if($product->product_condition != "")<div class="mt-2">{{ Helper::translation(1950,$translate) }} : <span class="{{ $badg }}">{{ $product->product_condition }}</span></div>@endif
                                    <div class="mt-3">@if($product->product_price != 0)<span @if($product->product_offer_price != 0) class="fs16 offer-price red-color" @else class="fs32" @endif>{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="fs32">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@endif</div>
                                    <p class="mt-3">
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
                                            <ul class="social">
                                                @if(Auth::guest())
                                                <li><a href="{{ url('/login') }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @else
                                                @if(Auth::user()->id != $product->user_id)
                                                <li><a href="{{ url('/wishlist') }}/{{ Auth::user()->id }}/{{ $product->product_token }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @endif
                                                @endif
                                                <li><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}" data-tip="{{ Helper::translation(2067,$translate) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                            <a class="add-to-cart" href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ Helper::translation(2067,$translate) }}</a>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ $product->product_name }}</a></h3>
                                            <span class="price">@if($product->product_offer_price != 0)<span class="linethrow">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@else<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif</span>
                                        </div>
                                    </div>
                                    </div>
                                   @php $x++; @endphp
                            @endforeach
                            </div>
                            <div class="swiper-button-next swiper-button-white"></div>
                    <div class="swiper-button-prev swiper-button-white"></div>
                </div>
            </div>
        </div>
        @endif
        @if($allsettings->site_home_bottom_banner == 1)
       <div class="container pt-3 mt-3 pb-3 mb-3 p-0">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
        <div class="basic-padding">
            <div class="image-hover">
              @if($allsettings->site_banner_three != '')
              <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner_three }}" alt="{{ $allsettings->site_banner_three_heading }}">
              @else
              <img src="{{ url('/') }}/public/img/no-image.jpg" alt="More">
              @endif
              <div class="overlay-pro">
                <h2>{{ Helper::translation(2949,$translate) }}</h2>
                @if($allsettings->site_banner_three_link != '')<a href="{{ $allsettings->site_banner_three_link }}" class="btn-hover">{{ Helper::translation(2058,$translate) }}</a>@endif
              </div>
            </div>
        </div>
      </div>
      </div>
      </div>
      @endif
      @if(count($deal['product']) != 0)
       <div class="container">
         <div class="row">
         <h4 class="black mb-2 pb-2">{{ Helper::translation(2070,$translate) }}</h4>
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                            @php $cj = 1; @endphp
                              @foreach($deal['product'] as $product)
                                    <div class="swiper-slide">
                                    <div class="product-grid2">
                                    <div class="product-image2">
                                    <div class="product-hider">
                               <a href="{{ url('/') }}/public/storage/product/{{ $product->product_image }}" data-fancybox="quick-view-{{ $product->product_token.$cj }}" data-type="image" class="quickview">
                               <i class="fa fa-eye"></i>
                               <p>{{ Helper::translation(2060,$translate) }}<br/>{{ Helper::translation(2061,$translate) }}</p>
                               </a>
                               <div class="product-images">
                                    @php $imagecount = count($product->productimages); @endphp
                                    @if($imagecount != 0)
                                    @foreach($product->productimages as $images)
                                    <a href="{{ url('/') }}/public/storage/product/{{ $images->product_image }}" data-fancybox="quick-view-{{ $product->product_token.$cj }}" data-type="image"></a>
                                    @endforeach
                                    @endif
                                    </div>
                                    <div class="product-former">
                                    <h3>{{ $product->product_name }}</h3>
                                    <div class="mt-3">{{ Helper::translation(2062,$translate) }} : @if($product->product_stock != 0)<span class="theme-color">{{ Helper::translation(2063,$translate) }} ({{ $product->product_stock }})</span>@else<span class="red-color">{{ Helper::translation(2064,$translate) }} ({{ $product->product_stock }})</span>@endif</div>
            @php if($product->product_condition == 'new'){ $badg = "badge badge-warning"; } else { $badg = "badge badge-secondary"; } @endphp
            @if($product->product_condition != "")<div class="mt-2">{{ Helper::translation(1950,$translate) }} : <span class="{{ $badg }}">{{ $product->product_condition }}</span></div>@endif
                                    <div class="mt-3">@if($product->product_price != 0)<span @if($product->product_offer_price != 0) class="fs16 offer-price red-color" @else class="fs32" @endif>{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="fs32">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@endif</div>
                                    <p class="mt-3">
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
                                            <ul class="social">
                                                @if(Auth::guest())
                                                <li><a href="{{ url('/login') }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @else
                                                @if(Auth::user()->id != $product->user_id)
                                                <li><a href="{{ url('/wishlist') }}/{{ Auth::user()->id }}/{{ $product->product_token }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @endif
                                                @endif
                                                <li><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}" data-tip="{{ Helper::translation(2067,$translate) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                            <a class="add-to-cart" href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ Helper::translation(2067,$translate) }}</a>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ $product->product_name }}</a></h3>
                                            <span class="price">@if($product->product_offer_price != 0)<span class="linethrow">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@else<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif</span>
                                        </div>
                                    </div>
                                    </div>
                                    @php $cj++; @endphp
                            @endforeach
                            </div>
                            <div class="swiper-button-next swiper-button-white"></div>
                    <div class="swiper-button-prev swiper-button-white"></div>
                </div>
               </div>
        </div>
        @endif
        @if(count($featured['product']) != 0)
        <div class="container mt-4 mb-4 pt-4 pb-4">
         <div class="row">
         <h4 class="black mb-2 pb-2">{{ Helper::translation(3060,$translate) }} {{ Helper::translation(1975,$translate) }}</h4>
         <div class="swiper-container">
                            <div class="swiper-wrapper">
                            @php $y = 1; @endphp
                              @foreach($external['product'] as $product)
                                    <div class="swiper-slide">
                                    <div class="product-grid2">
                                    <div class="product-image2">
                                    <div class="product-hider">
                               <a href="{{ url('/') }}/public/storage/product/{{ $product->product_image }}" data-fancybox="quick-view-{{ $product->product_token.$y }}" data-type="image" class="quickview">
                               <i class="fa fa-eye"></i>
                               <p>{{ Helper::translation(2060,$translate) }}<br/>{{ Helper::translation(2061,$translate) }}</p>
                               </a>
                               <div class="product-images">
                                    @php $imagecount = count($product->productimages); @endphp
                                    @if($imagecount != 0)
                                    @foreach($product->productimages as $images)
                                    <a href="{{ url('/') }}/public/storage/product/{{ $images->product_image }}" data-fancybox="quick-view-{{ $product->product_token.$y }}" data-type="image"></a>
                                    @endforeach
                                    @endif
                                    </div>
                                    <div class="product-former">
                                    <h3>{{ $product->product_name }}</h3>
                                    <div class="mt-3">{{ Helper::translation(2062,$translate) }} : @if($product->product_stock != 0)<span class="theme-color">{{ Helper::translation(2063,$translate) }} ({{ $product->product_stock }})</span>@else<span class="red-color">{{ Helper::translation(2064,$translate) }} ({{ $product->product_stock }})</span>@endif</div>
            @php if($product->product_condition == 'new'){ $badg = "badge badge-warning"; } else { $badg = "badge badge-secondary"; } @endphp
            @if($product->product_condition != "")<div class="mt-2">{{ Helper::translation(1950,$translate) }} : <span class="{{ $badg }}">{{ $product->product_condition }}</span></div>@endif
                                    <div class="mt-3">@if($product->product_price != 0)<span @if($product->product_offer_price != 0) class="fs16 offer-price red-color" @else class="fs32" @endif>{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="fs32">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@endif</div>
                                    <p class="mt-3">
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
                                            <ul class="social">
                                                @if(Auth::guest())
                                                <li><a href="{{ url('/login') }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @else
                                                @if(Auth::user()->id != $product->user_id)
                                                <li><a href="{{ url('/wishlist') }}/{{ Auth::user()->id }}/{{ $product->product_token }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @endif
                                                @endif
                                                <li><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}" data-tip="{{ Helper::translation(2067,$translate) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                            <a class="add-to-cart" href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ Helper::translation(2067,$translate) }}</a>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ $product->product_name }}</a></h3>
                                            <span class="price">@if($product->product_offer_price != 0)<span class="linethrow">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@else<span class="like">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif</span>
                                        </div>
                                    </div>
                                    </div>
                                   @php $y++; @endphp
                            @endforeach
                            </div>
                            <div class="swiper-button-next swiper-button-white"></div>
                    <div class="swiper-button-prev swiper-button-white"></div>
                </div>
               </div>
        </div>
        @endif
        @if(count($brand['view']) != 0)
        <div class="container mb-4 pb-4">
         <div class="row">
         <h4 class="black mb-3 pb-3 mt-4 pt-4">{{ Helper::translation(2075,$translate) }}</h4>
                    <div class="col-md-12">
                    <div id="client-logos" class="owl-carousel text-center">
                    @foreach($brand['view'] as $brand)
                    <div class="item">
                    <div class="client-inners">
                    <img src="{{ url('/') }}/public/storage/brands/{{ $brand->brand_image }}" alt="{{ $brand->brand_name }}" />
                    </div>
                    </div>
                    @endforeach
                    </div>
                    </div>
               </div>
        </div>
        @endif
    </main>
    @include('footer')
    @include('javascript')
    </body>
</html>
@else
@include('503')
@endif
