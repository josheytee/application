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
    protected $template = 'layout/region.tpl';
    protected $theme_manager;
    protected $component_manager;
    protected $tag = 'div';

    public function __construct(ComponentManager $component_manager, ThemeManager $theme_manager) {

        $this->component_manager = $component_manager;
        $this->theme_manager = $theme_manager;
    }

    function setTemplate($template) {
        $this->template = $template;
        return $this;
    }

    public function getComponents() {
        return $this->component_manager->getComponents();
    }

    public function getThemeConfig() {
        $this->theme_manager->getActiveTheme()->getConfig();
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
        dump($this->getThemeConfig());
        $byRegion = $this->component_manager->getByRegion($region);
        $markup = '';
//        dump($byRegion);
        foreach ($byRegion as $key => $component) {
            $markup .= $component->render();
        }
        $assign = [
            'attributes' => 'class="lead"',
            'content' => $markup
        ];
        return $this->rendertrait($assign, 'layout/region.tpl');

    }

}