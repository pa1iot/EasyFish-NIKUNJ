@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(1973,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
   @include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(1973,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(1973,$translate) }}</span></p>
      </div>
    </section>
  <main role="main">
      <div class="container page-white-box mt-3">
         <div class="row">
           @foreach($best['seller'] as $seller)
           <div class="col-lg-3 col-md-4 col-sm-6 mt-1 mb-1 pt-1 pb-1 prod-item">
    		    <div class="card profile-card-2">
                    <div class="card-img-block">
                      <a href="{{ URL::to('/user') }}/{{ $seller->username }}" title="{{ $seller->name }}">
                        @if($seller->user_banner != "")
                        <img class="img-fluid b-sellers" src="{{ url('/') }}/public/storage/users/{{ $seller->user_banner }}" alt="">
                        @else
                        <img class="img-fluid b-sellers" src="{{ url('/') }}/public/img/no-image.jpg" alt="">
                        @endif
                        </a>
                    </div>
                    <div class="card-body pt-5">
                    <a href="{{ URL::to('/user') }}/{{ $seller->username }}" title="{{ $seller->name }}">
                        @if($seller->user_photo != "")
                        <img src="{{ url('/') }}/public/storage/users/{{ $seller->user_photo }}" alt="" class="profile">
                        @else
                        <img src="{{ url('/') }}/public/img/no-image.jpg" alt="" class="profile">
                        @endif
                        </a>
                        <h5><a href="{{ URL::to('/user') }}/{{ $seller->username }}" class="theme-color">{{ $seller->name }}</a></h5>
                        <p class="card-text">{{ $product_count->has($seller->id) ? count($product_count[$seller->id]) : 0 }} {{ Helper::translation(1975,$translate) }}</p>
                        <p class="card-text">{{ $sale_count->has($seller->id) ? count($sale_count[$seller->id]) : 0 }} {{ Helper::translation(1976,$translate) }}</p>
                        <div><a href="{{ URL::to('/user') }}/{{ $seller->username }}" class="btn button-color">{{ Helper::translation(1977,$translate) }}</a></div>
                    </div>
                </div>
             </div>
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
