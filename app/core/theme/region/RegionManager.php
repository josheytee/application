<?php

namespace app\core\theme\region;

use app\core\component\ComponentManager;
use app\core\theme\ThemeManager;
use app\core\utility\ArrayHelper;
use app\core\view\Renderabletrait;

/**
 * Description of Region
 *
 * @author adapter
 */
class RegionManager implements RegionManagerInterface {

    use Renderabletrait;
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

    public function __construct(ComponentManager $component_manager, ThemeManager $theme_manager) {

        $this->component_manager = $component_manager;
        $this->theme_manager = $theme_manager;
        $this->activeTheme = $theme_manager->getActiveTheme();

    }

    function setTemplate($template) {
        $this->template = $template;
        return $this;
    }

    public function getComponents() {
        return $this->component_manager->getComponents();
    }

    public function setMax($max) {
        $this->max = $max;
        return $this;
    }

    /**
     * @param $region
     * @return null
     */
    public function getContent($region) {
        $components = $this->component_manager->getRegionComponents($region);
        $markup = '';
        foreach ($components as $component) {
            $markup .= $component->renderComponent($this->activeTheme);
        }
        $assign = [
//            'attributes' => 'class="lead"',
            'content' => $markup
        ];
        $baseTheme = $this->activeTheme->getBaseThemes();
//        dump($baseTheme);
        if (isset($baseTheme)) {
            $template = $baseTheme;
            if (!empty($this->rendertrait($assign, "layout/page__{$template}")))
                return $this->rendertrait($assign, "layout/page__{$template}");
        }


        return $this->rendertrait($assign, 'layout/region');

    }

}