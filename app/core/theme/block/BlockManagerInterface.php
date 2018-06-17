<?php

namespace app\core\theme\block;

use app\core\http\Request;
use app\core\routing\RouteMatchInterface;
use app\core\view\Renderable;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface BlockManagerInterface extends Renderable
{
    public function generateResponse($result,Request $request,RouteMatchInterface $route_match);
}
