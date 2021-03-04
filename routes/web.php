<?php


Route::group(['middleware' => ['XSS','web']], function () {

/* language */
//Artisan::call('up');
Route::get('/translate/{translate}', 'CommonController@cookie_translate');

/* language */
//Artisan::call('up');


Route::get('/', 'CommonController@view_index');
Route::get('/index', 'CommonController@view_index');
Route::post('/index', ['as' => 'index','uses'=>'CommonController@update_video']);
Route::get('/download/{url}/{title}/{mime}/{ext}/{size}', 'CommonController@view_download');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('searchajax',array('as'=>'searchajax','uses'=>'CommonController@autoComplete'));
Auth::routes();

Route::get('/logout', 'Admin\CommonController@logout');


/*Route::get('/mollie-payment','MollieController@preparePayment')->name('mollie.payment');
Route::get('/payment-success/{purchase_token}','MollieController@paymentSuccess')->name('payment.success');*/

Route::get('/mollie-payment','MollieController@preparePayment')->name('mollie.payment');
Route::get('/payment-success/{purchase_token}','MollieController@paymentSuccess')->name('payment-success');

/* email verification */

Route::get('/user-verify/{user_token}', 'CommonController@user_verify');

/* email verification */




/* my profile */
Route::get('/my-profile', 'ProfileController@view_myprofile');
Route::post('/my-profile', ['as' => 'my-profile','uses'=>'ProfileController@update_myprofile']);
/* my profile */

/* my product */
Route::get('/my-product', 'ProductController@view_products');
Route::get('/add-product', 'ProductController@add_product')->name('admin.add-product');
Route::post('/add-product', ['as' => 'add-product','uses'=>'ProductController@save_product']);
Route::get('/my-product/{product_token}', 'ProductController@delete_product');
Route::get('/edit-product/{dropimg}/{img_id}', 'ProductController@delete_single_image');
Route::get('/edit-product/{product_token}', 'ProductController@edit_product')->name('edit_product');
Route::post('/edit-product', ['as' => 'edit-product','uses'=>'ProductController@update_product']);
/* my product */


/* attribute type */
	
Route::get('/attribute-type', 'AttributeController@attribute_type');
Route::get('/add-attribute-type', 'AttributeController@add_attribute_type')->name('add-attribute-type');
Route::post('/add-attribute-type', 'AttributeController@save_attribute_type');
Route::get('/attribute-type/{attribute_id}', 'AttributeController@delete_attribute');
Route::get('/edit-attribute-type/{attribute_id}', 'AttributeController@edit_attribute_type')->name('edit-attribute-type');
Route::post('/edit-attribute-type', ['as' => 'edit-attribute-type','uses'=>'AttributeController@update_attribute_type']);
	
/* attribute type */


/* attribute value */
	
Route::get('/attribute-value', 'AttributeController@attribute_value');
Route::get('/add-attribute-value', 'AttributeController@add_attribute_value')->name('add-attribute-value');
Route::post('/add-attribute-value', 'AttributeController@save_attribute_value');
Route::get('/attribute-value/{attribute_value_id}', 'AttributeController@delete_attribute_value');
Route::get('/edit-attribute-value/{attribute_value_id}', 'AttributeController@edit_attribute_value')->name('edit-attribute-value');
Route::post('/edit-attribute-value', ['as' => 'edit-attribute-value','uses'=>'AttributeController@update_attribute_value']);
	
/* attribute value */


/* coupon */
Route::get('/my-coupon', 'CouponController@view_coupon');
Route::get('/add-coupon', 'CouponController@add_coupon')->name('add-coupon');
Route::post('/add-coupon', 'CouponController@save_coupon');
Route::get('/my-coupon/{coupon_id}', 'CouponController@delete_coupon');
Route::get('/edit-coupon/{coupon_id}', 'CouponController@edit_coupon')->name('edit-coupon');
Route::post('/edit-coupon', ['as' => 'edit-coupon','uses'=>'CouponController@update_coupon']);
/* coupon */

/* blog */
Route::get('/blog', 'BlogController@view_blog');
Route::get('/single/{slug}', 'BlogController@view_single');
Route::get('/blog/{category}/{id}/{slug}', 'BlogController@view_category_blog');
Route::post('/single', ['as' => 'single','uses'=>'BlogController@insert_comment']);
Route::get('/blog/{blog}/{slug}', 'BlogController@view_tags');
/* blog */


/* product import & export */
Route::get('/products-import-export', 'ImportExportController@view_products_import_export');
Route::post('/products-import-export', ['as' => 'products-import-export','uses'=>'ImportExportController@products_import']);
Route::get('/products-import-export/{type}', 'ImportExportController@download_products_export');
/* product import & export */


/* shop */
Route::get('/shop', 'CommonController@view_shop');
Route::post('/shop', ['as' => 'shop','uses'=>'CommonController@search_shop']);
Route::get('/product/{slug}', 'CommonController@view_product');
Route::post('/cart', ['as' => 'cart','uses'=>'ProductController@view_cart']);
Route::get('/shop/{type}/{slug}', 'CommonController@view_category_shop');
Route::get('/shop/{tag}', 'CommonController@view_tag_shop');
Route::get('/wishlist/{user_id}/{token}', 'ProductController@view_wishlist');
Route::get('/wishlist', 'ProductController@show_wishlist');
Route::get('/wishlist/{id}', 'ProductController@remove_wishlist');
Route::get('/cart', 'ProductController@show_cart');
Route::get('/cart/{id}', 'ProductController@delete_cart');
Route::get('/cart/{remove}/{coupon}', 'ProductController@remove_coupon');
Route::post('/coupon', ['as' => 'coupon','uses'=>'ProductController@view_coupon']);
Route::get('/checkout', 'ProductController@view_checkout');
Route::post('/checkout', ['as' => 'checkout','uses'=>'ProductController@update_checkout']);
Route::post('/confirm-paypal', ['as' => 'confirm-paypal','uses'=>'ProductController@confirm_paypal']);
Route::post('/2checkout', ['as' => '2checkout','uses'=>'ProductController@confirm_2checkout']);
Route::post('/charge', ['as' => 'charge','uses'=>'ProductController@charge']);
Route::post('/paystack', ['as' => 'paystack','uses'=>'ProductController@redirectToGateway']);
Route::post('/confirm-paystack', ['as' => 'confirm-paystack','uses'=>'ProductController@confirm_paystack']);
Route::get('/paystack', 'ProductController@handleGatewayCallback');
Route::post('/confirm-bank', ['as' => 'confirm-bank','uses'=>'ProductController@confirm_bank']);
Route::post('/confirm-cod', ['as' => 'confirm-cod','uses'=>'ProductController@confirm_cod']);
/* shop */

/* razorpay */
Route::post('/confirm-razorpay', ['as' => 'confirm-razorpay','uses'=>'ProductController@confirm_razorpay']);
Route::post('/razorpay', ['as' => 'razorpay','uses'=>'ProductController@razorpay_payment']);
/* razorpay */

/* user */
Route::get('/user/{slug}', 'CommonController@view_user');
Route::post('/user', ['as' => 'user','uses'=>'CommonController@send_message']);
/* user */

/* top menu */
Route::get('/top-deals', 'CommonController@view_top_deals');
Route::get('/new-releases', 'CommonController@view_new_releases');
Route::get('/best-sellers', 'CommonController@view_best_sellers');
Route::get('/featured-products', 'CommonController@view_featured_products');
Route::get('/start-sellings', 'CommonController@view_start_sellings');
Route::get('/track-order', 'CommonController@view_track_order');
Route::post('/track-order', ['as' => 'track-order','uses'=>'CommonController@get_track_order']);
/* top menu */


/* purchase & orders */
Route::get('/my-purchase', 'ProductController@view_purchase_details');
Route::get('/my-purchase-details/{token}', 'ProductController@purchase_full_details');
Route::get('/invoice/{token}', 'ProductController@invoice_download');
Route::post('/refund-request', ['as' => 'refund-request','uses'=>'ProductController@refund_request']);
Route::post('/rating', ['as' => 'rating','uses'=>'ProductController@rating_request']);
Route::get('/my-orders', 'ProductController@view_orders_details');
Route::get('/my-orders-details/{ord_id}/{token}', 'ProductController@single_orders_details');
Route::post('/order-track', ['as' => 'order-track','uses'=>'ProductController@order_track']);

Route::get('/conversation-to-vendor/{to_slug}/{order_id}', 'ProductController@view_conversation');
Route::post('/conversation', ['as' => 'conversation','uses'=>'ProductController@conversation_message']);
Route::get('/conversation/{id}', 'ProductController@delete_conversation');

Route::get('/conversation-to-buyer/{to_slug}/{order_id}', 'ProductController@view_buyer_conversation');
/* purchase & orders */


/* wallet */
Route::get('/my-wallet', 'ProfileController@view_withdrawal_request');
Route::post('/my-wallet', ['as' => 'my-wallet','uses'=>'ProfileController@withdrawal_request']);
/* wallet */


/* forgot */

Route::get('/forgot', 'CommonController@view_forgot');
Route::post('/forgot', ['as' => 'forgot','uses'=>'CommonController@update_forgot']);
Route::get('/reset/{user_token}', 'CommonController@view_reset');
Route::post('/reset', ['as' => 'reset','uses'=>'CommonController@update_reset']);

/* forgot */


/* pages */

Route::get('/page/{page_slug}', 'PageController@view_page');

/* pages */


/* success */
Route::get('/success/{order_token}', 'PaymentController@paypal_success');
Route::get('/cancel', 'PaymentController@payment_cancel');
Route::post('/stripe-success', ['as'=>'stripe-success','uses'=>'StripeController@stripe_success']);


Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');
/* success */


/* contact */

Route::get('/contact', 'CommonController@view_contact');
Route::post('/contact', ['as' => 'contact','uses'=>'CommonController@update_contact']);
/* contact */


/* newsletter */
Route::post('/newsletter', ['as' => 'newsletter','uses'=>'CommonController@update_newsletter']);
Route::get('/newsletter/{token}', 'CommonController@activate_newsletter');
Route::get('/newsletter', 'CommonController@view_newsletter');
/* newsletter */




});


