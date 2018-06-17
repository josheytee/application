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
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }


}
