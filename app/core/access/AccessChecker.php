<?php

namespace app\core\access;

use app\core\account\AccountInterface;
use app\core\http\Request;
use app\core\routing\RouteMatch;
use app\core\routing\RouteMatchInterface;

/**
 * AccessChecker is responsible for managing access to modules ,route and the app as a whole
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AccessChecker
{

    /**
     * @var AccessCheckerCollector
     */
    private $checkerCollector;

    /**
     * @var AccountInterface
     */
    private $account;

    public function __construct(AccessCheckerCollector $checkerCollector, AccountInterface $account)
    {
        $this->checkerCollector = $checkerCollector;
        $this->account = $account;
    }

    /**
     * {@inheritdoc}
     */
    public function checkRequest(Request $request, AccountInterface $account = NULL, $return_as_object = FALSE)
    {
        $route_match = RouteMatch::createFromRequest($request);
        return $this->check($route_match, $account, $request, $return_as_object);
    }

    /**
     * {@inheritdoc}
     */
    public function check(RouteMatchInterface $route_match, AccountInterface $account = NULL, Request $request = NULL, $return_as_object = FALSE)
    {
        if (!isset($account)) {
            $account = $this->account;
        }
        $route = $route_match->getRouteObject();
//        dump($route);
        $checkers = $route->getOption('_access_checks') ?: array();
        // Filter out checks which require the incoming request.
        if (!isset($request)) {
            $checkers = array_diff($checkers, $this->checkProvider->getChecksNeedRequest());
        }
        $result = AccessResult::neutral();
        if (!empty($checkers)) {
//      $arguments_resolver = $this->argumentsResolverFactory->getArgumentsResolver($route_match, $account, $request);
            if (!$checkers) {
                return AccessResult::neutral();
            }
            $result = AccessResult::allowed();
            foreach ($checkers as $checker) {
                $result = $result->andIf($this->performCheck($checker, [$route, $account]));
            }
        }
        return $return_as_object ? $result : $result->isAllowed();
    }

    public function performCheck($checker, $arguments)
    {
        $callable = $this->checkerCollector->loadCheck($checker);
//    $arguments = $arguments_resolver->getArguments($callable);
        /** @var \app\Core\Access\AccessResultInterface $service_access * */
        $service_access = call_user_func_array($callable, $arguments);
        if (!$service_access instanceof AccessResultInterface) {
            throw new AccessException("Access error in $checker. Access services must return an object that implements AccessResultInterface.");
        }

        return $service_access;
    }

}
