<style type="text/css">
#header {
    height: auto;
    position:relative;
    left: 0;
    top: 0;
    right: 0;
    transition: all 0.5s;
    z-index: 997;
    background-color: {{ $allsettings->site_theme_color }};
}
#footer
{
background-color: {{ $allsettings->site_footer_color }};
}
.copyright
{
background-color: {{ $allsettings->site_copyright_color }};
}
.product-grid2 .add-to-cart:hover{background-color:{{ $allsettings->site_button_color }};text-decoration:none}
.product-grid2 .social li a:hover{color:#fff;background-color:{{ $allsettings->site_button_color }};box-shadow:0 0 10px rgba(0,0,0,.5)}
.product-grid2 .title a:hover{color:{{ $allsettings->site_button_color }};}
.theme-color
{
color:{{ $allsettings->site_button_color }};
text-decoration:none;
}
.fa-star,.fa-star-o
{
color:{{ $allsettings->site_button_color }};
}
.custom-radio .custom-control-input:checked~.custom-control-label:before
{
background-color:{{ $allsettings->site_button_color }};
}
.cart-badge {
    background-color: {{ $allsettings->site_button_color }};
    border-radius: 10px;
    color: #000;
    display: inline-block;
    font-size: 12px;
    line-height: 1;
    padding: 3px 7px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}
#myTab a
{
color:#000;
}
#navbarSupportedContent .nav-item a:hover
{
color: {{ $allsettings->site_button_color }};
}
.page-item.active .page-link
{
background-color: {{ $allsettings->site_button_color }};
border-color: {{ $allsettings->site_button_color }};
}
.tag-btn
{
background-color: {{ $allsettings->site_button_color }};
color:#000;
padding:4px;
border-radius:4px;
text-decoration:none;
}
.tag-btn:hover
{
color:#000;
text-decoration:none;
}
.tab-card-header > .nav-tabs > li > a.show {
    border-bottom:2px solid {{ $allsettings->site_button_color }};
    color: {{ $allsettings->site_button_color }};
}
.tab-card-header > .nav-tabs > li > a:hover {
    color: {{ $allsettings->site_button_color }};
}
.page-link
{
color:{{ $allsettings->site_theme_color }};
}
.turn-ul li.on
{
background-color: {{ $allsettings->site_button_color }} !important;
color:#ffffff !important;
}
.theme-color:hover
{
color:{{ $allsettings->site_theme_color }};
text-decoration:none;
}
.login-btn
{
background:{{ $allsettings->site_button_color }};
color:{{ $allsettings->site_theme_color }} !important;
padding:2px 8px 2px 8px !important;
}
.login-btn:hover,.login-btn:active
{
color:#ffffff !important;
}
.link-color
{
color:{{ $allsettings->site_theme_color }};
}
.categorylist a:hover
{
color:{{ $allsettings->site_button_color }};
text-decoration:none;
}
.headerbg a,.blog-icon-view a
{
color:{{ $allsettings->site_button_color }};
text-decoration:none;
}
.link-color:hover
{
text-decoration:none;
color:{{ $allsettings->site_copyright_color }};
}
.post-date-day
{
background:{{ $allsettings->site_button_color }};
color:#fff;
padding:10px;
}
#countdown-timer li
{
background:{{ $allsettings->site_button_color }};
color:#FFFFFF;
min-width:40px;
opacity:0.9;
padding:2px;
border-radius:4px;
}
.image-hover {
  background: -webkit-linear-gradient(45deg, {{ $allsettings->site_theme_color }} 0, {{ $allsettings->site_button_color }} 100%);
  background: linear-gradient(45deg, {{ $allsettings->site_theme_color }} 0, {{ $allsettings->site_button_color }} 100%);
  position: relative;
  width: 100%;
  height: 100%;
  overflow: hidden;
}
.footer-box-info ul li a
{
margin-left:5px;
margin-right:5px;
color:#000000 !important;
background:{{ $allsettings->site_button_color }};
padding:5px;
border-radius:4px;
-webkit-border-radius:4px;
}
#sidebar {
    width: 250px;
    position: fixed;
    top: 0;
    left: -250px;
    height: 100vh;
    z-index: 999;
    background: {{ $allsettings->site_theme_color }};
    color: #fff;
    transition: all 0.3s;
    overflow-y: scroll;
    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
}
#sidebar .sidebar-header {
    padding: 20px;
    background: {{ $allsettings->site_button_color }};
}
#dismiss {
    width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    background: {{ $allsettings->site_button_hover }};
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}
#dismiss:hover {
    background: #fff;
    color: #000;
}
#LoginForm{ background: {{ $allsettings->site_theme_color }}; }
#sidebar ul li.active>a,
a[aria-expanded="true"] {
    color: #fff;
    background: {{ $allsettings->site_copyright_color }};
}
#sidebar ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: {{ $allsettings->site_copyright_color }};
	color:#fff;
}
#sidebar ul ul a:hover,#sidebar a
{
text-decoration:none;
}
#sidebar a
{
color:#FFFFFF;
}
#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 0px solid {{ $allsettings->site_button_color }};
}
#sidebar ul li a:hover {
    color: #000;
    background: #fff;
}
#mobile-nav ul .menu-item-active {
    color: {{ $allsettings->site_button_color }};
}
.header-scrolled .nav-menu li:hover > a, .header-scrolled .nav-menu > .menu-active > a {
    color: {{ $allsettings->site_button_color }};
}
.nav-menu li:hover > a, .nav-menu > .menu-active > a {
    color: {{ $allsettings->site_button_color }};
}
#mobile-nav ul .menu-has-children i.fa-chevron-up {
    color: {{ $allsettings->site_button_color }};
}
.review-user
{
color:{{ $allsettings->site_button_color }};
text-decoration:none;
}
.review-user:hover
{
color:{{ $allsettings->site_button_color }};
}
.button-color
{
background-color: {{ $allsettings->site_button_color }};
border-color:{{ $allsettings->site_button_color }};
color:#000;
}
.button-color:hover
{
background-color: {{ $allsettings->site_button_hover }};
border-color:{{ $allsettings->site_button_hover }};
color:#fff;
}
.button-color:focus
{
outline-style:none;
box-shadow:none;
outline: none;
border-color:transparent;
background-color: {{ $allsettings->site_button_hover }};
border-color:{{ $allsettings->site_button_hover }};
color:#fff;
}
.lato{}.jplist-panel .jplist-pagination{cursor:pointer;float:right;line-height:30px}
.jplist-panel .jplist-pagination button{list-style: none;
    float: left;
    width: 38px;
    height: 36px;
    line-height: 36px;
    text-align: center;
    border: 1px solid #54667a;
    margin-left: -1px;
    cursor: pointer;
    background: #fff;}
	.jplist-label { 
    height: 36px !important;
    line-height: 38px !important;
	border: 1px solid #54667a !important;
    margin-left: -1px;
    cursor: pointer !important;
    background: #fff !important;
	border-radius:0px !important;
	}
.jplist-panel button { border-radius:0px !important; box-shadow:0px !important; text-shadow:none !important; margin:10px 5px 0 0 !important; }	
.jplist-panel .jplist-pagination .jplist-current{color: #fff; background:{{ $allsettings->site_button_color }} !important;}
.jplist-panel .jplist-pagination .jplist-pagingprev,.jplist-panel .jplist-pagination .jplist-pagingmid,.jplist-panel .jplist-pagination .jplist-pagingnext{float:left}.jplist-panel .jplist-pagination .jplist-pagingprev button,.jplist-panel .jplist-pagination .jplist-pagingnext button{font-size:20px;}.jplist-one-page{display:none}.jplist-empty{display:none}
.customlable
{
float:right !important;
}
.red-color
{
color:#FF0000;
}
.offer-price
{
text-decoration:line-through;
}
.cart-page h4 a
{
font-size:16px;
color: {{ $allsettings->site_button_color }};
text-decoration:none;
}
.track {
     position: relative;
     background-color: #ddd;
     height: 7px;
     display: -webkit-box;
     display: -ms-flexbox;
     display: flex;
     margin-bottom: 60px;
     margin-top: 50px
}
.track .step {
     -webkit-box-flex: 1;
     -ms-flex-positive: 1;
     flex-grow: 1;
     width: 25%;
     margin-top: -18px;
     text-align: center;
     position: relative
}
.track .step.active:before {
     background: {{ $allsettings->site_button_color }};
}
.track .step::before {
     height: 7px;
     position: absolute;
     content: "";
     width: 100%;
     left: 0;
     top: 18px
}
.track .step.active .icon {
     background: {{ $allsettings->site_button_color }};
     color: #fff
}
.track .icon {
     display: inline-block;
     width: 40px;
     height: 40px;
     line-height: 40px;
     position: relative;
     border-radius: 100%;
     background: #ddd
}
.track .step.active .text {
     font-weight: 400;
     color: #000
}
.track .text {
     display: block;
     margin-top: 7px
}
</style>
@if($allsettings->site_custom_style != "")
<style type="text/css">
{{ $allsettings->site_custom_style }}
</style>
@endif