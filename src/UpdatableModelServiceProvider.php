<?php

namespace BinaryTorch\UpdatableModel;

use Illuminate\Support\ServiceProvider;
use BinaryTorch\UpdatableModel\Commands\MakeModelUpdater;

class UpdatableModelServiceProvider extends ServiceProvider
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
