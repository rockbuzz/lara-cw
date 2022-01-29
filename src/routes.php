<?php

Route::post(config('cw.routes.index.uri'), [
    'middleware' => config('cw.routes.index.middleware'),
    'as' => 'cw.deploy',
    'uses' => 'Rockbuzz\LaraCW\Http\Controllers\DeployController@index'
]);
