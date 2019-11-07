<?php

return [
    'sqllog' => [
        'driver' => 'daily',
        'path' => env('SQL_LOG_FILE_PATH') ?? storage_path('logs/sql.log'),
        'level' => 'debug',
        'days' => 14,
    ],
    'slow_query_log' => [
        /**
         * log when you are on these environments
         */
        'enabled' => env('SLOW_QUERY_LOG_ENABLED', false),
        'driver' => 'daily',
        'path' => env('SLOW_QUERY_LOG_FILE_PATH') ?? storage_path('logs/slow-queries.log'),
        'level' => 'debug',
        'days' => 14,
        /**
         * level to log
         */
        'log_level' => env('SLOW_QUERY_LOG_LEVEL', 'debug'),
        /**
         * log all sql queries that are slower than X seconds
         */
        'time_to_log' => env('SLOW_QUERY_TIME_TO_LOG', -1)
    ]
];
