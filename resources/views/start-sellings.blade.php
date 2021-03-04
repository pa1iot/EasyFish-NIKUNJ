@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2051,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->selling_background }}');">
      <div class="container text-center">
        <div class="row"> 
        <div class="col-md-8 mx-auto">
        <h2 class="mb-0">{{ Helper::translation(2175,$translate) }}</h2>
        <p class="mb-5 mt-5 text-white fs21">{{ Helper::translation(2176,$translate) }} {{ $allsettings->site_title }}.</p>
        <a href="{{ URL::to('/register') }}" class="btn button-color black-color">{{ Helper::translation(2177,$translate) }}</a>
        </div>
        </div>
      </div>
    </section>
<main role="main">
      <div class="container page-white-box mt-3">
         <div class="row">
           <div class="col-md-4 mt-1 mb-1 pt-1 pb-1">
         	  <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->selling_image_one }}" border="0" class="img-fluid">
           </div>
           <div class="col-md-8 mt-1 mb-1 pt-1 pb-1">
             <h3 class="text-dark font-bold m-b-lg mt-3 mb-3">{{ Helper::translation(2178,$translate) }}</h3>
             <p class="line-height-35">
             <strong>1.</strong> {{ Helper::translation(2179,$translate) }}.<br>
             <strong>2.</strong> {{ Helper::translation(2180,$translate) }}.<br>
             <strong>3.</strong> {{ Helper::translation(2181,$translate) }}.<br>
             <strong>4.</strong> {{ Helper::translation(2182,$translate) }} {{ $allsettings->site_title }}.<br>
             <strong>5.</strong> {{ Helper::translation(2183,$translate) }}.<br>
             </p>
           </div>
         </div>
         @php
         $hundred = 100;
         $seller_commission = $hundred - $allsettings->site_admin_commission;
         @endphp
         <div class="row">
            <div class="col-md-8 mt-3 mb-3 pt-3 pb-3">
             <h3 class="text-dark font-bold m-b-lg mt-4 pt-5 mb-3">{{ Helper::translation(2184,$translate) }} {{ $seller_commission }}% {{ Helper::translation(2185,$translate) }}</h3>
            	<p class="line-height-35">
                <strong>1.</strong> {{ Helper::translation(2186,$translate) }} <strong>{{ $seller_commission }}%</strong>.<br>
                <strong>2.</strong> {{ Helper::translation(2187,$translate) }}<br>
                <strong>3.</strong> {{ Helper::translation(2188,$translate) }}<br>
                <strong>4.</strong> {{ Helper::translation(2189,$translate) }}<br>
                </p>
           </div>
            <div class="col-md-4 mt-3 mb-3 pt-3 pb-3">
         	  <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->selling_image_two }}" border="0" class="img-fluid">
           </div>
         </div>
         <div class="row">
           <div class="col-md-12 mt-3 mb-3 pt-3 pb-3" align="center">
	        <h3 class="text-center">{{ Helper::translation(2190,$translate) }}</h3>
            </div>
         </div>   
         <div class="row text-center">
	        <div class="col-md-4 tex-center mt-2 mb-2 pt-2 pb-2">
				<span><img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->selling_icon_one }}" border="0" class="img-fluid ss-icon"></span><br>
				<span class="text-lg ">{{ Helper::translation(2059,$translate) }}</span>
			</div>
			<div class="col-md-4 tex-center mt-2 mb-2 pt-2 pb-2">
				<span><img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->selling_icon_two }}" border="0" class="img-fluid ss-icon"></span><br>
				<span class="text-lg ">{{ Helper::translation(2068,$translate) }}</span>
			</div>
			<div class="col-md-4 tex-center mt-2 mb-2 pt-2 pb-2">
				<span><img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->selling_icon_three }}" border="0" class="img-fluid ss-icon"></span><br>
				<span class="text-lg ">{{ Helper::translation(2069,$translate) }}</span>
			</div>
		</div>
         <div class="row">
           <div class="col-md-4 mt-5 mb-3 pt-5 pb-3 mx-auto" align="center">
	        <h3 class="text-center">{{ Helper::translation(2191,$translate) }}</h3>
            <a href="{{ URL::to('/register') }}" class="btn button-color black-color mt-3 btn-block">{{ Helper::translation(2177,$translate) }}</a>
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