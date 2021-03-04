@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2912,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2912,$translate) }} {{ Helper::translation(2918,$translate) }} {{ $user_details->username }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2912,$translate) }}</span></p>
      </div>
    </section>
   <main role="main">
      <div class="container page-white-box mt-3">
      <div>
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
         <div class="row">
           <div class="col-md-12 mt-1 mb-1 pt-1 pb-1">
         	    <div class="container emp-profile">
                  <div class="row">
                    <div class="col-md-3 white-bg">
                        <div class="profile-img">
                        <a href="{{ url('/') }}/user/{{ $user_details->username }}" title="{{ $user_details->name }}">
                        @if($user_details->user_photo != "")
                        <img src="{{ url('/') }}/public/storage/users/{{ $user_details->user_photo }}" alt="" class="rounded">
                        @else
                        <img src="{{ url('/') }}/public/img/no-user.png" alt="" class="rounded">
                        @endif
                        </a>   
                        </div>
                        <div align="center">
                            <div class="info mt-2">
                        <div class="title">
                            <a href="{{ url('/') }}/user/{{ $user_details->username }}" title="{{ $user_details->name }}" class="theme-color">{{ $user_details->username }}</a>
                        </div>
                        <div class="desc">
                        @if($user_details->verified == 1)
                        <i class="fa fa-check-circle green" aria-hidden="true"></i> {{ Helper::translation(2922,$translate) }}
                        @else
                        <i class="fa fa-times-circle-o red" aria-hidden="true"></i> {{ Helper::translation(2925,$translate) }}
                        @endif
                        </div>
                        <div align="center" class="mt-3">
                        <a href="{{ url('/my-purchase-details') }}/{{ $order_details->purchase_token }}" class="btn btn-danger btn-sm">&lt; {{ Helper::translation(2088,$translate) }}</a>
                        <a href="{{ url('/') }}/user/{{ $user_details->username }}" title="{{ $user_details->name }}" class="btn button-color btn-sm">{{ Helper::translation(1977,$translate) }}</a>
                        </div>
                        </div>
                        </div>
                        
                        <div class="mt-5 mb-3">
                         <h4 class="mb-3">{{ Helper::translation(2154,$translate) }}</h4>
                         <label><strong>{{ Helper::translation(2076,$translate) }} : </strong> {{ $ord_id }}</label><br>
                         <label><strong>{{ Helper::translation(1984,$translate) }} : </strong> <a href="{{ url('/product') }}/{{ $order_details->product_slug }}">{{ $order_details->product_name }}</a></label><br>
                         <label><strong>{{ Helper::translation(2078,$translate) }} : </strong> {{ $order_details->quantity }} X {{ $allsettings->site_currency_symbol }}{{ $order_details->price }}</label><br>
                         @if($order_details->product_attribute_values != "")
                         <label><strong>{{ Helper::translation(2079,$translate) }} : </strong> {{ $order_details->product_attribute_values }}</label><br>
                         @endif
                        </div>
                        </div> 
                        
                        <div class="col-md-9 ash-bg">
                        <div class="comments">
		<div class="comment-wrap">
				<div class="photo">
						<div class="avatar" style="background-image: url('{{ url('/') }}/public/storage/users/{{ Auth::user()->user_photo }}')"></div>
				</div>
				<div class="comment-block">
						<form method="POST" action="{{ route('conversation') }}" id="conversation_form"  enctype="multipart/form-data">
                        @csrf
								<textarea name="conver_text" id="" cols="30" rows="3" placeholder="{{ Helper::translation(2928,$translate) }}" data-bvalidator="required"></textarea>
                                
                                <input type="hidden" name="conver_user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="conver_seller_id" value="{{ $user_details->id }}">
                                <input type="hidden" name="conver_order_id" value="{{ $order_id }}">
                                <input type="hidden" name="conver_url" value="{{ url('/conversation-to-buyer') }}">
                                <input type="submit" value="{{ Helper::translation(2931,$translate) }}" class="btn button-color btn-sm px-4 py-2"> 
						</form>
				</div>
		</div>
        <div id="listShow" class="message-height">
        @foreach($chat['message'] as $chat)
		<div class="comment-wrap li-item">
				<div class="photo">
                        
						<div class="avatar" style="background-image: url('{{ url('/') }}/public/storage/users/{{ $chat->user_photo }}')"></div>
				</div>
				<div class="comment-block">
						<p class="comment-text">{{ $chat->conver_text }}</p>
						<div class="bottom-comment">
								<div class="comment-date">{{ $chat->conver_date }}</div>
								@if($chat->conver_user_id == Auth::user()->id)
                                <ul class="comment-actions">
										
										<li class="reply"><a href="{{ url('/conversation') }}/{{ base64_encode($chat->conver_id) }}" onClick="return confirm('{{ Helper::translation(1968,$translate) }}');"><span class="icon-delete"></span> {{ Helper::translation(1967,$translate) }}</a></li>
								</ul>
                                @endif
						</div>
				</div>
		</div>
        @endforeach
        </div>
        <div class="row mt-9" align="center">
              <div class="turn-page" id="pager"></div>
         </div>
         </div>
         </div>
        </div>
            </div>
           </div>
         </div>
      </div>
    </main>
    @include('footer')
    @include('javascript')
  </body>
</html>
@else
@include('503')
@endif