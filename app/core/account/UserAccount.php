<?php

namespace app\core\account;

use app\core\Context;
use app\core\entity\Role;
use app\core\entity\User;
use app\core\entity\Shop;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class UserAccount implements AccountInterface {

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user) {

        $this->user = $user;
    }

    public function getAccountName(): string {
        return $this->user->getName();
    }

    public function getCurrentShop(): \app\core\entity\Shop {
        return $this->user->getCurrentShop();
    }

    public function getEmail(): string {
        return $this->user->getEmail();
    }

    public function getLastAccessedTime(): int {

    }

    public function getRoles($exclude_locked_roles = FALSE): array {
        return $this->user->getRoles();
    }

    public function getUsername(): string {
        return $this->user->getUsername();
    }

    public function hasPermission($permission): bool {
      Context::doctrine()->getRepository(Role::class)->getUserPermisions(1,1);
        return 0;
    }

    public function id(): int {
        return $this->user->getId();
    }

    public function isAnonymous(): bool {
        return $this->id() == 0;
    }

    public function isAuthenticated(): bool {
        return $this->id() > 0;
    }

    public function getDefaultShop(): Shop {
        $this->user->getDefaultShop();
    }

}
