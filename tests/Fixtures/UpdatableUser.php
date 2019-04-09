<?php

namespace App;

use BinaryTorch\Updatable\UpdateableModel;

class UserUpdateableResource extends UpdateableModel
{
    /**
     * Registered fields to operate upon.
     *
     * @var array
     */
    protected $fields = ['name'];

    /**
     * @param  string $name
     * @return mixed
     */
    protected function name($name)
    {
        $this->request->validate(['name' => 'required|string|max:254']);

        return $this->model->name = $name;
    }
}
