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
    @if(in_array('block-section',$avilable))
    <div id="right-panel" class="right-panel">
       @include('admin.header')
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(3411,$translate) }}</h1>
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
                           <form action="{{ route('admin.home-section') }}" method="post" id="setting_form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           @endif
                           <div class="col-md-12 mt-3 pt-3"><h4>{{ Helper::translation(2056,$translate) }}</h4></div>
                             <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3414,$translate) }}</label>
                                                <input id="site_home_category" name="site_home_category" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_home_category }}">
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
                                                <label for="site_favicon" class="control-label mb-1">{{ Helper::translation(3417,$translate) }} ({{ Helper::translation(3003,$translate) }} 128 x 128)</label>
                                            <input type="file" id="site_more_category" name="site_more_category" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="{{ Helper::translation(1937,$translate) }}">@if($setting['setting']->site_more_category != '')
                                                <img width="70" height="70" src="{{ url('/') }}/public/storage/settings/{{ $setting['setting']->site_more_category }}" />
                                                @endif
                                            </div>
                                       </div>
                                </div>
                             </div>
                            </div>
                           <div class="col-md-12 mt-3 pt-3"><h4>{{ Helper::translation(3420,$translate) }}</h4></div>
                           <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3423,$translate) }}<span class="require">*</span></label><br/>
                                                 <select name="site_home_top_banner" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($setting['setting']->site_home_top_banner == 1) selected @endif>{{ Helper::translation(3120,$translate) }}</option>
                                                <option value="0" @if($setting['setting']->site_home_top_banner == 0) selected @endif>{{ Helper::translation(3117,$translate) }}</option>
                                         </select>
                                      </div>
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3426,$translate) }} ({{ Helper::translation(3003,$translate) }} : 630 X 250px )</label>
                                                <input type="file" id="site_banner_one" name="site_banner_one" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="{{ Helper::translation(1937,$translate) }}">@if($setting['setting']->site_banner_one != '')
                                                <img width="150" height="70" src="{{ url('/') }}/public/storage/settings/{{ $setting['setting']->site_banner_one }}" />
                                                @endif
                                            </div>    
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(2943,$translate) }}</label>
                                                <input id="site_banner_one_heading" name="site_banner_one_heading" type="text" class="form-control noscroll_textarea" value="{{ Helper::translation(2943,'en') }}" readonly><a href="languages" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; {{ Helper::translation(3303,$translate) }}</a></div><div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3432,$translate) }}</label>
                                          <input id="site_banner_one_link" name="site_banner_one_link" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_banner_one_link }}">
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
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3435,$translate) }} ({{ Helper::translation(3003,$translate) }} : 630 X 250px )</label>
                                                <input type="file" id="site_banner_two" name="site_banner_two" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="Please select file of type .jpg, .png or .jpeg">@if($setting['setting']->site_banner_two != '')
                                                <img width="150" height="70" src="{{ url('/') }}/public/storage/settings/{{ $setting['setting']->site_banner_two }}" />
                                                @endif
                                            </div>     
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3438,$translate) }}</label>
                                                <input id="site_banner_two_heading" name="site_banner_two_heading" type="text" class="form-control noscroll_textarea" value="{{ Helper::translation(2946,'en') }}" readonly><a href="languages" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; {{ Helper::translation(3303,$translate) }}</a></div><div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3441,$translate) }}</label>
                                              <input id="site_banner_two_link" name="site_banner_two_link" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_banner_two_link }}">                                         </div>
                                    </div>
                                </div>
                             </div>
                            </div>
                            <div class="col-md-12 mt-3 pt-3"><h4>{{ Helper::translation(2059,$translate) }}</h4></div>
                            <div class="col-md-6">
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3444,$translate) }}<span class="require">*</span></label>
                                                <input id="site_home_physical" name="site_home_physical" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_home_physical }}" data-bvalidator="required"> </div>     
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
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3447,$translate) }}<span class="require">*</span></label><br/>
                                                <select name="site_physical_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" @if($setting['setting']->site_physical_order == 'asc') selected @endif>ASC</option>
                                                <option value="desc" @if($setting['setting']->site_physical_order == 'desc') selected @endif>DESC</option>
                                                </select>
                                              </div> 
                                             <small>(ASC - {{ Helper::translation(3453,$translate) }} | DESC - {{ Helper::translation(3456,$translate) }})</small>
                                     </div>
                                </div>
                               </div>
                            </div>
                           <div class="col-md-12 mt-3 pt-3"><h4>{{ Helper::translation(2068,$translate) }}</h4></div>
                            <div class="col-md-6">
                             <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3450,$translate) }}<span class="require">*</span></label>
                                                <input id="site_home_external" name="site_home_external" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_home_external }}" data-bvalidator="required"></div>     
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
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3447,$translate) }}<span class="require">*</span></label><br/>
                                                 <select name="site_external_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" @if($setting['setting']->site_external_order == 'asc') selected @endif>ASC</option>
                                                <option value="desc" @if($setting['setting']->site_external_order == 'desc') selected @endif>DESC</option>
                                                </select>
                                               </div> 
                                             <small>(ASC - {{ Helper::translation(3453,$translate) }} | DESC - {{ Helper::translation(3456,$translate) }})</small>
                                           
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 mt-3 pt-3"><h4>{{ Helper::translation(2069,$translate) }}</h4></div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3459,$translate) }}<span class="require">*</span></label>
                                                <input id="site_home_digital" name="site_home_digital" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_home_digital }}" data-bvalidator="required"></div>     
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
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3447,$translate) }}<span class="require">*</span></label><br/>
                                                 <select name="site_digital_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" @if($setting['setting']->site_digital_order == 'asc') selected @endif>ASC</option>
                                                <option value="desc" @if($setting['setting']->site_digital_order == 'desc') selected @endif>DESC</option>
                                                </select>
                                             </div> 
                                             <small>(ASC - {{ Helper::translation(3453,$translate) }} | DESC - {{ Helper::translation(3456,$translate) }})</small>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 mt-3 pt-3"><h4>Bottom Banner</h4></div>
                            <div class="col-md-12">
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3423,$translate) }}<span class="require">*</span></label><br/>
                                                 <select name="site_home_bottom_banner" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" @if($setting['setting']->site_home_bottom_banner == 1) selected @endif>{{ Helper::translation(3120,$translate) }}</option>
                                                <option value="0" @if($setting['setting']->site_home_bottom_banner == 0) selected @endif>{{ Helper::translation(3117,$translate) }}</option>
                                         </select>
                                      </div>
                                      <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3462,$translate) }} ({{ Helper::translation(3003,$translate) }} : 1280 X 250px )</label>
                                                <input type="file" id="site_banner_three" name="site_banner_three" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="{{ Helper::translation(1937,$translate) }}">@if($setting['setting']->site_banner_three != '')
                                                <img width="150" height="70" src="{{ url('/') }}/public/storage/settings/{{ $setting['setting']->site_banner_three }}" />
                                                @endif
                                            </div>    
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(2949,$translate) }}</label>
                                                <input id="site_banner_three_heading" name="site_banner_three_heading" type="text" class="form-control noscroll_textarea" value="{{ Helper::translation(2949,'en') }}" readonly><a href="languages" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; {{ Helper::translation(3303,$translate) }}</a></div><div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3468,$translate) }}</label>
                                            <input id="site_banner_three_link" name="site_banner_three_link" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_banner_three_link }}"></div></div></div></div></div>
                                            <div class="col-md-12 mt-3 pt-3"><h4>{{ Helper::translation(3060,$translate) }} {{ Helper::translation(1975,$translate) }}</h4></div>
                            <div class="col-md-6">
                              <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">How many featured product display on homepage?<span class="require">*</span></label>
                                                <input id="site_home_featured" name="site_home_featured" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_home_featured }}" data-bvalidator="required"></div></div></div></div>
                            </div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3447,$translate) }}<span class="require">*</span></label><br/>
                                                <select name="site_featured_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" @if($setting['setting']->site_featured_order == 'asc') selected @endif>ASC</option>
                                                <option value="desc" @if($setting['setting']->site_featured_order == 'desc') selected @endif>DESC</option>
                                                </select>
                                              </div> 
                                             <small>(ASC - {{ Helper::translation(3453,$translate) }} | DESC - {{ Helper::translation(3456,$translate) }})</small>
                                    </div>
                                </div>
                               </div>
                            </div>
                           <div class="col-md-12 mt-3 pt-3"><h4>{{ Helper::translation(2070,$translate) }}</h4></div>
                            <div class="col-md-6">
                              <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3471,$translate) }}<span class="require">*</span></label>
                                                <input id="site_home_deal" name="site_home_deal" type="text" class="form-control noscroll_textarea" value="{{ $setting['setting']->site_home_deal }}" data-bvalidator="required"></div></div></div></div>
                            </div>
                            <div class="col-md-6">
                           <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3447,$translate) }}<span class="require">*</span></label><br/>
                                                <select name="site_deal_order" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="asc" @if($setting['setting']->site_deal_order == 'asc') selected @endif>ASC</option>
                                                <option value="desc" @if($setting['setting']->site_deal_order == 'desc') selected @endif>DESC</option>
                                                </select>
                                              </div> 
                                             <small>(ASC - {{ Helper::translation(3453,$translate) }} | DESC - {{ Helper::translation(3456,$translate) }})</small>
                                    </div>
                                </div>
                               </div>
                            </div> 
                            <input type="hidden" name="image_size" value="{{ $setting['setting']->site_max_image_size }}">
                             <input type="hidden" name="save_more_category" value="{{ $setting['setting']->site_more_category }}">
                             <input type="hidden" name="save_banner_one" value="{{ $setting['setting']->site_banner_one }}">
                             <input type="hidden" name="save_banner_two" value="{{ $setting['setting']->site_banner_two }}">
                             <input type="hidden" name="save_banner_three" value="{{ $setting['setting']->site_banner_three }}">
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