<?php

namespace Rockbuzz\LaraOrders;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class ServiceProvider extends SupportServiceProvider
{

    public function boot(Filesystem $filesystem)
    {
        $this->publishes([
            __DIR__ . '/../config/cw.php' => config_path('cw.php')
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/orders.php', 'orders');
    }
}
