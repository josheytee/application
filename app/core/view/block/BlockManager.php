<?php

namespace app\core\view\block;

use app\core\theme\region\RegionManager;
use app\core\view\Renderable;
use app\core\theme\ThemeManager;
use app\core\config\ConfigManager;
use app\core\http\Response;
use app\core\component\ComponentManager;
use app\core\routing\RouteMatchInterface;
use app\core\view\Renderabletrait;

/**
 * Description of TemplateSkeleton
 *
 * @author adapter
 */
class BlockManager implements Renderable {

    use Renderabletrait;

    /**
     * @var ConfigManager
     */
    private $config;

    /**
     * @var ThemeManager
     */
    private $theme;
    protected $default_regions;
    protected $regions;
    /**
     * @var RegionManager
     */
    private $region_manager;

    public function __construct(ThemeManager $theme, RegionManager $region_manager, ConfigManager $config = null) {

        $this->theme = $theme;
        $this->config = $config;
        $this->default_regions = $this->theme->getActiveTheme()->getRegions();
        $this->region_manager = $region_manager;
    }

    public function render($request) {
        return $this->rendertrait(['page' => $request], 'layout/page.tpl');
    }

    public function generateResponse($result, $request, RouteMatchInterface $route_match) {
//    $route_match;
//    $components = $this->component_manager->getComponents();
        $page = null;
        foreach ($this->default_regions as $region) {
//      if (!empty($page[$region])) {
//      $page[$region]['#theme_wrappers'][] = 'region';
            $page[$region] = $this->region_manager->getContent($region);
//      }
        }
//    $libraries = $result['libraries'];
        $page['content'] = $result['content'];

        $response = new Response($this->render($page));
        return $response;
    }

}
