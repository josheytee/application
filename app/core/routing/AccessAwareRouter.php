<?php

namespace app\core\routing;

use app\core\access\AccessChecker;
use app\core\account\AccountInterface;
use Symfony\Cmf\Component\Routing\ChainRouter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\RequestContext;

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
    private $accessChecker;

    /**
     * @var ChainRouter
     */
    private $chainRouter;
    /**
     * @var AccountInterface
     */
    private $account;

    public function __construct(ChainRouter $chainRouter, AccessChecker $accessChecker, AccountInterface $account)
    {

        $this->chainRouter = $chainRouter;
        $this->accessChecker = $accessChecker;
        $this->account = $account;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH): string
    {
        return $this->chainRouter->generate($name, $parameters, $referenceType);
    }

    public function getContext()
    {
        return $this->chainRouter->getContext();
    }

    public function getRouteCollection()
    {
        return $this->chainRouter->getRouteCollection();
    }

    public function match($pathinfo)
    {
        return $this->matchRequest(Request::create($pathinfo));
    }

    public function matchRequest(Request $request)
    {
        $parameters = $this->chainRouter->matchRequest($request);

//        dump($parameters);
//        dump($request);
        $request->attributes->add($parameters);
        $this->checkAccess($request);
        // We can not return $parameters because the access check can change the
        // request attributes.
        return $request->attributes->all();
    }

    public function setContext(RequestContext $context)
    {
        $this->chainRouter->setContext($context);
    }

    protected function checkAccess(Request $request)
    {
//        dump($this->account,'aacc');
        $result = $this->accessChecker->checkRequest($request, $this->account, TRUE);
        if (!$result->isAllowed()) {
            throw new AccessDeniedHttpException();
        }
    }
}
