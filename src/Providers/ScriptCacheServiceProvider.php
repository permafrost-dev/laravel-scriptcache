<?php

namespace Permafrost\ScriptCache\Providers;

use Illuminate\Support\ServiceProvider;

class ScriptCacheServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config.php'=>config_path('scriptcache.php'),
        ], 'scriptcache-config');

        $this->loadRoutesFrom(__DIR__.'/../Routes/api-routes.php');
    }
}
