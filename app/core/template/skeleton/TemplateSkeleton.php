<?php

namespace app\core\template\skeleton;

use app\core\template\skeleton\RegionCollection;
use app\core\template\skeleton\Region;
use Symfony\Component\HttpFoundation\Response;
use app\core\theme\ThemeManager;

/**
 * Description of TemplateSkeleton
 *
 * @author adapter
 */
class TemplateSkeleton extends Response {

    protected $template_engine;
    protected $region_collection;
    protected $theme_handler;
    protected $container_content;

    function __construct($container) {
        $this->template_engine;
        $this->theme_handler;
        $this->container_content = $container;
        parent::__construct($this->process());
    }

    function addRegion($region) {
        $this->region_collection = $region;
        return $this;
    }

    public function getActiveThemeRegions() {
        return (new ThemeManager())->getThemeData('system')['regions'];
    }

    public function process() {
        $rc = new RegionCollection();
        foreach ($this->getActiveThemeRegions() as $key => $value) {
            if ($key !== 'container') {
                $rc->add($key, new Region($key));
            }
        }
        $rc->add('container', new ContainerRegion('container', $this->container_content));
//        var_dump($rc);
        return $rc->getContent();
    }

}
