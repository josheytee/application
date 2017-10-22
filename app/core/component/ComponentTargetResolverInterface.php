<?php

namespace app\core\component;

use app\core\routing\RouteMatchInterface;

/**
 *
 * @author  Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface ComponentTargetResolverInterface
{

    public function appliesTo(RouteMatchInterface $route_match);

    public function resolveTarget(RouteMatchInterface $route_match);
}
