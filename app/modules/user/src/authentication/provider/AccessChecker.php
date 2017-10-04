<?php

namespace ntc\user\authentication\provider;

use app\core\account\AccountInterface;
use app\core\account\AuthenticationProviderInterface;
use app\core\http\Request;

class AccessChecker implements AuthenticationProviderInterface {

    /**
     * @var AccountInterface
     */
    private $account;

    /**
     * AccessChecker constructor.
     * @param AccountInterface $account
     */
    public function __construct(AccountInterface $account) {

        $this->account = $account;
    }

    public function applies(Request $request) {
        $route = $request->get('_route_object');
        return $route->hasRequirement('_access');
    }

    public function authenticate(Request $request) {
        $route = $request->get('_route_object');
        $permission = $route->getRequirement('_access');
        if ($this->account->hasPermission($permission)) {
            dump('wonderfull');
        }
        dump('sorry');
    }

}
