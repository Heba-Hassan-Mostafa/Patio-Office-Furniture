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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
     'google' => [
        'client_id' => '322096742490-8nf0ppfu20ttlkv7okf9b8bsoi574d20.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://patio-egypt.com/callback/google',
      ], 
      
       'facebook' => [
        'client_id' => '4439369002817457',
        'client_secret' => '4212370795c4bb8c4ab81d3937937efa',
        'redirect' => 'https://patio-egypt.com/callback/facebook',
      ], 

];
