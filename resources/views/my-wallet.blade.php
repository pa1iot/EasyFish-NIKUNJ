@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2045,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2045,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2045,$translate) }}</span></p>
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
           <div class="col-md-6">
         	<h4>{{ Helper::translation(2127,$translate) }} <span class="theme-color">{{ $allsettings->site_currency_symbol }}{{ $allsettings->site_minimum_withdrawal }} </span></h4>
           </div>
           <div class="col-md-6">
         	<h4>{{ Helper::translation(2857,$translate) }} <span class="theme-color">{{ $allsettings->site_currency_symbol }}{{ Auth::user()->referral_amount }} </span></h4>
           </div>
         </div>
         <div class="row mt-3 mb-3">
                    <div class="col-md-12">
                    <form action="{{ route('my-wallet') }}" class="setting_form" method="post" id="newsample_form" enctype="multipart/form-data">
                     {{ csrf_field() }}
                        <div class="withdraw_module cardify">
                            <div class="row form-group">
                                <div class="col-lg-6 white-bg">
                                    <div class="modules__title">
                                        <h4>{{ Helper::translation(2128,$translate) }}</h4>
                                    </div>
                                    <div class="modules__content">
                                       <div class="options">
                                            @php $no = 1; @endphp
                                            @foreach($withdraw_option as $withdraw) 
                                            <div class="custom-radio">
                                                <input type="radio" id="withdrawal-{{ $withdraw }}" name="withdrawal" value="{{ $withdraw }}" @if($no == 1) checked @endif>
                                                <label for="withdrawal-{{ $withdraw }}">
                                                    <span class="circle"></span>{{ $withdraw }}</label>
                                            </div>
                                            @php $no++; @endphp
                                            @endforeach
                                            <div class="row form-group" id="ifpaypal">
                                                <div class="col-md-12 mb-3 mb-md-0">
                                                  <label class="font-weight-bold" for="phone">{{ Helper::translation(2129,$translate) }}</label>
                                                     <input type="text" id="paypal_email" name="paypal_email" class="form-control" data-bvalidator="email,required">
                                                </div>
                                            </div> 
                                            <div class="row form-group" id="ifstripe">
                                                      <div class="col-md-12 mb-3 mb-md-0">
                                                        <label class="font-weight-bold" for="phone">{{ Helper::translation(2130,$translate) }}</label>
                                                    <input type="text" id="stripe_email" name="stripe_email" class="form-control" data-bvalidator="email,required">
                                                </div>
                                            </div>
                                            <div class="row form-group" id="ifpaystack">
                                                      <div class="col-md-12 mb-3 mb-md-0">
                                                        <label class="font-weight-bold" for="phone">{{ Helper::translation(2902,$translate) }}</label>
                                                    <input type="text" id="paystack_email" name="paystack_email" class="form-control" data-bvalidator="email,required">
                                                </div>
                                            </div>
                                            <div class="row form-group" id="iflocalbank">
                                                      <div class="col-md-12 mb-3 mb-md-0">
                                                        <label class="font-weight-bold" for="phone">{{ Helper::translation(2885,$translate) }}</label>
                                                    <textarea id="bank_details" name="bank_details" class="form-control" data-bvalidator="required"></textarea>
                                                <small><strong>Example:</strong><br/>
                                                Bank Name : Test Bank<br/>
                                                Branch Name : Test Branch<br/>
                                                Branch Code : 00000<br/>
                                                IFSC Code : 63632EF</small>
                                                </div>
                                            </div> 
                                        </div>
                                        <!-- end /.options -->
                                    </div>
                                    <!-- end /.modules__content -->
                                </div>
                                <!-- end /.col-md-6 -->
                                <div class="col-lg-6 white-bg">
                                    <div class="modules__title">
                                        <h4>{{ Helper::translation(2206,$translate) }}</h4>
                                    </div>
                                    <div class="modules__content">
                                        <p class="subtitle">{{ Helper::translation(2132,$translate) }}</p>
                                        <div class="options">
                                            <div>
                                                
                                                <label>
                                                    <span class="circle"></span>{{ Helper::translation(2133,$translate) }}:
                                                    <span class="bold">{{ $allsettings->site_currency_symbol }}{{ Auth::user()->earnings }}</span>
                                                </label>
                                            </div>
                                            <input type="hidden" name="available_balance" value="{{ base64_encode(Auth::user()->earnings) }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="user_token" value="{{ Auth::user()->user_token }}">
                                            <div class="row form-group" id="ifstripe">
                                                 <div class="col-md-12 mb-3 mb-md-0">
                                                    <label class="font-weight-bold" for="phone">{{ $allsettings->site_currency_code }}</label>
                                                    <input type="text" id="rlicense" name="get_amount" class="form-control" data-bvalidator="min[{{ $allsettings->site_minimum_withdrawal }}],max[{{ Auth::user()->earnings }}],required"></div>
                                                    </div>
                                                 </div>
                                           <div class="button_wrapper">
                                            <button type="submit" class="btn button-color pill px-4 py-2">{{ Helper::translation(2134,$translate) }}</button>
                                         </div>
                                    </div>
                                </div>
                                <!-- end /.col-md-6 -->
                            </div>
                            <!-- end /.row -->
                        </div>
                        </form>
                        <!-- end /.withdraw_module -->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
              <div class="row mt-3 mb-3">
              <div class="col-md-12">
              <div class="table-responsive">
              <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                            <th>{{ Helper::translation(1964,$translate) }}</th>
                                            <th>{{ Helper::translation(2135,$translate) }}</th>
                                            <th>{{ Helper::translation(2136,$translate) }}</th>
                                            <th>{{ Helper::translation(2129,$translate) }}</th>
                                            <th>{{ Helper::translation(2130,$translate) }}</th>
                                            <th>{{ Helper::translation(2902,$translate) }}</th>
                                            <th>{{ Helper::translation(2885,$translate) }}</th>
                                            <th>{{ Helper::translation(2137,$translate) }}</th>
                                            <th>{{ Helper::translation(1915,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($withdrawData['view'] as $withdrawal)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ date('d F Y', strtotime($withdrawal->withdraw_date)) }}</td>
                                            <td>{{ $withdrawal->withdraw_payment_type }}</td>
                                            <td>@if($withdrawal->paypal_id != "") {{ $withdrawal->paypal_id }} @else <span>---</span> @endif</td>
                                            <td>@if($withdrawal->stripe_id != "") {{ $withdrawal->stripe_id }} @else <span>---</span> @endif</td>
                                            <td>@if($withdrawal->paystack_email != "") {{ $withdrawal->paystack_email }} @else <span>---</span> @endif</td>
                                            <td>@if($withdrawal->bank_details != "") @php echo nl2br($withdrawal->bank_details); @endphp @else <span>---</span> @endif</td>
                                            <td>{{ $allsettings->site_currency_symbol }}{{ $withdrawal->withdraw_amount }}</td>
                                            <td>@if($withdrawal->withdraw_status == 'pending') <span class="badge badge-danger">{{ $withdrawal->withdraw_status }}</span> @else <span class="badge badge-success">{{ $withdrawal->withdraw_status }}</span> @endif </td>
                                        </tr>
                                        @php $no++; @endphp
                                    @endforeach     
                                    </tbody>
                             </table>
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