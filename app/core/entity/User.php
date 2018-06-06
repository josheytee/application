<?php

namespace app\core\entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['current_shop_id', 'remember_token'];

    public function currentShop()
    {
        return $this->hasOne(Shop::class, 'id', 'current_shop_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Shop::class)->withPivot('role');
    }

    public function permissions()
    {
        return Role::findOrFail($this->roles()->first()->pivot->role)->permissions;
    }

    public function shops()
    {
        return $this->belongsToMany(Shop::class);
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

}
