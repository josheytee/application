<?php

namespace app\core\account;

use app\core\Context;
use app\core\entity\User;


/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class UserAccount implements AccountInterface
{

    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {

        $this->user = $user;
    }

    public function getAccountName()
    {
        return $this->user->firstname.' '.$this->user->lastname;
    }

    public function getEmail()
    {
        return $this->user->email;
    }

    public function getLastAccessedTime()
    {

    }

    public function getRoles($exclude_locked_roles = FALSE)
    {
        return $this->user->getRoles();
    }

    public function getUsername()
    {
        return $this->user->username;
    }

    public function hasPermissions($permission)
    {
        return in_array($permission, $this->getPermissions());
    }

    public function getPermissions()
    {
        return $this->user->permissions;
    }

    public function id()
    {
        if ($this->user->id)
            return $this->user->id;
        return 0;
    }

    public function getCurrentShop()
    {
        return $this->user->currentShop;
    }

    public function isAnonymous()
    {
        return $this->id == 0;
    }

    public function isAuthenticated()
    {
        return $this->id > 0;
    }

    public function getPicture()
    {
        return '';
    }

}
