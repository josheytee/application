<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {

    protected $primaryKey = 'id_section';
    protected $table = 'section';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = ['id_parent', 'id_shop', 'name', 'description', 'url'];

    public function shop() {
        return $this->belongsTo('app\model\Shop', 'id_section', 'id_shop');
    }

    public function products() {
        return $this->hasMany('app\model\Product', 'id_section');
    }

    public function parent() {
    return $this->hasOne($this, 'id_parent', 'id_section');

    }

}
