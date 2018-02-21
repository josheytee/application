<?php

namespace ntc\user\access;

use app\core\access\AccessCheckerInterface;
use app\core\http\Request;

/**
 *
 */
class PermissionsChecker implements AccessCheckerInterface
{

    public function check(Request $request, $account)
    {
        if ($permission = $request->get('_route_object')->hasRequirement('_permission')) {
            dump($account->hasPermissions($permission));
        }
//        dump($request->get('_route_object')->hasRequirement('_permission'));
//        throw new \Exception('access denied');
//        if($account->hasPermissions($request->))
    }
}
