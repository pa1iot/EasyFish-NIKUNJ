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
                <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}"
                     alt="{{ $allsettings->site_title }}" class="logo">
            </a>
        @endif
    </div>
    <div class="login-form mt-5">
        <div class="main-div loginform col-md-5 mx-auto">
            <div>

                @if ($data = Session::get('data'))
                    <?php print_r($data);?>
                @endif
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


                    @if(Session::get('insertGetId'))
                        @php $btn_val= 'Verify OTP' ;@endphp

                    <div class="panel">
                        <h2>OTP Verification</h2>

                    </div>
                        <form method="POST" action="{{ route('SubmitVerifyOTP') }}" id="login_form">

                            <div class="form-group">
                                <label for="otp">OTP<span
                                        class="required">*</span></label>
                                <input id="otp" type="text" name="otp" class="form-control"
                                       placeholder="OTP"
                                       data-bvalidator="required">
                                <input type="hidden" name="user_phone" value="{{!empty(Session::get('user_phone')) ? base64_encode(Session::get('user_phone')) : '' }}">
                            </div>

                    @csrf
                    @else
                                @php $btn_val= Helper::translation(2212,$translate) ;@endphp
                            <div class="panel">
                                <h2>{{ Helper::translation(2213,$translate) }}</h2>
                                <p>{{ Helper::translation(2214,$translate) }} <br/> {{ Helper::translation(2215,$translate) }}</p>
                            </div>
                        <form method="POST" action="{{ route('register') }}" id="login_form">

                            @csrf

                            <div class="form-group">
                                <label for="urname">{{ Helper::translation(2216,$translate) }}<span
                                        class="required">*</span></label>
                                <input id="name" type="text" class="form-control" name="name"
                                       placeholder="{{ Helper::translation(2217,$translate) }}"
                                       value="{{ old('name') }}"
                                       data-bvalidator="required" autocomplete="name" autofocus> @error('name')
                                <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                         </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="user_name">{{ Helper::translation(2101,$translate) }}<span
                                        class="required">*</span></label>
                                <input id="username" type="text" name="username" class="form-control"
                                       placeholder="{{ Helper::translation(2218,$translate) }}"
                                       data-bvalidator="required">
                            </div>

                            <div class="form-group">
                                <label for="user_phone">{{ Helper::translation(3851,$translate) }}<span
                                        class="required">*</span></label>
                                <input id="user_phone" type="text" name="user_phone" class="form-control"
                                       placeholder="{{ Helper::translation(3851,$translate) }}"
                                       data-bvalidator="required">
                            </div>


                            <div class="form-group">
                                <label for="email_ad">{{ Helper::translation(2001,$translate) }} <span
                                        class="required"></span></label>
                                <input id="email" type="text" class="form-control" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="{{ Helper::translation(2034,$translate) }}" autocomplete="email"
                                       data-bvalidator="email"> @error('email')
                                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                                @enderror
                            </div>
                            <input type="hidden" name="user_type" value="customer">


                            @endif

                            <button type="submit"
                                    class="btn button-color btn-block rounded button-off">{{ $btn_val }}</button>
                            <div class="d-flex justify-content-between forgot">
                                <div>
                                </div>
                                <div>
                                    <a href="{{ URL::to('/login') }}"
                                       class="link-color">{{ Helper::translation(2223,$translate) }}</a>
                                </div>
                            </div>
                            {{--        </div>--}}
                        </form>
        </div>
    </div>
</div>
{{--</div>--}}
@include('script')
</body>
</html>
@else
    @include('503')
@endif
