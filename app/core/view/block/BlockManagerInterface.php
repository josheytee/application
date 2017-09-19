<?php

namespace app\core\view\block;

use app\core\view\Renderable;
use app\core\routing\RouteMatchInterface;
use app\core\http\Request;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface BlockManagerInterface extends Renderable {

  public function init();

  public function generateResponse($result, Request $request, RouteMatchInterface $route_match);
}
