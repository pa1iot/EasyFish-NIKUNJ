@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2026,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2026,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2026,$translate) }}</span></p>
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
           <div class="col-md-12">
              <div class="table-responsive">
             <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(1964,$translate) }}</th>
                                            <th>{{ Helper::translation(2076,$translate) }}</th>
                                            <th>{{ Helper::translation(1984,$translate) }}</th>
                                            <th>{{ Helper::translation(2077,$translate) }}</th>
                                            <th>{{ Helper::translation(2078,$translate) }}</th>
                                            <th>{{ Helper::translation(2079,$translate) }}</th>
                                            <th>{{ Helper::translation(2080,$translate) }}</th>
                                            <th>{{ Helper::translation(2081,$translate) }}</th>
                                            <th>{{ Helper::translation(2082,$translate) }}</th>
                                            <th>{{ Helper::translation(2083,$translate) }}</th>
                                            <th>{{ Helper::translation(2912,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($order['details'] as $product)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $product->ord_id }}</td>
                                            <td>
                                            <a href="{{ url('/product') }}/{{ $product->product_slug }}">
                                            @if($product->product_image != '')
                                                <img src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}"  class="img-thumb" alt="{{ $product->product_name }}"/>@else <img src="{{ url('/') }}/public/img/no-image.jpg"  class="img-thumb" alt="{{ $product->product_name }}"/>  @endif
                                                </a>
                                           </td>
                                            <td>{{ $product->purchase_token }}</td>
                                            <td>{{ $product->quantity }} X {{ $allsettings->site_currency_symbol }}{{ $product->price }}</td>
                                            <td>{{ $product->product_attribute_values }} </td>
                                            <td>{{ str_replace("-"," ",$product->payment_type) }} </td>
                                            <td>@if($product->order_status == 'completed') <span class="badge badge-success">{{ Helper::translation(2084,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(2085,$translate) }}</span> @endif</td>
                                            <td>@if($product->payment_status != '') <span class="badge badge-success">{{ $product->payment_status }}</span> @else <span class="badge badge-warning">{{ Helper::translation(2086,$translate) }}</span> @endif</td>
                                            <td><a href="my-orders-details/{{ $product->ord_id }}/{{ $product->purchase_token }}" class="btn btn-success btn-sm">{{ Helper::translation(2061,$translate) }}</a> </td>
                                            <td>
                                            @if($product->payment_status != $payment_status_buyer or $product->payment_status == $payment_status_vendor)
                                            <a href="{{ url('/conversation-to-buyer') }}/{{ $product->username }}/{{ $encrypter->encrypt($product->ord_id) }}" class="btn btn-primary btn-sm">{{ Helper::translation(2915,$translate) }}</a>
                                            @else
                                            <span>---</span>
                                            @endif
                                            </td>
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