<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
          <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                @if($allsettings->site_logo != '')
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}"  alt="{{ $allsettings->site_title }}" width="180"/></a>
                @else
                <a class="navbar-brand" href="{{ url('/') }}">{{ substr($allsettings->site_title,0,10) }}</a>
                @endif
                @if($allsettings->site_favicon != '')
                <a class="navbar-brand hidden" href="{{ url('/') }}"><img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}"  alt="{{ $allsettings->site_title }}" width="24"/></a>
                @else
                <a class="navbar-brand hidden" href="{{ url('/') }}">{{ substr($allsettings->site_title,0,1) }}</a>
                @endif
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                   @if(in_array('dashboard',$avilable))
                   <li>
                        <a href="{{ url('/admin') }}"> <i class="menu-icon fa fa-dashboard"></i>{{ Helper::translation(3549,$translate) }} </a>
                    </li>
                    @endif
                    @if(in_array('settings',$avilable))                 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gears"></i>{{ Helper::translation(3408,$translate) }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/general-settings') }}">{{ Helper::translation(3306,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/color-settings') }}">{{ Helper::translation(3171,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/email-settings') }}">{{ Helper::translation(3264,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/media-settings') }}">{{ Helper::translation(3522,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/currency-settings') }}">{{ Helper::translation(3201,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/payment-settings') }}">{{ Helper::translation(3552,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/social-settings') }}">{{ Helper::translation(3555,$translate) }}</a></li>
                            <li><i class="fa fa-gear"></i><a href="{{ url('/admin/preferred-settings') }}">{{ Helper::translation(3558,$translate) }}</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(in_array('block-section',$avilable))
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file-text-o"></i>{{ Helper::translation(3561,$translate) }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-text-o"></i><a href="{{ url('/admin/home-section') }}">{{ Helper::translation(3411,$translate) }}</a></li>
                            <li><i class="fa fa-file-text-o"></i><a href="{{ url('/admin/footer-section') }}">{{ Helper::translation(3294,$translate) }}</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->id == 1)
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-group"></i>{{ Helper::translation(3564,$translate) }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-user"></i><a href="{{ url('/admin/administrator') }}">{{ Helper::translation(3105,$translate) }}</a></li>
                            <li><i class="fa fa-user"></i><a href="{{ url('/admin/customer') }}">{{ Helper::translation(3210,$translate) }}</a></li>
                            @if($allsettings->type_of_marketplace == 'multi-vendor')
                            <li><i class="fa fa-user"></i><a href="{{ url('/admin/vendor') }}">{{ Helper::translation(3567,$translate) }}</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(in_array('country',$avilable))                    
                    <li>
                        <a href="{{ url('/admin/country-settings') }}"> <i class="menu-icon fa fa-flag"></i>{{ Helper::translation(2007,$translate) }}</a>
                    </li>
                    @endif
                    @if(in_array('manage-categories',$avilable))
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-location-arrow"></i>{{ Helper::translation(3570,$translate) }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/category') }}">{{ Helper::translation(3045,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/sub-category') }}">{{ Helper::translation(3099,$translate) }}</a></li>
                         </ul>
                    </li>
                    @endif
                    @if(in_array('products',$avilable))
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart"></i>{{ Helper::translation(1975,$translate) }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="{{ url('/admin/products') }}">{{ Helper::translation(3573,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="{{ url('/admin/attribute-type') }}">{{ Helper::translation(1914,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="{{ url('/admin/attribute-value') }}">{{ Helper::translation(1921,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="{{ url('/admin/brands') }}">{{ Helper::translation(3144,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="{{ url('/admin/coupons') }}">Coupons</a></li>
                            <li><i class="menu-icon fa fa-shopping-cart"></i><a href="{{ url('/admin/orders') }}">{{ Helper::translation(2154,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/refund') }}">{{ Helper::translation(2115,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/rating') }}">{{ Helper::translation(2114,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-location-arrow"></i><a href="{{ url('/admin/withdrawal') }}">{{ Helper::translation(3576,$translate) }}</a></li>
                         </ul>
                    </li>
                    @endif
                    @if($allsettings->site_blog_display == 1)
                    @if(in_array('blog',$avilable)) 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-comments-o"></i>{{ Helper::translation(1978,$translate) }}</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-comments-o"></i><a href="{{ url('/admin/blog-category') }}">{{ Helper::translation(3045,$translate) }}</a></li>
                            <li><i class="menu-icon fa fa-comments-o"></i><a href="{{ url('/admin/post') }}">{{ Helper::translation(3750,$translate) }}</a></li>
                        </ul>
                    </li>
                    @endif
                    @endif
                    @if(in_array('ads',$avilable))
                    <li>
                        <a href="{{ url('/admin/ads') }}"> <i class="menu-icon fa fa-file-image-o"></i>{{ Helper::translation(3111,$translate) }} </a>
                    </li>
                    @endif
                    @if(in_array('pages',$avilable))
                    <li>
                        <a href="{{ url('/admin/pages') }}"> <i class="menu-icon fa fa-file-text-o"></i>{{ Helper::translation(2028,$translate) }} </a>
                    </li>
                    @endif
                    @if(in_array('slideshow',$avilable))
                    <li>
                        <a href="{{ url('/admin/slideshow') }}"> <i class="menu-icon fa fa-image"></i>{{ Helper::translation(3579,$translate) }} </a>
                    </li>
                    @endif
                    @if(in_array('contact',$avilable))                                      
                    <li>
                        <a href="{{ url('/admin/contact') }}"> <i class="menu-icon fa fa-address-book-o"></i>{{ Helper::translation(2012,$translate) }} </a>
                    </li>
                    @endif
                    @if($allsettings->site_newsletter_display == 1)
                    @if(in_array('newsletter',$avilable))
                    <li>
                        <a href="{{ url('/admin/newsletter') }}"> <i class="menu-icon fa fa-newspaper-o"></i>{{ Helper::translation(2029,$translate) }} </a>
                    </li>
                    @endif
                    @endif
                    @if(in_array('languages',$avilable)) 
                    <li>
                        <a href="{{ url('/admin/languages') }}"> <i class="menu-icon fa fa-language"></i>{{ Helper::translation(3510,$translate) }} </a>
                    </li>
                    @endif
                    </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>