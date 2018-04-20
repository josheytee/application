<?php

namespace app\core\account;

use app\core\entity\User;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AccountProxy implements AccountProxyInterface
{

  private $initialAccountId;
  private $account;

  public function getAccountName()
  {
    return $this->getAccount()->getAccountName();
  }

  /**
   * {@inheritdoc}
   */
  public function getAccount()
  {
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
    return $this->account;
  }

  /**
   * {@inheritdoc}
   */
  public function setAccount(AccountInterface $account)
  {
    // If the passed account is already proxied, use the actual account instead
    // to prevent loops.
    if ($account instanceof static) {
      $account = $account->getAccount();
    }
    $this->account = $account;
  }

  /**
   * @todo use container to get entity manager instead of context
   * @param $account_id
   * @return null|object
   * @internal param type $acount_id
   */
  protected function loadUserAccount($account_id)
  {
    return User::find($account_id);
  }

  public function getCurrentShop()
  {
    return $this->getAccount()->getCurrentShop();
  }

  public function getEmail()
  {
    return $this->getAccount()->getEmail();
  }

  public function getLastAccessedTime()
  {
    return $this->getAccount()->getLastAccessedTime();
  }

  public function getRoles($exclude_locked_roles = FALSE)
  {
    return $this->getAccount()->getRoles($exclude_locked_roles)->toArray();
  }

  public function getRole()
  {
    return $this->getAccount()->getRoles();
  }

  public function getPicture()
  {
    return $this->getAccount()->getPicture();
  }

  public function getUsername()
  {
    return $this->getAccount()->getUsername();
  }

  public function hasPermission($permission)
  {
    return $this->getAccount()->hasPermission($permission);
  }

  public function hasPermissions($permissions)
  {
    return $this->getAccount()->hasPermissions($permissions);
  }

  public function getPermissions()
  {
    return $this->getAccount()->getPermissions();
  }

  public function id()
  {
    return $this->getAccount()->id();
  }

  public function isAnonymous()
  {
    return $this->getAccount()->isAnonymous();
  }

  public function isAuthenticated()
  {
    return $this->getAccount()->isAuthenticated();
  }

  /**
   * {@inheritdoc}
   */
  public function setInitialAccountId($account_id)
  {
    if (isset($this->account)) {
      throw new \LogicException('AccountProxyInterface::setInitialAccountId() cannot be called after an account was set on the AccountProxy');
    }

    $this->initialAccountId = $account_id;
  }

}
