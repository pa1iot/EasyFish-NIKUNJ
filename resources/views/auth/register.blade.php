@if($allsettings->maintenance_mode == 0)
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>{{ Helper::translation(2212,$translate) }} - {{ $allsettings->site_title }}</title>
        @include('style')
        {!! NoCaptcha::renderJs() !!}
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
               <h2>{{ Helper::translation(2213,$translate) }}</h2>
                   <p>{{ Helper::translation(2214,$translate) }} <br/> {{ Helper::translation(2215,$translate) }}</p>
               </div>
              <form method="POST" action="{{ route('register') }}" id="login_form">
               @csrf
               <div class="form-group">
                    <label for="urname">{{ Helper::translation(2216,$translate) }}<span class="required">*</span></label>
                       <input id="name" type="text" class="form-control" name="name" placeholder="{{ Helper::translation(2217,$translate) }}" value="{{ old('name') }}" data-bvalidator="required" autocomplete="name" autofocus>                         @error('name')
                         <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                      </div>
                  <div class="form-group">
                    <label for="user_name">{{ Helper::translation(2101,$translate) }}<span class="required">*</span></label>
                    <input id="username" type="text" name="username" class="form-control" placeholder="{{ Helper::translation(2218,$translate) }}" data-bvalidator="required">
                  </div>
                 <div class="form-group">
                 <label for="email_ad">{{ Helper::translation(2001,$translate) }} <span class="required">*</span></label>
                 <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ Helper::translation(2034,$translate) }}"  autocomplete="email" data-bvalidator="email,required">                     @error('email')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                </div>
                @if($allsettings->type_of_marketplace == 'multi-vendor')
                <div class="form-group">
                <label for="email_ad">{{ Helper::translation(2219,$translate) }} <span class="required">*</span></label>
                   <select id="user_type" class="form-control" name="user_type" data-bvalidator="required">
                      <option value=""></option>
                      <option value="customer">{{ Helper::translation(2220,$translate) }}</option>
                      <option value="vendor">{{ Helper::translation(2112,$translate) }}</option>
                   </select>
                </div>
                @else
                <input type="hidden" name="user_type" value="customer">
                @endif
                <div class="form-group">
                <label for="email_ad">{{ Helper::translation(2007,$translate) }} <span class="required">*</span></label>
                   <select id="user_country" class="form-control" name="user_country" data-bvalidator="required">
                      <option value=""></option>
                      @foreach($allcountry as $country)
                      <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
                      @endforeach
                   </select>
                </div>
                <div class="form-group">
                    <label for="password">{{ Helper::translation(2102,$translate) }} <span class="required">*</span></label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('Enter your password') }}" autocomplete="new-password" data-bvalidator="required">
                       @error('password')
                       <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                       </span>
                       @enderror
                </div>
                <div class="form-group">
                    <label for="con_pass"> {{ Helper::translation(2162,$translate) }} <span class="required">*</span></label>
                       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ Helper::translation(2221,$translate) }}" data-bvalidator="equal[password],required" autocomplete="new-password"></div>
                 <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                <label for="con_pass">{{ Helper::translation(2222,$translate) }}<span class="required">*</span></label>
                {!! app('captcha')->display() !!}
                @if ($errors->has('g-recaptcha-response'))
                  <span class="help-block">
                     <strong class="red">{{ $errors->first('g-recaptcha-response') }}</strong>
                  </span>
                @endif
              </div>
             <button type="submit" class="btn button-color btn-block rounded button-off">{{ Helper::translation(2212,$translate) }}</button>
             <div class="d-flex justify-content-between forgot">
             <div>
             </div>
             <div>
             <a href="{{ URL::to('/login') }}" class="link-color">{{ Helper::translation(2223,$translate) }}</a>
             </div>
             </div>
             </div>
            </form>
         </div>
       </div>
    </div>
    </div>
    @include('script')
</body>
</html>
@else
@include('503')
@endif