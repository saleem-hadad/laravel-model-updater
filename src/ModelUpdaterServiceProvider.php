<?php

namespace BinaryTorch\ModelUpdater;

use Illuminate\Support\ServiceProvider;
use BinaryTorch\ModelUpdater\Commands\MakeModelUpdater;

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
