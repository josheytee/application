<?php

namespace ntc\shop\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\entity\Shop;
use app\core\http\Request;
use app\core\repository\ModuleRepository;
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
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository, ComponentManager $componentManager)
    {
        $this->componentManager = $componentManager;
        $this->moduleRepository = $moduleRepository;
    }

    public static function inject(ContainerInterface $container)
    {
        return new static($container->get('module.repository'), $container->get('component.manager'));
    }

    public function index(Request $request, $shop_url)
    {
        $shop_components = '';
        $shop = Shop::where('url', $shop_url)->first();
        $default = $this->moduleRepository->getRepository('ntc\shop')->getCustom('default');
        if (is_array($shop->components)) {
            $default['components'] = $shop->components;
        }
        foreach ($default['components'] as $key) {
            $component = $this->componentManager->getComponent($key, 0);
            $shop_components .= $component->renderComponent($request);
        }
        return $this->render('ntc/output', ['output' => $shop_components]);
    }

    public function home(Request $request)
    {
        dump($this->componentManager->getTargetComponents('shop'));
    }

    public function getTitle($shop_url){
        return "ntc | $shop_url";
    }

}
