<?php

namespace BinaryTorch\Updatable\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use BinaryTorch\UpdatableResource\Traits\Updateable;

class User extends Model
{
    use Updateable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
