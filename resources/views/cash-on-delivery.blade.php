@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2881,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2881,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2881,$translate) }}</span></p>
      </div>
    </section>
<main role="main">
      <div class="container page-white-box mt-3">
         <div class="row justify-content-center pb-5 mb-5 mt-3 pt-3">
          <div class="col-md-12">
                    <div class="product_archive added_to__cart pb-3 mb-3">
                        
                        <div class="panel-body mb-5 pb-5">
                        <h3>{{ Helper::translation(2882,$translate) }}</h3>
                        <h5 class="mt-3">{{ Helper::translation(2883,$translate) }} : {{ $purchase_token }}</h5>
							
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