<?php

namespace ntc\account\access;

use app\core\access\AccessCheckerInterface;
use app\core\access\AccessResult;
use app\core\account\AccountInterface;
use Symfony\Component\Routing\Route;

/**
 *
 */
class PermissionsChecker implements AccessCheckerInterface
{


    public function check(Route $route, AccountInterface $account)
    {
        $permission = $route->getRequirement('_permission');
        if ($permission === NULL) {
            return AccessResult::neutral();
        }

        // Allow to conjunct the permissions with OR ('+') or AND (',').
        $split = explode(',', $permission);
        if (count($split) > 1) {
            return AccessResult::allowedIfHasPermissions($account, $split, 'AND');
        } else {
            $split = explode('+', $permission);
            return AccessResult::allowedIfHasPermissions($account, $split, 'OR');
        }
    }
}
