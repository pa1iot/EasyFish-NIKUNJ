@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2192,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2192,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2192,$translate) }}</span></p>
      </div>
    </section>
<main role="main">
      <div class="container page-white-box mt-3">
         <div class="row">
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1">
         	<div align="center"><h4>{{ Helper::translation(2193,$translate) }}</h4><br/>
                @if(!empty($payment_token))<h4> {{ Helper::translation(2194,$translate) }} : {{ $payment_token }}</h4>@endif
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