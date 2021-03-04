@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>@if($allsettings->site_blog_display == 1) {{ $edit['post']->post_title }} @else {{ Helper::translation(1912,$translate) }} @endif - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    @if($allsettings->site_blog_display == 1)
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(1978,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(1978,$translate) }}</span> <span class="split">&gt;</span> <span>{{ $edit['post']->post_title }}</span></p>
      </div>
    </section>
 <main role="main">
      <div class="container mt-3">
      @if($allsettings->blog_ads == 1)
      @if($allsettings->blog_top_ads !='')
         <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-2" align="center">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    @php echo html_entity_decode($allsettings->blog_top_ads); @endphp
                    <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
       </script>
      </div>
      </div>
      @endif 
      @endif
         <div class="row mb-5 pb-5">
        <!-- Blog Entries Column -->
        <div class="col-md-9">
          <!-- Blog Post -->
         <div class="card mb-5 shadow-sm bg-white border-0 rounded-0 blog-post-loop li-item">
           @if($edit['post']->post_media_type =='image')
           @if($edit['post']->post_image!='')
            <img src="{{ url('/') }}/public/storage/post/{{ $edit['post']->post_image }}" alt="{{ $edit['post']->post_title }}" class="card-img-top blog-img-lg rounded-0">
            @else
            <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $edit['post']->post_title }}" class="card-img-top rounded-0 blog-img-lg">
            @endif
            @endif
            @if($edit['post']->post_media_type =='video')
            @php 
            $link = $edit['post']->post_video;
            $video_id = explode("?v=", $link);
            $video_id = $video_id[1];
            @endphp
            <iframe type="text/html" width="100%" height="500px" src="https://www.youtube.com/embed/{{ $video_id }}?showinfo=0&rel=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe> 
            @endif
            @php
            $date = date('d', strtotime($edit['post']->post_date));
            $month = date('M', strtotime($edit['post']->post_date));
            $year = date('Y', strtotime($edit['post']->post_date));
            @endphp
            <div class="post-date"> <span class="post-date-day"><i class="fa fa-calendar"></i> {{ $date }} {{ $month }} {{ $year }}</span></div>
            <div class="card-body">
              <h3 class="card-title"><a href="{{ URL::to('/single') }}/{{ $edit['post']->post_slug }}" class="link-color">{{ $edit['post']->post_title }}</a></h3>
              <div class="blog-meta">
                        <div class="blog-icon-view">
                        <p><a href="{{ URL::to('/blog') }}/category/{{ $edit['post']->blog_cat_id }}/{{ $edit['post']->blog_category_slug }}">
                        <i class="fa fa-list-alt"></i> {{ $edit['post']->blog_category_name }}
                        </a></p>
                        <p class="comment"><i class="fa fa-comments"></i> {{ $count }}</p>
                        <p class="view"><i class="fa fa-eye"></i> {{ $edit['post']->post_view }}</p>
                        </div>
              </div>
              <div class="single-blog-content">
                                <div>
                                @php echo html_entity_decode($edit['post']->post_desc); @endphp
                                </div>
                                <div class="share mt-3 pt-3">
                                <p class="font-weight-bold">{{ Helper::translation(2168,$translate) }} :
                                @foreach($post_tags as $tags)
                                <a href="{{ url('/blog') }}/blog/{{ strtolower(str_replace(' ','-',$tags)) }}" class="fs13 tag-btn">{{ $tags }}</a>
                                @endforeach
                                </p>
                                </div>
                                <div class="share mt-3 pt-3">
                                    <p class="font-weight-bold">{{ Helper::translation(2169,$translate) }}</p>
                                        <div class="footer-box-info">
                                            <ul class="social-icons">
                                                <li>
                                                    <a class="share-button" data-share-url="{{ URL::to('/single') }}/{{ $edit['post']->post_slug }}" data-share-network="facebook" data-share-text="{{ $edit['post']->post_short_desc }}" data-share-title="{{ $edit['post']->post_title }}" data-share-via="{{ $allsettings->site_title }}" data-share-tags="" data-share-media="{{ url('/') }}/public/storage/post/{{ $edit['post']->post_image }}" href="javascript:void(0)"><i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="share-button" data-share-url="{{ URL::to('/single') }}/{{ $edit['post']->post_slug }}" data-share-network="twitter" data-share-text="{{ $edit['post']->post_short_desc }}" data-share-title="{{ $edit['post']->post_title }}" data-share-via="{{ $allsettings->site_title }}" data-share-tags="" data-share-media="{{ url('/') }}/public/storage/post/{{ $edit['post']->post_image }}" href="javascript:void(0)"><i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="share-button" data-share-url="{{ URL::to('/single') }}/{{ $edit['post']->post_slug }}" data-share-network="googleplus" data-share-text="{{ $edit['post']->post_short_desc }}" data-share-title="{{ $edit['post']->post_title }}" data-share-via="{{ $allsettings->site_title }}" data-share-tags="" data-share-media="{{ url('/') }}/public/storage/post/{{ $edit['post']->post_image }}" href="javascript:void(0)"><i class="fa fa-google-plus"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="share-button" data-share-url="{{ URL::to('/single') }}/{{ $edit['post']->post_slug }}" data-share-network="linkedin" data-share-text="{{ $edit['post']->post_short_desc }}" data-share-title="{{ $edit['post']->post_title }}" data-share-via="{{ $allsettings->site_title }}" data-share-tags="" data-share-media="{{ url('/') }}/public/storage/post/{{ $edit['post']->post_image }}" href="javascript:void(0)"><i class="fa fa-linkedin"></i>
                                                    </a>
                                                </li>
                                                                                                
                                            </ul>
                                        </div>
                                        <!-- end social_share -->
                                 </div>
                            </div>
            </div>
          </div>
         <div>
         @if ($message = Session::get('success'))
         <div class="alert alert-success" role="alert">
            <span class="alert_icon lnr lnr-checkmark-circle"></span>
              {{ $message }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="fa fa-window-close"></i>
              </button>
         </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
           <span class="alert_icon lnr lnr-warning"></span>
             {{ $message }}
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <i class="fa fa-window-close"></i>
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
        <i class="fas fa-window-close"></i>
        </button>
        </div>
        @endif
        </div>
        @if(Auth::guest())
          <div class="mb-5"> 
             <h5>{{ Helper::translation(2170,$translate) }} <a href="{{ URL::to('/login') }}" class="theme-color">{{ Helper::translation(2173,$translate) }}</a> {{ Helper::translation(2171,$translate) }}</h5>
          </div>      
          @endif
          <div class="card mb-5 shadow-sm bg-white border-0 rounded-0"> 
          <div class="comments">
          @if (Auth::check())
          <div class="container mt-3 mb-3">
          <div class="row">
		  <div class="col-md-1">
				@if(Auth::user()->user_photo != '')
				<div class="avatar"><img src="{{ url('/') }}/public/storage/users/{{ Auth::user()->user_photo }}" /></div>
                @else
                <div class="avatar"><img src="{{ url('/') }}/public/img/no-user.png" /></div>
                @endif
		  </div>
		  <div class="col-md-11">
			<form class="cmnt_reply_form" action="{{ route('single') }}" id="comment_form" method="post">
                {{ csrf_field() }}
				<textarea name="comment_content" id="" rows="3" placeholder="{{ Helper::translation(2172,$translate) }}" class="d-block form-control" data-bvalidator="required"></textarea>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="post_id" value="{{ $edit['post']->post_id }}">
                <input type="submit" name="submit" class="btn button-color mt-1" value="Submit">
			</form>
		  </div>
		</div>
        </div>
        @endif
        @if($count != 0)
        @php $no = 1; @endphp
        @foreach($comment['display'] as $comment)
        <div class="container mt-5 mb-5">
		<div class="row">
				<div class="col-md-1">
                        @if($comment->user_photo != '')
						<div class="avatar"><img src="{{ url('/') }}/public/storage/users/{{ $comment->user_photo }}" /></div>
                        @else
                        <div class="avatar"><img src="{{ url('/') }}/public/img/no-user.png" /></div>
                        @endif
				</div>
				<div class="col-md-11">
                        <h5>{{ $comment->name }}</h5>
						<p class="comment-text">{{ $comment->comment_content }}</p>
						<div class="bottom-comment">
								<div class="ash-color fs12"><i class="fa fa-calendar"></i> {{ date('d M Y', strtotime($comment->comment_date)) }}</div>
						</div>
				</div>
		</div>
        </div>
        @php $no++; @endphp
        @endforeach
        @endif
</div>
</div>
</div>
<!-- Sidebar Widgets Column -->
        <div class="col-md-3">
          <div class="card shadow-sm bg-white border-0 mb-5 rounded-0 categorylist">
            <h5 class="card-header bg-white">{{ Helper::translation(1932,$translate) }}</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                    @foreach($catData['post'] as $post)
                    @php if($translate == 'en'){ $cat_id = $post->blog_cat_id; } else { $cat_id = $post->blog_page_parent; } @endphp
                      <li><a href="{{ URL::to('/blog') }}/category/{{ $cat_id }}/{{ $post->blog_category_slug }}" class="ash-color">
                           <span class="fa fa-angle-right"></span> {{ $post->blog_category_name }}
                           <span class="post-count">[{{ $category_count->has($cat_id) ? count($category_count[$cat_id]) : 0 }}]</span>
                          </a>
                      </li>
                   @endforeach  
                  </ul>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Side Widget -->
          <div class="card shadow-sm bg-white border-0 mb-5 rounded-0">
          <h5 class="card-header bg-white">{{ Helper::translation(1980,$translate) }}</h5>
              <div class="items-bordered-wrap">
                  <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                    @foreach($blogPost['latest'] as $post)
                    <ul class="media-list">
                           <li class="media mb-4 mt-2 no-gutters">
                            <div class="col-md-5 full-width-image mr-2">
                            <a href="{{ URL::to('/single') }}/{{ $post->post_slug }}" title="{{ $post->post_title }}">
                            @if($post->post_media_type =='image')
                            @if($post->post_image!='')
                            <img src="{{ url('/') }}/public/storage/post/{{ $post->post_image }}" alt="{{ $post->post_title }}" class="mx-auto d-block img-sm">
                            @else
                            <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $post->post_title }}" class="img-sm">
                            @endif
                            @else
                            @php 
                            $link = $post->post_video;
                            $video_id = explode("?v=", $link);
                            $video_id = $video_id[1];
                            @endphp
                            <img src="https://img.youtube.com/vi/{{ $video_id }}/mqdefault.jpg" alt="{{ $post->post_title }}" class="mx-auto d-block img-sm">
                            @endif
                            </a>
                            </div>
                            <div class="col-md-7">
                                <a href="{{ URL::to('/single') }}/{{ $post->post_slug }}" class="link-color fs15">{{ $post->post_title }}</a>
                                <div class="ash-color">
                                <small>
                                    <i class="fa fa-clock"></i> {{ date('d M Y', strtotime($post->post_date)) }}
                                </small>
                                </div> 
                            </div>
                        </li>
                    </ul>
                    @endforeach  
                        </div>
                      </div>
                   </div>
                </div>
            </div>
            @if($allsettings->blog_ads == 1)
                 @if($allsettings->blog_sidebar_ads !='')
                 <div class="row">
                        <div class="col-lg-12" align="center">
                          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            @php echo html_entity_decode($allsettings->blog_sidebar_ads); @endphp
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                 </div> 
                 @endif      
                 @endif
        </div>
      </div>
      @if($allsettings->blog_ads == 1)
      @if($allsettings->blog_bottom_ads !='')
         <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mb-2" align="center">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    @php echo html_entity_decode($allsettings->blog_bottom_ads); @endphp
                    <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
       </script>
      </div>
      </div>
      @endif 
      @endif
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