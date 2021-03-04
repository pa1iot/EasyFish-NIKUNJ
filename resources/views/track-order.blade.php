@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2052,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2052,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2052,$translate) }}</span></p>
      </div>
    </section>
  <main role="main">
      <div class="container page-white-box mt-3">
         <div class="row">
           <div class="col-md-6 mt-1 mb-1 pt-1 pb-1 mx-auto">
         	    <form action="{{ route('track-order') }}" class="setting_form" id="track_form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-row">
                             <div class="form-group col-md-12">
                              <label>{{ Helper::translation(2195,$translate) }}</label>
                              <input id="order_number" name="order_number" placeholder="{{ __('Order No') }}" class="form-control" type="text" data-bvalidator="required">
                            </div>
                            
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-12"> 
                            <button type="submit" class="btn button-color">{{ Helper::translation(1919,$translate) }}</button>
                            </div>
                        </div>
                  </form>        
           </div>
         </div>
         @if($check_track_order != 0)
         @php
         $delivery_time ='+'.$track_order->product_estimate_time.' days';
         $delivery_date = date('d F Y', strtotime($delivery_time, strtotime($track_order->payment_date)));
         @endphp
         <div class="row">
           <div class="col-md-12">
              <div class="card-body">
                      <h6>{{ Helper::translation(2076,$translate) }}: {{ $order_id }}</h6>
                       <article class="card">
                              <div class="card-body row">
                               <div class="col"> <strong>{{ Helper::translation(2094,$translate) }}:</strong> <br>{{ $delivery_date }}</div>
                               <div class="col"> <strong>{{ Helper::translation(1915,$translate) }}:</strong> <br> Order has been {{ $track_order->order_tracking }}</div>
                               <div class="col"> <strong>{{ Helper::translation(2117,$translate) }}:</strong> <br> {{ $order_id }} </div>
                               </div>
                       </article>
                    <div class="track">
                         @if($track_order->order_tracking == $track_placed)
                         <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">{{ Helper::translation(2118,$translate) }}</span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> {{ Helper::translation(2119,$translate) }}</span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> {{ Helper::translation(2120,$translate) }} </span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text">{{ Helper::translation(2121,$translate) }}</span> </div>
                         @endif
                         @if($track_order->order_tracking == $track_packed)
                         <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">{{ Helper::translation(2118,$translate) }}</span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> {{ Helper::translation(2119,$translate) }}</span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> {{ Helper::translation(2120,$translate) }} </span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text">{{ Helper::translation(2121,$translate) }}</span> </div>
                         @endif
                         @if($track_order->order_tracking == $track_shipped)
                         <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">{{ Helper::translation(2118,$translate) }}</span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> {{ Helper::translation(2119,$translate) }}</span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> {{ Helper::translation(2120,$translate) }} </span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text">{{ Helper::translation(2121,$translate) }}</span> </div>
                         @endif
                         @if($track_order->order_tracking == $track_delivered)
                         <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">{{ Helper::translation(2118,$translate) }}</span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> {{ Helper::translation(2119,$translate) }}</span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> {{ Helper::translation(2120,$translate) }} </span> </div>
                         <div class="step active"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text">{{ Helper::translation(2121,$translate) }}</span> </div>
                         @endif
                         @if($track_order->order_tracking == '')
                         <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">{{ Helper::translation(2118,$translate) }}</span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-square"></i> </span> <span class="text"> {{ Helper::translation(2119,$translate) }}</span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> {{ Helper::translation(2120,$translate) }} </span> </div>
                         <div class="step"> <span class="icon"> <i class="fa fa-handshake-o"></i> </span> <span class="text">{{ Helper::translation(2121,$translate) }}</span> </div>
                         @endif
                         </div>
                  </div>
           </div>
         </div>
         @else
         @if($without == 1)
         <div class="row">
           <div class="col-md-12 mt-3 mb-3 pt-3 pb-3" align="center">
             <p>{{ Helper::translation(2196,$translate) }}</p>
           </div>
         </div> 
         @endif 
         @endif
      </div>
    </main>
    @include('footer')
    @include('javascript')
    </body>
</html>
@else
@include('503')
@endif