<?php

namespace app\core\entity;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

}
