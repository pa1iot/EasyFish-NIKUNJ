@php use ZigKart\Models\Attribute; @endphp
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
                        <h1>{{ Helper::translation(2019,$translate) }}</h1>
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
                       <form action="{{ route('admin.edit-attribute-type') }}" method="post" id="setting_form" enctype="multipart/form-data">
                       {{ csrf_field() }}
                        @endif
                        <div class="card">
                         <div class="col-md-6">
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
		     $view = Attribute::singlar($attribute_id);
		  }
		  else
		  {
		    $code = $language->language_code;
		    $view = Attribute::others($attribute_id,$code);
		  }
          @endphp
          <div class="tab-pane fade @if($i == 1) show active @endif mt-4" id="{{ $language->language_name }}" role="tabpanel">
              <div class="form-group">
                   <label for="name" class="control-label mb-1">{{ Helper::translation(1914,$translate) }} <span class="require">*</span></label>
                   <input type="text" name="attribute_name[]" id="attribute_name" value="@if(!empty($view->attribute_name)){{ $view->attribute_name }}@endif"   class="form-control" data-bvalidator="required">
              </div>
                          
          </div>
          <input type="hidden" name="language_code[]" value="{{ $language->language_code }}">
          @php $i++; @endphp
          @endforeach

        </div>
      </div>
      <div class="form-group">
                   <label for="name" class="control-label mb-1">{{ Helper::translation(2982,$translate) }} <span class="require">*</span></label>
                                                <input id="attribute_slug" name="attribute_slug" type="text" class="form-control" value="{{ $edit['type']->attribute_slug }}" data-bvalidator="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(2985,$translate) }}<span class="require">*</span></label>
                                                <select name="attribute_search" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($edit['type']->attribute_search == 1) selected @endif>{{ Helper::translation(1942,$translate) }}</option>
                                                <option value="0" @if($edit['type']->attribute_search == 0) selected @endif>{{ Helper::translation(1943,$translate) }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1918,$translate) }}</label>
                                                <input id="attribute_order" name="attribute_order" type="text" value="{{ $edit['type']->attribute_order }}" class="form-control">
                                            </div>                                     
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(1915,$translate) }} <span class="require">*</span></label>
                                                <select name="attribute_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($edit['type']->attribute_status == 1) selected @endif>{{ Helper::translation(1916,$translate) }}</option>
                                                <option value="0" @if($edit['type']->attribute_status == 0) selected @endif>{{ Helper::translation(1917,$translate) }}</option>
                                                </select>
                                            </div>   
                                            <input type="hidden" name="attribute_id" value="{{ $edit['type']->attribute_id }}">
                                            <input type="hidden" name="token" value="{{ uniqid() }}"> 
                                            <input type="hidden" name="user_id" value="{{ $edit['type']->user_id }}">    
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