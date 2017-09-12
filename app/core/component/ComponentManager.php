<?php

namespace app\core\component;

use app\core\theme\ThemeManager;
use app\core\component\ComponentInitializer;

/**
 * Description of ComponentProvider
 *
 * @author adapter
 */
class ComponentManager {

    /**
     * @var ComponentInitializer
     */
    private $initializer;

    /**
     * @var ThemeManager
     */
    private $theme;

    public function __construct(ComponentInitializer $initializer, ThemeManager $theme) {
        $this->theme = $theme;
        $this->initializer = $initializer;
    }

    public function getComponents() {
        return ($this->initializer->getComponents());
    }

    public function getByRegion($region) {
        $region_com = [];
//        dump($this->getComponents());
        foreach ($this->getComponents() as $component) {
            if ($component->region == $region) {
                $region_com[$component->name] = $component;
            }
        }
        return $region_com;
    }

}
