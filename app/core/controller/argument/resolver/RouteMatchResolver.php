<?php

namespace app\core\controller\argument\resolver;

use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use app\core\routing\RouteMatchInterface;
use app\core\routing\RouteMatch;

/**
 * Description of RouteMatchResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class RouteMatchResolver implements ArgumentValueResolverInterface {

  public function resolve(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata $argument): \Generator {
    yield RouteMatch::createFromRequest($request);
  }

  public function supports(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata $argument): bool {
    return ($argument->getName() == RouteMatchInterface::class) || is_subclass_of($argument->getName(), RouteMatchInterface::class);
  }

}
