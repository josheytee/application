<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $primaryKey = 'id_category';
    protected $table = 'category';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = ['name', 'description', 'icon'];

    public function shop() {
        $this->belongsTo('app\model\Shop', 'id_category', 'id_shop');
    }

}
