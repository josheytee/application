<?php

namespace ntc\user\authentication\provider;

use app\core\account\AccountInterface;
use app\core\account\AuthenticationProviderInterface;
use app\core\http\Request;

class UserPermissionChecker implements AuthenticationProviderInterface
{

    /**
     * @var AccountInterface
     */
    private $account;

    /**
     * AccessChecker constructor.
     * @param AccountInterface $account
     */
    public function __construct(AccountInterface $account)
    {
        $this->account = $account;
    }

    public function applies(Request $request)
    {
        $route = $request->get('_route_object');

        return $route->hasRequirement('_permission');
    }

    public function authenticate(Request $request)
    {

        dump($request);
        $route = $request->get('_route_object');
        $permission = $route->getRequirement('_access');
        dump($this->account);
//        dump($permission);
//        dump($this->account->getPermissions());
//        dump($this->account->hasPermissions($permission));
        if (!$this->account->hasPermissions($permission)) {
            dump('wonderfull');
        }
        dump('sorry');
    }

}
