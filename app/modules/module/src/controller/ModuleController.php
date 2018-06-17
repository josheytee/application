<?php

namespace ntc\module\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\http\Request;
use app\core\repository\ModuleRepository;
use app\core\theme\ThemeManager;
use app\core\view\form\Formbuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of ComponentController
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ModuleController extends ControllerBase
{
    /**
     * @var ComponentManager
     */
    private $componentManager;
    /**
     * @var ThemeManager
     */
    private $theme;
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository, ComponentManager $componentManager, ThemeManager $theme)
    {
        $this->componentManager = $componentManager;
        $this->theme = $theme;
        $this->moduleRepository = $moduleRepository;
    }

    public static function inject(ContainerInterface $container)
    {
        return new static($container->get('module.repository'), $container->get('component.manager'), $container->get('theme.manager'));
    }

    public function index()
    {
//        foreach ($this->moduleRepository->getRepositories() as $repository => $handler) {
//            Module::create(array_diff_key($handler->getInfo(),['theme'=>'','configure'=>'','type'=>'module']));
//        }
        $repositories = [];
        foreach ($this->moduleRepository->getRepositories() as $repository => $handler) {
            $repositories[$repository] = $handler->getInfo();
        }

        return $this->render('ntc/module/index', compact('repositories'));
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
