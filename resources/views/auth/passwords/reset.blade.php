@include('version')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ __('Reset Password') }} - {{ $allsettings->site_title }}</title>
    @include('stylesheet')
    @include('dynamic-style')
</head>
<body class="preload home1 mutlti-vendor">
@include('header')
<section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="{{ URL::to('/') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="active">
                                <a href="{{ URL::to('/login') }}">{{ __('Reset Password') }}</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">{{ __('Reset Password') }}</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <section class="login_area section--padding2">
        <div class="container">
        <div>
        @if ($message = Session::get('success'))
         <div class="alert alert-success" role="alert">
            <span class="alert_icon lnr lnr-checkmark-circle"></span>
              {{ $message }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="lnr lnr-cross" aria-hidden="true"></span>
              </button>
         </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            <span class="alert_icon lnr lnr-warning"></span>
              {{ $message }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="lnr lnr-cross" aria-hidden="true"></span>
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
        <span class="lnr lnr-cross" aria-hidden="true"></span>
        </button>
        </div>
        @endif
        </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="cardify login">
                           <div class="login--form">
                                <div class="form-group">
                                    <label for="user_name">{{ __('E-Mail Address') }}</label>
                                   <input id="email" type="email" class="text_field @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                   @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pass">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="text_field @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pass">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="text_field" name="password_confirmation" required autocomplete="new-password">                                    
                               </div>
                               <button class="btn btn--md theme-button" type="submit">{{ __('Reset Password') }}</button>
                             </div>
                            <!-- end .login--form -->
                        </div>
                        <!-- end .cardify -->
                    </form>
                </div>
                <!-- end .col-md-6 -->
            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->
    </section>
@include('footer')
@include('javascript')
</body>
</html>