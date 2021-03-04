@if($allsettings->maintenance_mode == 0)
<!DOCTYPE html>
<html lang="en">
<head>
<title>@if(Auth::user()->user_type == 'vendor'){{ Helper::translation(1911,$translate) }}@else{{ Helper::translation(1912,$translate) }}@endif  - {{ $allsettings->site_title }}</title>
@include('style')
</head>
<body>
@include('header')
@if(Auth::user()->user_type == 'vendor')
    <section class="headerbg" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_header_background }}');">
      <div class="container text-left">
        <h2 class="mb-0">{{ Helper::translation(1911,$translate) }}</h2>
        <p class="mb-0"><a href="{{ URL::to('/') }}">{{ Helper::translation(1913,$translate) }}</a> <span class="split">&gt;</span> <span>{{ Helper::translation(1911,$translate) }}</span></p>
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
             <form action="{{ route('add-attribute-type') }}" class="setting_form" id="contact_form" method="post" enctype="multipart/form-data">
             {{ csrf_field() }}
              <div class="card mt-3 tab-card">
        <div class="card-header tab-card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            @php $j = 1; @endphp
            @foreach($language_page['data'] as $language)
            <li class="nav-item">
                <a class="nav-link @if($j == 1) active show @endif"  data-toggle="tab" href="#{{ $language->language_name }}" role="tab"  aria-selected="true">{{ $language->language_name }}</a>
            </li>
            @php $j++; @endphp
            @endforeach
          </ul>
        </div>

        <div class="tab-content" id="myTabContent">
          @php $i = 1; @endphp
          @foreach($languages_page['data'] as $language)
          <div class="tab-pane fade @if($i == 1) show active @endif mt-4" id="{{ $language->language_name }}" role="tabpanel">
            <div class="form-group row">
               <div class="col-sm-12">
                        <label for="name">{{ Helper::translation(1914,$translate) }}<span class="required">*</span></label>
                        <input id="attribute_name" name="attribute_name[]" type="text" class="form-control" data-bvalidator="required">
                    </div>
            </div>               
          </div>
          <input type="hidden" name="language_code[]" value="{{ $language->language_code }}">
          @php $i++; @endphp
          @endforeach

        </div>
      </div>
              
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputContactNumber">Slug<span class="required">*</span></label>
                        <input id="attribute_slug" name="attribute_slug" type="text" class="form-control" data-bvalidator="required">
                    </div>
                    <div class="col-sm-6">
                        <label for="username">{{ Helper::translation(1915,$translate) }}<span class="required">*</span></label>
                        <select name="attribute_status" class="form-control" data-bvalidator="required">
                         <option value=""></option>
                         <option value="1">{{ Helper::translation(1916,$translate) }}</option>
                         <option value="0">{{ Helper::translation(1917,$translate) }}</option>
                         </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputContactNumber">{{ Helper::translation(1918,$translate) }}</label>
                        <input id="attribute_order" name="attribute_order" type="text" class="form-control">
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="token" value="{{ uniqid() }}">
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