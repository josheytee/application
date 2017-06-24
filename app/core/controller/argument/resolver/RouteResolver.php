<?php

namespace app\core\controller\argument\resolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

/**
 * Description of newPHPClass
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
final class RouteResolver implements ArgumentValueResolverInterface {

  public function supports(Request $request, ArgumentMetadata $argument): bool {
    return true;
  }

  public function resolve(Request $request, ArgumentMetadata $argument): \Generator {

    yield $request;
  }

}
