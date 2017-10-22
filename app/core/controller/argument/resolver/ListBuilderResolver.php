<?php

namespace app\core\controller\argument\resolver;

use app\core\view\listing\ListBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

/**
 * FormBuilderResolver adds FormBuilder to the controller method argument
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
final class ListBuilderResolver implements ArgumentValueResolverInterface
{

    /**
     * {@inheritdoc}
     */
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return ListBuilder::class === $argument->getType() || is_subclass_of($argument->getType(), ListBuilder::class);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        yield new ListBuilder();
    }

}
