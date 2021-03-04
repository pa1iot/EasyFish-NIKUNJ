@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>@if($allsettings->site_blog_display == 1) {{ $slug }} @else {{ Helper::translation(1912,$translate) }} @endif - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    @if($allsettings->site_blog_display == 1)
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(1978,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(1978,$translate) }}</span>@if($slug != 'Blog') <span class="split">&gt;</span> <span>{{ $slug }}</span>@endif</p>
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
          <div class="col-md-9">
          <!-- Blog Post -->
          @foreach($blogData['post'] as $post)
          <div class="card mb-5 shadow-sm white-box border-0 rounded-0 blog-post-loop li-item">
            @if($post->post_media_type =='image')
            <a href="{{ URL::to('/single') }}/{{ $post->post_slug }}" title="{{ $post->post_title }}">
            @if($post->post_image!='')
            <img src="{{ url('/') }}/public/storage/post/{{ $post->post_image }}" alt="{{ $post->post_title }}" class="card-img-top blog-img-lg rounded-0">
            @else
            <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $post->post_title }}" class="card-img-top rounded-0 blog-img-lg">
            @endif
            </a>
            @endif
            @if($post->post_media_type =='video')
            @php 
            $link = $post->post_video;
            $video_id = explode("?v=", $link);
            $video_id = $video_id[1];
            @endphp
            <iframe type="text/html" width="100%" height="500px" src="https://www.youtube.com/embed/{{ $video_id }}?showinfo=0&rel=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe> 
            @endif
            @php
            $date = date('d', strtotime($post->post_date));
            $month = date('M', strtotime($post->post_date));
            $year = date('Y', strtotime($post->post_date));
            if($translate == 'en')
            {
            $comment_post_id = $post->post_id;
            }
            else
            {
            $comment_post_id = $post->post_page_parent;
            }
            @endphp
            <div class="post-date"> <span class="post-date-day"><i class="fa fa-calendar"></i> {{ $date }} {{ $month }} {{ $year }}</span></div>
            <div class="card-body">
              <h3 class="card-title"><a href="{{ URL::to('/single') }}/{{ $post->post_slug }}" class="link-color">{{ $post->post_title }}</a></h3>
              <div class="blog-meta">
                  <div class="blog-icon-view">
                        <p><a href="{{ URL::to('/blog') }}/category/{{ $post->blog_cat_id }}/{{ $post->blog_category_slug }}">
                        <i class="fa fa-list-alt"></i> {{ $post->blog_category_name }}
                        </a></p>
                        <p class="comment"><i class="fa fa-comments"></i> {{ $comments->has($comment_post_id) ? count($comments[$comment_post_id]) : 0 }}</p>
                        <p class="view"><i class="fa fa-eye"></i> {{ $post->post_view }}</p>
                  </div>
              </div>
              <p class="card-text">{{ substr($post->post_short_desc,0,300).'...' }}</p>
              <a href="{{ URL::to('/single') }}/{{ $post->post_slug }}" class="btn button-color">{{ Helper::translation(1979,$translate) }}</a>
            </div>
          </div>
         @endforeach
         <div class="text-right">
            <div class="turn-page" id="post-pager"></div>
         </div>
       </div>
        <!-- Sidebar Widgets Column -->
      <div class="col-md-3">
        <!-- Search Widget -->
         <!-- Categories Widget -->
          <div class="card shadow-sm bg-white border-0 mb-5 rounded-0 categorylist">
            <h5 class="card-header bg-white link-color">{{ Helper::translation(1932,$translate) }}</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                    @foreach($catData['post'] as $post)
                    @php if($translate == 'en'){ $cat_id = $post->blog_cat_id; } else { $cat_id = $post->blog_page_parent; } @endphp
                      <li>
                      <a href="{{ URL::to('/blog') }}/category/{{ $cat_id }}/{{ $post->blog_category_slug }}" class="ash-color">
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
          <h5 class="card-header bg-white link-color">{{ Helper::translation(1980,$translate) }}</h5>
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