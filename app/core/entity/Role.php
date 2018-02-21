<?php

namespace app\core\entity;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getPermissionsAttribute($permission)
    {
        return unserialize($permission) ?? [];
    }


    /**
     * Set the permissions attribute
     *
     * @param  string $value
     * @return void
     */
    public function setPermissionsAttribute($value)
    {
        $this->attributes['permissions'] = serialize($value);
    }

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
