<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>{{ Helper::translation(2041,$translate) }} - {{ $allsettings->site_title }}</title>
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
               <h2>{{ Helper::translation(2041,$translate) }}</h2>
                   <p>{{ Helper::translation(2207,$translate) }}</p>
               </div>
               <form action="{{ route('login') }}" method="POST" id="login_form">
                @csrf
                <div class="form-group">
        
                    <label for="urname">{{ Helper::translation(2208,$translate) }}</label>
                    <input type="text" class="form-control rounded-0" name="email" placeholder="{{ Helper::translation(2208,$translate) }}" data-bvalidator="required">
                </div>
                <div class="form-group">
                    <label for="urname">{{ Helper::translation(2102,$translate) }}</label>
                    <input type="password" class="form-control rounded-0" name="password" placeholder="{{ Helper::translation(2102,$translate) }}" data-bvalidator="required">
                </div>
                <div class="d-flex justify-content-between forgot">
                <div>
                <a href="{{ URL::to('/forgot') }}" class="link-color">{{ Helper::translation(2209,$translate) }}</a>
                </div>
                <div>
                  <a href="{{ URL::to('/register') }}" class="link-color">{{ Helper::translation(2210,$translate) }}</a>
                </div>
                </div>
                <button type="submit" class="btn button-color btn-block rounded button-off">{{ Helper::translation(2041,$translate) }}</button>
                @if($allsettings->display_social_login == 1)
                <div class="row form-group mt-4">
                <div class="col-md-12">
                <label class="font-weight-bold" for="fullname">{{ Helper::translation(2211,$translate) }}</label>
                <div>
                <a href="{{ url('/login/facebook') }}">
                            <img src="{{ url('/') }}/public/img/fb.png" alt=""/>
                </a>
                <a href="{{ url('/login/google') }}">
                            <img src="{{ url('/') }}/public/img/gp.png" alt=""/>
                </a>
                </div>
                </div>
             </div>
             @endif
            </form>
         </div>
        </div>
      </div>
    </div>
    @include('script')
 </body>
</html>