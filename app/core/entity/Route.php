<?php

namespace app\core\entity;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    public $timestamps = false;

    public function getObjectAttribute($value)
    {
        return unserialize($value);
    }

    public function setObjectAttribute($value)
    {
        $this->attributes['object'] = serialize($value);
    }
}
