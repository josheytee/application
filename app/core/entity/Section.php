<?php

namespace app\core\entity;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Section extends Model
{
    use NodeTrait;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function parent()
    {
        return $this->belongsTo(Section::class,'parent_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
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
