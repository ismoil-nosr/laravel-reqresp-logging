<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'enabled' => env('REQUEST_LOGGER_ENABLED', false),
    'queue' => env('REQUEST_LOGGER_QUEUE', false),
    'filter_request' => env('REQUEST_LOGGER_FILTER_REQUEST', true),
    'filter_response' => env('REQUEST_LOGGER_FILTER_RESPONSE', true),
    'filter_keys' => explode(',', env('REQUEST_LOGGER_FILTER_KEYS', 'password,token,secret')),
];