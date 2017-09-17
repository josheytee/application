<?php

namespace app\core\controller\argument\resolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use app\core\routing\RouteMatchInterface;
use app\core\routing\RouteMatch;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

/**
 * Description of RouteMatchResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class RouteMatchResolver implements ArgumentValueResolverInterface {

  public function resolve(Request $request, ArgumentMetadata $argument): \Generator {
    yield RouteMatch::createFromRequest($request);
  }

  public function supports(Request $request, ArgumentMetadata $argument): bool {
    return ($argument->getName() == RouteMatchInterface::class) || is_subclass_of($argument->getName(), RouteMatchInterface::class);
  }

}
