<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>{{ $purchase_token }} - {{ $allsettings->site_title }}</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <link rel="stylesheet" type="text/css" href="{{ URL::to('resources/views/template/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::to('resources/views/template/css/stylesheet.css') }}">
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container" style="background:#FFFFFF;">
  <!-- Header -->
  <header>
  <div class="row align-items-center mb-5">
    <div class="col-sm-7 text-center text-sm-left mb-sm-0">
      @if($allsettings->site_logo != '')
      <a href="{{ URL::to('/') }}" target="_blank">
      <img width="200" src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="{{ $allsettings->site_title }}"/>
      </a>
      @endif
    </div>
    <div class="col-sm-5 text-right" style="float:right;">
      <h4 class="text-7 mb-0">Invoice</h4>
    </div>
  </div>
  <hr>
  <div class="row align-items-center">
    <div class="col-sm-6 text-center text-sm-left"><strong>{{ Helper::translation(2091,$translate) }}:</strong> {{ date("d M Y", strtotime($payment_date)) }}</div>
    <div class="col-sm-6 text-right" style="float:right;"> <strong>Invoice No / {{ Helper::translation(2077,$translate) }}:</strong> #{{ $purchase_token }}</div>
  </div>
  <hr>
  <div class="row align-items-center mt-3">
  <div class="col-sm-6 text-center text-sm-left"> <strong>Pay To:</strong>
      <address>
      {{ $buyer_name }}<br />
      {{ $buyer_address }}<br />
      {{ $buyer_city }}, {{ $buyer_zip }}<br />
      {{ $buyer_country }}<br/>
	  {{ $buyer_email }}
      </address>
    </div>
    <div class="col-sm-6 text-right" style="float:right;"> <strong>Invoiced To:</strong>
      <address>
      {{ $allsettings->office_address }}<br />
      {{ $allsettings->office_email }}<br />
      {{ $allsettings->office_phone }}
      </address>
    </div>
   </div> 
   <div class="row align-items-center mt-3">
   <table class="table">
  <thead class="grey bg-light-2 text-center">
    <tr>
      <th scope="col">{{ Helper::translation(1964,$translate) }}</th>
      <th scope="col">{{ Helper::translation(2076,$translate) }}</th>
      <th scope="col">{{ Helper::translation(1984,$translate) }}</th>
      <th scope="col">{{ Helper::translation(2079,$translate) }}</th>
      <th scope="col">{{ Helper::translation(2112,$translate) }}</th>
      <th scope="col">{{ Helper::translation(2078,$translate) }}</th>
     </tr>
  </thead>
  <tbody class="text-center">
    @php $no = 1; @endphp
    @foreach($product['view'] as $product)
    <tr class="mb-5 mt-2">
      <th scope="row">{{ $no }}</th>
      <td>{{ $product->ord_id }}
      </td>
      <td>
      <a href="{{ url('/product') }}/{{ $product->product_slug }}">
      <br/>
      @if($product->product_image != '')
      <img src="{{ url('/') }}/public/storage/product/{{ $product->product_image }}"  class="img-thumb" alt="{{ $product->product_name }}"/>@else <img src="{{ url('/') }}/public/img/no-image.jpg"  class="img-thumb" alt="{{ $product->product_name }}"/>  
      @endif
      </a></td>
      <td>{{ $product->product_attribute_values }}</td>
      <td><a href="{{ url('/user') }}/{{ $product->username }}">{{ $product->name }}</a></td>
      <td>{{ $product->quantity }} X {{ $allsettings->site_currency_symbol }}{{ $product->price }}</td>
    </tr>
    @php $no++; @endphp
    @endforeach 
    <tr>
      <td colspan="5" class="bg-light-2 text-right"><strong>{{ Helper::translation(2090,$translate) }}</strong></td>
      <td class="bg-light-2">{{ $allsettings->site_currency_symbol }}{{ $purchase->shipping_price }}</td>
      </tr>
    <tr>
      <td colspan="5" class="bg-light-2 text-right"><strong>{{ Helper::translation(1993,$translate) }}</strong></td>
      <td class="bg-light-2">{{ $allsettings->site_currency_symbol }}{{ $purchase->processing_fee }}</td>
      </tr>
      <tr>
      <td colspan="5" class="bg-light-2 text-right"><strong>{{ Helper::translation(2092,$translate) }}</strong></td>
      <td class="bg-light-2">{{ $allsettings->site_currency_symbol }}{{ $purchase->subtotal }}</td>
      </tr>
       <tr>
      <td colspan="5" class="bg-light-2 text-right"><strong>{{ Helper::translation(2093,$translate) }}</strong></td>
      <td class="bg-light-2">{{ $allsettings->site_currency_symbol }}{{ $purchase->total }}</td>
      </tr>
  </tbody>
</table>
</div>
  <div class="row align-items-center">
  <div class="row align-items-center">
    <div class="col-sm-6 text-center text-sm-left"><strong>{{ Helper::translation(2080,$translate) }}</strong> {{ $payment_type }}</div>
    <div class="col-sm-6 text-right" style="float:right;"> <strong>{{ Helper::translation(2089,$translate) }}</strong> {{ $payment_token }}</div>
  </div>
  </div>
  </header>
</div>
</body>
</html>