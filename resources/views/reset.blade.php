@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{{ Helper::translation(2038,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
<section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2038,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2038,$translate) }}</span></p>
      </div>
    </section>
<main role="main">
<div class="container page-white-box mt-3">
<div class="row">
<div class="col-xl-12 col-md-12 col-sm-12">
    <div class="pb-3 mb-3 mt-3 pt-3 col-md-5 mx-auto">
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
        <div>
        <article class="card-body">
        <h4 class="card-title mb-4 mt-1">{{ Helper::translation(2038,$translate) }}</h4>
             <form method="POST" action="{{ route('reset') }}" id="reset_form">
             @csrf
             <input type="hidden" name="user_token" value="{{ $token }}">
            <div class="form-group">
                <label>{{ Helper::translation(2102,$translate) }}</label>
                <input type="password" class="form-control input-lg" name="password" placeholder="{{ Helper::translation(2102,$translate) }}" id="password" data-bvalidator="required">
            </div>
            <div class="form-group">
               <label>{{ Helper::translation(2162,$translate) }}</label>
                <input type="password" class="form-control input-lg" placeholder="{{ Helper::translation(2162,$translate) }}" name="password_confirmation" id="password_confirmation" data-bvalidator="equal[password],required">
            </div> 
            <div class="form-group">
                <button type="submit" class="btn button-color"> {{ Helper::translation(2038,$translate) }} </button>
            </div>                                                  
        </form>
        </article>
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