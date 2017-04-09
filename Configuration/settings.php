<?php
return [
    'settings' => [
        'displayErrorDetails' => ('true' === getenv('DEBUG_DETAIL')), // set to false in production
        'debug'         => ('true' === getenv('DEBUG_DETAIL')),
        'whoops.editor' => 'sublime',
        'service_directories' => [
            'services'    => APP_ROOT.'/configuration/services/',
            'middlewares' => APP_ROOT.'/configuration/middleware/',
            'routes'      => APP_ROOT.'/configuration/routes/',
        ], 

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
            'template_cache' => APP_ROOT.'/cache/',            
            'debug' => ('true' === getenv('DEBUG_DETAIL'))
        ],

        // Monolog settings
        'logger' => [
            'name' => 'stepostr',
            'path' => __DIR__ . '/../logs/app.log',
        ],

        // DB settings
        'db' => [
            'host'  => getenv('DB_HOST'),
            'user'  => getenv('DB_USER'),
            'pass'  => getenv('DB_PASS'),
            'dbname'  => getenv('DB_NAME')
        ]
    ],
];
