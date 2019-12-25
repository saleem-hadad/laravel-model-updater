<?php

namespace Laimoon\ModelUpdater\Traits;

use Laimoon\ModelUpdater\Updater;

trait Updatable
{
    /**
     * @param Updater $updater
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fillUpdates(Updater $updater)
    {
        return $updater->process($this);
    }
}
