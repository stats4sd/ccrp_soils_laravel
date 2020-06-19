<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'kobo' => [
        'endpoint' => env('KOBO_ENDPOINT', 'https://kf.kobotoolbox.org'),
        'endpoint_v2' => env('KOBO_ENDPOINT').'/api/v2', 'https://kf.kobotoolbox.org/api/v2',
        'old_endpoint' => env('KOBO_OLD_ENDPOINT', 'https://kc.kobotoolbox.org'),
        'token' => env('KOBO_TOKEN', ''),
        'username' => env('KOBO_USERNAME', ''),
        'password' => env('KOBO_PASSWORD', ''),
    ],

    'recaptcha' => [
        'key' => env('GOOGLE_RECAPTCHA_KEY', null),
        'secret' => env('GOOGLE_RECAPTCHA_SECRET', null),
    ],

];
