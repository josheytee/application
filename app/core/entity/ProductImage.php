<?php

namespace app\core\entity;

use Illuminate\Database\Eloquent\Model;


class ProductImage extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function images()
    {
        return $this->belongsTo(Product::class);
    }

}
