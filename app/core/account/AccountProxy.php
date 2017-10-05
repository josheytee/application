<?php

namespace app\core\account;

use app\core\Context;
use app\core\entity\Shop;
use app\core\entity\User;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AccountProxy implements AccountProxyInterface {

    private $initialAccountId;
    private $account;

    /**
     * {@inheritdoc}
     */
    public function setAccount(AccountInterface $account) {
        // If the passed account is already proxied, use the actual account instead
        // to prevent loops.
        if ($account instanceof static) {
            $account = $account->getAccount();
        }
        $this->account = $account;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccount() {
        if (!isset($this->account)) {
            if ($this->initialAccountId) {
                // After the container is rebuilt, DrupalKernel sets the initial
                // account to the id of the logged in user. This is necessary in order
                // to refresh the user account reference here.
                $this->setAccount($this->loadUserAccount($this->initialAccountId));
            } else {
                $this->account = new AnonymousUser();
            }
        }
        dump($this->account);
        return $this->account;
    }

    public function getAccountName(): string {
        return $this->getAccount()->getAccountName();
    }

    public function getCurrentShop(): Shop {
        return $this->getAccount()->getCurrentShop();
    }

    public function getEmail(): string {
        return $this->getAccount()->getEmail();
    }

    public function getLastAccessedTime(): int {
        return $this->getAccount()->getLastAccessedTime();
    }

    public function getRoles($exclude_locked_roles = FALSE): array {
        return $this->getAccount()->getRoles($exclude_locked_roles);
    }

    public function getUsername(): string {
        return $this->getAccount()->getUsername();
    }

    public function hasPermission($permission): bool {
        return $this->getAccount()->hasPermission($permission);
    }

    public function id(): int {
        return $this->getAccount()->id();
    }

    public function isAnonymous(): bool {
        return $this->getAccount()->isAnonymous();
    }

    public function isAuthenticated(): bool {
        return $this->getAccount()->isAuthenticated();
    }

    /**
     * {@inheritdoc}
     */
    public function setInitialAccountId($account_id) {
        if (isset($this->account)) {
            throw new \LogicException('AccountProxyInterface::setInitialAccountId() cannot be called after an account was set on the AccountProxy');
        }

        $this->initialAccountId = $account_id;
    }

    /**
     * @todo use container to get entity manager instead of context
     * @param $account_id
     * @return null|object
     * @internal param type $acount_id
     */
    protected function loadUserAccount($account_id) {
        return Context::doctrine()->find(User::class, $account_id);
    }

    public function getDefaultShop() {
        return $this->getAccount()->getDefaultShop();
    }

}
