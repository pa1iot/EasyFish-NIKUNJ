<header id="header">
<div class="container-fluid">
      <div class="row">
      <div id="logo" class="col-lg-3 col-md-3 col-sm-4 mb-1">
        @if($allsettings->site_logo != '')
    	<a href="{{ URL::to('/') }}">
    	<img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="{{ $allsettings->site_title }}">
    	</a>
    	@endif
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 mt-2 pt-1">
             <form action="{{ route('shop') }}" class="search_form" id="search_form" method="post" enctype="multipart/form-data">
             {{ csrf_field() }}
              <div class="input-group flex-fill">
                 <input type="text" class="form-control" id="search_text" name="search_text" placeholder="{{ Helper::translation(2039,$translate) }}">
                   <div class="input-group-append">
                    <button class="btn btn-secondary button-color" type="submit">
                       <i class="fa fa-search"></i>
                 </button>
            </div>
         </div>
         </form>
      </div> 
     <div class="col-lg-5 col-md-5 col-sm-4 mt-2 pt-1 mb-1">
      <nav class="pull-right" id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a></li>
          <li> <a href="{{ URL::to('/shop') }}"> {{ Helper::translation(2040,$translate) }} </a></li>
          @if($allsettings->site_blog_display == 1)
          <li> <a href="{{ URL::to('/blog') }}"> {{ Helper::translation(1978,$translate) }} </a></li>
          @endif
          @foreach($mainmenu['pages'] as $pages)
		  <li> <a href="{{ URL::to('/page/') }}/{{ $pages->page_slug }}"> {{ $pages->page_title }} </a></li>
		  @endforeach
          <li> <a href="{{ URL::to('/contact') }}"> {{ Helper::translation(2012,$translate) }} </a></li>
          @if($allsettings->google_translate == 1)
          <li class="menu-has-children"><a href="javascript:void(0)"><span class="fa fa-language"></span> {{ $language_title }}</a>
            <ul>
              @foreach($languages['view'] as $language)
              <li><a href="{{ URL::to('/translate') }}/{{ $language->language_code }}">{{ $language->language_name }}</a></li>
              @endforeach
            </ul>
          </li>
          @endif
          @if(Auth::guest())
          <li><a href="{{ url('/login') }}" class="btn login-btn">{{ Helper::translation(2041,$translate) }}</a></li>
          @else 
          <li class="menu-has-children"><a href="javascript:void(0)">{{ Helper::translation(2042,$translate) }}</a>
            <ul>
              @if(Auth::user()->user_type == 'customer')
              <li><a href="{{ url('/my-profile') }}">{{ Helper::translation(2043,$translate) }}</a></li>
              <li><a href="{{ url('/my-purchase') }}">{{ Helper::translation(2044,$translate) }}</a></li>
              <li><a href="{{ url('/my-wallet') }}">{{ Helper::translation(2045,$translate) }}</a></li>
              @endif
              @if(Auth::user()->user_type == 'vendor')
              <li><a href="{{ url('/my-profile') }}">{{ Helper::translation(2043,$translate) }}</a></li>
              <li><a href="{{ url('/my-product') }}">{{ Helper::translation(2046,$translate) }}</a></li>
              <li><a href="{{ url('/attribute-type') }}">{{ Helper::translation(1914,$translate) }}</a></li>
              <li><a href="{{ url('/attribute-value') }}">{{ Helper::translation(1921,$translate) }}</a></li>
              <li><a href="{{ url('/my-coupon') }}">{{ Helper::translation(2047,$translate) }}</a></li>
              <li><a href="{{ url('/my-orders') }}">{{ Helper::translation(2026,$translate) }}</a></li>
              <li><a href="{{ url('/my-purchase') }}">{{ Helper::translation(2044,$translate) }}</a></li>
              <li><a href="{{ url('/my-wallet') }}">{{ Helper::translation(2045,$translate) }}</a></li>
              @endif
              <li><a href="{{ url('/logout') }}">{{ Helper::translation(2048,$translate) }}</a></li>
            </ul>
          </li>
          @endif
        </ul>
      </nav><!-- #nav-menu-container -->
      </div>
      </div>
    </div>
    <div class="navbar navbar-expand-lg category-bar row">
                <div class="container-fluid">
                  <div class="col-lg-3 col-md-12 col-sm-12">
                    <button type="button" id="sidebarCollapse" class="btn button-color">
                        <i class="fa fa-bars"></i>
                        <span>{{ Helper::translation(1932,$translate) }}</span>
                    </button>
                    <button class="btn button-color d-inline-block d-lg-none ml-auto pull-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <button class="btn button-color d-inline-block d-lg-none ml-auto mmiddle pull-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                  </div> 
                  <div class="col-lg-4 col-md-12 col-sm-12">
                   <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                        <ul class="nav navbar-nav">
                            @if($allsettings->type_of_marketplace == 'multi-vendor')
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/best-sellers') }}">{{ Helper::translation(1973,$translate) }}</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/new-releases') }}">{{ Helper::translation(2049,$translate) }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/top-deals') }}">{{ Helper::translation(2050,$translate) }}</a>
                            </li>
                            @if($allsettings->type_of_marketplace == 'multi-vendor')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/start-sellings') }}">{{ Helper::translation(2051,$translate) }}</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/track-order') }}">{{ Helper::translation(2052,$translate) }}</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/wishlist') }}">{{ Helper::translation(2053,$translate) }}</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                   </div>
                  <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            @if($allsettings->type_of_marketplace == 'multi-vendor')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/track-order') }}">{{ Helper::translation(2052,$translate) }}</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/wishlist') }}">{{ Helper::translation(2053,$translate) }}</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/checkout') }}">{{ Helper::translation(1995,$translate) }}</a>
                            </li>
                            <li class="nav-item"><a href="{{ url('/cart') }}" class="nav-link"><i class="fa fa-shopping-cart"></i> {{ Helper::translation(1983,$translate) }} <span class="cart-badge">{{ $cart_count }}</span></a></li>
                        </ul>
                    </div>
                   </div> 
                 </div>
            </nav>
            <nav id="sidebar">
            <div id="dismiss">
                <i class="fa fa-arrow-left"></i>
            </div>
            <div class="sidebar-header">
                <h3>{{ Helper::translation(1932,$translate) }}</h3>
            </div>
            <ul class="list-unstyled components">
                @foreach($categories['display'] as $menu)
                <li>
                    <a @if(count($menu->subcategory) != 0) href="#menu-{{ $menu->cat_id }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" @else href="{{ URL::to('/shop/category') }}/{{ $menu->category_slug }}"  @endif>
                        @if($menu->category_image != '')
                        <img src="{{ url('/') }}/public/storage/category/{{ $menu->category_image }}" alt="{{ $menu->category_name }}" class="menu-icon">
                        @else
                        <i class="fa fa-paper-plane"></i>
                        @endif
                        <span onclick="window.location.href='{{ URL::to('/shop/category') }}/{{ $menu->category_slug }}'">{{ $menu->category_name }}</span>
                    </a>
                    @if(count($menu->subcategory) != 0)
                    <ul class="collapse list-unstyled" id="menu-{{ $menu->cat_id }}">
                    @foreach($menu->subcategory as $sub_category)  
                        <li>
                            <a href="{{ URL::to('/shop/subcategory') }}/{{$sub_category->subcategory_slug}}">{{ $sub_category->subcategory_name }}</a>
                        </li>
                    @endforeach    
                    </ul>
                    @endif
                </li>
                @endforeach
                </ul>
        </div>
</header>