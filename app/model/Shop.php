<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model {

    protected $primaryKey = 'id_shop';
    protected $table = 'shop';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = ['id_user', 'id_category', 'name', 'description', 'url'];

    public function category() {
        return $this->hasOne('app\model\Category', 'id_category', 'id_shop');
    }

    public function sections() {
        return $this->hasMany('app\model\Section', 'id_section');
    }

    public function product() {
        return $this->belongsTo('app\model\Product', 'id_shop', 'id_product');
    }

    public function users() {
        return $this->belongsToMany('app\model\User', 'user_shop', 'id_shop', 'id_user');
    }

}
