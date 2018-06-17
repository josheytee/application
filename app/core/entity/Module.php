<?php

namespace app\core\entity;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getDependenciesAttribute($value)
    {
        return unserialize($value);
    }

    public function setDependenciesAttribute($value)
    {
        $this->attributes['dependencies'] = serialize($value);
    }
}
