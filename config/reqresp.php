<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    /**
     * Allows to enable and disable logging
     */
    'enabled' => env('REQRESP_ENABLED', false),

    /**
     * Allows to queue logging
     */
    'queue' => env('REQRESP_QUEUE_ENABLED', false),

    /**
     * Allows to turn enable and disable filtering request's body
     */
    'filter_request' => env('REQRESP_FILTER_REQUEST_ENABLED', true),

    /**
     * Allows to turn enable and disable filtering response's body
     */
    'filter_response' => env('REQRESP_FILTER_RESPONSE_ENABLED', true),

    /**
     * Allows to hide sensitive data from requests/responses
     */
    'filter_keys' => explode(',', env('REQRESP_FILTER_KEYS', 'password,token,secret')),

    /**
     * Specify default log channel
     */
    'log_channel' => env('REQRESP_LOGGER_CHANNEL', 'default'),

    /**
     * Specify queue name
     */
    'queue_name' => env('REQRESP_QUEUE_NAME', 'default'),

    /**
     * Here you can specify logging channels where you want to store you log data
     */
    'channels' => [
        'default' => [
            'driver' => 'single',
            'path' => storage_path('logs/reqresp.log'),
            'level' => 'debug',
        ],
    ],
];
