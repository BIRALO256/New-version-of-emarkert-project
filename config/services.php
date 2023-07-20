<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // facebook app id and secret key

    'facebook' => [
        'client_id' => '146618981738183',
        'client_secret' => '0e67ee2633d929d667161378ec4090a1',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '1000125923709-v0o4v53dogbloi6igr7kkm7ibf4vcjal.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],

];
