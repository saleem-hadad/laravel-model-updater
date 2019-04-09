<?php

namespace BinaryTorch\LaravelUpdatable;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BinaryTorch\LaravelUpdatable\Skeleton\SkeletonClass
 */
class LaravelUpdatableFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-updatable';
    }
}
