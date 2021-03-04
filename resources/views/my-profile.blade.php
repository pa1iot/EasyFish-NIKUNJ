@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>@if(Auth::user()->user_type != 'admin'){{ Helper::translation(2043,$translate) }}@else{{ Helper::translation(1912,$translate) }}@endif  - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
@if(Auth::user()->user_type != 'admin')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2043,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2043,$translate) }}</span></p>
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
             <form action="{{ route('my-profile') }}" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
             {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="name">{{ Helper::translation(2018,$translate) }} <span class="required">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $edit['profile']->name }}" data-bvalidator="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="username">{{ Helper::translation(2101,$translate) }} <span class="required">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $edit['profile']->username }}" data-bvalidator="required">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputAddressLine1">{{ Helper::translation(2014,$translate) }} <span class="required">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $edit['profile']->email }}" data-bvalidator="required,email">
                    </div>
                    <div class="col-sm-6">
                        <label for="inputAddressLine2">{{ Helper::translation(2102,$translate) }}</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="country">{{ Helper::translation(2007,$translate) }} <span class="required">*</span></label>
                        <select class="form-control" name="user_country" data-bvalidator="required">
                        @foreach($allcountry as $country)
                        <option value="{{ $country->country_id }}" @if($edit['profile']->user_country == $country->country_id) selected @endif>{{ $country->country_name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="inputState">{{ Helper::translation(2103,$translate) }}</label>
                        <select class="form-control" id="user_gender" name="user_gender">
                        <option value="male" @if($edit['profile']->user_gender == "male") selected @endif>{{ Helper::translation(2104,$translate) }}</option>
                        <option value="female" @if($edit['profile']->user_gender == "female") selected @endif>{{ Helper::translation(2105,$translate) }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputContactNumber">{{ Helper::translation(2106,$translate) }}</label>
                        <input type="file" class="form-control" id="user_banner" name="user_banner">
                        @if($edit['profile']->user_banner != "")
                        <img src="{{ url('/') }}/public/storage/users/{{ $edit['profile']->user_banner }}" alt="{{ $edit['profile']->name }}" class="img-thumb">
                        @else
                        <img src="{{ url('/') }}/public/img/no-image.jpg" alt="{{ $edit['profile']->name }}" class="img-thumb">
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label for="inputState">{{ Helper::translation(2107,$translate) }}</label>
                        <input type="file" class="form-control" id="user_photo" name="user_photo">
                        @if($edit['profile']->user_photo != "")
                        <img src="{{ url('/') }}/public/storage/users/{{ $edit['profile']->user_photo }}" alt="{{ $edit['profile']->name }}" class="img-thumb">
                        @else
                        <img src="{{ url('/') }}/public/img/no-image.jpg" alt="{{ $edit['profile']->name }}" class="img-thumb">
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputContactNumber">{{ Helper::translation(2003,$translate) }}</label>
                        <input type="text" class="form-control" id="user_address" name="user_address" value="{{ $edit['profile']->user_address }}">
                    </div>
                    <div class="col-sm-6">
                        <label for="inputState">{{ Helper::translation(2002,$translate) }}</label>
                        <input type="text" class="form-control" id="user_phone" name="user_phone" value="{{ $edit['profile']->user_phone }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputContactNumber">{{ Helper::translation(2108,$translate) }}</label>
                        <textarea name="user_about" id="summary-ckeditor" rows="6" class="form-control">{{ html_entity_decode($edit['profile']->user_about) }}</textarea>
                    </div>
                    <div class="col-sm-6">
                        <label for="inputState">{{ Helper::translation(2851,$translate) }}</label>
                        <input type="text" class="form-control" id="affiliate_url" name="affiliate_url" value="{{ url('/') }}/?ref={{ $edit['profile']->id }}" readonly>
                        <small>({{ Helper::translation(2854,$translate) }})</small>
                    </div>
                </div>
                <input type="hidden" name="save_password" value="{{ $edit['profile']->password }}">
                <input type="hidden" name="edit_id" value="{{ $edit['profile']->user_token }}">
                <input type="hidden" name="image_size" value="{{ $allsettings->site_max_image_size }}">
                <input type="hidden" name="save_photo" value="{{ $edit['profile']->user_photo }}">
                <input type="hidden" name="save_banner" value="{{ $edit['profile']->user_banner }}">
                <button type="submit" class="btn button-color float-right">{{ Helper::translation(1919,$translate) }}</button>
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