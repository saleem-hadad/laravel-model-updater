<?php

namespace BinaryTorch\UpdatableModel\Traits;

use BinaryTorch\UpdatableModel\UpdatableModel;

trait Updatable
{
    /**
     * @param  UpdatableModel $updatableModel
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fillUpdate(UpdatableModel $updatableModel)
    {
        return $updatableModel->process($this);
    }
}
