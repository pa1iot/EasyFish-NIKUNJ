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
                        <h1>{{ Helper::translation(1927,$translate) }}</h1>
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
                            <form action="{{ route('admin.add-product') }}" method="post" id="category_form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           @endif
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
          <div class="tab-pane fade @if($i == 1) show active @endif mt-4" id="{{ $language->language_name }}" role="tabpanel">
              <div class="form-group">
                   <label for="name" class="control-label mb-1">{{ Helper::translation(1928,$translate) }} <span class="require">*</span></label>
                   <input type="text" name="product_name[]" id="product_name" value=""   class="form-control" data-bvalidator="required">
              </div>
              <div class="form-group">
                        <label for="site_keywords" class="control-label mb-1">{{ Helper::translation(1930,$translate) }} <span class="require">*</span></label>
                                                 <textarea name="product_short_desc[]" id="product_short_desc" rows="3" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"></textarea>
                      </div>
                      <div class="form-group">
                            <label for="site_desc" class="control-label mb-1">{{ Helper::translation(1931,$translate) }}<span class="require">*</span></label>
                                                <textarea name="product_desc[]" id="summary-ckeditor{{ $language->language_id }}" rows="3"  class="form-control" data-bvalidator="required"></textarea>
                       </div>            
          </div>
          <input type="hidden" name="language_code[]" value="{{ $language->language_code }}">
          @php $i++; @endphp
          @endforeach

        </div>
      </div>
      <div class="form-group">
                            <label for="name" class="control-label mb-1">{{ Helper::translation(2982,$translate) }} <span class="require">*</span></label>
                                                <input id="product_slug" name="product_slug" type="text" class="form-control" data-bvalidator="required">
                                            </div>
                                       
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1929,$translate) }} <span class="require">*</span></label>
                                                <input id="product_sku" name="product_sku" type="text" class="form-control" data-bvalidator="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(1932,$translate) }} <span class="require">*</span></label>
                                                <select name="product_category[]" class="form-control" data-bvalidator="required" multiple>
                                                @foreach($categories['display'] as $menu)
                                                <option value="cat-{{$menu->cat_id}}">{{ $menu->category_name }}</option>
                                                     @foreach($menu->subcategory as $sub_category)
                                                     <option value="subcat-{{$sub_category->subcat_id}}" class="ml-2">- {{ $sub_category->subcategory_name }}</option>
                                                     @endforeach
                                                @endforeach 
                                                </select>
                                            </div> 
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1934,$translate) }} ({{ $allsettings->site_currency_symbol }})<span class="require">*</span></label>
                                                <input id="product_price" name="product_price" type="text" class="form-control" data-bvalidator="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1935,$translate) }} ({{ $allsettings->site_currency_symbol }})</label>
                                                <input id="product_offer_price" name="product_offer_price" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="customer_earnings" class="control-label mb-1">{{ Helper::translation(1936,$translate) }} <span class="require">*</span></label>
                                                <input type="file" id="product_image" name="product_image" class="form-control-file" data-bvalidator="required,extension[jpg:png:jpeg]" data-bvalidator-msg="{{ Helper::translation(1937,$translate) }}"></div> 
                                             <div class="form-group">
                                                <label for="customer_earnings" class="control-label mb-1">{{ Helper::translation(1938,$translate) }}</label>
                                                <input type="file" id="product_gallery[]" name="product_gallery[]" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="{{ Helper::translation(1937,$translate) }}" multiple>
                                             </div>
                                             <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1933,$translate) }}</label>
                                                <input id="product_video_url" name="product_video_url" type="text" class="form-control">
                                                <small>( Example : https://www.youtube.com/watch?v=C0DPdy98e4c )</small>
                                     </div> 
                                     <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(1941,$translate) }} <span class="require">*</span></label>
                                                <select name="product_allow_seo" id="product_allow_seo" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1">{{ Helper::translation(1942,$translate) }}</option>
                                                <option value="0">{{ Helper::translation(1943,$translate) }}</option>
                                                </select>
                                   </div>      
                                     <div id="ifseo">
                                     <div class="form-group">
                                           <label for="site_keywords" class="control-label mb-1">{{ Helper::translation(1944,$translate) }} <span class="require">*</span></label>
                                            <textarea name="product_seo_keyword" id="product_seo_keyword" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"></textarea>
                                       </div> 
                                       <div class="form-group">
                                           <label for="site_desc" class="control-label mb-1">{{ Helper::translation(1945,$translate) }} <span class="require">*</span></label>
                                              <textarea name="product_seo_desc" id="product_seo_desc" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]"></textarea>
                                            </div>
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
                                  <div class="form-group">
                                                <label for="site_keywords" class="control-label mb-1">{{ Helper::translation(1939,$translate) }}</label>
                                            <textarea name="product_tags" id="product_tags" rows="4" placeholder="{{ Helper::translation(1940,$translate) }}" class="form-control noscroll_textarea"></textarea>
                                            </div>
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(3060,$translate) }} <span class="require">*</span></label>
                                                <select name="product_featured" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1">{{ Helper::translation(1942,$translate) }}</option>
                                                <option value="0">{{ Helper::translation(1943,$translate) }}</option>
                                                </select>
                                             </div>
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(1946,$translate) }} <span class="require">*</span></label>
                                                <select name="product_type" id="product_type" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                @foreach($product_type as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                  <div id="ifphysical_external">
                                     <div class="form-group">
                                                <label for="site_keywords" class="control-label mb-1">{{ Helper::translation(1948,$translate) }}</label>
                                            <textarea name="product_return_policy" id="product_return_policy" rows="6" class="form-control noscroll_textarea"></textarea>
                                            </div> 
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1949,$translate) }}</label>
                                                <input id="product_estimate_time" name="product_estimate_time" type="text" class="form-control" data-bvalidator="digit,min[1]">
                                                <small>Days</small>
                                     </div>  
                                     <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(1950,$translate) }} <span class="require">*</span></label>
                                                <select name="product_condition" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="new">{{ Helper::translation(1951,$translate) }}</option>
                                                <option value="used">{{ Helper::translation(1952,$translate) }}</option>
                                                </select>
                                           </div>
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ Helper::translation(3144,$translate) }}</label>
                                                <select name="product_brand" class="form-control">
                                                <option value=""></option>
                                                @foreach($brand['view'] as $brand)
                                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                                </select>
                                           </div>
                                           <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1953,$translate) }}</label>
                                                <input id="product_stock" name="product_stock" type="text" class="form-control" data-bvalidator="digit,min[0]">
                                                <small><span class="red-color">{{ Helper::translation(1954,$translate) }}</span></small>
                                     </div> 
                                     @foreach($attribute_product['display'] as $attribute)
                                     <div class="form-group">
                                                <label for="site_title" class="control-label mb-1">{{ $attribute->attribute_name }}</label>
                                                <select name="product_attribute[]" class="form-control" multiple>
                                                @foreach($attribute->attributevalue as $product_value)
                                                <option value="{{ $product_value->attribute_value_id }}-{{ $attribute->attribute_id }}">{{ $product_value->attribute_value }}</option>
                                                @endforeach
                                                </select>
                                                
                                            </div>
                                     @endforeach
                                     </div>
                                     <div class="form-group" id="ifdigital">
                                                <label for="customer_earnings" class="control-label mb-1">{{ Helper::translation(1955,$translate) }}<span class="require">*</span></label>
                                                <input type="file" id="product_file" name="product_file" class="form-control-file" data-bvalidator="required,extension[zip]" data-bvalidator-msg="{{ Helper::translation(1956,$translate) }}"></div>   <div class="form-group" id="ifexternal">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1957,$translate) }} <span class="require">*</span></label>
                                                <input id="product_external_url" name="product_external_url" type="text" class="form-control" data-bvalidator="required,url">
                                     </div> 
                                     <div id="ifphysical">
                                     <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1958,$translate) }} ({{ $allsettings->site_currency_symbol }})</label>
                                                <input id="product_local_shipping_fee" name="product_local_shipping_fee" type="text" class="form-control" data-bvalidator="min[0]">
                                                <small>({{ Helper::translation(3063,$translate) }}) <span class="red-color"> - if leave empty "free shipping"</span></small>
                                     </div> 
                                     <div class="form-group">
                                                <label for="name" class="control-label mb-1">{{ Helper::translation(1960,$translate) }} ({{ $allsettings->site_currency_symbol }})</label>
                                                <input id="product_global_shipping_fee" name="product_global_shipping_fee" type="text" class="form-control" data-bvalidator="min[0]">
                                                <small>({{ Helper::translation(3066,$translate) }}) <span class="red-color"> - {{ Helper::translation(1959,$translate) }}</span></small>
                                     </div>
                                    </div>
                                    <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> {{ Helper::translation(1961,$translate) }} <span class="require">*</span></label>
                                                <select name="flash_deals" id="flash_deals" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1">{{ Helper::translation(1942,$translate) }}</option>
                                                <option value="0">{{ Helper::translation(1943,$translate) }}</option>
                                                </select>
                                                
                                            </div>      
                             <div id="ifdeal">
                            <div class="form-group">
                                                <label for="site_keywords" class="control-label mb-1">{{ Helper::translation(1962,$translate) }} <span class="require">*</span></label>
                                             <input id="flash_deal_start_date" name="flash_deal_start_date" type="text" class="form-control" data-bvalidator="required">
                                            </div> 
                               <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">{{ Helper::translation(1963,$translate) }} <span class="require">*</span></label>
                                            <input id="flash_deal_end_date" name="flash_deal_end_date" type="text" class="form-control" data-bvalidator="required">
                                            </div>
                                  </div>  
                                 <input type="hidden" name="image_size" value="{{ $allsettings->site_max_image_size }}"> 
                                  <input type="hidden" name="file_size" value="{{ $allsettings->site_max_zip_size }}">
                                  <input type="hidden" name="token" value="{{ uniqid() }}">              
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