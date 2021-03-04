<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => config('paypal.mode'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => config('paypal.sandbox.username'),
        'password'    => config('paypal.sandbox.password'),
        'secret'      => config('paypal.sandbox.secret'),
        'certificate' => config('paypal.sandbox.certificate'),
        'app_id'      => config('paypal.sandbox.app_id'), // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => config('paypal.live.username'),
        'password'    => config('paypal.live.password'),
        'secret'      => config('paypal.live.secret'),
        'certificate' => config('paypal.live.certificate'),
        'app_id'      => config('paypal.live.app_id'), // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => config('paypal.currency'),
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];
