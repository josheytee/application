<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

//    public $fillable;
    protected $table = 'user';
    protected $fillable = ['name', 'serial_number'];

//    public $primaryKey;
}
