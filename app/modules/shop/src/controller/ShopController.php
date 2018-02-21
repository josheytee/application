<?php

namespace ntc\shop\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\http\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of ShopController
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ShopController extends ControllerBase
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

    public function index(Request $request)
    {
        $components = $this->componentManager->getTargetComponents('shop');
        $shop_components = '';
        foreach ($components as $component) {
            $shop_components .= $component->renderComponent($request);
        }
        return $this->render('ntc/shop/index', ['output' => $shop_components]);
    }

    public function home(Request $request)
    {
        dump($this->componentManager->getTargetComponents('shop'));
    }

}
