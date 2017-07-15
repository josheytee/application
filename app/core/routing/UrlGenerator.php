<?php

namespace app\core\routing;

use app\core\routing\RouteProvider;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Generator\UrlGenerator as BaseUrlGenerator;

/**
 * Description of UrlGenerator
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class UrlGenerator extends BaseUrlGenerator {

  public function __construct(RouteProvider $route_provider, RequestContext $request_context) {

    parent::__construct($route_provider->getRoutes(), $request_context);
  }

}
