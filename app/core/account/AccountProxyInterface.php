<?php

namespace app\core\account;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
interface AccountProxyInterface extends AccountInterface
{

  /**
   * Sets the currently wrapped account.
   *
   * Setting the current account is highly discouraged! Instead, make sure to
   * inject the desired user object into the dependent code directly.
   *
   * @param AccountInterface $account
   *   The current account.
   */
  public function setAccount(AccountInterface $account);

  /**
   * Gets the currently wrapped account.
   *
   * @return AccountInterface
   *   The current account.
   */
  public function getAccount();
}
