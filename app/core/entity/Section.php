<?php

namespace app\core\entity;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function parent()
    {
        return $this->hasOne(Section::class, 'parent_id');
    }

    public function images()
    {
        return $this->hasMany(SectionImage::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
