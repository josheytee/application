<?php

namespace app\core\access;

use app\core\http\Request;
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

    public function __construct(AccessCheckerCollector $checkerCollector)
    {
        $this->checkerCollector = $checkerCollector;
    }


    /**
     * {@inheritdoc}
     */
    public function check(RouteMatchInterface $route_match)
    {
    }


    public function checkRequest(Request $request, $account)
    {
        foreach ($this->checkerCollector->getSortedCheckers() as $priority => $checker) {
            $checker->check($request, $account);
        }
    }

}
