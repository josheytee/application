<?php

namespace ntc\section\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\entity\Section;
use app\core\entity\Shop;
use app\core\http\Request;
use app\core\repository\ModuleRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SectionController extends ControllerBase
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
        return new static(
            $container->get('module.repository'),
            $container->get('component.manager')
        );
    }

    public function index(Request $request, $shop_url)
    {
        $shop_components = '';

        $shop = Shop::where('url', $shop_url)->first();
        $default = $this->moduleRepository->getRepository('ntc\section')->getCustom('default');
        if (is_array($shop->components)) {
            $default['index'] = $shop->components;
        }
        foreach ($default['index'] as $key) {
            $component = $this->componentManager->getComponent($key, 0);
            $shop_components .= $component->renderComponent($request);
        }
        return $this->render('ntc/output', ['output' => $shop_components]);
    }

    public function single(Request $request, $shop_url, $section_url)
    {
        $shop_components = '';

        $shop = Shop::where('url', $shop_url)->first();
        $section = Section::where('url', $section_url)->where('shop_id', $shop->id)->first();
        $default = $this->moduleRepository->getRepository('ntc\section')->getCustom('default');
        if (isset($section->components) && is_array($section->components)) {
            $default['single'] = $section->components;
        }
        foreach ($default['single'] as $key) {
            $component = $this->componentManager->getComponent($key, 0);
            $shop_components .= $component->renderComponent($request);
        }
        return $this->render('ntc/output', ['output' => $shop_components]);
    }

}