<?php

namespace BinaryTorch\UpdatableModel\Traits;

use BinaryTorch\UpdatableModel\UpdateableModel;

trait Updateable
{
    /**
     * @param  UpdateableModel $updateableModel
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fillUpdate(UpdateableModel $updateableModel)
    {
        return $updateableModel->process(self);
    }
}
