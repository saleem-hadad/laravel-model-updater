<?php

namespace Laimoon\ModelUpdater;

use Laimoon\ModelUpdater\Commands\MakeModelUpdater;
use Illuminate\Support\ServiceProvider;

class ModelUpdaterServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(MakeModelUpdater::class);
        }
    }
}
