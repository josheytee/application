<?php

namespace ntc\product\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\http\Request;
use app\core\repository\ModuleRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProductController extends ControllerBase
{
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
        return new static(
            $container->get('module.repository'),
            $container->get('component.manager')
        );
    }

    public function index(Request $request, $shop_url, $product_id, $product_url)
    {
        $product_components = '';

//        $shop = Shop::where('url', $shop_url)->first();
        $default = $this->moduleRepository->getRepository('ntc\product')->getCustom('default');
//        if (is_array($shop->components)) {
//            $default['index'] = $shop->components;
//        }
        foreach ($default['index'] as $key) {
            $component = $this->componentManager->getComponent($key, 0);
            $product_components .= $component->renderComponent($request);
        }
        return $this->render('ntc/output', ['output' => $product_components]);
    }

}