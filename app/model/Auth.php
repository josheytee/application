<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model {

    protected $primaryKey = 'id_auth';
    protected $table = 'auth';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = ['id_user', 'duration', 'secret'];

}
