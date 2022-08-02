<?php

return [
    /**
     * Request settings
     */
    'request' => [
        /**
         * Add your own middleware
         */
        'middleware' => []
    ],

    /**
     * LogGroupNames settings
     */
    'groups' => [
        /**
         * Exclude LogGroupNames from retrieving all the groups. BE AWARE: CONFLICTS WHEN USED TOGETHER WITH "only"
         */
        'exclude' => [],

        /**
         * Only allow LogGroupNames specified in this array. Even when the array is filled with values, a request
         * to AWS will be made to retrieve results. If you make a typo, the LogGroupName wont be displayed
         */
        'only' => []
    ],

    /**
     * AWS Credentials
     */
    'aws' => [
        /**
         * AWS Credentials
         */
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION')
    ],

    /**
     * Interface settings
     */
    'interface' => [
        /**
         * Display the datetime format as preferred. Momentjs is used to cast timestamps
         */
        'date_time_format' => 'DD-MM-YYYY HH:MM:ss'
    ]
];
