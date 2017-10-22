<?php

namespace ntc\component\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\http\Request;
use app\core\theme\ThemeManager;
use app\core\view\form\Formbuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of ComponentController
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentController extends ControllerBase
{
    /**
     * @var ComponentManager
     */
    private $componentManager;
    /**
     * @var ThemeManager
     */
    private $theme;

    public function __construct(ComponentManager $componentManager, ThemeManager $theme)
    {
        $this->componentManager = $componentManager;
        $this->theme = $theme;
    }

    public static function inject(ContainerInterface $container)
    {
        return new static(
            $container->get('component.manager'),
            $container->get('theme.manager')
        );
    }

    public function index()
    {
//    dump(base64_encode('ntc\product\single'));
//    dump(base64_decode('bnRjXHByb2R1Y3Rcc2luZ2xl'));
        $components = $this->componentManager->getComponents();
        return $this->renderCustom(__DIR__ . '/../../templates/components.tpl', compact('components'));
    }

    public function single(Request $request, Formbuilder $builder, $id)
    {
        $component = $this->componentManager->getComponent($id);
//        return $this->renderCustom(__DIR__ . '/../../templates/component.tpl', compact('component'));
        return ['content' => $component->renderConfig($request, $builder)];
    }

    public function configure(Request $request, Formbuilder $builder, $id)
    {
        //open config
        //edit it
        //close it
        $activeTheme = $this->theme->getActiveTheme();
//        dump($activeTheme->getConfig('regions'));
        $component = $this->componentManager->getComponent($id);
//        dump($component);
//        dump($component->renderConfig($request, $builder));
        return ['content' => $component->renderConfig($request, $builder)];
    }


}
