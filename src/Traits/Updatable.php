<?php

namespace BinaryTorch\UpdatableModel\Traits;

use BinaryTorch\UpdatableModel\Updater;

trait Updatable
{
    /**
     * @param  Updater $updater
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fillUpdates(Updater $updater)
    {
        return $updater->process($this);
    }
}
