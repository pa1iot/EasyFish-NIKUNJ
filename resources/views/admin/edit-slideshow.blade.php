@php use ZigKart\Models\Slideshow; @endphp
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
    @if(in_array('slideshow',$avilable))
    <div id="right-panel" class="right-panel">
       @include('admin.header')
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(3255,$translate) }}</h1>
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
                       <form action="{{ route('admin.edit-slideshow') }}" method="post" id="setting_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @endif
                        <div class="card">
                         <div class="col-md-8">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    <div class="card mt-3 tab-card">
                                    <div class="card-header tab-card-header">
                                      <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                        @php $j = 1; @endphp
                                        @foreach($language['data'] as $language)
                                        <li class="nav-item">
                                            <a class="nav-link @if($j == 1) active show @endif"  data-toggle="tab" href="#{{ $language->language_name }}" role="tab"  aria-selected="true">{{ $language->language_name }}</a>
                                        </li>
                                        @php $j++; @endphp
                                        @endforeach
                                      </ul>
                                    </div>
                            
                                    <div class="tab-content" id="myTabContent">
                                      @php $i = 1; @endphp
                                      @foreach($languages['data'] as $language)
                                      @php
                                      if($language->language_code == 'en')
                                      {
                                         $view = Slideshow::singlar($slide_id);
                                      }
                                      else
                                      {
                                        $code = $language->language_code;
                                        $view = Slideshow::others($slide_id,$code);
                                      }
                                      @endphp
                                      <div class="tab-pane fade @if($i == 1) show active @endif mt-4" id="{{ $language->language_name }}" role="tabpanel">
                                          <div class="form-group">
                                               <label for="name" class="control-label mb-1">{{ Helper::translation(3072,$translate) }}</label>
                                               <input type="text" name="slide_title[]" id="slide_title" value="@if(!empty($view->slide_title)){{ $view->slide_title }}@endif"   class="form-control">
                                          </div>
                                          <div class="form-group">
                                              <label for="site_desc" class="control-label mb-1">{{ Helper::translation(3075,$translate) }}</label>
                                              <input id="slide_desc" name="slide_desc[]" type="text" class="form-control" value="@if(!empty($view->slide_desc)){{ $view->slide_desc }}@endif">
                                          </div> 
                                          <div class="form-group">
                                              <label for="site_desc" class="control-label mb-1">{{ Helper::translation(3078,$translate) }}</label>
                                              <input id="slide_btn_text" name="slide_btn_text[]" type="text" class="form-control" value="@if(!empty($view->slide_btn_text)){{ $view->slide_btn_text }}@endif">
                                          </div>            
                                      </div>
                                      <input type="hidden" name="language_code[]" value="{{ $language->language_code }}">
                                      @php $i++; @endphp
                                      @endforeach
                            
                                    </div>
                                  </div>
                                  <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(3081,$translate) }}</label>
                                                <select name="slide_text_position" class="form-control">
                                                <option value="left" @if($edit['slide']->slide_text_position == 'left') selected @endif>{{ Helper::translation(3084,$translate) }}</option>
                                                <option value="right" @if($edit['slide']->slide_text_position == 'right') selected @endif>{{ Helper::translation(3087,$translate) }}</option>
                                                <option value="center" @if($edit['slide']->slide_text_position == 'center') selected @endif>{{ Helper::translation(3090,$translate) }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="site_logo" class="control-label mb-1">{{ Helper::translation(3579,$translate) }} {{ Helper::translation(2099,$translate) }} ({{ Helper::translation(3003,$translate) }} 1920 x 400) <span class="require">*</span></label>
                                            <input type="file" id="slide_image" name="slide_image" class="form-control-file"  @if($edit['slide']->slide_image == '') data-bvalidator="required,extension[jpg:png:jpeg]" data-bvalidator-msg="{{ Helper::translation(1937,$translate) }}" @else data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="Please select file of type .jpg, .png or .jpeg" @endif>@if($edit['slide']->slide_image != '') <img  src="{{ url('/') }}/public/storage/slideshow/{{ $edit['slide']->slide_image }}" alt="{{ $edit['slide']->slide_image }}" class="image-size" />@else <img src="{{ url('/') }}/public/img/no-image.jpg" alt="{{ $edit['slide']->slide_image }}"  class="image-size"/>  @endif
                                            </div>                                  
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(3093,$translate) }}</label>
                                                <input id="slide_btn_link" name="slide_btn_link" type="text" class="form-control" data-bvalidator="url" value="{{ $edit['slide']->slide_btn_link }}">
                                            </div>                                     
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1918,$translate) }}</label>
                                                <input id="slide_order" name="slide_order" type="text" class="form-control" data-bvalidator="digit,min[0]" value="{{ $edit['slide']->slide_order }}">
                                            </div> 
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(1915,$translate) }} <span class="require">*</span></label>
                                                <select name="slide_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($edit['slide']->slide_status == 1) selected @endif>{{ Helper::translation(1916,$translate) }}</option>
                                                <option value="0" @if($edit['slide']->slide_status == 0) selected @endif>{{ Helper::translation(1917,$translate) }}</option>
                                                </select>
                                             </div>   
                                            <input type="hidden" name="save_slide_image" value="{{ $edit['slide']->slide_image }}">                                             
                                            <input type="hidden" name="image_size" value="{{ $allsettings->site_max_image_size }}">    
                                            <input type="hidden" name="slide_id" value="{{ $edit['slide']->slide_id }}">   
                                           <input type="hidden" name="token" value="{{ uniqid() }}">  
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