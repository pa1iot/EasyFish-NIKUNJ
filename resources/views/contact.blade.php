@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2012,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
{!! NoCaptcha::renderJs() !!}
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2012,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2012,$translate) }}</span></p>
      </div>
    </section>
    <main role="main">
      <div class="container page-white-box mt-3">
         <div class="row">
	    <div class="col-md-12">
	        <h4>{{ Helper::translation(2013,$translate) }}</h4>
		    <hr>
	    </div>
		<div class="col-md-6">
		    <div class="address">
		    <h5>{{ Helper::translation(2003,$translate) }}:</h5>
		    <ul class="list-unstyled">
		        <li> {{ $allsettings->office_address }}</li>
		       
		    </ul>
		    </div>
		    <div class="email">
		    <h5>{{ Helper::translation(2014,$translate) }}:</h5>
		    <ul class="list-unstyled">
		        <li> {{ $allsettings->office_email }}</li>
		        
		    </ul>
		    </div>
		    <div class="phone">
		        <h5>{{ Helper::translation(2002,$translate) }}:</h5>
		        <ul class="list-unstyled">
		        <li> {{ $allsettings->office_phone }}</li>
		       
		    </ul>
		    </div>
		</div>
		<div class="col-md-6">
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
		    <div class="card">
		        <div class="card-body">
		             <form action="{{ route('contact') }}" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <input id="from_name" name="from_name" placeholder="{{ Helper::translation(2015,$translate) }}" class="form-control" type="text" data-bvalidator="required">
                            </div>
                            <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="inputEmail4" placeholder="{{ Helper::translation(2014,$translate) }}" name="from_email" data-bvalidator="email,required">
                            </div>
                          </div>
                          <div class="form-row">
                          <div class="form-group col-md-12">
                                     <input id="from_phone" name="from_phone" placeholder="{{ Helper::translation(2002,$translate) }}" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                                      <textarea class="form-control" cols="20" rows="5" placeholder="{{ Helper::translation(2016,$translate) }}" name="message_text" data-bvalidator="required"></textarea>
                            </div>
                        </div>
                        <div class="form-row form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                         <div class="col-md-12">
                          {!! app('captcha')->display() !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                                <strong class="red">{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                        @endif
                        </div>
                      </div>
                        <div class="form-row">
                            <button type="submit" class="btn button-color">{{ Helper::translation(1919,$translate) }}</button>
                        </div>
                    </form>
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