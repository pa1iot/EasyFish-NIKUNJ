@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2197,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2197,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2197,$translate) }}</span></p>
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
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1">
         	    <div class="container emp-profile">
                  <div class="row">
                    <div class="col-md-3 white-bg">
                        <div class="profile-img">
                        <a href="{{ URL::to('/user') }}/{{ $user_details->username }}" title="{{ $user_details->name }}">
                        @if($user_details->user_photo != "")
                        <img src="{{ url('/') }}/public/storage/users/{{ $user_details->user_photo }}" alt="" class="rounded">
                        @else
                        <img src="{{ url('/') }}/public/img/no-user.png" alt="" class="rounded">
                        @endif
                        </a>   
                        </div>
                        <div align="center">
                            <div class="info mt-2">
                        <div class="title">
                            <a href="{{ URL::to('/user') }}/{{ $user_details->username }}" title="{{ $user_details->username }}" class="theme-color">{{ $user_details->name }}</a>
                        </div>
                        <div class="desc">{{ $total_product }} {{ __('Products') }}</div>
                        </div>
                        <div class="stars-active">
                         @if($count_rating == 0)
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        @endif
                        @if($count_rating == 1)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        @endif
                        @if($count_rating == 2)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        @endif
                        @if($count_rating == 3)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        @endif
                        @if($count_rating == 4)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        @endif
                        @if($count_rating == 5)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        @endif
                        <span>( {{ $getreview }} {{ Helper::translation(2144,$translate) }} )</span>
                        </div>
                        </div>
                        </div> 
                       <div class="col-md-9 ash-bg">
                        <div class="profile-banner">
                         @if($user_details->user_banner != "")
                           <img src="{{ url('/') }}/public/storage/users/{{ $user_details->user_banner }}" alt="" class="rounded">
                         @else
                         <img src="{{ url('/') }}/public/img/no-image.jpg" alt="" class="rounded">
                         @endif  
                        </div>
                        <div class="profile-head">
                                    @if($user_details->user_address != "")
                                    <h4 class="text-white">
                                        {{ $user_details->user_address }}
                                    </h4>
                                    @endif
                                    <p class="theme-color">
                                        @if($user_details->country_name != ""){{ $user_details->country_name }},@endif Member since {{ date('F Y', strtotime($user_details->created_at)) }}
                                    </p>
                       </div>
                       <div class="tabnav mt-3">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ Helper::translation(2108,$translate) }}</a>
                                </li>
                                @if($user_details->user_type == 'vendor')
                                <li class="nav-item">
                                    <a class="nav-link show" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="true">{{ Helper::translation(1975,$translate) }}</a>
                                </li>
                                @endif
                               <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{ Helper::translation(2198,$translate) }}</a>
                                </li>
                                </ul>
                        </div>    
                        <div class="tab-content profile-tab" id="myTabContent_new">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                      <div class="row">
                                            <div class="col-md-3">
                                                <label>{{ Helper::translation(2018,$translate) }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <p>{{ $user_details->name }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>{{ Helper::translation(2014,$translate) }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <p>{{ $user_details->email }}</p>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-3">
                                                <label>{{ Helper::translation(2103,$translate) }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <p>{{ $user_details->user_gender }}</p>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-3">
                                                <label>{{ Helper::translation(2199,$translate) }}</label>
                                            </div>
                                            <div class="col-md-9">
                                               @php echo nl2br($user_details->user_about); @endphp
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>{{ Helper::translation(2200,$translate) }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <p>{{ $user_details->user_phone }}</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
                              <div class="mt-1 mb-1 pt-1 pb-1">
                           <div class="row" align="center">
                           @php $z = 1; @endphp
                              @foreach($shop['product'] as $product) 
                                   <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-2 pb-2">
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
                                                <li><a href="{{ url('/wishlist') }}/{{ Auth::user()->id }}/{{ $product->product_token }}" data-tip="{{ Helper::translation(2066,$translate) }}"><i class="fa fa-shopping-bag"></i></a></li>@endif
                                                @endif
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
                           </div>
                            </div>
                           <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                           <form action="{{ route('user') }}" class="seller_form" id="seller_form" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="row form-group">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                      <label class="font-weight-bold" for="fullname">{{ Helper::translation(2015,$translate) }}</label>
                                      <input type="text" id="from_name" class="form-control" name="from_name" placeholder="{{ Helper::translation(2015,$translate) }}" data-bvalidator="required">
                                    </div>
                                    
                                    <div class="col-md-6">
                                      <label class="font-weight-bold" for="email">{{ Helper::translation(2014,$translate) }}</label>
                                      <input type="text" id="email" class="form-control" name="from_email" placeholder="{{ Helper::translation(2001,$translate) }}" data-bvalidator="required,email">
                                    </div>
                                  </div>
                                 <div class="row form-group">
                                    <div class="col-md-12 mb-3 mb-md-0">
                                      <label class="font-weight-bold" for="phone">{{ Helper::translation(2002,$translate) }}</label>
                                      <input type="text" id="phone" class="form-control" name="phone" placeholder="{{ Helper::translation(2200,$translate) }}" data-bvalidator="required">
                                    </div>
                                 </div>
                                 <div class="row form-group">
                                  <div class="col-md-12">
                                      <label class="font-weight-bold" for="message">{{ Helper::translation(2126,$translate) }}</label> 
                                      <textarea name="message_text" id="message" cols="30" rows="5" class="form-control" data-bvalidator="required"></textarea>
                                    </div>
                                  </div>  
                                  <input type="hidden" name="to_email" value="{{ $user_details->email }}">
                                  <input type="hidden" name="to_name" value="{{ $user_details->name }}">
                                  <div class="row form-group">
                                    <div class="col-md-12">
                                      <input type="submit" value="{{ Helper::translation(2201,$translate) }}" class="btn button-color">
                                    </div>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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