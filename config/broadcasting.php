<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "reverb", "pusher", "ably", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_CONNECTION', 'pusher'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over WebSockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'reverb' => [
            'driver' => 'reverb',
            'key' => env('REVERB_APP_KEY'),
            'secret' => env('REVERB_APP_SECRET'),
            'app_id' => env('REVERB_APP_ID'),
            'options' => [
                'host' => env('REVERB_HOST'),
                'port' => env('REVERB_PORT', 443),
                'scheme' => env('REVERB_SCHEME', 'https'),
                'useTLS' => true,
            ],
            'client_options' => [
                // Guzzle client options: https://docs.guzzlephp.org/en/stable/request-options.html
            ],
        ],

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('VITE_PUSHER_APP_KEY'),
            'secret' => env('VITE_PUSHER_APP_SECRET'),
            'app_id' => env('VITE_PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('VITE_PUSHER_APP_CLUSTER', default: 'eu'),
                'host' => env('VITE_PUSHER_HOST') ?: 'api-'.env('VITE_PUSHER_APP_CLUSTER', 'eu').'.VITE_PUSHER.com',
                'port' => env('VITE_PUSHER_PORT', 80),
                'scheme' => env('VITE_PUSHER_SCHEME', 'http'),
                'useTLS' => false,

                'curl_options' => [

                CURLOPT_CAINFO => 'C:\\cacert.pem',
                ],
            ],
            'client_options' => [
                
                // CURLOPT_SSL_VERIFYHOST => 0,
                // CURLOPT_SSL_VERIFYPEER => 0,
            ],
        ],

        'ably' => [
            'driver' => 'ably',
            'key' => env('ABLY_KEY'),
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
