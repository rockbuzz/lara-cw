<?php

return [
    // Turn auto deploy on or off
    'status' => env('CW_ENABLED', true),

    // Define the deployment environment
    'env' => env('CW_ENV', 'staging'),

    // Defines the uri and middleware that webhooks will use
    'routes' => [
        'index' => [
            'uri' => env('CW_DEPLOY_URI', '_deploy'),
            'middleware' => ['web']
        ]
    ],

    // Set authentication and repository values
    'api_key' => env('CW_API_KEY'),

    'api_url' => env('CW_API_URL'),

    'email' => env('CW_EMAIL'),

    'server_id' => env('CW_SERVER_ID'),

    'app_id' => env('CW_APP_ID'),

    'deploy_path' => env('CW_DEPLOY_PATH'),

    'git_url' => env('CW_GIT_URL'),

    'branch_name' => env('CW_BRANCH_NAME'),

    // Set commands after deploy
    'composer' => [
        '--version',
        #'install', 
        #'--no-cache', 
        #'--no-interaction'
    ],

    'artisan' => [
        '--version',
        #'migrate --force --no-interaction',
        #'cache:clear',
        #'route:cache',
        #'view:clear',
        #'config:clear',
        #'clear-compiled',
        #'optimize'        
    ]
];
