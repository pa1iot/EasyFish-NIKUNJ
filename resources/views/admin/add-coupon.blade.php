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
    @if(in_array('products',$avilable))
    <div id="right-panel" class="right-panel">
      @include('admin.header')
       <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(1922,$translate) }}</h1>
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
                        <form action="{{ route('admin.add-coupon') }}" method="post" id="setting_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @endif
                         <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(1923,$translate) }} <span class="require">*</span></label>
                                                <input id="coupon_code" name="coupon_code" type="text" class="form-control noscroll_textarea" value="" data-bvalidator="required"> 
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(1925,$translate) }} <span class="require">*</span></label>
                                                <input id="flash_deal_start_date" name="coupon_start_date" type="text" class="form-control noscroll_textarea" value="" data-bvalidator="required"> 
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(1915,$translate) }} <span class="require">*</span></label>
                                                <select name="coupon_status" class="form-control" data-bvalidator="required">
                                                 <option value=""></option>
                                                 <option value="1">{{ Helper::translation(1916,$translate) }}</option>
                                                 <option value="0">{{ Helper::translation(1917,$translate) }}</option>
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
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(1924,$translate) }}(%) <span class="require">*</span></label>
                                                <input id="coupon_value" name="coupon_value" type="text" class="form-control noscroll_textarea" value="" data-bvalidator="required,min[1]">
                                            </div>
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(1926,$translate) }} <span class="require">*</span></label>
                                                <input id="flash_deal_end_date" name="coupon_end_date" type="text" class="form-control noscroll_textarea" value="" data-bvalidator="required"> 
                                            </div>
                                            @if($allsettings->type_of_marketplace == 'multi-vendor')
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(2112,$translate) }} <span class="require">*</span></label>
                                                <select name="user_id" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                @foreach($vendor['view'] as $vendor)
                                                <option value="{{ $vendor->id }}">{{ $vendor->username }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            @else
                                            <input type="hidden" name="user_id" value="1">
                                            @endif
                                            <input type="hidden" name="discount_type" value="percentage">
                                     </div>
                                </div>
                              </div>
                            </div>
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