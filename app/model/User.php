<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $primaryKey = 'id_user';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';
    protected $fillable = ['firstname', 'lastname', 'username', 'email', 'phone', 'password', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function shops() {
        return $this->belongsToMany('app\model\Shop', 'user_shop', 'id_user', 'id_shop');
    }

}
