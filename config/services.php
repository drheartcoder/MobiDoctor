<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'STRIPE_KEY'    => env('STRIPE_KEY'),
        'STRIPE_SECRET' => env('STRIPE_SECRET'),
        'CLIENT_ID'     => env('CLIENT_ID'),
        'CURRENCY'      => env('CURRENCY'),
        'TOKEN_URI'     => 'https://connect.stripe.com/oauth/token',
        'AUTHORIZE_URI' => 'https://connect.stripe.com/oauth/authorize',
    ],

    'twilio' => [
        'TWILIO_SID'    => env('TWILIO_SID'),
        'TWILIO_TOKEN'  => env('TWILIO_TOKEN'),
        'TWILIO_NUMBER' => env('TWILIO_NUMBER'),
    ],

    'virgil' => [
        'APPPASS' => env('VIRGIL_APPPASS'),
        'APPID'   => env('VIRGIL_APPID'),
        'TOKEN'   => env('VIRGIL_TOKEN'),
        'APPKEY'  => env('VIRGIL_APPKEY'),
    ],

    'google' => [
        'GOOGLE_MAPS_API' => env('GOOGLE_MAPS_API'),
    ],

    'EWAY' => [
        'API_KEY'      => 'C3AB9CaQ+yoeX4z/2UcSr87iib4LMl+qM3KkTJhZpeAYC7Z1mFkNr8ebqVPNxCuH+tv+S+',
        'API_PASSWORD' => 'n385yFLV',
        'ENDPOINT'     => 'MODE_SANDBOX'
    ],

    'facebook' => 
    [
        'client_id'     => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect'      => env('APP_URL').'/social_auth/facebook/callback',
    ],


];
