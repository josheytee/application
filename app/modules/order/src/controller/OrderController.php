<?php

namespace ntc\order\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\http\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class OrderController extends ControllerBase
{
    private $componentManager;

    public function __construct(ComponentManager $componentManager)
    {
        $this->componentManager = $componentManager;
    }

    public static function inject(ContainerInterface $container)
    {
        return new static($container->get('component.manager'));
    }

    public function index(Request $request, $step)
    {
        $components = '';
        $defaultSteps = ['ntc\order\cart', 'ntc\account\account', 'ntc\account\address', 'ntc\carrier\shipping', 'ntc\payment\payment'];
        if ($this->currentUser()->id() > 0)
            $defaultSteps = ['ntc\order\cart', 'ntc\account\address', 'ntc\carrier\shipping', 'ntc\payment\payment'];

        $component = $this->componentManager->getComponent($defaultSteps[$step], false);
        $components = $component->renderComponent($request);

        return $this->render('ntc/output', ['output' => $components]);
    }

}
