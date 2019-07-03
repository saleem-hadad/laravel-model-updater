<?php

namespace BinaryTorch\UpdatableModel;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

abstract class UpdateableModel
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
     * @param  Model $model
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

    /**
     * @return mixed
     */
    protected function update($any)
    {
        return $this->model->update($any);
    }
}
