<?php

return [
    'sqllog' => [
        'driver' => 'daily',
        'path' => env('SQL_LOG_FILE_PATH') ?? storage_path('logs/sql.log'),
        'level' => 'debug',
        'days' => 14,
    ]
];
