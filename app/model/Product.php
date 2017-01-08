<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $primaryKey = 'id_product';
    protected $table = 'product';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = ['id_shop', 'id_section', 'name', 'description', 'price', 'availability'];

    public function shop() {
        return $this->hasOne('app\model\Shop', 'id_shop', 'id_product');
    }

    public function section() {
        return $this->hasOne('app\model\Section', 'id_section', 'id_product');
    }

}
