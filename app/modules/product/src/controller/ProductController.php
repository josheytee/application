<?php

namespace ntc\product\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\http\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProductController extends ControllerBase
{
    /**
     * @var ComponentManager
     */
    private $componentManager;

    public function __construct(ComponentManager $componentManager)
    {
        $this->componentManager = $componentManager;
    }

    public static function inject(ContainerInterface $container)
    {
        return new static($container->get('component.manager'));
    }

    public function index(Request $request, $url)
    {
        $components = $this->componentManager->getTargetComponents('product');
        $product_component = '';
        foreach ($components as $component) {
            $product_component .= $component->renderComponent($request);
        }
        return $this->render('ntc/product/single', ['output' => $product_component]);
    }

}