@if($allsettings->maintenance_mode == 0)
    <!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $shop->product_name }} - {{ $allsettings->site_title }}</title>
    @include('style')
    @if($shop->product_allow_seo == 1)
        <meta name="description" content="{{ $shop->product_seo_desc }}">
        <meta name="keywords" content="{{ $shop->product_seo_keyword }}">
    @else
        <meta name="description" content="{{ $allsettings->site_desc }}">
        <meta name="keywords" content="{{ $allsettings->site_keywords }}">
    @endif
</head>
<body>
@include('header')
<section class="headerbg"
         style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
    <div class="container text-left">
        <h2 class="mb-0">{{ $shop->product_name }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span>
            <a href="{{ URL::to('/shop') }}">{{ Helper::translation(2040,$translate) }}</a> <span
                class="split">&gt;</span><span> {{ $shop->product_name }}</span></p>
    </div>
</section>
<main role="main">
    <div class="container">
        @if($allsettings->shop_ads == 1)
            @if($allsettings->shop_top_ads !='')
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2" align="center">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        @php echo html_entity_decode($allsettings->shop_top_ads); @endphp
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            @endif
        @endif
        <div class="row bg-white border-0 mt-3 mb-3">
            <div class="col-md-12 mt-3">

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
            <div class="col-md-6 mt-3 mb-3" id="slider">
                <div class="item">
                    <div class="clearfix">
                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                            @if($shop->product_image != "")
                                <li data-thumb="{{ url('/') }}/public/storage/product/{{ $shop->product_image }}">
                                    <a href="">
                                        <img src="{{ url('/') }}/public/storage/product/{{ $shop->product_image }}"/>
                                    </a>
                                </li>
                            @endif
                            @php $imagecount = count($shop->productimages); @endphp
                            @if($imagecount != 0)
                                @foreach($shop->productimages as $images)
                                    <li data-thumb="{{ url('/') }}/public/storage/product/{{ $images->product_image }}">
                                        <a href="">
                                            <img
                                                src="{{ url('/') }}/public/storage/product/{{ $images->product_image }}"/>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3 mb-3">
                <form action="{{ route('cart') }}" class="cart_form" id="cart_form" method="post"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h3>{{ $shop->product_name }}</h3>
                    <span class="stars-active" style="width:88%">
                @if($getreview == 0)
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        @else
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
                        @endif
                <span>( {{ $getreview }} {{ Helper::translation(2144,$translate).' )' }}</span>
            </span>

                    @if($shop->product_type != 'digital')
                        <div class="mt-2">{{ Helper::translation(2062,$translate) }} : @if($shop->product_stock != 0)
                                <span class="theme-color">{{ Helper::translation(2063,$translate) }} ({{ $shop->product_stock }})</span>@else
                                <span class="red-color">{{ Helper::translation(2064,$translate) }} ({{ $shop->product_stock }})</span>@endif
                        </div>
                    @endif

                    @if($shop->product_type != 'digital')
                        @php $attri_value = 0; @endphp
                        @if(!empty($shop->product_attribute))
                            @php $product_attr = explode(',',$shop->product_attribute); @endphp
                            @if(count($attributer['display']) != 0)
                                @foreach($attributer['display'] as $attribute)
                                    @php $i = 1; @endphp
                                    @foreach($attribute->attributeagain as $product_value)
                                        @if(in_array($product_value->attribute_value_id,$product_attr))
                                            @if($i == 1)
                                                @php $attri_value += $product_value->attribute_value_price; @endphp
                                            @endif
                                            @php $i++; @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                @php $attri_value = 0; @endphp
                            @endif
                        @else
                            @php $attri_value = 0; @endphp
                        @endif
                    @else
                        @php $attri_value = 0; @endphp
                    @endif
                    <?php /*?><div class="mt-5" id="start">
            @if($shop->product_price != 0)<span @if($shop->product_offer_price != 0) class="fs16 offer-price red-color" @else class="fs32 display_result" @endif>{{ $allsettings->site_currency_symbol }}{{ $shop->product_price+$attri_value }}</span>@endif @if($shop->product_offer_price != 0)<span class="fs32 display_result">{{ $allsettings->site_currency_symbol }}{{ $shop->product_offer_price+$attri_value }}</span>@endif</div><?php */
                    ?>
                    <div class="mt-5" id="start">
                        @if($shop->product_offer_price != 0)<span
                            class="fs32 display_result">{{ $allsettings->site_currency_symbol }}{{ $shop->product_offer_price }}</span>@else
                            <span
                                class="fs32 display_result">{{ $allsettings->site_currency_symbol }}{{ $shop->product_price }}</span>@endif
                    </div>
                    @if(!empty($shop->product_offer_price))
                        <input type="hidden" name="foo" id="foo" data-price-effect="{{ $shop->product_offer_price }}"/>
                    @else
                        <input type="hidden" name="foo" id="foo" data-price-effect="{{ $shop->product_price }}"/>
                    @endif
                    @if($shop->flash_deals == 1)
                        <div class="single-details">
                            <ul class="countdown-{{ $shop->product_token }}" id="countdown-timer">
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
                        </div>
                    @endif
                    <div class="qty mt-5 mb-5">
                        @if($shop->product_type != 'digital')
                            <span>
                                              <label>{{ Helper::translation(2145,$translate) }}</label>
                                              <input type="number" name="qty" class="form-control qty_box" id="qty"
                                                     min="0.5" step="0.5"
                                                     data-bvalidator="required,min[0.5],max[{{ $shop->product_stock }}]"
                                                     value="0.5">
                                           </span>
                        @else
                            <input type="hidden" name="qty" value="1">
                        @endif
                        @if($shop->product_type != 'digital')
                                <label>KG</label>
                            @php $product_attr = explode(',',$shop->product_attribute); @endphp
                            @if(count($attributer['display']) != 0)

                                @foreach($attributer['display'] as $attribute)
                                    <span>

                                              <label>{{ $attribute->attribute_name }}</label>
                                        <span>{{ $product_value->attribute_value }}</span>
{{--                                              <select name="product_attribute[]" class="form-control qty_box attri_box"--}}
{{--                                                      required>--}}
{{--                                                 <option value="" data-price-effect="0"></option>--}}
{{--                                                 @foreach($attribute->attributeagain as $product_value)--}}
{{--                                                      @if(in_array($product_value->attribute_value_id,$product_attr))--}}
{{--                                                          <option--}}
{{--                                                              value="{{ $product_value->attribute_value_id }}_{{ $attribute->attribute_name }} - {{ $product_value->attribute_value }}"--}}
{{--                                                              data-price-effect="{{ $product_value->attribute_value_price }}">{{ $product_value->attribute_value }}</option>@endif--}}
{{--                                                  @endforeach--}}
{{--                                             </select>--}}
                                           </span>
                                @endforeach
                            @endif
                        @endif
                    </div>
{{--                    <div class="mt-2">{{ Helper::translation(1987,$translate) }} : <span><a--}}
{{--                                href="{{ URL::to('/user') }}/{{ $seller->username }}"--}}
{{--                                class="theme-color">{{ $seller->name }}</a></span></div>--}}
                    @if($shop->product_type != 'digital')
                        <div class="mt-2">{{ Helper::translation(2094,$translate) }} :
                            <span>{{ $shop->product_estimate_time }} {{ Helper::translation(2071,$translate) }}</span>
                        </div>@endif
                    @if(Auth::guest())
                        <div class="mt-3">
                            @if($shop->product_video_url != '')
                                <a class="bla-2 btn btn-danger float-left mr-1" href="{{ $shop->product_video_url }}"><i
                                        class="fa fa-file-video-o"></i> {{ Helper::translation(2147,$translate) }}</a>
                            @endif
                            <a href="{{ URL::to('/login') }}"
                               class="btn button-color float-left">{{ Helper::translation(2067,$translate) }}</a>
                        </div>
                    @else
                        @if($shop->product_stock != 0)
                            @if($shop->user_id != Auth::user()->id)
                                @if($shop->product_type != 'external')
                                    <div class="mt-3">
                                        @if($shop->product_video_url != '')
                                            <a class="bla-2 btn btn-danger float-left mr-1"
                                               href="{{ $shop->product_video_url }}"><i
                                                    class="fa fa-file-video-o"></i> {{ Helper::translation(2147,$translate) }}
                                            </a>
                                        @endif
                                        <button type="submit"
                                                class="btn button-color float-left">{{ Helper::translation(2067,$translate) }}</button>
                                    </div>
                                @else
                                    <div class="mt-3">
                                        @if($shop->product_video_url != '')
                                            <a class="bla-2 btn btn-danger float-left mr-1"
                                               href="{{ $shop->product_video_url }}"><i
                                                    class="fa fa-file-video-o"></i> {{ Helper::translation(2147,$translate) }}
                                            </a>
                                        @endif
                                        <a href="{{ $shop->product_external_url }}" class="btn button-color float-left"
                                           target="_blank">{{ Helper::translation(2148,$translate) }}</a>
                                    </div>
                                @endif
                            @else
                                <div class="mt-3">
                                    @if($shop->product_video_url != '')
                                        <a class="bla-2 btn btn-danger float-left mr-1"
                                           href="{{ $shop->product_video_url }}"><i
                                                class="fa fa-file-video-o"></i> {{ Helper::translation(2147,$translate) }}
                                        </a>
                                    @endif
                                    <a href="{{ URL::to('/edit-product') }}/{{ $shop->product_token }}"
                                       class="btn button-color float-left">{{ Helper::translation(2149,$translate) }}</a>
                                </div>
                            @endif
                        @endif
                    @endif
                    <input type="hidden" name="product_token" value="{{ $shop->product_token }}">
                    <input type="hidden" name="product_id" value="{{ $shop->product_id }}">
                    @if(!empty($shop->product_offer_price))
                        <input type="hidden" name="price" id="price"
                               value="{{ base64_encode($shop->product_offer_price+$attri_value) }}">
                    @else
                        <input type="hidden" name="price" id="price"
                               value="{{ base64_encode($shop->product_price+$attri_value) }}">
                    @endif
                    <input type="hidden" name="product_user_id" value="{{ $shop->user_id }}">
                    <input type="hidden" name="product_stock" value="{{ $shop->product_stock }}">
                </form>
                <div class="footer-box-info mt-3 mb-3 pt-3 pb-3 clearfix">
                    <p class="font-weight-bold">{{ Helper::translation(2150,$translate) }} : </p>
                    <ul class="social-icons">
                        <li>
                            <a class="share-button" data-share-url="{{ URL::to('/product') }}/{{ $shop->product_slug }}"
                               data-share-network="facebook" data-share-text="{{ $shop->product_short_desc }}"
                               data-share-title="{{ $shop->product_name }}"
                               data-share-via="{{ $allsettings->site_title }}" data-share-tags=""
                               data-share-media="{{ url('/') }}/public/storage/product/{{ $shop->product_image }}"
                               href="javascript:void(0)">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a class="share-button" data-share-url="{{ URL::to('/product') }}/{{ $shop->product_slug }}"
                               data-share-network="twitter" data-share-text="{{ $shop->product_short_desc }}"
                               data-share-title="{{ $shop->product_name }}"
                               data-share-via="{{ $allsettings->site_title }}" data-share-tags=""
                               data-share-media="{{ url('/') }}/public/storage/product/{{ $shop->product_image }}"
                               href="javascript:void(0)">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a class="share-button" data-share-url="{{ URL::to('/product') }}/{{ $shop->product_slug }}"
                               data-share-network="googleplus" data-share-text="{{ $shop->product_short_desc }}"
                               data-share-title="{{ $shop->product_name }}"
                               data-share-via="{{ $allsettings->site_title }}" data-share-tags=""
                               data-share-media="{{ url('/') }}/public/storage/product/{{ $shop->product_image }}"
                               href="javascript:void(0)">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a class="share-button" data-share-url="{{ URL::to('/product') }}/{{ $shop->product_slug }}"
                               data-share-network="linkedin" data-share-text="{{ $shop->product_short_desc }}"
                               data-share-title="{{ $shop->product_name }}"
                               data-share-via="{{ $allsettings->site_title }}" data-share-tags=""
                               data-share-media="{{ url('/') }}/public/storage/product/{{ $shop->product_image }}"
                               href="javascript:void(0)">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 mb-5">
                <div class="card mt-3 tab-card">
                    <div class="card-header tab-card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab"
                                   aria-controls="One"
                                   aria-selected="true">{{ Helper::translation(1931,$translate) }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab"
                                   aria-controls="Two"
                                   aria-selected="false">{{ Helper::translation(2151,$translate) }}</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab"--}}
{{--                                   aria-controls="Three"--}}
{{--                                   aria-selected="false">{{ Helper::translation(1939,$translate) }}</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab"--}}
{{--                                   aria-controls="Four"--}}
{{--                                   aria-selected="false">{{ Helper::translation(1948,$translate) }}</a>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                            @php echo html_entity_decode($shop->product_desc); @endphp
                        </div>
                        <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                            @foreach($getreviewdata['view'] as $rating)
                                <div class="container mt-2 mb-2">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="avatar">
                                                <a href="{{ URL::to('/user') }}/{{ $rating->username }}">
                                                    @if($rating->user_photo!='')
                                                        <img
                                                            src="{{ url('/') }}/public/storage/users/{{ $rating->user_photo }}"
                                                            alt="{{ $rating->username }}" class="media-object">
                                                    @else
                                                        <img src="{{ url('/') }}/public/img/no-user.png"
                                                             alt="{{ $rating->username }}" class="media-object">
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <a href="{{ URL::to('/user') }}/{{ $rating->username }}"
                                               class="review-user">
                                                {{ $rating->username }}
                                            </a>
                                            <p class="comment-text">{{ $rating->review }}</p>
                                            <p>
                                                @if($rating->rating == 0)
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                                @if($rating->rating == 1)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                                @if($rating->rating == 2)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                                @if($rating->rating == 3)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                                @if($rating->rating == 4)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                                @if($rating->rating == 5)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
{{--                        <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">--}}
{{--                            @foreach($product_tag as $tags)--}}
{{--                                @if(!empty($tags))--}}
{{--                                    <a href="{{ url('/shop') }}/{{ strtolower(str_replace(' ','-',$tags)) }}"--}}
{{--                                       class="fs13 tag-btn">{{ $tags }}</a>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade p-3" id="four" role="tabpanel" aria-labelledby="four-tab">--}}
{{--                            <p>@php echo nl2br($shop->product_return_policy); @endphp</p>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            @if(count($another['product']) != 0)
                <div class="col-md-12 mb-5">
                    <h4 class="black mb-2 pb-2 text-center">{{ Helper::translation(2152,$translate) }}</h4>
                    <div class="row mt-3 pt-3" align="center">
                        @php $z = 1; @endphp
                        @foreach($another['product'] as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-2 pb-2">
                                <div class="product-grid2">
                                    <div class="product-image2">
                                        <div class="product-hider">
                                            <a href="{{ url('/') }}/public/storage/product/{{ $product->product_image }}"
                                               data-fancybox="quick-view-{{ $product->product_token.$z }}"
                                               data-type="image" class="quickview">
                                                <i class="fa fa-eye"></i>
                                                <p>{{ Helper::translation(2060,$translate) }}
                                                    <br/>{{ Helper::translation(2061,$translate) }}</p>
                                            </a>
                                            <div class="product-images">
                                                @php $imagecount = count($product->productimages); @endphp
                                                @if($imagecount != 0)
                                                    @foreach($product->productimages as $images)
                                                        <a href="{{ url('/') }}/public/storage/product/{{ $images->product_image }}"
                                                           data-fancybox="quick-view-{{ $product->product_token.$z }}"
                                                           data-type="image"></a>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="product-former">
                                                <h3>{{ $product->product_name }}</h3>
                                                <div class="mt-3">{{ Helper::translation(2062,$translate) }}
                                                    : @if($product->product_stock != 0)<span class="theme-color">{{ Helper::translation(2063,$translate) }} ({{ $product->product_stock }})</span>@else
                                                        <span class="red-color">{{ Helper::translation(2064,$translate) }} ({{ $product->product_stock }})</span>@endif
                                                </div>
                                                @php if($product->product_condition == 'new'){ $badg = "badge badge-warning"; } else { $badg = "badge badge-secondary"; } @endphp
                                                @if($product->product_condition != "")
                                                    <div class="mt-2">{{ Helper::translation(1950,$translate) }} : <span
                                                            class="{{ $badg }}">{{ $product->product_condition }}</span>
                                                    </div>@endif
                                                <div class="mt-3">@if($product->product_price != 0)<span
                                                        @if($product->product_offer_price != 0) class="fs16 offer-price red-color"
                                                        @else class="fs32" @endif>{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>@endif @if($product->product_offer_price != 0)
                                                        <span
                                                            class="fs32">{{ $allsettings->site_currency_symbol }}{{ $product->product_offer_price }}</span>@endif
                                                </div>
                                                <p class="mt-3">
                                                    {{ $product->product_short_desc }}
                                                </p>
                                                <p><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}"
                                                      class="btn button-color">{{ Helper::translation(2065,$translate) }}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <a href="{{ URL::to('/product') }}/{{ $product->product_slug }}">
                                            @if($product->product_image != "")
                                                <img class="pic-1"
                                                     src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}">
                                            @else
                                                <img class="pic-1" src="{{ url('/') }}/public/img/no-image.jpg">
                                            @endif
                                            @php $imagecount = count($product->productimages); @endphp
                                            @if($imagecount != 0)
                                                @php $no = 1; @endphp
                                                @foreach($product->productimages as $images)
                                                    @if($no == 1)
                                                        <img class="pic-2"
                                                             src="{{ url('/') }}/public/storage/product/{{ $images->product_image }}">
                                                    @endif
                                                    @php $no++; @endphp
                                                @endforeach
                                            @else
                                                <img class="pic-2"
                                                     src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}">
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
                                                <li><a href="{{ url('/login') }}"
                                                       data-tip="{{ Helper::translation(2066,$translate) }}"><i
                                                            class="fa fa-shopping-bag"></i></a></li>
                                            @else
                                                @if(Auth::user()->id != $product->user_id)
                                                    <li>
                                                        <a href="{{ url('/wishlist') }}/{{ Auth::user()->id }}/{{ $product->product_token }}"
                                                           data-tip="{{ Helper::translation(2066,$translate) }}"><i
                                                                class="fa fa-shopping-bag"></i></a></li>
                                                @endif
                                            @endif
                                            <li><a href="{{ URL::to('/product') }}/{{ $product->product_slug }}"
                                                   data-tip="{{ Helper::translation(2067,$translate) }}"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                        <a class="add-to-cart"
                                           href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ Helper::translation(2067,$translate) }}</a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a
                                                href="{{ URL::to('/product') }}/{{ $product->product_slug }}">{{ $product->product_name }}</a>
                                        </h3>
                                        <span
                                            class="price like">{{ $allsettings->site_currency_symbol }}{{ $product->product_price }}</span>
                                    </div>
                                </div>
                            </div>
                            @php $z++; @endphp
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        @if($allsettings->shop_ads == 1)
            @if($allsettings->shop_bottom_ads !='')
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2" align="center">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        @php echo html_entity_decode($allsettings->shop_bottom_ads); @endphp
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            @endif
        @endif
    </div>
</main>
@include('footer')
@include('javascript')
<script type="text/javascript">
    var EffectElements = $('form input[data-price-effect], form select');
    EffectElements.on('change', function () {
        var PriceEffect = 0;
        var GetErr = 0;
        EffectElements.each(function () { // Loop through elements
            if ($(this).is('.attri_box')) { //if this element is a select
                $(this).children().each(function () { //Loop through the child elements (options)
                    if ($(this).is(':selected')) { //if this option is selected
                        PriceEffect += parseFloat($(this).attr('data-price-effect')) * $("#qty").val();
                        GetErr += parseFloat($(this).attr('data-price-effect'));
                    }
                });
            } else {
                PriceEffect += parseFloat($(this).attr('data-price-effect')) * $("#qty").val();
                GetErr += parseFloat($(this).attr('data-price-effect'));
            }
        });
        $('.display_result').text("{{ $allsettings->site_currency_symbol }}" + PriceEffect);
        //$('#price').val($('#name').val());
        //$('#checkprice').val(btoa(PriceEffect));
        $('#price').val(btoa(GetErr));
    });
    $(document).ready(function () {
        var EffectElementer = $('form input[data-price-effect], form select');
        /*$("#qty").click(function(event) {*/
        $("#qty").bind('keyup mouseup', function (event) {
            var PriceEffect = 0;
            var GetErr = 0;
            var FinalEffect = 0;
            EffectElementer.each(function () {
                if ($(this).is('.attri_box')) {
                    $(this).children().each(function () { //Loop through the child elements (options)
                        if ($(this).is(':selected')) {
                            PriceEffect += parseFloat($(this).attr('data-price-effect')) * $("#qty").val();
                            GetErr += parseFloat($(this).attr('data-price-effect'));

                        }

                    });

                } else {
                    PriceEffect += parseFloat($(this).attr('data-price-effect')) * $("#qty").val();
                    GetErr += parseFloat($(this).attr('data-price-effect'));

                }
            });
            $('.display_result').text("{{ $allsettings->site_currency_symbol }}" + PriceEffect);
            $('#price').val(btoa(GetErr));

        });
    });
</script>
</body>
</html>
@else
    @include('503')
@endif
