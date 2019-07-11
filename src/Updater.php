<?php

namespace BinaryTorch\ModelUpdater;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Updater
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * The Eloquent model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Registered fields to operate upon.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Model $model
     *
     * @return Model
     */
    public function process(Model $model)
    {
        $this->model = $model;

        foreach ($this->getIntendedUpdateFields() as $field => $value) {
            if (method_exists($this, $field)) {
                $this->$field($value);
            }
        }

        $this->model->save();

        return $this;
    }

    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    public function getIntendedUpdateFields()
    {
        return $this->request->only($this->fields);
    }
}
