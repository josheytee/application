<?php

namespace app\core\routing;

use app\core\access\AccessChecker;
use app\core\account\AccountInterface;
use Symfony\Cmf\Component\Routing\ChainRouter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;

/**
 * Description of AccessAwareRouter
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AccessAwareRouter implements AccessAwareRouterInterface
{

    /**
     * @var AccessChecker
     */
    private $access_checker;

    /**
     * @var ChainRouter
     */
    private $chain_router;
    /**
     * @var AccountInterface
     */
    private $account;

    public function __construct(ChainRouter $chain_router, AccessChecker $access_checker, AccountInterface $account)
    {

        $this->chain_router = $chain_router;
        $this->access_checker = $access_checker;
        $this->account = $account;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH): string
    {
        return $this->chain_router->generate($name, $parameters, $referenceType);
    }

    public function getContext()
    {
        return $this->chain_router->getContext();
    }

    public function getRouteCollection()
    {
        return $this->chain_router->getRouteCollection();
    }

    public function match($pathinfo)
    {
        return $this->matchRequest(Request::create($pathinfo));
    }

    public function matchRequest(Request $request)
    {
        $parameters = $this->chain_router->matchRequest($request);
        $request->attributes->add($parameters);
        $this->checkAccess($request);
        // We can not return $parameters because the access check can change the
        // request attributes.
        return $request->attributes->all();
    }

    public function setContext(RequestContext $context)
    {
        $this->chain_router->setContext($context);
    }

    protected function checkAccess(Request $request)
    {
        $this->access_checker->checkRequest($request, $this->account);
    }
}
