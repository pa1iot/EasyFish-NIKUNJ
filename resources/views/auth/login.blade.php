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
                <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}"
                     alt="{{ $allsettings->site_title }}" class="logo">
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

                    <div class="msg_class" style="display: none">
                    <div class="alert alert-danger" role="alert">
                        <span class="alert_icon lnr lnr-checkmark-circle"></span>
                       <div class="msg"></div>

                    </div>
                    </div>


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

                <div class="panel">
                    <h2>OTP Verification</h2>

                </div>
                <form method="POST" action="{{ route('SubmitVerifyOTPLogin') }}" id="login_form">

                    <div class="form-group">
                        <label for="otp">OTP<span
                                class="required">*</span></label>
                        <input id="otp" type="text" name="otp" class="form-control"
                               placeholder="OTP"
                               data-bvalidator="required">


                            <div class="d-flex justify-content-between forgot">

                                <a class="link-color" style="cursor: pointer" onclick="resendotp('{{!empty(Session::get('user_phone')) ? base64_encode(Session::get('user_phone')) : '' }}');">Resend OTP</a>

                            </div>

                            <div>
                                <input type="hidden" name="user_phone"
                                       value="{{!empty(Session::get('user_phone')) ? base64_encode(Session::get('user_phone')) : '' }}">
                            </div>

                            @csrf
                            @else
                                <div class="panel">
                                    <h2>{{ Helper::translation(2041,$translate) }}</h2>
                                    <p>{{ Helper::translation(2207,$translate) }}</p>
                                </div>
                                <form action="{{ route('SubmitLogin') }}" method="POST" id="login_form">
                                    @csrf

                                    <div class="form-group">

                                        <label for="urname">  {{ Helper::translation(3851,$translate) }}</label>
                                        <input type="text" class="form-control rounded-0" name="user_phone"
                                               placeholder="{{ Helper::translation(3851,$translate) }}"
                                               data-bvalidator="required">
                                    </div>

                                    <div class="d-flex justify-content-between forgot">
                                        {{--                                            <div>--}}
                                        {{--                                            <a href="{{ URL::to('/forgot') }}" class="link-color">{{ Helper::translation(2209,$translate) }}</a>--}}
                                        {{--                                            </div>--}}
                                        <div>
                                            <a href="{{ URL::to('/register') }}"
                                               class="link-color">{{ Helper::translation(2210,$translate) }}</a>
                                        </div>
                                    </div>


                                    @endif
                                    <button type="submit"
                                            class="btn button-color btn-block rounded button-off">{{ Helper::translation(2041,$translate) }}</button>
                                </form>
                        </div>
                    </div>
        </div>
    </div>
@include('script')

    <script>

        function resendotp(phone) {
            alert(phone);
            $.ajax({
                type: 'post',
                url: '{{url('resendotp')}}',
                data: {'_token':'<?php echo csrf_token() ?>','phone': phone},
                success: function (data) {
                     $(".alert-success").hide();
                     $(".msg_class").show();
                     $(".msg").html(data.success);
                    console.log(data);
                    console.log(data.success);
                }
            });
        }

    </script>

</body>
</html>
