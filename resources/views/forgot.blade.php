@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <title>{{ Helper::translation(2032,$translate) }} - {{ $allsettings->site_title }}</title>
        @include('style')

    </head>
	<body id="LoginForm">
	  <div class="container mt-5">
        <div align="center" class="mt-5 mb-5">
        @if($allsettings->site_logo != '')
    	<a href="{{ URL::to('/') }}" class="navbar-brand">
    	<img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="{{ $allsettings->site_title }}" class="logo">
    	</a>
    	@endif
        </div>
        <div class="login-form mt-5">
           <div class="main-div loginform col-md-5 mx-auto">
               <div>
                  @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                       <span class="alert_icon lnr lnr-checkmark-circle"></span>
                           {{ $message }}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close"></i>
                           </button>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                       <span class="alert_icon lnr lnr-warning"></span>
                          {{ $message }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close"></i>
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
                    <i class="fa fa-close"></i>
                    </button>
                    </div>
                    @endif
               </div>
               <div class="panel">
               <h2>{{ Helper::translation(2032,$translate) }}</h2>
                   <p>{{ Helper::translation(2033,$translate) }}</p>
               </div>
               <form method="POST" action="{{ route('forgot') }}" id="login_form">
               @csrf 
                <div class="form-group">
                 <label for="urname">{{ Helper::translation(2034,$translate) }}</label>
                 <input type="text" class="form-control input-lg" name="email" placeholder="{{ Helper::translation(2034,$translate) }}" data-bvalidator="email,required">
                </div>
               <button type="submit" class="btn button-color btn-block rounded button-off">{{ Helper::translation(2035,$translate) }}</button>
             </form>
         </div>
       </div>
    </div>
    </div>
    @include('javascript')
    </body>
</html>
@else
@include('503')
@endif