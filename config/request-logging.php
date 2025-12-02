<?php

return [
    'log_sql_queries' => env('LOG_SQL_QUERIES', false),
    
    'log_requests' => env('LOG_REQUESTS', true),
    
    'log_views' => env('LOG_VIEWS', true),
    
    'log_parameters' => env('LOG_PARAMETERS', true),
    
    'exclude_paths' => [
        'telescope*',
        'horizon*',
        '_debugbar*',
        'livewire*',
    ],
];
