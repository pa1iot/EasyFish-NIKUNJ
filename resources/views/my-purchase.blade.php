@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ Helper::translation(2044,$translate) }} - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(2044,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(2044,$translate) }}</span></p>
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
                                            <th>{{ Helper::translation(2077,$translate) }}</th>
                                            <th>{{ Helper::translation(2089,$translate) }}</th>
                                            <th>{{ Helper::translation(2080,$translate) }}</th>
                                            <th>{{ Helper::translation(2109,$translate) }}</th>
                                            <th>{{ Helper::translation(2091,$translate) }}</th>
                                            <th>{{ Helper::translation(2082,$translate) }}</th>
                                            <th>{{ Helper::translation(2083,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($purchase['details'] as $product)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $product->purchase_token }}</td>
                                            <td>{{ $product->payment_token }} </td>
                                            <td>{{ str_replace("-"," ",$product->payment_type) }} </td>
                                            <td>{{ $allsettings->site_currency_symbol }}{{ $product->total }} </td>
                                            <td>{{ $product->payment_date }} </td>
                                            <td>@if($product->payment_status == 'completed') <span class="badge badge-success">{{ Helper::translation(2084,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(2085,$translate) }}</span> @endif</td>
                                            <td><a href="my-purchase-details/{{ $product->purchase_token }}" class="btn btn-success btn-sm">{{ Helper::translation(2061,$translate) }}</a> </td>
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