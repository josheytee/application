<?php

namespace app\core\theme\region;

use app\core\component\ComponentManager;
use app\core\http\Request;
use app\core\theme\ThemeManager;
use app\core\utility\ArrayHelper;
use app\core\view\RenderableTrait;

/**
 *
 * @author adapter
 */
class RegionManager implements RegionManagerInterface
{

    use RenderableTrait;
    use ArrayHelper;

    protected $name;
    protected $content;
    //maximum number of components allowed
    protected $max;
    protected $components = [];
    protected $components_path = [];
    protected $template = 'layout/region';
    protected $theme_manager;
    protected $component_manager;
    protected $tag = 'div';
    protected $activeTheme;

    public function __construct(ComponentManager $component_manager, ThemeManager $theme_manager)
    {

        $this->component_manager = $component_manager;
        $this->theme_manager = $theme_manager;
        $this->activeTheme = $theme_manager->getActiveTheme();

    }

    function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function getComponents()
    {
        return $this->component_manager->getComponents();
    }

    public function setMax($max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @param Request $request
     * @param $region
     * @return null
     */
    public function getContent(Request $request, $region)
    {
        $components = $this->component_manager->getRegionComponents($region);
        $markup = [];
        foreach ($components as $id => $component) {
            $markup[$id] = $component->renderComponent($request, $region);
        }
        return $this->renderTrait(['components' => $markup], 'layout/region');

    }

}