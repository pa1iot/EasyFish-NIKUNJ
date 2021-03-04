@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ $page['page']->page_title }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ $page['page']->page_title }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ $page['page']->page_title }}</span></p>
      </div>
    </section>
  <main role="main">
      <div class="container page-white-box mt-3">
         @if($allsettings->page_ads == 1)
      @if($allsettings->page_top_ads !='')
         <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-2" align="center">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    @php echo html_entity_decode($allsettings->page_top_ads); @endphp
                    <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
       </script>
      </div>
      </div>
      @endif 
      @endif
         <div class="row">
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1">
         	@php echo html_entity_decode($page['page']->page_desc); @endphp
           </div>
         </div>
         @if($allsettings->page_ads == 1)
      @if($allsettings->page_bottom_ads !='')
         <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-2" align="center">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    @php echo html_entity_decode($allsettings->page_bottom_ads); @endphp
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
</body>
</html>
@else
@include('503')
@endif