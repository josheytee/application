<?php

namespace ntc\block;

use app\core\component\ComponentManager;
use app\core\config\ConfigManager;
use app\core\http\Request;
use app\core\template\Displayable;
use app\core\theme\ThemeManager;
use app\core\view\Renderable;

/**
 * Description of TemplateSkeleton
 *
 * @author adapter
 */
class BlockManager implements Renderable
{

    protected $default_regions;

    use Displayable;
    protected $regions;
    /**
     * @var ComponentManager
     */
    private $component_manager;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var ConfigManager
     */
    private $config;
    /**
     * @var ThemeManager
     */
    private $theme;

    public function __construct(Request $request, ThemeManager $theme, ComponentManager $component_manager, ConfigManager $config = null)
    {

        $this->theme = $theme;
        $this->config = $config;
        $this->default_regions = $this->theme->getActiveTheme()->getRegions();
        $this->request = $request;
        $this->component_manager = $component_manager;
    }

    public function getRegions()
    {
//    $user_region = $this->config->get('user.regions');
//    return array_merge($this->default_regions, $user_region);
        return $this->default_regions;
    }

    public function setContainerContent($container_content)
    {
        $this->container_content = $container_content;
        return $this;
    }

    public function render()
    {
        if ($this->isAdminRequest()) {
            $this->initAdmin();
        } else {
            $this->init();
        }
        return $this->display(['regions' => $this->regions], 'layout/html.tpl');
    }

    public function isAdminRequest()
    {
        return $this->request->isAdmin();
    }

    public function initAdmin()
    {
        $this->regions['container'] = new Block('container', $this->getContainerContent());
    }

    public function getContainerContent()
    {
        return $this->container_content;
    }

    public function init()
    {
//    foreach ($this->getRegions() as $region) {
//      $this->regions[$region] = new Block($region);
//    }
        $this->regions['container'] = new Block('container', $this->getContainerContent());
    }

    public function generateResponse($result, $request)
    {
        $this->component_manager;
    }

}
