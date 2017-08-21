<?php

namespace app\core\routing;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface AccessAwareRouterInterface extends RouterInterface, RequestMatcherInterface {

}
