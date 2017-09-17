<?php

namespace app\core\component;

use app\core\theme\ThemeManager;

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

    public function getThemeConfig($region = '') {
        return $this->theme->getActiveTheme()->getConfig('regions')[$region] ?? [];
    }


    public function getRegionComponents($region) {
        $components = $this->getComponents();
        $config = $this->getThemeConfig($region) ?? [];
        $flip = array_flip($config);
//        dump($components);
//        $c = 0;
//        $in = array_sort(array_intersect_key($components, $flip), function ($v, $i) use ($c, $config) {
//            dump($i);
//            if ($config[$c] > $i)
//                return 1;
//            $c++;
//            return ($config[$c] < $i) ? -1 : 0;
//        });
//        dump($in);
//        dump( array_intersect_key($components, $flip));
        return array_intersect_key($components, $flip);

    }
}
