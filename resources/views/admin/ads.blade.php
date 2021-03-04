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
    @if(in_array('ads',$avilable)) 
    <div id="right-panel" class="right-panel">
       @include('admin.header')
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(3111,$translate) }}</h1>
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
                           <form action="{{ route('admin.ads') }}" method="post" id="setting_form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           @endif
                           <div class="col-md-12 mt-3"><h5>{{ Helper::translation(3114,$translate) }}</h5></div>
                           <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3114,$translate) }}</label>
                                                <select name="shop_ads" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="0" @if($setting['setting']->shop_ads == 0) selected @endif>{{ Helper::translation(3117,$translate) }}</option>
                                                <option value="1" @if($setting['setting']->shop_ads == 1) selected @endif>{{ Helper::translation(3120,$translate) }}</option>
                                                </select>
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
                                                <strong>{{ Helper::translation(3123,$translate) }} : <br> <img src="{{ url('/') }}/public/img/ins.png"></strong>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                           <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3135,$translate) }}</label>
                                            <textarea name="shop_top_ads" id="shop_top_ads" rows="6" class="form-control noscroll_textarea" >{{ $setting['setting']->shop_top_ads }}</textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3126,$translate) }}</label>
                                            <textarea name="shop_bottom_ads" id="shop_bottom_ads" rows="6" class="form-control noscroll_textarea" >{{ $setting['setting']->shop_bottom_ads }}</textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3129,$translate) }}</label>
                                            <textarea name="shop_sidebar_ads" id="shop_sidebar_ads" rows="6" class="form-control noscroll_textarea" >{{ $setting['setting']->shop_sidebar_ads }}</textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 mt-3"><h5>{{ Helper::translation(3132,$translate) }}</h5></div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3132,$translate) }}</label>
                                                <select name="blog_ads" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="0" @if($setting['setting']->blog_ads == 0) selected @endif>{{ Helper::translation(3117,$translate) }}</option>
                                                <option value="1" @if($setting['setting']->blog_ads == 1) selected @endif>{{ Helper::translation(3120,$translate) }}</option>
                                                </select>
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
                                                <strong>{{ Helper::translation(3123,$translate) }} : <br> <img src="{{ url('/') }}/public/img/ins.png"></strong>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3135,$translate) }}</label>
                                            <textarea name="blog_top_ads" id="blog_top_ads" rows="6" class="form-control noscroll_textarea" >{{ $setting['setting']->blog_top_ads }}</textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3126,$translate) }}</label>
                                            <textarea name="blog_bottom_ads" id="blog_bottom_ads" rows="6" class="form-control noscroll_textarea" >{{ $setting['setting']->blog_bottom_ads }}</textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3129,$translate) }}</label>
                                            <textarea name="blog_sidebar_ads" id="blog_sidebar_ads" rows="6" class="form-control noscroll_textarea" >{{ $setting['setting']->blog_sidebar_ads }}</textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 mt-3"><h5>{{ Helper::translation(3138,$translate) }}</h5></div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3138,$translate) }}</label>
                                                <select name="page_ads" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="0" @if($setting['setting']->page_ads == 0) selected @endif>{{ Helper::translation(3117,$translate) }}</option>
                                                <option value="1" @if($setting['setting']->page_ads == 1) selected @endif>{{ Helper::translation(3120,$translate) }}</option>
                                                </select>
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
                                                <strong>{{ Helper::translation(3123,$translate) }} : <br> <img src="{{ url('/') }}/public/img/ins.png"></strong>
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
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3135,$translate) }}</label>
                                            <textarea name="page_top_ads" id="page_top_ads" rows="6" class="form-control noscroll_textarea" >{{ $setting['setting']->page_top_ads }}</textarea>
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
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3126,$translate) }}</label>
                                            <textarea name="page_bottom_ads" id="page_bottom_ads" rows="6" class="form-control noscroll_textarea" >{{ $setting['setting']->page_bottom_ads }}</textarea>
                                            </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                             <input type="hidden" name="sid" value="1">
                            <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> {{ Helper::translation(1919,$translate) }}</button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> {{ Helper::translation(2979,$translate) }} </button>
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