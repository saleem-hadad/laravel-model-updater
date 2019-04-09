<?php

namespace BinaryTorch\UpdatableResource\Traits;

use BinaryTorch\Updatable\UpdateableModel;

trait Updateable
{
    /**
     * @param  UpdateableModel $updateableModel
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fillUpdate(UpdateableModel $updateableModel)
    {
        return $updateableModel->process($this);
    }
}