/* admin panel */


    Route::group(['middleware' => ['is_admin', 'XSS']], function () {
    Route::get('/admin', 'Admin\AdminController@admin');
	
	/* administrator */
	Route::get('/admin/administrator', 'Admin\MembersController@administrator');
	Route::get('/admin/add-administrator', 'Admin\MembersController@add_administrator')->name('admin.add-administrator');
	Route::post('/admin/add-administrator', 'Admin\MembersController@save_administrator');
	Route::get('/admin/administrator/{token}', 'Admin\MembersController@delete_administrator');
	Route::get('/admin/edit-administrator/{token}', 'Admin\MembersController@edit_administrator')->name('admin.edit-administrator');
	Route::post('/admin/edit-administrator', ['as' => 'admin.edit-administrator','uses'=>'Admin\MembersController@update_administrator']);
	/* administrator */
	
	/* customer */
	Route::get('/admin/customer', 'Admin\MembersController@customer');
	Route::get('/admin/add-customer', 'Admin\MembersController@add_customer')->name('admin.add-customer');
	Route::post('/admin/add-customer', 'Admin\MembersController@save_customer');
	Route::get('/admin/customer/{token}', 'Admin\MembersController@delete_customer');
	Route::get('/admin/edit-customer/{token}', 'Admin\MembersController@edit_customer')->name('admin.edit-customer');
	Route::post('/admin/edit-customer', ['as' => 'admin.edit-customer','uses'=>'Admin\MembersController@update_customer']);
	/* customer */
	
	
	/* vendor */
	Route::get('/admin/vendor', 'Admin\MembersController@vendor');
	Route::get('/admin/add-vendor', 'Admin\MembersController@add_vendor')->name('admin.add-vendor');
	Route::post('/admin/add-vendor', 'Admin\MembersController@save_customer');
	Route::get('/admin/vendor/{token}', 'Admin\MembersController@delete_customer');
	Route::get('/admin/edit-vendor/{token}', 'Admin\MembersController@edit_vendor')->name('admin.edit_vendor');
	Route::post('/admin/edit-vendor', ['as' => 'admin.edit-vendor','uses'=>'Admin\MembersController@update_customer']);
	/* vendor */
	
	
	/* country */
	Route::get('/admin/country-settings', 'Admin\SettingsController@country_settings');
	Route::get('/admin/add-country', 'Admin\SettingsController@add_country')->name('admin.add-country');
	Route::post('/admin/add-country', 'Admin\SettingsController@save_country');
	Route::get('/admin/country-settings/{cid}', 'Admin\SettingsController@delete_country');
	Route::get('/admin/edit-country/{cid}', 'Admin\SettingsController@edit_country')->name('admin.edit-country');
	Route::post('/admin/edit-country', ['as' => 'admin.edit-country','uses'=>'Admin\SettingsController@update_country']);
    /* country */

		
	/* edit profile */
	
	Route::get('/admin/edit-profile', 'Admin\MembersController@edit_profile');
	Route::post('/admin/edit-profile', ['as' => 'admin.edit-profile','uses'=>'Admin\MembersController@update_profile']);
	/* edit profile */
	
	
	/* general settings */
	
	Route::get('/admin/general-settings', 'Admin\SettingsController@general_settings');
	Route::post('/admin/general-settings', ['as' => 'admin.general-settings','uses'=>'Admin\SettingsController@update_general_settings']);
		
	/* general settings */
	
	
	/* media settings */
	
	Route::get('/admin/media-settings', 'Admin\SettingsController@media_settings');
	Route::post('/admin/media-settings', ['as' => 'admin.media-settings','uses'=>'Admin\SettingsController@update_media_settings']);
		
	/* media settings */
	
	
	/* email settings */
	
	Route::get('/admin/email-settings', 'Admin\SettingsController@email_settings');
	Route::post('/admin/email-settings', ['as' => 'admin.email-settings','uses'=>'Admin\SettingsController@update_email_settings']);
	
	/* email settings */
	
	/* currency settings */
	Route::get('/admin/currency-settings', 'Admin\SettingsController@currency_settings');
	Route::post('/admin/currency-settings', ['as' => 'admin.currency-settings','uses'=>'Admin\SettingsController@update_currency_settings']);
	/* currency settings */
	
	
	/* preferred settings */
	Route::get('/admin/preferred-settings', 'Admin\SettingsController@preferred_settings');
	Route::post('/admin/preferred-settings', ['as' => 'admin.preferred-settings','uses'=>'Admin\SettingsController@update_preferred_settings']);
	/* preferred settings */
	
	
	
	
	/* social settings */
	
	Route::get('/admin/social-settings', 'Admin\SettingsController@social_settings');
	Route::post('/admin/social-settings', ['as' => 'admin.social-settings','uses'=>'Admin\SettingsController@update_social_settings']);
	
	/* social settings */
	
	
	/* color settings */
	
	Route::get('/admin/color-settings', 'Admin\SettingsController@color_settings');
	Route::post('/admin/color-settings', ['as' => 'admin.color-settings','uses'=>'Admin\SettingsController@update_color_settings']);
	
	/* color settings */
	
	
	
	/* payment settings */
	
	Route::get('/admin/payment-settings', 'Admin\SettingsController@payment_settings');
	Route::post('/admin/payment-settings', ['as' => 'admin.payment-settings','uses'=>'Admin\SettingsController@update_payment_settings']);
	
	/* payment settings */
	
	
	
	
	/* footer section layout */
	
	Route::get('/admin/footer-section', 'Admin\SettingsController@footer_section');
	Route::post('/admin/footer-section', ['as' => 'admin.footer-section','uses'=>'Admin\SettingsController@update_footer_section']);
	
	/* footer section  layout */
	
	
	/* ads section */
	
	Route::get('/admin/ads', 'Admin\SettingsController@ads_section');
	Route::post('/admin/ads', ['as' => 'admin.ads','uses'=>'Admin\SettingsController@update_ads_section']);
	
	/* ads section */
	
	
	/* homepage section */
	
	Route::get('/admin/home-section', 'Admin\SettingsController@home_section');
	Route::post('/admin/home-section', ['as' => 'admin.home-section','uses'=>'Admin\SettingsController@update_home_section']);
	
	/* homepage section */
	
	
	/* demo mode */
	Route::post('/admin/demo-mode', ['as' => 'admin.demo-mode','uses'=>'Admin\SettingsController@update_demo_mode']);
	Route::get('/admin/demo-mode', 'Admin\SettingsController@demo_mode');
	/* demo mode */
	
	
	
	/* category */
	
	Route::get('/admin/category', 'Admin\CategoryController@category');
	Route::get('/admin/add-category', 'Admin\CategoryController@add_category')->name('admin.add-category');
	Route::post('/admin/add-category', 'Admin\CategoryController@save_category');
	Route::get('/admin/category/{cat_id}', 'Admin\CategoryController@delete_category');
	Route::get('/admin/edit-category/{cat_id}', 'Admin\CategoryController@edit_category')->name('admin.edit-category');
	Route::post('/admin/edit-category', ['as' => 'admin.edit-category','uses'=>'Admin\CategoryController@update_category']);
	/* category */
	
	
	/* subcategory */
	Route::get('/admin/sub-category', 'Admin\CategoryController@subcategory');
	Route::get('/admin/add-subcategory', 'Admin\CategoryController@add_subcategory')->name('admin.add-subcategory');
	Route::post('/admin/add-subcategory', 'Admin\CategoryController@save_subcategory');
	Route::get('/admin/sub-category/{subcat_id}', 'Admin\CategoryController@delete_subcategory');
	Route::get('/admin/edit-subcategory/{cat_id}', 'Admin\CategoryController@edit_subcategory')->name('admin.edit-subcategory');
	Route::post('/admin/edit-subcategory', ['as' => 'admin.edit-subcategory','uses'=>'Admin\CategoryController@update_subcategory']);
	/* subcategory */
	
	
	
	/* brands */
	
	Route::get('/admin/brands', 'Admin\ProductController@view_brands');
	Route::get('/admin/add-brand', 'Admin\ProductController@add_brand')->name('admin.add-brand');
	Route::post('/admin/add-brand', 'Admin\ProductController@save_brand');
	Route::get('/admin/brands/{brand_id}', 'Admin\ProductController@delete_brand');
	Route::get('/admin/edit-brand/{brand_id}', 'Admin\ProductController@edit_brand')->name('admin.edit-brand');
	Route::post('/admin/edit-brand', ['as' => 'admin.edit-brand','uses'=>'Admin\ProductController@update_brand']);
	
	/* brands */
	
	
	/* coupon */
	Route::get('/admin/coupons', 'Admin\CouponController@view_coupon');
	Route::get('/admin/add-coupon', 'Admin\CouponController@add_coupon')->name('admin.add-coupon');
	Route::post('/admin/add-coupon', 'Admin\CouponController@save_coupon');
	Route::get('/admin/coupons/{coupon_id}', 'Admin\CouponController@delete_coupon');
	Route::get('/admin/edit-coupon/{coupon_id}', 'Admin\CouponController@edit_coupon')->name('admin.edit-coupon');
	Route::post('/admin/edit-coupon', ['as' => 'admin.edit-coupon','uses'=>'Admin\CouponController@update_coupon']);
	/* coupon */
	
	
	/* attribute type */
	
	Route::get('/admin/attribute-type', 'Admin\AttributeController@attribute_type');
	Route::get('/admin/add-attribute-type', 'Admin\AttributeController@add_attribute_type')->name('admin.add-attribute-type');
	Route::post('/admin/add-attribute-type', 'Admin\AttributeController@save_attribute_type');
	Route::get('/admin/attribute-type/{attribute_id}', 'Admin\AttributeController@delete_attribute');
	Route::get('/admin/edit-attribute-type/{attribute_id}', 'Admin\AttributeController@edit_attribute_type')->name('admin.edit-attribute-type');
	Route::post('/admin/edit-attribute-type', ['as' => 'admin.edit-attribute-type','uses'=>'Admin\AttributeController@update_attribute_type']);
	
	/* attribute type */
	
	
	
	/* attribute value */
	
	Route::get('/admin/attribute-value', 'Admin\AttributeController@attribute_value');
	Route::get('/admin/add-attribute-value', 'Admin\AttributeController@add_attribute_value')->name('admin.add-attribute-value');
	Route::post('/admin/add-attribute-value', 'Admin\AttributeController@save_attribute_value');
	Route::get('/admin/attribute-value/{attribute_value_id}', 'Admin\AttributeController@delete_attribute_value');
	Route::get('/admin/edit-attribute-value/{attribute_value_id}', 'Admin\AttributeController@edit_attribute_value')->name('admin.edit-attribute-value');
	Route::post('/admin/edit-attribute-value', ['as' => 'admin.edit-attribute-value','uses'=>'Admin\AttributeController@update_attribute_value']);
	
	/* attribute value */
	
	
	/* products */
	
	Route::get('/admin/products', 'Admin\ProductController@view_products');
	Route::get('/admin/add-product', 'Admin\ProductController@add_product')->name('admin.add-product');
	Route::post('/admin/add-product', 'Admin\ProductController@save_product');
	Route::get('/admin/products/{product_token}', 'Admin\ProductController@delete_product');
	Route::get('/admin/edit-product/{dropimg}/{img_id}', 'Admin\ProductController@delete_single_image');
	Route::get('/admin/edit-product/{product_token}', 'Admin\ProductController@edit_product')->name('admin.edit_product');
	Route::post('/admin/edit-product', ['as' => 'admin.edit-product','uses'=>'Admin\ProductController@update_product']);
	
	/* products */
	
	/* product import & export */
	Route::get('/admin/products-import-export', 'Admin\ImportExportController@view_products_import_export');
	Route::post('/admin/products-import-export', ['as' => 'admin.products-import-export','uses'=>'Admin\ImportExportController@products_import']);
	Route::get('/admin/products-import-export/{type}', 'Admin\ImportExportController@download_products_export');
	/* product import & export */
	
	
	/* orders */
	
	Route::get('/admin/orders', 'Admin\ProductController@view_orders');
	Route::get('/admin/order-details/{token}', 'Admin\ProductController@view_order_single');
	Route::get('/admin/order-details/{ord_id}/{user_type}', 'Admin\ProductController@view_payment_approval');
	Route::get('/admin/orders/{ord_id}/{payment_type}', 'Admin\ProductController@complete_orders');
	Route::post('/admin/order-track', ['as' => 'admin.order-track','uses'=>'Admin\ProductController@order_track']);
	/* orders */
	
	/* rating */
	
	Route::get('/admin/rating', 'Admin\ProductController@view_rating');
	Route::get('/admin/rating/{rating_id}', 'Admin\ProductController@rating_delete');
	/* rating */
	
	/* refund request */
	Route::get('/admin/refund', 'Admin\ProductController@view_refund');
	Route::get('/admin/refund/{ord_id}/{refund_id}/{user_type}', 'Admin\ProductController@view_payment_refund');
	/* refund request */
	
	
	/* withdrawal */
	
	Route::get('/admin/withdrawal', 'Admin\ProductController@view_withdrawal');
	Route::get('/admin/withdrawal/{wd_id}/{wd_user_id}', 'Admin\ProductController@view_withdrawal_update');
	/* withdrawal */
	
	
	/* blog */
	
	Route::get('/admin/blog-category', 'Admin\BlogController@blog_category');
	Route::get('/admin/add-blog-category', 'Admin\BlogController@add_blog_category')->name('admin.add-blog-category');
	Route::post('/admin/add-blog-category', 'Admin\BlogController@save_blog_category');
	Route::get('/admin/blog-category/{blog_cat_id}', 'Admin\BlogController@delete_blog_category');
	Route::get('/admin/edit-blog-category/{blog_cat_id}', 'Admin\BlogController@edit_blog_category')->name('admin.edit-blog-category');
	Route::post('/admin/edit-blog-category', ['as' => 'admin.edit-blog-category','uses'=>'Admin\BlogController@update_blog_category']);
	
	/* blog */
	
	
	
	/* post */
	
	Route::get('/admin/post', 'Admin\BlogController@posts');
	Route::get('/admin/add-post', 'Admin\BlogController@add_post')->name('admin.add-post');
	Route::post('/admin/add-post', 'Admin\BlogController@save_post');
	Route::get('/admin/post/{post_id}', 'Admin\BlogController@delete_post');
	Route::get('/admin/edit-post/{post_id}', 'Admin\BlogController@edit_post')->name('admin.edit-post');
	Route::post('/admin/edit-post', ['as' => 'admin.edit-post','uses'=>'Admin\BlogController@update_post']);
	
	/* post */
	
	
	/* comment */
	Route::get('/admin/comment/{post_id}', 'Admin\BlogController@comments');
	Route::get('/admin/comment/{delete}/{comment_id}', 'Admin\BlogController@delete_comment');
	Route::get('/admin/comment/update-status/{status}/{comment_id}', 'Admin\BlogController@comment_status');
	/* comment */
	
	
	
	
	/* pages */
	
	Route::get('/admin/pages', 'Admin\PagesController@pages');
	Route::get('/admin/add-page', 'Admin\PagesController@add_page')->name('admin.add-page');
	Route::post('/admin/add-page', 'Admin\PagesController@save_page');
	Route::get('/admin/pages/{page_id}', 'Admin\PagesController@delete_pages');
	Route::get('/admin/edit-page/{page_id}', 'Admin\PagesController@edit_page')->name('admin.edit-page');
	Route::post('/admin/edit-page', ['as' => 'admin.edit-page','uses'=>'Admin\PagesController@update_page']);
	
	/* pages */
	
	
	/* slideshow */
	
	Route::get('/admin/slideshow', 'Admin\SlideshowController@slideshow');
	Route::get('/admin/add-slideshow', 'Admin\SlideshowController@add_slideshow')->name('admin.add-slideshow');
	Route::post('/admin/add-slideshow', 'Admin\SlideshowController@save_slideshow');
	Route::get('/admin/slideshow/{slide_id}', 'Admin\SlideshowController@delete_slideshow');
	Route::get('/admin/edit-slideshow/{slide_id}', 'Admin\SlideshowController@edit_slideshow')->name('admin.edit-slideshow');
	Route::post('/admin/edit-slideshow', ['as' => 'admin.edit-slideshow','uses'=>'Admin\SlideshowController@update_slideshow']);
	
	/* slideshow */
	
			
	/* contact */
	Route::get('/admin/contact', 'Admin\CommonController@view_contact');
	Route::get('/admin/contact/{id}', 'Admin\CommonController@view_contact_delete');
	Route::get('/admin/add-contact', 'Admin\CommonController@view_add_contact');
	Route::post('/admin/add-contact', ['as' => 'admin.add-contact','uses'=>'Admin\CommonController@update_contact']);
	/* contact */
	
	
	/* newsletter */
	Route::get('/admin/newsletter', 'Admin\CommonController@view_newsletter');
	Route::get('/admin/newsletter/{id}', 'Admin\CommonController@view_newsletter_delete');
	Route::get('/admin/send-updates', 'Admin\CommonController@view_send_updates');
	Route::post('/admin/send-updates', ['as' => 'admin.send-updates','uses'=>'Admin\CommonController@send_updates']);
	/* newsletter */
	
	
	/* languages */
	Route::get('/admin/languages', 'Admin\LanguageController@view_languages');
	Route::get('/admin/add-language', 'Admin\LanguageController@add_language')->name('admin.add-language');
	Route::post('/admin/add-language', 'Admin\LanguageController@save_language');
	Route::get('/admin/languages/{token}/{code}', 'Admin\LanguageController@delete_languages');
	Route::get('/admin/edit-language/{language_id}', 'Admin\LanguageController@edit_language')->name('admin.edit-language');
	Route::post('/admin/edit-language', ['as' => 'admin.edit-language','uses'=>'Admin\LanguageController@update_language']);
	/* languages */
	
	
	/* edit keywords */
	Route::get('/admin/add-keywords', 'Admin\LanguageController@add_keywords');
	Route::post('/admin/add-keywords', ['as' => 'admin.add-keywords','uses'=>'Admin\LanguageController@insert_keywords']);
	Route::get('/admin/edit-keywords/{code}', 'Admin\LanguageController@edit_keywords');
	Route::post('/admin/edit-keywords', ['as' => 'admin.edit-keywords','uses'=>'Admin\LanguageController@save_keywords']);
	/* edit keywords */
	
	
	
});


/* admin panel */