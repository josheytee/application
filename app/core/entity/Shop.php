<?php

namespace app\core\entity;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function Category()
    {
        return $this->hasOne(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
