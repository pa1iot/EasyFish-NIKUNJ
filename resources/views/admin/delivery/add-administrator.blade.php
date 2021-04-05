<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    @include('admin.stylesheet')
</head>

<body>
@include('admin.navigation')
<!-- Right Panel -->
@if(Auth::user()->id == 1)
    <div id="right-panel" class="right-panel">
        @include('admin.header')
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(3847,$translate) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">

                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="col-sm-12">
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="col-sm-12">
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)

                        {{$error}}

                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @if($demo_mode == 'on')
                                @include('admin.demo-mode')
                            @else
                                <form action="{{ route('admin.add-deliveryboy') }}" method="post" id="setting_form"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @endif
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <!-- Credit Card -->
                                            <div id="pay-invoice">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="name"
                                                               class="control-label mb-1">{{ Helper::translation(2018,$translate) }}
                                                            <span class="require">*</span></label>
                                                        <input id="name" name="name" type="text" class="form-control"
                                                               data-bvalidator="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name"
                                                               class="control-label mb-1">{{ Helper::translation(2101,$translate) }}
                                                            <span class="require">*</span></label>
                                                        <input id="username" name="username" type="text"
                                                               class="form-control" data-bvalidator="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email"
                                                               class="control-label mb-1">{{ Helper::translation(2014,$translate) }}
                                                            <span class="require">*</span></label>
                                                        <input id="email" name="email" type="text" class="form-control"
                                                               data-bvalidator="email,required">
                                                    </div>
                                                    <input type="hidden" name="user_type" value="deliveryboy">
                                                    <div class="form-group">
                                                        <label for="password"
                                                               class="control-label mb-1">{{ Helper::translation(2102,$translate) }}
                                                            <span class="require">*</span></label>
                                                        <input id="password" name="password" type="text"
                                                               class="form-control" data-bvalidator="required">
                                                    </div>
                                                    @if(Auth::user()->id == 1)
                                                        <div class="form-group">
{{--                                                            <label for="earnings" class="control-label mb-1">{{ Helper::translation(2973,$translate) }}--}}
{{--                                                                ({{ $allsettings->site_currency_symbol }})</label>--}}
                                                            <input id="earnings" name="earnings" type="hidden"
                                                                   class="form-control" data-bvalidator="min[0]">
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="customer_earnings"
                                                               class="control-label mb-1">{{ Helper::translation(2107,$translate) }}</label>
                                                        <input type="file" id="user_photo" name="user_photo"
                                                               class="form-control-file"
                                                               data-bvalidator="extension[jpg:png:jpeg]"
                                                               data-bvalidator-msg="Please select file of type .jpg, .png or .jpeg">
                                                    </div>




                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <!-- Credit Card -->
                                            <div id="pay-invoice">
                                                <div class="card-body">


                                                    <div class="form-group">
                                                        <label for="user_address"
                                                               class="control-label mb-1">{{ Helper::translation(3848,$translate) }}
                                                            <span class="require">*</span></label>

                                                        <textarea id="user_address" name="user_address" class="form-control" data-bvalidator="required"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="user_phone"
                                                               class="control-label mb-1">{{ Helper::translation(2002,$translate) }}</label>
                                                        <input id="user_phone" name="user_phone" type="text"
                                                               class="form-control" data-bvalidator="required" >
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="postcode"
                                                               class="control-label mb-1">{{ Helper::translation(2006,$translate) }}</label>
                                                        <input id="postcode" name="postcode" type="text"
                                                               class="form-control" data-bvalidator="required" >
                                                    </div>


{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="customer_earnings"--}}
{{--                                                               class="control-label mb-1"><strong>{{ Helper::translation(2976,$translate) }}</strong></label><br/><br/>--}}
{{--                                                        @foreach($permission as $key => $value)--}}
{{--                                                            <span><input type="checkbox" id="user_permission[]"--}}
{{--                                                                         name="user_permission[]" value="{{ $key }}"> {{ $value }}</span>--}}
{{--                                                            <br/>--}}
{{--                                                        @endforeach--}}
{{--                                                    </div>--}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 no-padding">
                                        <div class="card-footer">
                                            <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> {{ Helper::translation(1919,$translate) }}
                                            </button>
                                            <button type="reset" class="btn btn-danger btn-sm">
                                                <i class="fa fa-ban"></i> {{ Helper::translation(2979,$translate) }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
@else
    @include('admin.denied')
@endif
<!-- Right Panel -->
@include('admin.javascript')
</body>
</html>
