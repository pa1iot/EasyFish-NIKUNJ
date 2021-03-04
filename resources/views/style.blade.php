@php
/**
 * Script Name - ZigKart - Multivendor Products Marketplace
 * Version - 13.1
 * Author - Codecanor
 */
@endphp
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="author" content="{{ $allsettings->site_title }}">
@if($view_name != 'product')
<meta name="description" content="{{ $allsettings->site_desc }}">
<meta name="keywords" content="{{ $allsettings->site_keywords }}">
@endif
@if($allsettings->site_favicon != '')
<link rel="apple-touch-icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
<link rel="shortcut icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
@endif
<link rel="stylesheet" href="{{ URL::to('resources/views/template/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/template/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/template/css/style.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/template/css/responsive.css') }}">
@include('dynamic')
<link href="{{ URL::to('resources/views/template/css/carousel.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ URL::to('resources/views/template/css/font-awesome.min.css') }}">
<!-- Our Custom CSS -->
<link rel="stylesheet" href="{{ URL::to('resources/views/template/menu/style3.css') }}">
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<!--- scroller -->
<link rel="stylesheet" href="{{ URL::to('resources/views/template/scroller/swiper.css') }}">
<!--- scroller -->
<!--- quick-view -->
<link rel="stylesheet" href="{{ URL::to('resources/views/template/quick-view/quick.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/template/quick-view/style.css') }}">
<!--- quick-view -->
<!--- auto search -->
<?php /*?><link rel="stylesheet" href="{{ URL::to('resources/views/template/autosearch/jquery-ui.css') }}"><?php */?>
<!--- auto search -->
<!--- brands -->
<link rel="stylesheet" type="text/css" href="{{ URL::to('resources/views/template/brands/style.css') }}">
<!--- brands -->
<!-- pagination -->
<link rel="stylesheet" href="{{ URL::to('resources/views/template/pagination/pagination.css') }}">
<!-- pagination -->
<!-- datatable -->
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
<!-- datatable -->
<!-- picker -->
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/picker/jquery-ui-timepicker-addon.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/admin/template/picker/jquery-ui.css') }}" />
<!-- picker -->
<!--- filter -->
<link rel="stylesheet" href="{{ URL::to('resources/views/template/filter/jplist.core.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/template/filter/jplist.jquery-ui-bundle.min.css') }}">
<?php /*?><link rel="stylesheet" href="{{ URL::to('resources/views/template/filter/jquery-ui.css') }}" /><?php */?>
<!--- filter -->
<!--- product slider -->
<link rel="stylesheet"  href="{{ URL::to('resources/views/template/product-carousel/css/lightslider.css') }}">
<!--- product slider -->
<!--- video popup -->
<link rel="stylesheet"  href="{{ URL::to('resources/views/template/video/YouTubePopUp.css') }}">
<!--- video popup -->
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@if($translate == 'ar')
<link rel="stylesheet" href="{{ URL::to('resources/views/template/css/rtl.css') }}" />
@endif
<!-- cookie -->
<link href="{{ URL::to('resources/views/template/cookie/cookiealert.css') }}" rel="stylesheet" type="text/css"/>
<!-- cookie -->