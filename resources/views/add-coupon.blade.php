@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>@if(Auth::user()->user_type == 'vendor'){{ Helper::translation(1922,$translate) }}@else{{ Helper::translation(1912,$translate) }}@endif  - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
@if(Auth::user()->user_type == 'vendor')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(1922,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a><span class="split">&gt;</span> <span>{{ Helper::translation(1922,$translate) }}</span></p>
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
             <form action="{{ route('add-coupon') }}" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
             {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="name">{{ Helper::translation(1923,$translate) }}<span class="required">*</span></label>
                        <input id="coupon_code" name="coupon_code" type="text" class="form-control" data-bvalidator="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="name">{{ Helper::translation(1924,$translate) }}(%)<span class="required">*</span></label>
                        <input id="coupon_value" name="coupon_value" type="text" class="form-control" data-bvalidator="required,min[1]">
                    </div>
                    <input type="hidden" name="discount_type" value="percentage">
                    <?php /*?><div class="col-sm-6">
                        <label for="username">Discount Type <span class="required">*</span></label>
                        <select name="discount_type" class="form-control" data-bvalidator="required">
                         <option value=""></option>
                         <option value="percentage">Percentage</option>
                         <option value="fixed">Fixed</option>
                         </select>
                    </div><?php */?>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                         <label for="site_keywords">{{ Helper::translation(1925,$translate) }}<span class="required">*</span></label>
                        <input id="flash_deal_start_date" name="coupon_start_date" type="text" class="form-control" autocomplete="off" data-bvalidator="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="site_desc">{{ Helper::translation(1926,$translate) }}<span class="required">*</span></label>
                        <input id="flash_deal_end_date" name="coupon_end_date" type="text" class="form-control" autocomplete="off" data-bvalidator="required">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="username">{{ Helper::translation(1915,$translate) }}<span class="required">*</span></label>
                        <select name="coupon_status" class="form-control" data-bvalidator="required">
                         <option value=""></option>
                         <option value="1">{{ Helper::translation(1916,$translate) }}</option>
                         <option value="0">{{ Helper::translation(1917,$translate) }}</option>
                         </select>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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