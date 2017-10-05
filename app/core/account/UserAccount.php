<?php

namespace app\core\account;

use app\core\Context;
use app\core\entity\{
  Role, User
};

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class UserAccount implements AccountInterface {

    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user) {

        $this->user = $user;
    }

    public function getAccountName() {
        return $this->user->getName();
    }

    public function getCurrentShop() {
        return $this->user->getCurrentShop();
    }

    public function getEmail() {
        return $this->user->getEmail();
    }

    public function getLastAccessedTime() {

    }

    public function getRoles($exclude_locked_roles = FALSE) {
        return $this->user->getRoles();
    }

    public function getUsername() {
        return $this->user->getUsername();
    }

    public function getPermission() {
        return Context::doctrine()->getRepository(Role::class)
          ->getUserPermisions($this->id(), $this->getCurrentShop()->getId());
    }

    public function hasPermission($permission) {
//        dump($this->id());
        return in_array($permission, $this->getPermission());
    }

    public function id() {
        if ($this->user->getId())
            return $this->user->getId();
        return 0;
    }

    public function isAnonymous() {
        return $this->id() == 0;
    }

    public function isAuthenticated() {
        return $this->id() > 0;
    }

    public function getDefaultShop() {
        $this->user->getDefaultShop();
    }

}
