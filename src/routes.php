<?php

Route::get(config('cw.routes.index.uri'), [
    'middleware' => config('cw.routes.index.middleware'),
    'as' => config('cw.routes.index.as'),
    'uses' => config('cw.routes.index.uses')
]);
