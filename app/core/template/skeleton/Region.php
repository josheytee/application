<?php

namespace app\core\template\skeleton;

use app\core\component\Component;
use app\core\component\ComponentProvider;
use app\core\theme\ThemeManager;
use app\core\template\skeleton\RegionInterface;

/**
 * Description of Region
 *
 * @author adapter
 */
class Region implements RegionInterface {

    use \app\core\template\Displayable;

    protected $name;
    protected $content;
    //maximum number of components allowed
    protected $max;
    protected $components = [];
    protected $components_path = [];
    protected $template = 'layout/region.tpl';
    protected $theme_manager;
    protected $component_provider;

    public function __construct($name) {
        $this->name = $name;
        $this->initialize();
    }

    function setTemplate($template) {
        $this->template = $template;
        return $this;
    }

    public function getComponents() {
        return $this->components;
    }

    /**
     *
     * @param Component $components
     * @return $this
     * @throws \Exception
     */
    public function addComponents(Component $components) {
        if (count($this->components) > $this->max) {
            throw new \Exception('Components exceed max components allowed');
        }
        $this->components[] = $components;
        return $this;
    }

    public function setMax($max) {
        $this->max = $max;
        return $this;
    }

    public function initialize() {
        $this->theme_manager = new ThemeManager();
        $this->component_provider = new ComponentProvider();
        $this->content[$this->name] = '';
    }

    public function getContent() {
        foreach ($this->component_provider->getRegionComponents($this->name) as $component => $path) {

            if ($this->name !== 'container' && file_exists($path . DS . ucwords($component) . '.php')) {
                require_once $path . DS . ucwords($component) . '.php';
                $this->content[$this->name] .= (new $component())->renderComponent();
            }
        }
        return $this->display(['region_content' => $this->content[$this->name]], 'layout/region.tpl');
    }

}
