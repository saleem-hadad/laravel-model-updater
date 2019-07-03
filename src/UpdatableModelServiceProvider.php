<?php

namespace BinaryTorch\UpdatableModel;

use Illuminate\Support\ServiceProvider;
use BinaryTorch\UpdatableModel\Commands\MakeUpdatableModel;

class UpdatableModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(MakeUpdatableModel::class);
        }
    }
}
