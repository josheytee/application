<?php

namespace app\core\entity;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

}
