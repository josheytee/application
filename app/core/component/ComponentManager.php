<?php

namespace app\core\component;

use app\core\theme\ThemeManager;

/**
 * Description of ComponentProvider
 *
 * @author adapter
 */
class ComponentManager
{

    /**
     * @var ComponentInitializer
     */
    private $initializer;

    /**
     * @var ThemeManager
     */
    private $theme;

    public function __construct(ComponentInitializer $initializer, ThemeManager $theme)
    {
        $this->theme = $theme;
        $this->initializer = $initializer;
    }

    public function getRegionComponents($region)
    {
        $components = $this->getComponents();
        $config = $this->getThemeConfig('regions')[$region] ?? [];
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

    public function getComponents()
    {
        return ($this->initializer->getComponents());
    }

    public function getThemeConfig($key = null)
    {
        return $key ?
            $this->theme->getActiveTheme()->getConfig($key) :
            $this->theme->getActiveTheme()->getConfig();

    }

    public function setThemeConfig($key, $value)
    {

    }

    public function getTargetComponents($target)
    {
        $components = [];
        foreach ($this->getComponents() as $id => $component) {
            if ($component->getTarget() == $target) {
                $components[$id] = $component;
            }
        }
        return $components;
    }

    public function getComponent($component, $encoded = true)
    {
        return $encoded ? $this->getComponents()[base64_decode($component)] : $this->getComponents()[$component];
    }
}
