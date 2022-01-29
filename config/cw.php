<?php

return [
    'status' => true,
    'env' => ['staging'],
    'api_key' => env('CW_API_KEY'),
    'api_url' => env('CW_API_URL'),
    'email' => env('CW_EMAIL'),
    'server_id' => env('CW_SERVER_ID'),
    'app_id' => env('CW_APP_ID'),
    'deploy_path' => env('CW_DEPLOY_PATH'),
    'git_url' => env('CW_GIT_URL'),
    'branch_name' => env('CW_BRANCH_NAME'),
    'routes' => [
        'index' => [
            'uri' => env('CW_DEPLOY_URI'),
            'as' => 'cw.deploy',
            'middleware' => ['web'],
            'uses' => 'Rockbuzz\EventCW\Http\Controllers\DeployController@index'
        ]
    ]
];
