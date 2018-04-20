<?php

namespace app\core\access;

use Symfony\Component\Routing\Route;
use app\core\account\AccountInterface;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
interface AccessCheckerInterface
{

  public function check(Route $route, AccountInterface $account);
}
