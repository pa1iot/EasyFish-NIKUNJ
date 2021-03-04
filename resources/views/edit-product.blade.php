@php use ZigKart\Models\Product; @endphp
@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>@if(Auth::user()->user_type == 'vendor'){{ Helper::translation(2149,$translate) }}@else{{ Helper::translation(1912,$translate) }}@endif  - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
@if(Auth::user()->user_type == 'vendor')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2149,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2149,$translate) }}</span></p>
      </div>
    </section>
    <main role="main">
     <div class="container page-white-box mt-3">
     <div class="row">
	     <div class="col-md-12">
             @if ($message = Session::get('success'))
             <div class="alert alert-success" role="alert">
                 <span class="alert_icon lnr lnr-checkmark-circle"></span>
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span class="fa fa-close" aria-hidden="true"></span>
                    </button>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
               <span class="alert_icon lnr lnr-warning"></span>
                  {{ $message }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="fa fa-close" aria-hidden="true"></span>
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
            <span class="fa fa-close" aria-hidden="true"></span>
            </button>
            </div>
            @endif
            </div>
        </div>
    <div class="row">
        <div class="col-md-12">
             <form action="{{ route('edit-product') }}" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
             {{ csrf_field() }}
             <div class="card mt-3 tab-card">
        <div class="card-header tab-card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            @php $j = 1; @endphp
            @foreach($language_page['data'] as $language)
            <li class="nav-item">
                <a class="nav-link @if($j == 1) active show @endif"  data-toggle="tab" href="#{{ $language->language_name }}" role="tab"  aria-selected="true">{{ $language->language_name }}</a>
            </li>
            @php $j++; @endphp
            @endforeach
          </ul>
        </div>

        <div class="tab-content" id="myTabContent">
          @php $i = 1; @endphp
          @foreach($languages_page['data'] as $language)
          @php
          if($language->language_code == 'en')
		  {
		     $view = Product::singlar($edit['product']->product_id);
		  }
		  else
		  {
		    $code = $language->language_code;
		    $view = Product::others($edit['product']->product_id,$code);
		  }
          @endphp
          <div class="tab-pane fade @if($i == 1) show active @endif mt-4" id="{{ $language->language_name }}" role="tabpanel">
          <div class="form-group row">
              <div class="col-sm-6">
                        <label for="name">{{ Helper::translation(1928,$translate) }} <span class="required">*</span></label>
                        <input id="product_name" name="product_name[]" type="text" class="form-control" data-bvalidator="required" value="@if(!empty($view->product_name)){{ $view->product_name }}@endif">
                    </div>
                    <div class="col-sm-6">
                        <label for="site_keywords">{{ Helper::translation(1930,$translate) }} <span class="required">*</span></label>
                        <textarea name="product_short_desc[]" id="product_short_desc" rows="3" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]">@if(!empty($view->product_short_desc)){{ $view->product_short_desc }}@endif</textarea>
                    </div>
                    <div class="col-sm-12">
                         <label for="site_desc">{{ Helper::translation(1931,$translate) }}<span class="required">*</span></label>
                       <textarea name="product_desc[]" id="summary-ckeditor{{ $language->language_id }}" rows="3"  class="form-control" data-bvalidator="required">@if(!empty($view->product_desc)){{ html_entity_decode($view->product_desc) }}@endif</textarea>
                    </div>
                                 
          </div>
          </div>
          <input type="hidden" name="language_code[]" value="{{ $language->language_code }}">
          @php $i++; @endphp
          @endforeach
         
        </div>
      </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="name">Slug<span class="required">*</span></label>
                        <input id="product_slug" name="product_slug" type="text" class="form-control" data-bvalidator="required" value="{{ $edit['product']->product_slug }}">
                    </div>
                    <div class="col-sm-6">
                         <label for="name">{{ Helper::translation(1929,$translate) }} <span class="required">*</span></label>
                        <input id="product_sku" name="product_sku" type="text" class="form-control" data-bvalidator="required" value="{{ $edit['product']->product_sku }}">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="site_title"> {{ Helper::translation(1932,$translate) }} <span class="required">*</span></label>
                        <select name="product_category[]" class="form-control" data-bvalidator="required" multiple>
                                                @foreach($categories['display'] as $menu)
                                                @php 
                                                
                                                if($translate == 'en') { $menuu_id = $menu->cat_id; } else { $menuu_id = $menu->category_page_parent; } 
                                                $cats = 'cat-'.$menuu_id;
                                                @endphp
                                                <option value="cat-{{ $menuu_id }}" @if(in_array($cats,$product_categories)) selected="selected" @endif>{{ $menu->category_name }}</option>
                                                     @foreach($menu->subcategory as $sub_category)
                                                     @php 
                                                     
                                                     if($translate == 'en') { $submenuu_id = $sub_category->subcat_id; } else { $submenuu_id = $sub_category->subcategory_page_parent; } 
                                                     $subcats = 'subcat-'.$submenuu_id;
                                                     @endphp
                                                     <option value="subcat-{{ $submenuu_id }}" class="ml-2" @if(in_array($subcats,$product_categories)) selected="selected" @endif>- {{ $sub_category->subcategory_name }}</option>
                                                     @endforeach
                                                @endforeach 
                                                </select>
                    </div>
                    <div class="col-sm-6">
                         <label for="name">{{ Helper::translation(1933,$translate) }}</label>
                        <input id="product_video_url" name="product_video_url" type="text" class="form-control" value="{{ $edit['product']->product_video_url }}">
                        <small>( {{ __('Example') }} : https://www.youtube.com/watch?v=C0DPdy98e4c )</small>
                    </div>
                </div>
               <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="name">{{ Helper::translation(1934,$translate) }} ({{ $allsettings->site_currency_symbol }})<span class="required">*</span></label>
                         <input id="product_price" name="product_price" type="text" class="form-control" data-bvalidator="required,min[1]" value="{{ $edit['product']->product_price }}">
                    </div>
                    <div class="col-sm-6">
                        <label for="name">{{ Helper::translation(1935,$translate) }} ({{ $allsettings->site_currency_symbol }})</label>
                        <input id="product_offer_price" name="product_offer_price" type="text" class="form-control" data-bvalidator="min[1]" value="@if($edit['product']->product_offer_price != 0){{ $edit['product']->product_offer_price }}@endif">
                    </div>
               </div>
               <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="customer_earnings">{{ Helper::translation(1936,$translate) }} <span class="required">*</span></label>
                         <input type="file" id="product_image" name="product_image" class="form-control-file" @if($edit['product']->product_image == '') data-bvalidator="required,extension[jpg:png:jpeg]" @else data-bvalidator="extension[jpg:png:jpeg]" @endif data-bvalidator-msg="{{ Helper::translation(1937,$translate) }}"> @if($edit['product']->product_image != '')
                                          <img src="{{ url('/') }}/public/storage/product/{{ $edit['product']->product_image }}"  class="image-size" alt="{{ $edit['product']->product_name }}"/>@else <img src="{{ url('/') }}/public/img/no-image.jpg"  class="image-size" alt="{{ $edit['product']->product_name }}"/>
                                          @endif    
                    </div>
                    <div class="col-sm-6">
                        <label for="customer_earnings">{{ Helper::translation(1938,$translate) }}</label>
                        <input type="file" id="product_gallery[]" name="product_gallery[]" class="form-control-file" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="{{ Helper::translation(1937,$translate) }}" multiple><br/>@foreach($editimage['view'] as $product)
                                     <div class="item-img"><img src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}" alt="{{ $product->product_image }}" class="item-thumb">
                                                    <a href="{{ url('/edit-product') }}/dropimg/{{ base64_encode($product->proimg_id) }}" onClick="return confirm('{{ Helper::translation(1968,$translate) }}');" class="drop-icon"><span class="fa fa-trash-o drop-icon"></span></a>
                                                    </div>
                                                   @endforeach
                                   <div class="clearfix"></div>
                    </div>
                </div>
               <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_keywords">{{ Helper::translation(1939,$translate) }}</label>
                        <textarea name="product_tags" id="product_tags" rows="4" placeholder="{{ Helper::translation(1940,$translate) }}" class="form-control noscroll_textarea">{{ $edit['product']->product_tags }}</textarea>
                    </div>
                    <div class="col-sm-6">
                        <label for="site_title">{{ Helper::translation(1941,$translate) }}<span class="required">*</span></label>
                        <select name="product_allow_seo" id="product_allow_seo" class="form-control" data-bvalidator="required">
                             <option value=""></option>
                             <option value="1" @if($edit['product']->product_allow_seo == 1) selected @endif>{{ Helper::translation(1942,$translate) }}</option>
                             <option value="0" @if($edit['product']->product_allow_seo == 0) selected @endif>{{ Helper::translation(1943,$translate) }}</option>
                        </select>
                    </div>
                </div>
                <div id="ifseo" @if($edit['product']->product_allow_seo == 1) class="force-block" @else class="force-none" @endif>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_keywords">{{ Helper::translation(1944,$translate) }} <span class="required">*</span></label>
                        <textarea name="product_seo_keyword" id="product_seo_keyword" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]">{{ $edit['product']->product_seo_keyword }}</textarea>
                    </div>
                    <div class="col-sm-6">
                        <label for="site_desc">{{ Helper::translation(1945,$translate) }} <span class="required">*</span></label>
                        <textarea name="product_seo_desc" id="product_seo_desc" rows="4" class="form-control noscroll_textarea" data-bvalidator="required,maxlen[160]">{{ $edit['product']->product_seo_desc }}</textarea>
                    </div>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                         <label for="site_title">{{ Helper::translation(1946,$translate) }} <span class="required">*</span></label>
                        <?php /*?><select name="product_type" id="product_type" class="form-control" data-bvalidator="required">
                           <option value=""></option>
                           @foreach($product_type as $type)
                           <option value="{{ $type }}" @if($edit['product']->product_type == $type) selected @endif>{{ $type }}</option>
                           @endforeach
                       </select><?php */?>
                       <select name="product_type" id="product_type" class="form-control" data-bvalidator="required">
                             <option value=""></option>
                             <option value="physical" @if($edit['product']->product_type == 'physical') selected @endif>{{ Helper::translation(2165,$translate) }}</option>
                             <option value="digital" @if($edit['product']->product_type == 'digital') selected @endif>{{ Helper::translation(2167,$translate) }}</option>                            @if($allsettings->display_external_product == 1)
                             <option value="external" @if($edit['product']->product_type == 'external') selected @endif>{{ Helper::translation(2166,$translate) }}</option>@endif
                        </select>
                      </div>
                </div>
                <div id="ifphysical_external" @if($edit['product']->product_type == 'physical' or $edit['product']->product_type == 'external') class="force-block" @else class="force-none" @endif>
                <div class="form-group row">
                    <div class="col-sm-12">
                         <label for="site_keywords">{{ Helper::translation(1947,$translate) }}</label>
                        <select name="product_brand" id="product_brand" class="form-control">
                             <option value=""></option>
                             @foreach($brand['view'] as $brand)
                             <option value="{{ $brand->brand_id }}" @if($edit['product']->product_brand == $brand->brand_id) selected @endif>{{ $brand->brand_name }}</option>
                             @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_keywords">{{ Helper::translation(1948,$translate) }}</label>
                        <textarea name="product_return_policy" id="product_return_policy" rows="6" class="form-control noscroll_textarea">{{ $edit['product']->product_return_policy }}</textarea>
                    </div>
                    <div class="col-sm-6">
                        <label for="name">{{ Helper::translation(1949,$translate) }} <span class="required">*</span></label>
                        <input id="product_estimate_time" name="product_estimate_time" type="text" class="form-control" data-bvalidator="required,digit,min[1]" value="{{ $edit['product']->product_estimate_time }}">
                        <small>{{ __('Days') }}</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_title">{{ Helper::translation(1950,$translate) }} <span class="required">*</span></label>
                        <select name="product_condition" class="form-control" data-bvalidator="required">
                            <option value=""></option>
                            <option value="new" @if($edit['product']->product_condition == 'new') selected @endif>{{ Helper::translation(1951,$translate) }}</option>
                            <option value="used" @if($edit['product']->product_condition == 'used') selected @endif>{{ Helper::translation(1952,$translate) }}</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="name">{{ Helper::translation(1953,$translate) }}</label>
                        <input id="product_stock" name="product_stock" type="text" class="form-control" data-bvalidator="digit,min[0]" value="{{ $edit['product']->product_stock }}">
                        <small><span class="red-color">{{ Helper::translation(1954,$translate) }}</span></small>
                    </div>
                </div>
                @if(count($attributer['display']) != 0)
                <div class="form-group row">
                    @foreach($attributer['display'] as $attribute)
                    <div class="col-sm-6">
                         <label for="site_title">{{ $attribute->attribute_name }}</label>
                        <select name="product_attribute[]" class="form-control" multiple>
                                                @foreach($attribute->attributeagain as $product_value)
                                                <option value="{{ $product_value->attribute_value_id }}-{{ $attribute->attribute_id }}" @if(in_array($product_value->attribute_value_id,$product_attribute)) selected="selected" @endif>{{ $product_value->attribute_value }}</option>
                                                @endforeach
                                                </select>
                    </div>
                  @endforeach  
                </div>
                @endif
                </div>
                <div class="form-group row">
                    <div id="ifdigital" @if($edit['product']->product_type == 'digital') class="col-sm-6 force-block" @else class="col-sm-6 force-none" @endif>
                         <label for="customer_earnings">{{ Helper::translation(1955,$translate) }}<span class="required">*</span></label>
                        <input type="file" id="product_file" name="product_file" class="form-control-file" @if($edit['product']->product_file == '') data-bvalidator="required,extension[zip]" @else data-bvalidator="extension[zip]" @endif data-bvalidator-msg="{{ Helper::translation(1956,$translate) }}">
                                                @if($allsettings->site_s3_storage == 1)
                                                @php 
                                                if($edit['product']->product_file != '')
                                                {
                                                $fileurl = Storage::disk('s3')->url($edit['product']->product_file); 
                                                }
                                                else
                                                {
                                                $fileurl = '';  
                                                }
                                                @endphp
                                                <br/><a href="{{ $fileurl }}" class="blue-color" download>{{ $edit['product']->product_file }}</a>
                                                @else
                                                <br/>@if($edit['product']->product_file!='')<a href="{{ url('/') }}/public/storage/product/{{ $edit['product']->product_file }}" class="blue-color" download>{{ $edit['product']->product_file }}</a>@endif @endif
                    </div>
                    <div id="ifexternal" @if($edit['product']->product_type == 'external') class="col-sm-6 force-block" @else class="col-sm-6 force-none" @endif>
                        <label for="name">{{ Helper::translation(1957,$translate) }} <span class="required">*</span></label>
                        <input id="product_external_url" name="product_external_url" type="text" class="form-control" data-bvalidator="required,url" value="{{ $edit['product']->product_external_url }}">
                    </div>
                </div>
                <div id="ifphysical" @if($edit['product']->product_type == 'physical') class="force-block" @else class="force-none" @endif>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="name">{{ Helper::translation(1958,$translate) }} ({{ $allsettings->site_currency_symbol }})</label>
                        <input id="product_local_shipping_fee" name="product_local_shipping_fee" type="text" class="form-control" data-bvalidator="min[0]" value="{{ $edit['product']->product_local_shipping_fee }}">
                        <small>{{ __('(Vendor country based shipping)') }} <span class="red-color"> - {{ Helper::translation(1959,$translate) }}</span></small>
                    </div>
                    <div class="col-sm-6">
                        <label for="name">{{ Helper::translation(1960,$translate) }} ({{ $allsettings->site_currency_symbol }})</label>
                        <input id="product_global_shipping_fee" name="product_global_shipping_fee" type="text" class="form-control" data-bvalidator="min[0]" value="{{ $edit['product']->product_global_shipping_fee }}">
                        <small>{{ __('(Vendor non country based shipping)') }} <span class="red-color"> - {{ Helper::translation(1959,$translate) }}</span></small>
                    </div>
                    
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                         <label for="site_title"> {{ Helper::translation(1961,$translate) }} <span class="required">*</span></label>
                        <select name="flash_deals" id="flash_deals" class="form-control" data-bvalidator="required">
                          <option value=""></option>
                          <option value="1" @if($edit['product']->flash_deals == 1) selected @endif>{{ Helper::translation(1942,$translate) }}</option>
                          <option value="0" @if($edit['product']->flash_deals == 0) selected @endif>{{ Helper::translation(1943,$translate) }}</option>
                        </select>
                    </div>
                 </div>
                <div id="ifdeal" @if($edit['product']->flash_deals == 1) class="force-block" @else class="force-none" @endif>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_keywords">{{ Helper::translation(1962,$translate) }} <span class="required">*</span></label>
                        <input id="flash_deal_start_date" name="flash_deal_start_date" type="text" class="form-control" data-bvalidator="required" value="{{ $edit['product']->flash_deal_start_date }}">
                    </div>
                    <div class="col-sm-6">
                        <label for="site_desc">{{ Helper::translation(1963,$translate) }} <span class="required">*</span></label>
                        <input id="flash_deal_end_date" name="flash_deal_end_date" type="text" class="form-control" data-bvalidator="required" value="{{ $edit['product']->flash_deal_end_date }}">
                    </div>
                </div>
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="image_size" value="{{ $allsettings->site_max_image_size }}"> 
                <input type="hidden" name="file_size" value="{{ $allsettings->site_max_zip_size }}">
                <input type="hidden" name="save_product_image" value="{{ $edit['product']->product_image }}"> 
                <input type="hidden" name="save_product_file" value="{{ $edit['product']->product_file }}">            
                <input type="hidden" name="product_token" value="{{ $edit['product']->product_token }}">
                <input type="hidden" name="token" value="{{ uniqid() }}"> 
                <input type="hidden" name="product_id" value="{{ $edit['product']->product_id }}">
                <button type="submit" class="btn button-color float-left">{{ Helper::translation(1919,$translate) }}</button>
            </form>
        </div>
    </div>
</div>
</main>
@else
@include('not-found')
@endif
@include('footer')
@include('javascript')
</body>
</html>
@else
@include('503')
@endif
