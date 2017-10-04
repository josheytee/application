<?php

namespace app\core\view\block;

use app\core\config\ConfigManager;
use app\core\http\Request;
use app\core\http\Response;
use app\core\routing\RouteMatchInterface;
use app\core\theme\region\RegionManager;
use app\core\theme\ThemeManager;
use app\core\view\Renderable;
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

    public function render($page, RouteMatchInterface $routeMatch) {
        if ($routeMatch->getRouteObject()->hasOption('module')) {
            $template = $routeMatch->getRouteObject()->getOption('module');
            if (!empty($this->rendertrait(['page' => $page], "layout/page__{$template}")))
                return $this->rendertrait(['page' => $page], "layout/page__{$template}");
        }

        return $this->rendertrait(['page' => $page], 'layout/page.tpl');
    }

    public function generateResponse($result, Request $request, RouteMatchInterface $routeMatch) {
        $page = null;
        foreach ($this->default_regions as $region) {
//      if (!empty($page[$region])) {
//      $page[$region]['#theme_wrappers'][] = 'region';
            $page[$region] = $this->region_manager->getContent($region);
//      }
        }
//    $libraries = $result['libraries'];
        $page['content'] = $result['content'];

        $response = new Response($this->render($page, $routeMatch));
        return $response;
    }

}
