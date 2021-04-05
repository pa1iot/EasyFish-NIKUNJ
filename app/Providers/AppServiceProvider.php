<?php

namespace ZigKart\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use ZigKart\Models\Members;
use ZigKart\Models\Settings;
use ZigKart\Models\Category;
use ZigKart\Models\Pages;
use ZigKart\Models\Product;
use ZigKart\Models\Comment;
use ZigKart\Models\SubCategory;
use ZigKart\Models\Languages;
use ZigKart\Models\Attribute;
use Illuminate\Support\Facades\View;
use Auth;
use Illuminate\Support\Facades\Config;
use Route;
use Request;
use Cookie;
use Illuminate\Support\Facades\Crypt;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            \URL::forceScheme('http');
        }

        Schema::defaultStringLength(191);
		$admin = Members::adminData();
		View::share('admin', $admin);

		$allsettings = Settings::allSettings();
		View::share('allsettings', $allsettings);

		$allcountry = Settings::allCountry();
		View::share('allcountry', $allcountry);

		$languages['view'] = Languages::allLanguage();
		View::share('languages', $languages);

		$alllang['data'] = Languages::allLanguage();
		View::share('alllang', $alllang);

		$demo_mode = 'off'; // on
		View::share('demo_mode', $demo_mode);

		$encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
		View::share('encrypter', $encrypter);

		if(!empty(Cookie::get('translate')))
		{
		$translate = Cookie::get('translate');
		   $lang_title['view'] = Languages::getLanguage($translate);
		   $language_title = $lang_title['view']->language_name;
		}
		else
		{
		  $default_count = Languages::defaultLanguageCount();
		  if($default_count == 0)
		  {
		  $translate = "en";
		  $lang_title['view'] = Languages::getLanguage($translate);
		   $language_title = $lang_title['view']->language_name;
		  }
		  else
		  {
		  $default['lang'] = Languages::defaultLanguage();
		  $translate =  $default['lang']->language_code;
		  $lang_title['view'] = Languages::getLanguage($translate);
		   $language_title = $lang_title['view']->language_name;
		  }

		}
		View::share('translate', $translate);
		View::share('language_title', $language_title);


		$mainmenu['pages'] = Pages::mainmenuData($translate);
		View::share('mainmenu', $mainmenu);


		$footerpages['pages'] = Pages::footermenuData($translate);
		View::share('footerpages', $footerpages);

		$permission = array('dashboard' => 'Dashboard', 'settings' => 'Settings', 'block-section' => 'Block Section', 'country' => 'Country', 'manage-categories' => 'Manage Categories', 'products' => 'Products', 'blog' => 'Blog', 'ads' => 'Ads', 'pages' => 'Pages', 'slideshow' => 'Slideshow', 'contact' => 'Contact', 'newsletter' => 'Newsletter', 'languages' => 'Languages');
		View::share('permission', $permission);



		view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);

			if (Auth::check())
			{
			   $user['avilable'] = Members::logindataUser(Auth::user()->id);
			   $avilable = explode(',',$user['avilable']->user_permission);
			   $user_id = Auth::user()->id;
	           $cart_count = Product::cartCount($user_id);
			}
			else
			{
			  $avilable = "";
			  $cart_count = 0;
			}
			view()->share('avilable', $avilable);
			view()->share('cart_count', $cart_count);

        });

		if($allsettings->stripe_mode == 0)
		{
		$stripe_publish_key = $allsettings->test_publish_key;
		$stripe_secret_key = $allsettings->test_secret_key;

		}
		else
		{
		$stripe_publish_key = $allsettings->live_publish_key;
		$stripe_secret_key = $allsettings->live_secret_key;
		}
		View::share('stripe_publish_key', $stripe_publish_key);
		View::share('stripe_secret_key', $stripe_secret_key);

		$product_type = array("physical","digital","external");
		View::share('product_type', $product_type);

		$payment_status_vendor = "payment released to vendor";
		View::share('payment_status_vendor', $payment_status_vendor);

		$track_placed = "Placed";
		$track_packed = "Packed";
		$track_shipped = "Shipped";
		$track_delivered = "Delivered";
		View::share('track_placed', $track_placed);
		View::share('track_packed', $track_packed);
		View::share('track_shipped', $track_shipped);
		View::share('track_delivered', $track_delivered);

		$payment_status_buyer = "payment released to buyer";
		View::share('payment_status_buyer', $payment_status_buyer);

		$categorybox['view'] = Category::recentcategoryData($allsettings->site_home_category,$translate);
		View::share('categorybox', $categorybox);

		$categories['display'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->where('language_code','=',$translate)->orderBy('display_order','asc')->get();
		View::share('categories', $categories);

		$attribute['display'] = Attribute::with('AttributeValue')->where('attribute_status','=','1')->where('attribute_drop_status','=','no')->orderBy('attribute_order','asc')->get();
		View::share('attribute', $attribute);

		$attribute_product['display'] = Attribute::with('AttributeValue')->where('attribute_status','=','1')->where('attribute_drop_status','=','no')->where('attribute_page_parent','=',0)->orderBy('attribute_order','asc')->get();
		View::share('attribute_product', $attribute_product);

		$deal_limit = $allsettings->site_home_deal;
	   $deal_display =  $allsettings->site_deal_order;
		$today_date = date('Y-m-d h:i a');
		$deal['product'] = Product::with('ProductImages')->where('flash_deal_start_date','<=',$today_date)->where('flash_deal_end_date','>=',$today_date)->where('flash_deals','=',1)->where('product_status','=',1)->where('product_drop_status','=','no')->take($deal_limit)->orderBy('product_id',$deal_display)->get();
		View::share('deal', $deal);

		Config::set('mail.driver', $allsettings->mail_driver);
		Config::set('mail.host', $allsettings->mail_host);
		Config::set('mail.port', $allsettings->mail_port);
		Config::set('mail.username', $allsettings->mail_username);
		Config::set('mail.password', $allsettings->mail_password);
		Config::set('mail.encryption', $allsettings->mail_encryption);

		Config::set('filesystems.disks.s3.key', $allsettings->aws_access_key_id);
		Config::set('filesystems.disks.s3.secret', $allsettings->aws_secret_access_key);
		Config::set('filesystems.disks.s3.region', $allsettings->aws_default_region);
		Config::set('filesystems.disks.s3.bucket', $allsettings->aws_bucket);

		Config::set('services.facebook.client_id', $allsettings->facebook_client_id);
		Config::set('services.facebook.client_secret', $allsettings->facebook_client_secret);
		Config::set('services.facebook.redirect', $allsettings->facebook_callback_url);
		Config::set('services.google.client_id', $allsettings->google_client_id);
		Config::set('services.google.client_secret', $allsettings->google_client_secret);
		Config::set('services.google.redirect', $allsettings->google_callback_url);


		Config::set('paystack.publicKey', $allsettings->paystack_public_key);
		Config::set('paystack.secretKey', $allsettings->paystack_secret_key);
		Config::set('paystack.merchantEmail', $allsettings->paystack_merchant_email);
		Config::set('paystack.paymentUrl', 'https://api.paystack.co');


		Config::set('paypal.mode', $allsettings->paypal_mode);
		Config::set('paypal.currency', $allsettings->site_currency_code);

		Config::set('paypal.sandbox.username', $allsettings->paypal_api_username);
		Config::set('paypal.sandbox.password', $allsettings->paypal_api_password);
		Config::set('paypal.sandbox.secret', $allsettings->paypal_api_secret);
		Config::set('paypal.sandbox.app_id', $allsettings->paypal_email);
		Config::set('paypal.sandbox.certificate', '');

		Config::set('paypal.live.username', $allsettings->paypal_api_username);
		Config::set('paypal.live.password', $allsettings->paypal_api_password);
		Config::set('paypal.live.secret', $allsettings->paypal_api_secret);
		Config::set('paypal.live.app_id', $allsettings->paypal_email);
		Config::set('paypal.live.certificate', '');

    }
}
