<?php

namespace app\core\view\block;

use app\core\view\Renderable;
use app\core\routing\RouteMatchInterface;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface BlockManagerInterface extends Renderable {

  public function init();

  public function generateResponse($result, $request, RouteMatchInterface $route_match);
}
