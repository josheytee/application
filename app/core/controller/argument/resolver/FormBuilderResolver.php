<?php

namespace app\core\controller\argument\resolver;

use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use app\core\view\form\Formbuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

/**
 * FormBuilderResolver adds FormBuilder to the controller method argument
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
final class FormBuilderResolver implements ArgumentValueResolverInterface {

  /**
   * {@inheritdoc}
   */
  public function supports(Request $request, ArgumentMetadata $argument) {
    return Formbuilder::class === $argument->getType() || is_subclass_of($argument->getType(), Formbuilder::class);
  }

  /**
   * {@inheritdoc}
   */
  public function resolve(Request $request, ArgumentMetadata $argument) {
    yield new Formbuilder();
  }

}
