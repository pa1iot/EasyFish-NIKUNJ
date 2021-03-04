<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
@include('admin.stylesheet')
</head>
<body>
@include('admin.navigation')
<!-- Right Panel -->
    @if(in_array('settings',$avilable))
    <div id="right-panel" class="right-panel">
       @include('admin.header')
       <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(3555,$translate) }}</h1>
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
                           <form action="{{ route('admin.social-settings') }}" method="post" id="setting_form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           @endif
                           <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3780,$translate) }} </label>
                                                <input id="facebook_url" name="facebook_url" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->facebook_url }}" data-bvalidator="url">
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3783,$translate) }} </label>
                                                <input id="twitter_url" name="twitter_url" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->twitter_url }}" data-bvalidator="url">
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3786,$translate) }} </label>
                                                <input id="gplus_url" name="gplus_url" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->gplus_url }}" data-bvalidator="url">
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
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3789,$translate) }} </label>
                                                <input id="pinterest_url" name="pinterest_url" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->pinterest_url }}" data-bvalidator="url"></div><div class="form-group"><label for="site_title" class="control-label mb-1">{{ Helper::translation(3792,$translate) }} </label>
                                                <input id="instagram_url" name="instagram_url" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->instagram_url }}" data-bvalidator="url"></div><input type="hidden" name="sid" value="1">
                             </div>
                                </div>
                             </div>
                             </div>
                             <div class="col-md-12"><div class="card-body"><h4>{{ Helper::translation(3795,$translate) }} </h4></div></div>
                             <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3795,$translate) }}<span class="require">*</span></label>
                                                 <select name="display_social_login" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($setting['setting']->display_social_login == 1) selected @endif>{{ Helper::translation(3120,$translate) }}</option>
                                                <option value="0" @if($setting['setting']->display_social_login == 0) selected @endif>{{ Helper::translation(3117,$translate) }}</option>
                                                </select>
                                            </div>
                                </div>
                                </div>
                              </div>
                            </div>
                             <div class="col-md-12"></div>
                             <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3798,$translate) }} <span class="require">*</span></label>
                                                <input id="facebook_client_id" name="facebook_client_id" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->facebook_client_id }}" data-bvalidator="required"> <small>Example : 24661324324234232</small>
                                            </div>
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3801,$translate) }} <span class="require">*</span></label>
                                                <input id="facebook_client_secret" name="facebook_client_secret" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->facebook_client_secret }}" data-bvalidator="required"> <small>Example : 5fd2de273a28f223232423424232432</small>
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
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3804,$translate) }} <span class="require">*</span></label>
                                                <input id="facebook_callback_url" name="facebook_callback_url" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->facebook_callback_url }}" data-bvalidator="required,url"> <small>Example : {{ URL::to('/') }}/login/facebook/callback</small>
                                            </div>
                             </div>
                                </div>

                            </div>
                            </div>
                             <div class="col-md-12"></div>
                             <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3807,$translate) }} <span class="require">*</span></label>
                                                <input id="google_client_id" name="google_client_id" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->google_client_id }}" data-bvalidator="required"> <small>Example : 5464565465454-ups8ho3dria.apps.googleusercontent.com</small>
                                            </div>
                                             <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3810,$translate) }} <span class="require">*</span></label>
                                                <input id="google_client_secret" name="google_client_secret" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->google_client_secret }}" data-bvalidator="required"> <small>Example : fwIUn323232j1-32432423YBe</small>
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
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3813,$translate) }} <span class="require">*</span></label>
                                                <input id="google_callback_url" name="google_callback_url" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->google_callback_url }}" data-bvalidator="required,url"> <small>Example : {{ URL::to('/') }}/login/google/callback</small>
                                            </div>
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