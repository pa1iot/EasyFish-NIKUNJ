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
                        <h1>{{ Helper::translation(3225,$translate) }}</h1>
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
                       @if($demo_mode == 'on')
                           @include('admin.demo-mode')
                           @else
                       <form action="{{ route('admin.edit-brand') }}" method="post" id="setting_form" enctype="multipart/form-data">
                       {{ csrf_field() }}
                        @endif
                        <div class="card">
                         <div class="col-md-8">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(2994,$translate) }} <span class="require">*</span></label>
                                                <input id="brand_name" name="brand_name" type="text" class="form-control" value="{{ $edit['brand']->brand_name }}" data-bvalidator="required">
                                            </div> 
                                           <div class="form-group">
                                                <label for="site_logo" class="control-label mb-1">{{ Helper::translation(2099,$translate) }} ({{ Helper::translation(3003,$translate) }} 200 x 200)</label>
                                            <input type="file" id="brand_image" name="brand_image" class="form-control-file"  data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="{{ Helper::translation(1937,$translate) }}">@if($edit['brand']->brand_image != '') <img  src="{{ url('/') }}/public/storage/brands/{{ $edit['brand']->brand_image }}" alt="{{ $edit['brand']->brand_image }}" class="image-size" />@else <img src="{{ url('/') }}/public/img/no-image.jpg" alt="{{ $edit['brand']->brand_image }}"  class="image-size"/>  @endif
                                            </div>                                  
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1918,$translate) }}</label>
                                                <input id="brand_order" name="brand_order" type="text" class="form-control" data-bvalidator="digit,min[0]" value="{{ $edit['brand']->brand_order }}">
                                            </div> 
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(1915,$translate) }} <span class="require">*</span></label>
                                                <select name="brand_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($edit['brand']->brand_status == 1) selected @endif>{{ Helper::translation(1916,$translate) }}</option>
                                                <option value="0" @if($edit['brand']->brand_status == 0) selected @endif>{{ Helper::translation(1917,$translate) }}</option>
                                                </select>
                                            </div>   
                                            <input type="hidden" name="save_brand_image" value="{{ $edit['brand']->brand_image }}">                                             
                                            <input type="hidden" name="image_size" value="{{ $allsettings->site_max_image_size }}">    
                                            <input type="hidden" name="brand_id" value="{{ $edit['brand']->brand_id }}">   
                                     </div>
                                </div>
                             </div>
                            </div>
                           <div class="col-md-6">
                           </div>
                           <div class="card-footer">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                     <i class="fa fa-dot-circle-o"></i> {{ Helper::translation(1919,$translate) }}
                                 </button>
                                 <button type="reset" class="btn btn-danger btn-sm">
                                     <i class="fa fa-ban"></i> {{ Helper::translation(1919,$translate) }}
                                 </button>
                           </div>
                         </div> 
                       </form> 
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